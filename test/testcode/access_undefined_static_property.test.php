<?php

class ComposerAutoloaderInit7033babd32da3410d35a338a5cac8c30
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            echo 'self::$loader is not null'.PHP_EOL;
            return;
        }
        echo 'self::$loader is null'.PHP_EOL;
    }
}

ComposerAutoloaderInit7033babd32da3410d35a338a5cac8c30::getLoader();