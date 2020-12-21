<?php

namespace AnimateDead;

use Exception;

class FlowAggregator {
    // IP => array()[LogEntry]
    public $flows;
    public function __construct(array $log_entries) {
        $this->flows = array();
        foreach ($log_entries as $log_entry) { 
            $this->AddFlow($log_entry);
        }
    }

    public function AddFlow(LogEntry $log_entry) {
        if (!array_key_exists($log_entry->host, $this->flows)) {
            $this->flows[$log_entry->host] = array();
        }
        array_push($this->flows[$log_entry->host], $log_entry);
    }

    public function SummarizeFlows() {
        throw new Exception("Feature not implemented");
    }
}