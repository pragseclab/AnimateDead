<?php

function tokenField() {  # Return a field for the (CSRF) token
    return "<input type='hidden' name='user_token' value='{$_COOKIE[ 'session_token' ]}' />";
}

echo tokenField();