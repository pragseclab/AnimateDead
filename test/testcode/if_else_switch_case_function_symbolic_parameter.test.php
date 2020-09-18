<?php

function PMA_isValid(&$var, $type = 'length', $compare = null)
{
    if (!isset($var)) {
        // var is not even set
        return false;
    }

    if ($type === false) {
        // no vartype requested
        return true;
    }

    if (is_array($type)) {
        return in_array($var, $type);
    }

    // allow some aliases of var types
    $type = strtolower($type);
    switch ($type) {
        case 'identic' :
            $type = 'identical';
            break;
        case 'len' :
            $type = 'length';
            break;
        case 'bool' :
            $type = 'boolean';
            break;
        case 'float' :
            $type = 'double';
            break;
        case 'int' :
            $type = 'integer';
            break;
        case 'null' :
            $type = 'NULL';
            break;
    }

    if ($type === 'identical') {
        return $var === $compare;
    }

    // whether we should check against given $compare
    if ($type === 'similar') {
        switch (gettype($compare)) {
            case 'string':
            case 'boolean':
                $type = 'scalar';
                break;
            case 'integer':
            case 'double':
                $type = 'numeric';
                break;
            default:
                $type = gettype($compare);
        }
    } elseif ($type === 'equal') {
        $type = gettype($compare);
    }

    // do the check
    if ($type === 'length' || $type === 'scalar') {
        $is_scalar = is_scalar($var);
        if ($is_scalar && $type === 'length') {
            return strlen($var) > 0;
        }
        return $is_scalar;
    }

    if ($type === 'numeric') {
        return is_numeric($var);
    }

    if (gettype($var) === $type) {
        return true;
    }

    return false;
}

$ids = PMA_isValid($_POST['id'], 'scalar') ? 'ids,were,valid' : null;
$vids = explode(',', $ids)[0];
$vals = PMA_isValid($_POST['id'], 'scalar') ? 'vals were valid' : null;

echo 'ids: '.$ids.PHP_EOL;
echo 'vids: '.$vids.PHP_EOL;
echo 'vals: '.$vals.PHP_EOL;
