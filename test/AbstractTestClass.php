<?php

declare(strict_types=1);

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

use malmax\ExecutionMode;
use malmax\PHPAnalyzer;
use PHPEmul\SymbolicVariable;
use PHPUnit\Framework\TestCase;
use AnimateDead\Utils;

/**
 * General template for the unit tests
 * Class AbstractTest
 */
class AbstractTestClass extends TestCase
{
    public Emulator $emulator;
    public string $output;
    public array $coverage_info;
    public array $fork_info;

    public function test()
    {
    }

    /**
     * Run the test PHP file and get the results
     * @param string $file_name
     * @param string $http_method
     * @param array $parameters
     * @param string $config_file
     * @param int|null $reanimation_id
     * @return void
     */
    public function runScript(string $file_name, string $http_method, array $parameters = [], string $config_file='./config.json', ?int $reanimation_id = null, $extended_reanimation_logs_mode=false)
    {
        // Parse config file
        $init_env = Utils::load_config($config_file);
        $predefined_constants = Utils::get_constants($config_file);
        $symbolic_parameters = Utils::get_symbolic_parameters($http_method, $config_file);
        $symbolic_functions = Utils::get_symbolic_functions($config_file);
        $input_sensitive_symbolic_functions = Utils::get_input_sensitive_symbolic_functions($config_file);
        $symbolic_methods = Utils::get_symbolic_methods($config_file);
        $symbolic_classes = Utils::get_symbolic_classes($config_file);
        $input_sensitive_symbolic_methods = Utils::get_input_sensitive_symbolic_methods($config_file);
        $symbolic_loop_iterations = Utils::get_symbolic_loop_iterations($config_file);
        $init_env['_SERVER']['REQUEST_METHOD'] = strtoupper($http_method);
        foreach ($parameters as $param => $values) {
            foreach ($values as $param_value) {
                if (in_array($param, ['_POST', '_GET', '_COOKIE'])) {
                    $init_env[$param][$param_value] = null;
                    $init_env['_REQUEST'][$param] = null;
                }
                elseif ($param === '_SESSION') {
                    $init_env['_SESSION'][$param] = null;
                }
            }

        }
        // Prepare the engine
        $engine = new PHPAnalyzer($init_env, $http_method, $predefined_constants, new ReanimationCallback(), 'test');
        $engine->execution_mode = ExecutionMode::ONLINE;
        $engine->extended_logs_emulation_mode = $extended_reanimation_logs_mode;
        $engine->direct_output = false;
        $engine->symbolic_loop_iterations = $symbolic_loop_iterations;
        $engine->symbolic_parameters = $symbolic_parameters;
        $engine->symbolic_functions = $symbolic_functions;
        $engine->input_sensitive_symbolic_functions = $input_sensitive_symbolic_functions;
        $engine->symbolic_methods = $symbolic_methods;
        $engine->symbolic_classes = $symbolic_classes;
        $engine->input_sensitive_symbolic_methods = $input_sensitive_symbolic_methods;
        $engine->immutable_symbolic_variables = Utils::get_immutable_symbolic_variables($config_file);
        $engine->max_output_length = Utils::get_max_output_length($config_file);

        if ($reanimation_id !== null) {
            Utils::$PATH_PREFIX .= '../test/testcode/logs/';
            $engine->reanimate = true;
            $engine->reanimation_transcript = Utils::load_reanimation_log($reanimation_id);
        }

        if (strcasecmp($http_method, 'POST') === 0) {
            $engine->concolic = true;
            $engine->diehard = false;
        }
        elseif (strcasecmp($http_method, 'GET') === 0) {
            $engine->concolic = true;
            $engine->diehard = false;
        }
        else {
            throw new Exception($http_method . ' VERB is not supported.');
        }
        // Execute script
        $file_name = $file_name;
        $engine->start($file_name);
        $this->output = $engine->output ?? "";
        $this->coverage_info = $engine->lineLogger->coverage_info;
        $this->fork_info = $engine->fork_info;
    }

    // Helper functions
    public function getForkInfo() {
        return $this->fork_info;
    }
    public function getForkedLines($filename)
    {
        if (isset($this->fork_info)) {
            foreach ($this->fork_info as $fork_filename => $fork_info) {
                if ($filename === $fork_filename) {
                    return $fork_info;
                }
            }
        }
        return [];
    }
    public function getCoverageInfo() {
        return $this->coverage_info;
    }
    public function getCoveredLines($filename) {
        $realfilename = realpath($filename);
        if (array_key_exists($realfilename, $this->coverage_info)) {
            return array_keys($this->coverage_info[$realfilename]);
        }
        else {
            return [];
        }
    }
    public function getVariableValue($variable_name) {
        throw new \Exception('getVariableValue($variable_name) not implemented yet.');
    }
}

class ReanimationCallback {
    public function add_reanimation_task() {
        echo 'Dummy reanimation callback invoked'.PHP_EOL;
    }
}