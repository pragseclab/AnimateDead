<?php

/**
 * Sets globals from $_POST
 */
$post_params = array(
    // 'charset_of_file',
    // 'format',
    // 'import_type',
    // 'is_js_confirmed',
    // 'MAX_FILE_SIZE',
    // 'message_to_show',
    // 'noplugin',
    'skip_queries',
    'local_import_file'
);

foreach ($post_params as $one_post_param) {
    if (isset($_POST[$one_post_param])) {
        $GLOBALS[$one_post_param] = $_POST[$one_post_param];
    }
}

foreach ($post_params as $one_post_param) {
    if(array_key_exists($one_post_param, $GLOBALS) && $GLOBALS[$one_post_param]) {
        echo $one_post_param.' is set.'.PHP_EOL;
    }
    else {
        echo $one_post_param.' is not set.'.PHP_EOL;
    }
}