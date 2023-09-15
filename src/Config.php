<?php

namespace edrard\Zimbra;

use edrard\Log\MyLog;

class Config
{
    private static $config = [];
    private static $mysql = [];

    public static function init($config,$mysql){
        static::$config = $config;
        static::$mysql = $mysql;
    }
    public static function getConfig($type){
        return static::${$type};
    }
}

