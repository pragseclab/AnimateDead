<?php

use malmax\ExecutionMode;
use malmax\PHPAnalyzer;
use AnimateDead\Utils;
use AnimateDead\LogParser;
use AnimateDead\Request2FS;

ini_set("memory_limit",-1);
require __DIR__.'/vendor/autoload.php';

$usage='Usage: php RaiseDead.php -l access.log -e extended_logs.log -r application/root/dir -u uri_prefix [-i ip_addr -v verbosity --reanimationpid pid]'.PHP_EOL;
if (isset($argc) && !defined('DISTRIBUTED'))
{
    // Parse command line arguments
    $options=getopt('l:r:u:i:e:::v::t:',['log:', 'root_dir:', 'uri_prefix:', 'ip_addr::', 'verbosity::', 'reanimationpid::']);
    if (((!isset($options['l']) && (!isset($options['e']))) || !isset($options['r']) || !isset($options['u']))) {
        die($usage);
    }
    // Load config file
    $config_file_path = 'config.json';
    $init_env = Utils::load_config($config_file_path);
    $predefined_constants = Utils::get_constants($config_file_path);
    $symbolic_functions = Utils::get_symbolic_functions($config_file_path);
    $input_sensitive_symbolic_functions = Utils::get_input_sensitive_symbolic_functions($config_file_path);
    $symbolic_methods = Utils::get_symbolic_methods($config_file_path);
    $symbolic_classes = Utils::get_symbolic_classes($config_file_path);
    $input_sensitive_symbolic_methods = Utils::get_input_sensitive_symbolic_methods($config_file_path);
    $symbolic_loop_iterations = Utils::get_symbolic_loop_iterations($config_file_path);
    $htaccess_bool = Utils::get_htaccess_bool($config_file_path);
    // Parse logs
    if (isset($options['l'])) {
        $log_file_path = $options['l'];
        $application_root_dir = $options['r'];
        $uri_prefix = $options['u'];
        if (isset($options['i'])) {
            $filter_ip = $options['i'];
        }
        else {
            $filter_ip = '';
        }
        $flows = parse_logs($log_file_path, $application_root_dir, $uri_prefix, $filter_ip, $htaccess_bool);
        // Setup execution engine
        $session_variables = [];
        $cookies = [];
        // Clean up execution log
        if (!isset($options['reanimationpid'])) {
            file_put_contents(Utils::$PATH_PREFIX . 'line_coverage_logs.txt', '');
            $reanimation_logs = glob(Utils::$PATH_PREFIX . 'reanimation_logs/*.txt');
            foreach ($reanimation_logs as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            $line_coverage_logs = glob(Utils::$PATH_PREFIX . 'line_coverage_logs/*.txt');
            foreach ($line_coverage_logs as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        foreach ($flows as $flow) {
            foreach ($flow as $log_entry) {
                $verb = $log_entry->verb;
                $target_file = $log_entry->target_file;
                $status_code = $log_entry->status;
                $parameters = $log_entry->query_string_array;

                $init_env['_SESSION'] = $session_variables;
                $init_env['_COOKIE'] = $cookies;
                $init_env['_SERVER']['REQUEST_METHOD'] = $verb;
                $init_env['_GET'] = $parameters ?? [];
                // $init_env['_POST'] = ['pma_username'=>'root',
                //                       'pma_password'=>'root',
                //                       'server'=>'1',
                //                       'target'=>'index.php',
                //                       'token'=>'53710afd53c4582d9c5210eb4d21ff47'];
                // $init_env['_REQUEST'] = ['pma_username'=>'root',
                //     'pma_password'=>'root',
                //     'server'=>'1',
                //     'target'=>'index.php',
                //     'token'=>'53710afd53c4582d9c5210eb4d21ff47'];
                $engine = new PHPAnalyzer($init_env, $predefined_constants);
                $engine->execution_mode = ExecutionMode::ONLINE;
                // Reanimation mode is enabled
                if (isset($options['reanimationpid'])) {
                    $engine->reanimate = true;
                    $engine->reanimation_transcript = Utils::load_reanimation_log($options['reanimationpid']);
                }
                $engine->direct_output = false;
                $engine->symbolic_loop_iterations = $symbolic_loop_iterations;
                // $engine->direct_output = true;
                if (isset($options['v'])) {
                    $engine->verbose = $options['v'];
                    // $engine->verbose = 4;
                }
                // Set engine's symbolic parameters
                $engine->symbolic_parameters = Utils::get_symbolic_parameters(strtoupper($log_entry->verb), false, $config_file_path);
                $engine->symbolic_functions = $symbolic_functions;
                $engine->input_sensitive_symbolic_functions = $input_sensitive_symbolic_functions;
                $engine->symbolic_methods = $symbolic_methods;
                $engine->symbolic_classes = $symbolic_classes;
                $engine->input_sensitive_symbolic_methods = $input_sensitive_symbolic_methods;
                $engine->immutable_symbolic_variables = Utils::get_immutable_symbolic_variables($config_file_path);
                $engine->max_output_length = Utils::get_max_output_length($config_file_path);
                // Set execution engine parameters
                $engine->concolic = true;
                $engine->diehard = false;
                // if (strcasecmp($verb, 'POST') === 0) {
                //     $engine->concolic = true;
                //     $engine->diehard = false;
                // }
                // elseif (strcasecmp($verb, 'GET') === 0) {
                //     $engine->concolic = true;
                //     $engine->diehard = false;
                // }
                // else {
                //     throw new Exception($verb . ' VERB isb not supported.');
                // }
                echo sprintf('Now processing %s to %s'.PHP_EOL, $verb, $target_file);
                // Execute script
                $engine->start($target_file);
                // Write output to file
                file_put_contents(Utils::$PATH_PREFIX.'_output.txt', $engine->output, FILE_APPEND);
                if (isset($engine->termination_reason)) {
                    $engine->lineLogger->logTerminationReason($engine->termination_reason);
                }
                if ($engine->is_child) {
                    // We don't want forked processes to work outside the context of a single request
                    echo 'Child process finished.'.PHP_EOL;
                    // var_dump($engine->variables['_SESSION']);
                    // var_dump($engine->variables['_COOKIE']);
                    break;
                }
                // Save $_SESSION variables
                // var_dump($engine->variables['_SESSION']);
                // var_dump($engine->variables['_COOKIE']);
                // $session_variables = $engine->variables['_SESSION'];
                // $cookies = $engine->variables['_COOKIE'];
            }
        }
    }
    else {
        // extended logs
        $log_file_path = $options['e'];
        $flows = parse_extended_logs($log_file_path);
        // Setup execution engine
        $session_variables = [];
        $cookies = [];
        // Clean up execution log
        if (!isset($options['reanimationpid'])) {
            file_put_contents(Utils::$PATH_PREFIX . 'line_coverage_logs.txt', '');
            $reanimation_logs = glob(Utils::$PATH_PREFIX . 'reanimation_logs/*.txt');
            foreach ($reanimation_logs as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            $line_coverage_logs = glob(Utils::$PATH_PREFIX . 'line_coverage_logs/*.txt');
            foreach ($line_coverage_logs as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }

        foreach ($flows as $log_entry) {
            $verb = $log_entry['request_method'];
            $target_file = $options['r'] . str_replace('/var/www/html/phpMyAdmin-4.7.0-all-languages', '', $log_entry['script_filename']) ;

            $init_env['_SESSION'] = $log_entry['session'] ?? [];
            $init_env['_COOKIE'] = $log_entry['cookie'] ?? [];
            $init_env['_SERVER']['REQUEST_METHOD'] = $verb;
            $init_env['_GET'] = $log_entry['get'] ?? [];
            $init_env['_POST'] = $log_entry['post'] ?? [];
            $init_env['_REQUEST'] = array_merge($init_env['_GET'], $init_env['_POST'], $init_env['_COOKIE']);
            $engine = new PHPAnalyzer($init_env, $predefined_constants);
            $engine->execution_mode = ExecutionMode::ONLINE;
            // Reanimation mode is enabled
            if (isset($options['reanimationpid'])) {
                $engine->reanimate = true;
                $engine->reanimation_transcript = Utils::load_reanimation_log($options['reanimationpid']);
            }
            $engine->direct_output = false;
            $engine->symbolic_loop_iterations = $symbolic_loop_iterations;
#            $engine->htaccess_bool  = $htaccess_bool;
            // $engine->direct_output = true;
            if (isset($options['v'])) {
                $engine->verbose = $options['v'];
                // $engine->verbose = 4;
            }
            // Set engine's symbolic parameters
            $engine->symbolic_parameters = Utils::get_symbolic_parameters(strtoupper($verb), true, $config_file_path);
            $engine->symbolic_functions = $symbolic_functions;
            $engine->input_sensitive_symbolic_functions = $input_sensitive_symbolic_functions;
            $engine->symbolic_methods = $symbolic_methods;
            $engine->symbolic_classes = $symbolic_classes;
            $engine->input_sensitive_symbolic_methods = $input_sensitive_symbolic_methods;
            $engine->immutable_symbolic_variables = Utils::get_immutable_symbolic_variables($config_file_path);
            $engine->max_output_length = Utils::get_max_output_length($config_file_path);
            // Set execution engine parameters
            $engine->concolic = true;
            $engine->diehard = false;
            // if (strcasecmp($verb, 'POST') === 0) {
            //     $engine->concolic = true;
            //     $engine->diehard = false;
            // }
            // elseif (strcasecmp($verb, 'GET') === 0) {
            //     $engine->concolic = true;
            //     $engine->diehard = false;
            // }
            // else {
            //     throw new Exception($verb . ' VERB isb not supported.');
            // }
            echo sprintf('Now processing %s to %s'.PHP_EOL, $verb, $target_file);
            // Execute script
            $engine->start($target_file);
            // Write output to file
            // file_put_contents(Utils::$PATH_PREFIX.'output.txt', $engine->output, FILE_APPEND);
            if (isset($engine->termination_reason)) {
                $engine->lineLogger->logTerminationReason($engine->termination_reason);
            }
            if ($engine->is_child) {
                // We don't want forked processes to work outside the context of a single request
                echo 'Child process finished.'.PHP_EOL;
                // var_dump($engine->variables['_SESSION']);
                // var_dump($engine->variables['_COOKIE']);
                break;
            }
            // Save $_SESSION variables
            // var_dump($engine->variables['_SESSION']);
            // var_dump($engine->variables['_COOKIE']);
            // $session_variables = $engine->variables['_SESSION'];
            // $cookies = $engine->variables['_COOKIE'];
        }
    }
}
elseif (!defined('DISTRIBUTED')) {
    die($usage);
}

function parse_extended_logs(string $log_file_path) {
    $lines = file($log_file_path);
    $log_entries = [];
    $serialized_entry = '';
    foreach ($lines as $line) {
        // $log_entries[] = json_decode($line, true);
        if (strpos($line, '----') === false) {
            $serialized_entry .= $line;
        }
        else {
             $log_entries[] = unserialize($serialized_entry);
            $serialized_entry = '';
        }
    }
    return $log_entries;
}

function parse_logs(string $log_file_path, string $application_root_dir, string $uri_prefix, string $filter_ip='', bool $htaccess_bool) {
    $log_parser = new LogParser(array($log_file_path));
    $log_parser->Parse($uri_prefix);
    $request2fs = new Request2FS($application_root_dir);
    $log_lines = [];
    if ($filter_ip === '') {
        $flows = $log_parser->flow_aggregator->flows;
    }
    else {
        $flows = [$filter_ip];
    }
    foreach ($flows as $flow_ip) {
        foreach ($log_parser->flow_aggregator->flows[$flow_ip] as $flow_id => $log_entry) {
            if (@$request2fs->GetTargetFile($log_entry->path, $htaccess_bool) !== null) {
                if (pathinfo($request2fs->GetTargetFile($log_entry->path, $htaccess_bool), PATHINFO_EXTENSION) === 'php') {
                    $log_entry->SetTargetFile($request2fs->GetTargetFile($log_entry->path,$htaccess_bool));
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
