<?php

namespace AnimateDead;

class LogParser
{
    public $log_entries = array();
    private $parser;
    private $log_files;
    public $flow_aggregator;

    public function __construct(array $log_files, $log_format='%h %l %u %t "%r" %>s %O "%{Referer}i" \"%{User-Agent}i"')
    {
        $this->log_files = $log_files;
        $this->parser = new \Kassner\LogParser\LogParser();
        $this->parser->setFormat($log_format);
    }

    public function Parse($uri_prefix) {
        foreach ($this->log_files as $log_file) {
            $lines = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                try {
                    $log_entry = new LogEntry($this->parser->parse($line), $uri_prefix);
                    if($log_entry->path !== null) {
                        $this->log_entries[] = $log_entry;
                    }
                } catch (\Throwable $th) {
                    //TODO: Catch \Kassner\LogParser\FormatException if a line doesn't match the format
                    throw $th;
                }
            }
        }
        $this->flow_aggregator = new FlowAggregator($this->log_entries);
    }

    public function PrintLogs() {
        foreach($this->log_entries as $log_entry) {
            var_dump($log_entry);
        }
    }

    public function PrintFlows() {
        var_dump($this->flow_aggregator->flows);
    }
}
