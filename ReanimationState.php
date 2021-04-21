<?php


class ReanimationState {
    public $init_env;
    public $httpverb;
    public $targetfile;
    public $reanimation_array;
    public $linenumber;
    public $line_coverage_hash;
    public $symbol_table_hash;

    public function __construct($init_env=null, $httpverb=null, $reanimation_array=null, $targetfile=null, $linenumber=null, $line_coverage_hash=null, $symbol_table_hash=null) {
        $this->init_env = $init_env;
        $this->httpverb = $httpverb;
        $this->targetfile = $targetfile;
        $this->reanimation_array = $reanimation_array;
        $this->linenumber = $linenumber;
        $this->line_coverage_hash = $line_coverage_hash;
        $this->symbol_table_hash = $symbol_table_hash;
    }
}