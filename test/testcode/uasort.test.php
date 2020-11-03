<?php

class Language {
    public string $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function cmp($other)
    {
        return strcmp($this->name, $other->name);
    }
}

$available_languages = ['en' => new Language('English'),
                        'az' => new Language('Azerbaijani'),
                        'bg' => new Language('Bulgarian'),
                        'zw_tw' => new Language('Chinese traditional')];

uasort($available_languages, function($a, $b)
{
    return $a->cmp($b);
}
);

var_dump($available_languages);