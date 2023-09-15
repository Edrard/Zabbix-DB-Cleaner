<?php

use edrard\Zimbra\Config;
use edrard\DbCreate\DB;
use edrard\Zimbra\CleanTable;
use edrard\Log\MyLog;
use edrard\Log\Timer;

header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';
//Set true to disable info logs
MyLog::init();
if (FALSE) {
    MyLog::changeType(['warning','error','critical'],'log');
}

$mysql = require __DIR__ . '/mysql.php';
$config = require __DIR__ . '/config.php';
$config = Config::init($config,$mysql);

$db = new DB(Config::getConfig('mysql'));
$run = new CleanTable($db,Config::getConfig('config')) ;
$run->runProcess();
MyLog::info("Full process Runtime is: ".Timer::getTime() ,array());