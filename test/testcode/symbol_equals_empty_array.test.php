<?php

// If we didn't get any parameters, either user called this directly, or
// upload limit has been reached, let's assume the second possibility.
if ($_POST == array() && $_GET == array()) {
    $message = PMA\libraries\Message::error(
        __(
            'You probably tried to upload a file that is too large. Please refer ' .
            'to %sdocumentation%s for a workaround for this limit.'
        )
    );
    $message->addParam('[doc@faq1-16]');
    $message->addParam('[/doc]');

    // so we can obtain the message
    $_SESSION['Import_message']['message'] = $message->getDisplay();
    $_SESSION['Import_message']['go_back_url'] = $GLOBALS['goto'];

    $response->setRequestStatus(false);
    $response->addJSON('message', $message);

    exit; // the footer is displayed automatically
}