<?php
date_default_timezone_set('Asia/Bangkok');
error_reporting( E_ALL );
//phpinfo();
// change the following paths if necessary
$globals=dirname(__FILE__).'/globals.php';
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/fontend/config/main.php';
$mobile_detect=dirname(__FILE__).'/Mobile_Detect.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once($globals);
require_once($mobile_detect);
$detect = new Mobile_Detect;
ob_start();
session_start();
if(isset($_REQUEST["lg"])  && $_REQUEST["lg"]!='')
{
    $_SESSION['language']=$_REQUEST["lg"];
}
if(isset($_SESSION['language']) && $_SESSION['language']!="")
{
	$lang=$_SESSION['language'];
}
else{
	$_SESSION['language']="vn";
	$lang="vn";
}

define('NGON_NGU',$lang);

define('THEMES', 'natek');

$app = Yii::createWebApplication($config);

//Xoa cache Yii
if(isset($_REQUEST["cc"]) && $_REQUEST["cc"]==1)
{
	Yii::app()->cache->flush();
}
app()->user->setState('user_id', 0);

$app->run();
