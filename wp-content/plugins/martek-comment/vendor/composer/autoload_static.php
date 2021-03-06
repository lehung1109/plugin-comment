<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ee92213ab4899f71ccfb8349d9b0ab7
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Premmerce\\SDK\\' => 14,
        ),
        'M' => 
        array (
            'MartekComment\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Premmerce\\SDK\\' => 
        array (
            0 => __DIR__ . '/..' . '/premmerce/wordpress-sdk/src',
        ),
        'MartekComment\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6ee92213ab4899f71ccfb8349d9b0ab7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6ee92213ab4899f71ccfb8349d9b0ab7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6ee92213ab4899f71ccfb8349d9b0ab7::$classMap;

        }, null, ClassLoader::class);
    }
}
