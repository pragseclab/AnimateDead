<?php

function getAESSecret($secret)
{
    // Grab second part, up to 16 chars
    // The MAC and AES secrets can overlap if original secret is short
    $length = strlen($secret);
    if ($length > 16) {
        return substr($secret, -16);
    }
    return enlargeSecret(
        $length == 1 ? $secret : substr($secret, 1)
    );
}

function enlargeSecret($secret)
{
    while (strlen($secret) < 16) {
        $secret .= $secret;
    }
    return substr($secret, 0, 16);
}

echo getAESSecret($_POST['secret']);