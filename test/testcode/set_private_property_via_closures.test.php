<?php

Class PrivatePropClass {
    public $prefixLengthsPsr4 = array(1,2,3);

    public function getPrivateProps() {
        return $this->prefixLengthsPsr4;
    }
}

$var = new PrivatePropClass();
$property_name = 'prefixLengthsPsr4';
$temp = array();

$closure =  \Closure::bind(function () use (&$var, &$temp, $property_name) {
    $var->{$property_name} = 'Set private var';
    echo $var->{$property_name};
    $temp=['temp'=>&$var->{$property_name}];
}, null, PrivatePropClass::class);

$closure();
var_dump($temp);