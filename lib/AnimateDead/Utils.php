<?php

namespace AnimateDead;

use malmax\PHPAnalyzer;
use PHPEmul\ReanimationEntry;

Class Utils {

    public static $PATH_PREFIX = '/home/ubuntu/animate_dead/logs/';

    public static function load_config(string $config='config.json') {
        self::$PATH_PREFIX = include('env.php');
        $init_environ=[];
        $superglobals=array_flip(explode(",$",'_GET,$_POST,$_FILES,$_COOKIE,$_SESSION,$_SERVER,$_REQUEST,$_ENV,$GLOBALS'));
        foreach ($superglobals as $k=>$sg)
            if (isset($GLOBALS[$k]))
                $init_environ[$k]=&$GLOBALS[$k];
            else
                $init_environ[$k]=[];
        $init_environ['GLOBALS']=&$init_environ;
        // Read config from JSON
        $config = 'config.json';
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $init_environ['_SERVER']['SERVER_NAME'] = $config_json['server']['server_name'];
        $init_environ['_SERVER']['SERVER_ADDR'] = $config_json['server']['server_addr'];
        $init_environ['_SERVER']['GATEWAY_INTERFACE'] = $config_json['server']['gateway_interface'];
        $init_environ['_SERVER']['SERVER_SOFTWARE'] = $config_json['server']['server_software'];
        $init_environ['_SERVER']['SERVER_PROTOCOL'] = $config_json['server']['server_protocol'];
        $init_environ['_SERVER']['SERVER_ADMIN'] = $config_json['server']['server_admin'];
        $init_environ['_SERVER']['SERVER_PORT'] = $config_json['server']['server_port'];
        $init_environ['_SERVER']['SERVER_SIGNATURE'] = $config_json['server']['server_signature'];
        return $init_environ;
    }
    public static function get_constants(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $defined_constants = unserialize(file_get_contents($config_json['constants']), ['allowed_classes' => false]);
        return $defined_constants;
    }
    public static function get_symbolic_parameters(string $method='POST', string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_parameters = $config_json['symbolic_parameters'];
        if (in_array($method, ['GET', 'HEAD', 'OPTIONS', 'TRACE'])) {
            return $symbolic_parameters['GET'];
        }
        elseif (in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            return $symbolic_parameters['POST'];
        }
        trigger_error(sprintf('Unknown HTTP method %s', $method), E_USER_ERROR);
    }
    public static function get_immutable_symbolic_variables(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $immutable_symbolic_variables = $config_json['immutable_symbolic_variables'];
        return $immutable_symbolic_variables;
    }
    public static function get_max_output_length(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $max_output_length = $config_json['max_output_length'];
        return $max_output_length;
    }
    public static function get_symbolic_loop_iterations(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_loop_iteration = $config_json['symbolic_loop_iteration'];
        return $symbolic_loop_iteration;
    }
    public static function get_symbolic_functions(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_functions = $config_json['symbolic_functions'];
        return $symbolic_functions;
    }
    public static function get_input_sensitive_symbolic_functions(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $input_sensitive_symbolic_functions = $config_json['input_sensitive_symbolic_functions'];
        return $input_sensitive_symbolic_functions;
    }
    public static function get_input_sensitive_symbolic_methods(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $input_sensitive_symbolic_methods = $config_json['input_sensitive_symbolic_methods'];
        return $input_sensitive_symbolic_methods;
    }
    public static function get_symbolic_methods(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_methods = $config_json['symbolic_methods'];
        return $symbolic_methods;
    }

    public static function get_symbolic_classes(string $config='config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_classes = $config_json['symbolic_classes'];
        return $symbolic_classes;
    }

    public static function append_reanimation_log($pid, array $reanimation_points) {
        file_put_contents(self::$PATH_PREFIX.'reanimation_logs/'.$pid.'_reanimation_log.txt', serialize($reanimation_points));
    }

    public static function breakpoint($emul, string $filename, int $linenumber=-1) {
        if (strpos($filename, $emul->current_file)) {
            if ($linenumber === -1) {
                return true;
            }
            elseif ($emul->current_line === $linenumber) {
                return true;
            }
        }
        return false;
    }

    public static function remove_logs($pid) {
        unlink(self::$PATH_PREFIX.'reanimation_logs/'.$pid.'_reanimation_log.txt');
    }

    public static function load_reanimation_log($pid) {
        $reanimation_log_file = self::$PATH_PREFIX.'reanimation_logs/'.$pid.'_reanimation_log.txt';
        if (file_exists($reanimation_log_file)) {
            $reanimation_log = file_get_contents($reanimation_log_file);
            $reanimation_points = unserialize($reanimation_log, ['ReanimationEntry']);
            return $reanimation_points;
        }
        else {
            trigger_error('Reanimation log file not found at: '.$reanimation_log_file);
        }
    }
}