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
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit7033babd32da3410d35a338a5cac8c30', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit7033babd32da3410d35a338a5cac8c30', 'loadClassLoader'));
        return self::$loader;
    }
}

$loader = ComposerAutoloaderInit7033babd32da3410d35a338a5cac8c30::getLoader();

if ($loader instanceof \Composer\Autoload\ClassLoader) {
    echo 'loader is an instance of ClassLoader'.PHP_EOL;
}
else {
    echo 'loader is not an instance of ClassLoader'.PHP_EOL;
}