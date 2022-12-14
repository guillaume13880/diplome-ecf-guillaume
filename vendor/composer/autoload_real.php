<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit828e886d7ccfaa11f9d92fcdd98e3abf
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit828e886d7ccfaa11f9d92fcdd98e3abf', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit828e886d7ccfaa11f9d92fcdd98e3abf', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit828e886d7ccfaa11f9d92fcdd98e3abf::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
