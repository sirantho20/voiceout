<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
class ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98
=======
class ComposerAutoloaderInitf7f0c73f6c06538f86ec594e5e93f170
>>>>>>> master
=======
class ComposerAutoloaderInitf7f0c73f6c06538f86ec594e5e93f170
=======
class ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98
>>>>>>> bencopy
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
=======
class ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98
>>>>>>> bencopy
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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98', 'loadClassLoader'));
=======
=======
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
        spl_autoload_register(array('ComposerAutoloaderInitf7f0c73f6c06538f86ec594e5e93f170', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitf7f0c73f6c06538f86ec594e5e93f170', 'loadClassLoader'));

        $vendorDir = dirname(__DIR__);
        $baseDir = dirname($vendorDir);
<<<<<<< HEAD
>>>>>>> master
=======
=======
        spl_autoload_register(array('ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98', 'loadClassLoader'));
>>>>>>> bencopy
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
=======
        spl_autoload_register(array('ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInite7ed24bb9c1c482b9fa770e94bad4e98', 'loadClassLoader'));
>>>>>>> bencopy

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            composerRequiree7ed24bb9c1c482b9fa770e94bad4e98($file);
=======
            composerRequiref7f0c73f6c06538f86ec594e5e93f170($file);
>>>>>>> master
=======
            composerRequiref7f0c73f6c06538f86ec594e5e93f170($file);
=======
            composerRequiree7ed24bb9c1c482b9fa770e94bad4e98($file);
>>>>>>> bencopy
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
=======
            composerRequiree7ed24bb9c1c482b9fa770e94bad4e98($file);
>>>>>>> bencopy
        }

        return $loader;
    }
}

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
function composerRequiree7ed24bb9c1c482b9fa770e94bad4e98($file)
=======
function composerRequiref7f0c73f6c06538f86ec594e5e93f170($file)
>>>>>>> master
=======
function composerRequiref7f0c73f6c06538f86ec594e5e93f170($file)
=======
function composerRequiree7ed24bb9c1c482b9fa770e94bad4e98($file)
>>>>>>> bencopy
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
=======
function composerRequiree7ed24bb9c1c482b9fa770e94bad4e98($file)
>>>>>>> bencopy
{
    require $file;
}
