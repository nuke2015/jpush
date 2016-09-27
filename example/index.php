<?php
require_once __DIR__ . '/../vendor/autoload.php';

use nuke2015\jpush;

//极光通信指纹;
define('MASTER_SECRET', '');
define('APP_KEY', '');
define('MONOLOG_LEVEL', 'DEBUG');
define('MONOLOG_LOGFILE', 'jpush.log');

//全网安卓通知;
$Android             = new Jpush\Android();
list($status, $data) = $Android->sendByAll('hello feng feng');
echo '<pre>';
var_dump($status);
var_dump($data);

//全网苹果通知;
$Ios                 = new Jpush\Ios();
list($status, $data) = $Ios->sendByAll('hello feng feng');
echo '<pre>';
var_dump($status);
var_dump($data);

//按设备REGISTRATION_ID批量苹果通知;
$Ios                 = new Jpush\Ios();
$ids                 = array('registration_id', 'registration_id');
list($status, $data) = $Ios->sendByIds('hello feng feng', $ids);
echo '<pre>';
var_dump($status);
var_dump($data);

//按标签TAG,批量苹果通知;
$Ios                 = new Jpush\Ios();
$ids                 = array('registration_id', 'registration_id');
list($status, $data) = $Ios->sendByTag('hello feng feng', $ids);
echo '<pre>';
var_dump($status);
var_dump($data);

//全网附加消息透传
$Android = new Jpush\Android();
$data    = array('m' => 'scene', 'a' => 'msgnew', 'count' => $count);
$Android->setExtras($data);
list($status, $data) = $Android->sendByAll($content);
var_dump($data);
