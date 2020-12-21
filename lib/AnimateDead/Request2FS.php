<?php

namespace AnimateDead;

class Request2FS {
    private $root_dir;
    private $request_uri_prefix;
    private $redirect_rules;

    public function __construct($root_dir, $uri_prefix) {
        $this->root_dir = $root_dir;
        $this->request_uri_prefix = $uri_prefix;
    }
    // Parse the mime types on the server and php.conf file to find out how extensions are mapped to handlers and which extensions belog to PHP
    // Handle .htaccess rewrite and 
    public function GetTargetFile($request_path): ?string {
        // If URI's should have a prefix, ignore those without the prefix (Addressing other web apps)
        // Prefix:  /phpMyAdmin-4.7.0-all-languages/
        // Matches: /phpMyAdmin-4.7.0-all-languages/index.php
        if (substr($request_path, 0, strlen($this->request_uri_prefix)) === $this->request_uri_prefix) {
            $file_path = substr($request_path, strlen($this->request_uri_prefix));
            $full_path = $this->root_dir . $file_path;
            if (file_exists($full_path)) {
                if (is_dir($full_path)) {
                    return $full_path . 'index.php';
                }
                return $full_path;
            }
            else {
                trigger_error('File not found: ' . $full_path, E_USER_WARNING);
                return null;
            }
        }
        else {
            return null;
        }
    }
}