<?php
namespace eva;

use eva\core\Config;

class app
{
    static public $ioc;

    public function __construct($config)
    {
        Config::set($config);
    }

}