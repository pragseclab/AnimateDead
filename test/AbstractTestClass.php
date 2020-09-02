<?php

declare(strict_types=1);

namespace AnimateDead\Tests;
require __DIR__ . '/../vendor/autoload.php';

use malmax\PHPAnalyzer;
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
     * @return void
     */
    public function runScript(string $file_name, string $http_method, array $parameters = [], string $config_file='./config.json')
    {
        // Parse config file
        $init_env = Utils::load_config($config_file);
        $predefined_constants = Utils::get_constants($config_file);
        $symbolic_parameters = Utils::get_symbolic_parameters($config_file);
        $symbolic_functions = Utils::get_symbolic_functions($config_file);
        $input_sensitive_symbolic_functions = Utils::get_input_sensitive_symbolic_functions($config_file);
        $init_env['_SERVER']['REQUEST_METHOD'] = strtoupper($http_method);
        // Prepare the engine
        $engine = new PHPAnalyzer($init_env, $predefined_constants);
        $engine->direct_output = false;
        if (strcasecmp($http_method, 'POST') === 0) {
            $engine->concolic = true;
            $engine->diehard = false;
            $engine->symbolic_parameters = $symbolic_parameters;
            $engine->symbolic_functions = $symbolic_functions;
            $engine->input_sensitive_symbolic_functions = $input_sensitive_symbolic_functions;
        }
        elseif (strcasecmp($http_method, 'GET') === 0) {
            $engine->concolic = false;
            $engine->diehard = false;
        }
        else {
            throw new Exception($http_method . ' VERB isb not supported.');
        }
        // Execute script
        $file_name = $file_name;
        $engine->start($file_name);
        $this->output = $engine->output;
        $this->coverage_info = $engine->lineLogger->coverage_info;
        $this->fork_info = $engine->fork_info;
    }

    // Helper functions
    public function getForkInfo() {
        return $this->fork_info;
    }
    public function getForkedLines($filename)
    {
        $lines = [];
        if (isset($this->fork_info)) {
            foreach ($this->fork_info as $fork_info) {
                if (isset($fork_info[$filename])) {
                    $forked_line = $fork_info[$filename];
                    if (!in_array($forked_line, $lines)) {
                        $lines[] = $forked_line;
                    }
                }
            }
        }
        return $lines;
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