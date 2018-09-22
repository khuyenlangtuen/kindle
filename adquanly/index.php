<?php
date_default_timezone_set('Asia/Bangkok');
//echo date("d/m/Y H:i:s");
//echo time()*1000;
//phpinfo();
// change the following paths if necessary
$globals=dirname(__FILE__).'/../globals.php';
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
