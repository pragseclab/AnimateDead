<?php

class Theme {
    private string $name;

    public function __construct() {
        $this->name = 'default theme';
    }

    public function getTheme() {
        return $this->name;
    }
}

$_SESSION['theme'] = new Theme();
echo $_SESSION['theme']->getTheme();