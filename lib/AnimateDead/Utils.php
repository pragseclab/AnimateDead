<?php

namespace AnimateDead;

use malmax\PHPAnalyzer;
use PHPEmul\ReanimationEntry;

Class Utils {

    public static $PATH_PREFIX;
    // Controls whether stdout is saved to a file.
    // Occupies too much disk space, use only when required.
    public const LOG_OUTPUT = false;

    public static function load_config(string $config=null) {
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
        if (!isset($config)) {
            $config = self::get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $init_environ['_SERVER']['SERVER_NAME'] = $config_json['server']['server_name'];
        $init_environ['_SERVER']['HTTP_HOST'] = $config_json['server']['http_host'];
        $init_environ['_SERVER']['HTTP_X_FORWARDED_PROTO'] = $config_json['server']['http_x_forwarded_proto'];
        $init_environ['_SERVER']['SERVER_ADDR'] = $config_json['server']['server_addr'];
        $init_environ['_SERVER']['REMOTE_ADDR'] = $config_json['server']['remote_addr'];
        $init_environ['_SERVER']['GATEWAY_INTERFACE'] = $config_json['server']['gateway_interface'];
        $init_environ['_SERVER']['SERVER_SOFTWARE'] = $config_json['server']['server_software'];
        $init_environ['_SERVER']['SERVER_PROTOCOL'] = $config_json['server']['server_protocol'];
        $init_environ['_SERVER']['SERVER_ADMIN'] = $config_json['server']['server_admin'];
        $init_environ['_SERVER']['SERVER_PORT'] = $config_json['server']['server_port'];
        $init_environ['_SERVER']['SERVER_SIGNATURE'] = $config_json['server']['server_signature'];
        return $init_environ;
    }
    public static function get_constants(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $defined_constants = unserialize(file_get_contents(self::get_current_dir().$config_json['constants']), ['allowed_classes' => false]);
        return $defined_constants;
    }
    public static function get_symbolic_parameters(string $method='POST', bool $extended_logs_emulation_mode=false, string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        if ($extended_logs_emulation_mode) {
            $symbolic_parameters = $config_json['symbolic_parameters_extended_logs_emulation_mode'];
        }
        else {
            $symbolic_parameters = $config_json['symbolic_parameters'];
        }
        if (in_array($method, ['GET', 'HEAD', 'OPTIONS', 'TRACE'])) {
            return $symbolic_parameters['GET'] ?? [];
        }
        elseif (in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            return $symbolic_parameters['POST'] ?? [];
        }
        trigger_error(sprintf('Unknown HTTP method %s', $method), E_USER_ERROR);
    }
    public static function get_immutable_symbolic_variables(string $config=null) {
        if (!isset($config)) {
            $config = self::get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $immutable_symbolic_variables = $config_json['immutable_symbolic_variables'];
        return $immutable_symbolic_variables;
    }
    public static function get_max_output_length(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $max_output_length = $config_json['max_output_length'];
        return $max_output_length;
    }

    public static function get_symbolic_loop_iterations(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_loop_iteration = $config_json['symbolic_loop_iteration'];
        return $symbolic_loop_iteration;
    }

    public static function get_fork_on_symbolic_in_array_config(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $fork_on_symbolic_in_array = $config_json['fork_on_symbolic_in_array_config'];
        return $fork_on_symbolic_in_array;
    }

    public static function get_symbolic_functions(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_functions = $config_json['symbolic_functions'];
        return $symbolic_functions;
    }
    public static function get_input_sensitive_symbolic_functions(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $input_sensitive_symbolic_functions = $config_json['input_sensitive_symbolic_functions'];
        return $input_sensitive_symbolic_functions;
    }
    public static function get_input_sensitive_symbolic_methods(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $input_sensitive_symbolic_methods = $config_json['input_sensitive_symbolic_methods'];
        return $input_sensitive_symbolic_methods;
    }
    public static function get_symbolic_methods(string $config=null) {
        if (!isset($config)) {
            $config = get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_methods = $config_json['symbolic_methods'];
        return $symbolic_methods;
    }

    public static function get_htaccess_bool(string $config=null) {
        if (!isset($config)) {
            $config = self::get_default_config();
        }
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $htaccess_bool = $config_json['htaccess'];
        return $htaccess_bool;
    }
    public static function get_symbolic_classes(string $config=__DIR__ .'/config.json') {
        $config_json = file_get_contents($config);
        $config_json = json_decode($config_json, true);
        $symbolic_classes = $config_json['symbolic_classes'];
        return $symbolic_classes;
    }

    public static function append_reanimation_log($pid, array $reanimation_points) {
        file_put_contents(self::$PATH_PREFIX.'reanimation_logs/'.$pid.'_reanimation_log.txt', json_encode($reanimation_points));
    }

    public static function log_error($pid, string $error_msg) {
        file_put_contents(self::$PATH_PREFIX.'error_logs/'.$pid.'_error_log.txt', $error_msg, FILE_APPEND);
    }

    public static function log_output($pid, string $output) {
        if (self::LOG_OUTPUT) {
            file_put_contents(self::$PATH_PREFIX.'outputs/'.$pid.'_output.txt', $output, FILE_APPEND);
        }
    }

    public static function log_forkinfo(string $forkinfo) {
        file_put_contents(self::$PATH_PREFIX.'_forkinfo.txt', $forkinfo, FILE_APPEND);
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

    public static function get_default_config() {
        return self::get_current_dir().'config.json';
    }

    public static function get_current_dir() {
        return self::$PATH_PREFIX.'../';
    }
}
