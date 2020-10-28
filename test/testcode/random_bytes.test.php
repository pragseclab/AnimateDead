<?php

function string($length)
{
    if (version_compare(PHP_VERSION, '7.0.0', '>=')) {
        try {
            return \random_bytes($length);
        } catch (\Throwable $e) {
        // If a sufficient source of randomness is unavailable, random_bytes() will throw an
        // object that implements the Throwable interface (Exception, TypeError, Error).
        // We don't actually need to do anything here. The string() method should just continue
        // as normal. Note, however, that if we don't have a sufficient source of randomness for
        // random_bytes(), most of the other calls here will fail too, so we'll end up using
        // the PHP implementation.
        }
    }
}
echo 'Random: ' . string(16);