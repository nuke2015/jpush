<?php
require_once __DIR__.'/../vendor/autoload.php';

//极光通信指纹;
define('MASTER_SECRET','');
define('APP_KEY','');
define('MONOLOG_LEVEL','DEBUG');
define('MONOLOG_LOGFILE','jpush.log');

$Android = new Jpush\Android();
list($status, $data) = $Android->sendByAll('hello feng feng');
echo '<pre>';
var_dump($status);
var_dump($data);
