<?php

use malmax\PHPAnalyzer;
use AnimateDead\Utils;
use AnimateDead\LogParser;
use AnimateDead\Request2FS;

ini_set("memory_limit",-1);
require __DIR__.'/vendor/autoload.php';

$usage='Usage: php RaiseDead.php -l access.log -r application/root/dir -u uri_prefix [-i ip_addr -v verbosity]'.PHP_EOL;
if (isset($argc))
{
    // Parse command line arguments
    $options=getopt('l:r:u:i:v',['log', 'root_dir', 'uri_prefix', 'ip_addr']);
    if (!isset($options['l']) || !isset($options['r']) || !isset($options['u']) || !isset($options['i'])) {
        die($usage);
    }
    // Load config file
    $config_file_path = 'config.json';
    $init_env = Utils::load_config($config_file_path);
    $predefined_constants = Utils::get_constants($config_file_path);
    $symbolic_parameters = Utils::get_symbolic_parameters($config_file_path);
    $symbolic_functions = Utils::get_symbolic_functions($config_file_path);
    $input_sensitive_symbolic_functions = Utils::get_input_sensitive_symbolic_functions($config_file_path);
    // Parse logs
    $log_file_path = $options['l'];
    $application_root_dir = $options['r'];
    $uri_prefix = $options['u'];
    if (isset($options['i'])) {
        $filter_ip = $options['i'];
    }
    else {
        $filter_ip = '';
    }
    $flows = parse_logs($log_file_path, $application_root_dir, $uri_prefix, $filter_ip);
    // Setup execution engine
    $session_variables = [];
    $cookies = [];
    // Clean up execution log
    file_put_contents('/mnt/c/Users/baminazad/Documents/Pragsec/autodebloating/malmax/index_logs.txt', '');
    foreach ($flows as $flow) {
        foreach ($flow as $log_entry) {
            $init_env['_SESSION'] = $session_variables;
            $init_env['_COOKIE'] = $cookies;
            $engine = new PHPAnalyzer($init_env, $predefined_constants);
            $engine->direct_output = false;
            // $engine->direct_output = true;
            if (isset($options['v'])) {
                $engine->verbose = $options['v'];
                // $engine->verbose = 4;
            }
            $verb = $log_entry->verb;
            $target_file = $log_entry->target_file;
            $status_code = $log_entry->status;
            $parameters = $log_entry->query_string_array;
            // Set execution engine parameters
            if (strcasecmp($verb, 'POST') === 0) {
                $engine->concolic = true;
                $engine->diehard = false;
                $engine->symbolic_parameters = $symbolic_parameters;
                $engine->symbolic_functions = $symbolic_functions;
                $engine->input_sensitive_symbolic_functions = $input_sensitive_symbolic_functions;
            }
            elseif (strcasecmp($verb, 'GET') === 0) {
                $engine->concolic = false;
                $engine->diehard = false;
            }
            else {
                throw new Exception($verb . ' VERB isb not supported.');
            }
            echo sprintf('Now processing %s to %s'.PHP_EOL, $verb, $target_file);
            // Execute script
            $engine->start($target_file);
            // Write output to file
            file_put_contents('/mnt/c/Users/baminazad/Documents/Pragsec/autodebloating/malmax/output.txt', $engine->output, FILE_APPEND);
            if ($engine->is_child) {
                // We don't want forked processes to work outside the context of a single request
                echo 'Child process finished.'.PHP_EOL;
                // var_dump($engine->variables['_SESSION']);
                // var_dump($engine->variables['_COOKIE']);
                break;
            }
            // Save $_SESSION variables
            var_dump($engine->variables['_SESSION']);
            var_dump($engine->variables['_COOKIE']);
            $session_variables = $engine->variables['_SESSION'];
            $cookies = $engine->variables['_COOKIE'];
        }
    }

}
else {
    die($usage);
}

function parse_logs(string $log_file_path, string $application_root_dir, string $uri_prefix, string $filter_ip='') {
    $log_parser = new LogParser(array($log_file_path));
    $log_parser->Parse();
    $request2fs = new Request2FS($application_root_dir, $uri_prefix);
    $log_lines = [];
    if ($filter_ip === '') {
        $flows = $log_parser->flow_aggregator->flows;
    }
    else {
        $flows = [$filter_ip];
    }
    foreach ($flows as $flow_ip) {
        foreach ($log_parser->flow_aggregator->flows[$flow_ip] as $flow_id => $log_entry) {
            if (@$request2fs->GetTargetFile($log_entry->path) !== null) {
                if (pathinfo($request2fs->GetTargetFile($log_entry->path), PATHINFO_EXTENSION) === 'php') {
                    $log_entry->SetTargetFile($request2fs->GetTargetFile($log_entry->path));
                    // $log_lines[$log_entry->path] = $log_entry->verb . ':' . $log_entry->target_file . ':' . $log_entry->status;
                    $log_lines[$log_entry->path] = $log_entry->target_file;
                } else {
                    // Remove log entry for static files
                    unset($log_parser->flow_aggregator->flows[$flow_ip][$flow_id]);
                }
            } else {
                // Remove log entry for other applications
                unset($log_parser->flow_aggregator->flows[$flow_ip][$flow_id]);
            }
        }
    }
    if ($filter_ip === '') {
        return $log_parser->flow_aggregator->flows[$filter_ip];
    }
    else {
        return $log_parser->flow_aggregator->flows;
    }
}