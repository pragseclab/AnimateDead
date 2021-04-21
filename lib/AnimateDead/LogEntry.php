<?php

namespace AnimateDead;

class LogEntry {
    public $host;
    public $logname;
    public $user;
    public $datetime;
    public $request;
    public $query_string_array;
    public $path;
    public $verb;
    public $status;
    public $length;
    public $referer;
    public $uagent;
    public $target_file;

    public function __construct($log_entry_stdclass) {
        $this->host = $log_entry_stdclass->host;
        $this->logname = $log_entry_stdclass->logname;
        $this->user = $log_entry_stdclass->user;
        $this->datetime = $log_entry_stdclass->time;
        $this->request = $log_entry_stdclass->request;
        $this->query_string_array = LogEntry::ExtractQueryString($this->request);
        $this->path = LogEntry::ExtractRequestPath($this->request);
        $this->verb = LogEntry::ExtractRequestVerb($this->request);
        $this->status = $log_entry_stdclass->status;
        $this->length = $log_entry_stdclass->sentBytes;
        $this->referer = $log_entry_stdclass->HeaderReferer;
        $this->uagent = $log_entry_stdclass->HeaderUserAgent;
    }

    public function SetTargetFile($target_file) {
        $this->target_file = $target_file;
    }

    public static function ExtractRequestPath($request): ?string {
        $url_segments = explode('?', $request);
        if (explode(' ', $url_segments[0])) {

        }
        $request_path = explode(' ', $url_segments[0])[1];
        return $request_path;
    }

    public static function ExtractRequestVerb($request): string {
        $url_segments = explode('?', $request);
        $verb = explode(' ', $url_segments[0])[0];
        return $verb;
    }

    public static function ExtractQueryString($request): ?array {
        $url_segments = explode('?', $request);
        if (sizeof($url_segments) < 2) {
            // No Query String
            return null;
        }
        else {
            $query_string = explode(' ', $url_segments[1])[0];
            $query_string_array = array();
            parse_str($query_string, $query_string_array);
            return $query_string_array;
        }
    }
}