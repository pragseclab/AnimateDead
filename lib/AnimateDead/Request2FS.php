<?php

namespace AnimateDead;

class Request2FS {
    private $root_dir;
    private $redirect_rules;

    public function __construct($root_dir) {
        $this->root_dir = $root_dir;
    }
    public function GetTargetFile($request_uri,$htaccess_bool): ?string {
        // If URI's should have a prefix, ignore those without the prefix (Addressing other web apps)
        // Prefix:  /phpMyAdmin-4.7.0-all-languages/
        // Matches: /phpMyAdmin-4.7.0-all-languages/index.php
        //change apache to only give back the filename
        $uri = explode('?', $request_uri)[0];
        $full_path = $this->root_dir . $uri;
        if ($htaccess_bool==1){
            $url = 'apache' . $uri;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url . '?a=1');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($curl);
            return $res;
        }
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
}
