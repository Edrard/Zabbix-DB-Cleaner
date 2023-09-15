<?php

use edrard\Zimbra\Config;
use edrard\DbCreate\DB;
use edrard\Zimbra\CleanTable;

header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$mysql = require __DIR__ . '/mysql.php';
$config = require __DIR__ . '/config.php';
$config = Config::init($config,$mysql);

$db = new DB(Config::getConfig('mysql'));
$run = new CleanTable($db,Config::getConfig('config')) ;
$run->runProcess();
