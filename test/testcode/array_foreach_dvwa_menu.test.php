<?php

$menuBlocks = array();

$menuBlocks[ 'home' ] = array();
if( $_POST['logged_in'] ) {
    $menuBlocks[ 'home' ][] = array( 'id' => 'home', 'name' => 'Home', 'url' => '.' );
    $menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );
    $menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'Setup / Reset DB', 'url' => 'setup.php' );
}
else {
    $menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'Setup DVWA', 'url' => 'setup.php' );
    $menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );
}

if( $_POST['logged_in'] ) {
    $menuBlocks[ 'vulnerabilities' ] = array();
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'brute', 'name' => 'Brute Force', 'url' => 'vulnerabilities/brute/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'exec', 'name' => 'Command Injection', 'url' => 'vulnerabilities/exec/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'csrf', 'name' => 'CSRF', 'url' => 'vulnerabilities/csrf/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'fi', 'name' => 'File Inclusion', 'url' => 'vulnerabilities/fi/.?page=include.php' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'upload', 'name' => 'File Upload', 'url' => 'vulnerabilities/upload/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'captcha', 'name' => 'Insecure CAPTCHA', 'url' => 'vulnerabilities/captcha/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'sqli', 'name' => 'SQL Injection', 'url' => 'vulnerabilities/sqli/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'sqli_blind', 'name' => 'SQL Injection (Blind)', 'url' => 'vulnerabilities/sqli_blind/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'weak_id', 'name' => 'Weak Session IDs', 'url' => 'vulnerabilities/weak_id/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_d', 'name' => 'XSS (DOM)', 'url' => 'vulnerabilities/xss_d/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_r', 'name' => 'XSS (Reflected)', 'url' => 'vulnerabilities/xss_r/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_s', 'name' => 'XSS (Stored)', 'url' => 'vulnerabilities/xss_s/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'csp', 'name' => 'CSP Bypass', 'url' => 'vulnerabilities/csp/' );
    $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'javascript', 'name' => 'JavaScript', 'url' => 'vulnerabilities/javascript/' );
}

$menuBlocks[ 'meta' ] = array();
if( $_POST['logged_in'] ) {
    $menuBlocks[ 'meta' ][] = array( 'id' => 'security', 'name' => 'DVWA Security', 'url' => 'security.php' );
    $menuBlocks[ 'meta' ][] = array( 'id' => 'phpinfo', 'name' => 'PHP Info', 'url' => 'phpinfo.php' );
}
$menuBlocks[ 'meta' ][] = array( 'id' => 'about', 'name' => 'About', 'url' => 'about.php' );

if( $_POST['logged_in'] ) {
    $menuBlocks[ 'logout' ] = array();
    $menuBlocks[ 'logout' ][] = array( 'id' => 'logout', 'name' => 'Logout', 'url' => 'logout.php' );
}

$menuHtml = '';

foreach( $menuBlocks as $menuBlock ) {
    $menuBlockHtml = '';
    foreach( $menuBlock as $menuItem ) {
        $selectedClass = ( $menuItem[ 'id' ] == $pPage[ 'page_id' ] ) ? 'selected' : '';
        $fixedUrl = DVWA_WEB_PAGE_TO_ROOT.$menuItem[ 'url' ];
        $menuBlockHtml .= "<li class=\"{$selectedClass}\"><a href=\"{$fixedUrl}\">{$menuItem[ 'name' ]}</a></li>\n";
    }
    $menuHtml .= "<ul class=\"menuBlocks\">{$menuBlockHtml}</ul>";
}