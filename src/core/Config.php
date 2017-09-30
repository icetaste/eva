<?php
namespace eva\core;

class Config
{

    private static $config;

    private function __construct()
    {
    }

    static public function set($config)
    {
        self::$config = $config;
    }

    static public function get($name)
    {
        $config = self::$config;
        return $config[$name] ? $config[$name] : null;
    }

    static function getAll()
    {
        return self::$config;
    }

}