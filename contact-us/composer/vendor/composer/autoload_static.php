<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf68a4539f47bbfad821a801f79db8fad
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rodri\\Composer\\' => 15,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'F' => 
        array (
            'Fpdf\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rodri\\Composer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Fpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/fpdf/fpdf/src/Fpdf',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf68a4539f47bbfad821a801f79db8fad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf68a4539f47bbfad821a801f79db8fad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf68a4539f47bbfad821a801f79db8fad::$classMap;

        }, null, ClassLoader::class);
    }
}