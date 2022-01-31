<?php

class MagicMethodClass
{
    public $public_prop;
    protected $protected_prop;
    private $private_prop;

    public function __get($name) {
        echo 'Running __get for ' . $name . PHP_EOL;
        return $this->$name;
    }

    public function __construct() {
        $this->public_prop = 'public_prop';
        $this->protected_prop = 'protected_prop';
        $this->private_prop = 'private_prop';
    }
}

$m = new MagicMethodClass();
echo 'public_prop is ' . $m->public_prop;
echo 'protected_prop is ' . $m->protected_prop;
echo 'private_prop is ' . $m->private_prop;