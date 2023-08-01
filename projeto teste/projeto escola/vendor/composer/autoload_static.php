<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit43a9d39b833a032cbd27d918779348cc
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit43a9d39b833a032cbd27d918779348cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit43a9d39b833a032cbd27d918779348cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit43a9d39b833a032cbd27d918779348cc::$classMap;

        }, null, ClassLoader::class);
    }
}