<?php

Class PrivatePropClass {
    public $prefixLengthsPsr4 = array(1,2,3);
}

$var = new PrivatePropClass();
$property_name = 'prefixLengthsPsr4';

$temp=['temp'=>&$var->{$property_name}];

var_dump($temp);