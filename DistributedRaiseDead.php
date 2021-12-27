<?php

use malmax\ExecutionMode;
use malmax\PHPAnalyzer;
use AnimateDead\Utils;
use AnimateDead\LogParser;
use AnimateDead\Request2FS;

ini_set("memory_limit",-1);
require __DIR__.'/vendor/autoload.php';
define('DISTRIBUTED', true);
include 'RaiseDead.php';
include 'ReanimationState.php';

function raise_the_dead(array $options, $reanimation_callback_object=null) {
    // Parse logs
    $application_root_dir = $options['root_dir'];
    $uri_prefix = $options['uri_prefix'];
    $flows = [];
    if (isset($options['ip_address'])) {
        $filter_ip = $options['ip_address'];
    }
    else {
        $filter_ip = '';
    }
    // Normal logs
    if (isset($options['log'])) {
        $log_file_path = $options['log'];
        $flows = parse_logs($log_file_path, $application_root_dir, $uri_prefix, $filter_ip);
        foreach ($flows as $flow) {
            foreach ($flow as $log_entry) {
                $verb = $log_entry->verb;
                $target_file = $log_entry->target_file;
                $status_code = $log_entry->status;
                $parameters = $log_entry->query_string_array;
                $referer = $log_entry->referer;

                $init_env['_SESSION'] = [];
                $init_env['_COOKIE'] = [];
                $init_env['_SERVER']['REQUEST_METHOD'] = $verb;
                $init_env['_GET'] = $parameters ?? [];
                $init_env['_SERVER']['HTTP_REFERER'] = $referer;
                start_engine($init_env, $verb, $target_file, $reanimation_callback_object, null, null, 0, 4, false);
            }
        }
    }
    else {
        $log_file_path = $options['extended_logs'];
        $flows = parse_extended_logs($log_file_path);
        $session_variables = [];
        $cookies = [];
        foreach ($flows as $log_entry) {
            $verb = $log_entry['request_method'];
            $target_file = $options['root_dir'] . $log_entry['script_filename'];
            // Removing non utf characters
            array_walk($log_entry['session'], function(&$value, $key) {
                $value = 'dummy';
            });
            $referer = $log_entry->referer;
            array_walk($log_entry['cookie'], function(&$value, $key) {
                $value = 'dummy';
            });
            $init_env['_SESSION'] = $log_entry['session'] ?? [];
            $init_env['_COOKIE'] = $log_entry['cookie'] ?? [];
            $init_env['_SERVER']['REQUEST_METHOD'] = $verb;
            $init_env['_SERVER']['HTTP_REFERER'] = $referer;
            $init_env['_GET'] = $log_entry['get'] ?? [];
            $init_env['_POST'] = $log_entry['post'] ?? [];
            $init_env['_REQUEST'] = array_merge($init_env['_GET'], $init_env['_POST'], $init_env['_COOKIE']);
            start_engine($init_env, $verb, $target_file, $reanimation_callback_object, $options['reanimationarray'] ?? [], $options['verbosity']);
        }
    }
}

function reanimate(ReanimationState $reanimationState, IAnimateDeadWorker $reanimation_callback_object) {
    start_engine($reanimationState->init_env, $reanimationState->httpverb, $reanimationState->targetfile, $reanimation_callback_object, $reanimationState->reanimation_array);
}

function start_engine($init_env, $httpverb, $targetfile, $reanimation_callback_object=null, $reanimation_array=null, $correlation_id='dummy', $execution_id=0, $verbosity=4) {
    // Load config file
    Utils::$PATH_PREFIX = include('lib/AnimateDead/env.php');
    $config_file_path = Utils::get_default_config();
    $init_env = array_merge_recursive($init_env, Utils::load_config($config_file_path));
    $predefined_constants = Utils::get_constants($config_file_path);
    $symbolic_functions = Utils::get_symbolic_functions($config_file_path);
    $input_sensitive_symbolic_functions = Utils::get_input_sensitive_symbolic_functions($config_file_path);
    $symbolic_methods = Utils::get_symbolic_methods($config_file_path);
    $symbolic_classes = Utils::get_symbolic_classes($config_file_path);
    $input_sensitive_symbolic_methods = Utils::get_input_sensitive_symbolic_methods($config_file_path);
    $symbolic_loop_iterations = Utils::get_symbolic_loop_iterations($config_file_path);

    $engine = new PHPAnalyzer($init_env, $httpverb, $predefined_constants, $reanimation_callback_object, $correlation_id);
    $engine->execution_mode = ExecutionMode::ONLINE;
    // Reanimation mode is enabled
    if (is_array($reanimation_array) && count($reanimation_array) > 0) {
        $engine->reanimate = true;
        $engine->reanimation_transcript = $reanimation_array;
    }
    $engine->direct_output = false;
    $engine->symbolic_loop_iterations = $symbolic_loop_iterations;
    $engine->verbose = 1;
    // Set engine's symbolic parameters
    $engine->symbolic_parameters = Utils::get_symbolic_parameters(strtoupper($httpverb), $config_file_path);
    $engine->symbolic_functions = $symbolic_functions;
    $engine->input_sensitive_symbolic_functions = $input_sensitive_symbolic_functions;
    $engine->symbolic_methods = $symbolic_methods;
    $engine->symbolic_classes = $symbolic_classes;
    $engine->input_sensitive_symbolic_methods = $input_sensitive_symbolic_methods;
    $engine->immutable_symbolic_variables = Utils::get_immutable_symbolic_variables($config_file_path);
    $engine->max_output_length = Utils::get_max_output_length($config_file_path);
    $engine->execution_id = $execution_id;
    // Set execution engine parameters
    $engine->concolic = true;
    $engine->diehard = false;
    echo sprintf('Now processing %s to %s'.PHP_EOL, $httpverb, $targetfile);
    // Execute script
    $engine->reanimation_state = new ReanimationState();
    try {
        $engine->start($targetfile);
    }
    catch (\Exception $e) {
        Utils::log_error($correlation_id, $e->getMessage());
        $engine->shutdown();
    } finally {
        // Write output to file
        Utils::append_reanimation_log('get_execution', $engine->full_reanimation_transcript);
        // Disable logging all the output text in a single file
        // file_put_contents(Utils::$PATH_PREFIX.$correlation_id.'_output.txt', $engine->output, FILE_APPEND);
        if (isset($engine->termination_reason)) {
            $engine->lineLogger->logTerminationReason($engine->termination_reason);
        }
        echo sprintf('Finished at [%s]'.PHP_EOL, date("h:i:sa"));
        return $engine->lineLogger->coverage_info;
    }
}
