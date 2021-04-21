<?php

class clswithdestructor {
    public $class_property;

    public function __construct($value) {
        $this->class_property = $value;
    }
    public function __destruct() {
        echo 'Destructing object with: '.$this->class_property.PHP_EOL;
    }
}

$object = new clswithdestructor('property_value');