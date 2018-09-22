<?php

/**
 * This is the shortcut to DIRECTORY_SEPARATOR
 */
defined('DS') or define('DS',DIRECTORY_SEPARATOR);
define('TIME', time());

/**
 * This is the shortcut to Yii::app()
 */
function app()
{
    return Yii::app();
}

/**
 * This is the shortcut to Yii::app()->clientScript
 */
function cs()
{
    // You could also call the client script instance via Yii::app()->clientScript
    // But this is faster
    return Yii::app()->getClientScript();
}

/**
 * This is the shortcut to Yii::app()->user.
 */
function user()
{
    return Yii::app()->getUser();
}

function userDisplayName($user = null) {
	if ( empty($user) ) return '(empty)';

	$display_name = $user->email;
	if ( !empty($user->firstname) ) {
		$display_name = $user->firstname;
	} elseif ( !empty($user->name) ) {
		$display_name = $user->name;
	} elseif ( !empty($user->user_login) ) {
		$display_name = $user->user_login;
	}

	return CHtml::encode($display_name);
}

function userDisplayNameArr($user = null) {
	if ( empty($user) ) return '(empty)';

	$display_name = $user['email'];
	if ( !empty($user['firstname']) ) {
		$display_name = $user['firstname'];
	} elseif ( !empty($user['user_login']) ) {
		$display_name = $user['user_login'];
	}

	return $display_name;
}

/**
 * This is the shortcut to Yii::app()->createUrl()
 */
function url($route,$params=array(),$ampersand='&')
{
    return Yii::app()->createUrl($route,$params,$ampersand);
}

/**
 * This is the shortcut to CHtml::encode
 */
function h($text)
{
    return htmlspecialchars($text,ENT_QUOTES,Yii::app()->charset);
}

/**
 * This is the shortcut to CHtml::link()
 */
function l($text, $url = '#', $htmlOptions = array())
{
    return CHtml::link($text, $url, $htmlOptions);
}

function img($object_type, $src, $alt, $htmlOptions, $size = 'full', $return_url = false)
{
	try
	{
		$max_dim = 2000;
		$path = Yii::getPathOfAlias('upload') . '/';
		$url = Yii::app()->params['frontUrl'] . 'uploads/';
	
		if ( !file_exists("{$path}{$object_type}/$src") ) {
			if ( file_exists("{$path}{$object_type}/no_image.png") ) {
				return img($object_type, 'no_image.png', $alt, $htmlOptions, $size, $return_url);
			} else {
				return '';
			}
		}
		
		if ( $size == 'full' ) {
			if ( $return_url ) {
				return "$url/$object_type/$src";
			}
			return CHtml::image($url."/$object_type/".$src, $alt, $htmlOptions);
		} else {
			$width = isset($size['width']) ? $size['width'] : $max_dim;
			$height = isset($size['height']) ? $size['height'] : $max_dim;
	
			$image_name = basename($src);
			$safe_image_name = safe_file_name($image_name);
			$new_image_name = ($width==$max_dim?'0':$width).'x'.($height==$max_dim?'0':$height).'-'.$safe_image_name;
			$thumbnail_folder = "thumbnail/".($width==$max_dim?'0':$width).'/'.($height==$max_dim?'0':$height);
			$thumbnail_path = "{$path}{$thumbnail_folder}";
			if ( !file_exists($thumbnail_path) ) mkdir($thumbnail_path, 0777, true);
	
			if ( !file_exists("$thumbnail_path/$new_image_name") ) {
				if ( $size == 'full' ) {
					@copy("{$path}{$object_type}/".$src, "$thumbnail_path/$new_image_name");
				} else {
					$image = Yii::app()->image->load("{$path}{$object_type}/$src");
					$image->resize($width, $height)->quality(100);
					$image->save("$thumbnail_path/$new_image_name");
				}
			}
	
			if ( $return_url ) {
				return "{$url}{$thumbnail_folder}/{$new_image_name}";
			}
			return CHtml::image("{$url}{$thumbnail_folder}/{$new_image_name}", $alt, $htmlOptions);
		}
	}
	catch(Exception $ex)
	{
		return img($object_type, 'no_image.png', $alt, $htmlOptions, $size, $return_url);
	}
}
/******************tao anh moi**************************/
function img2($object_type,$have_src, $src, $alt, $htmlOptions, $size = 'full', $return_url = false)
{
	$max_dim = 2000;
	$width = isset($size['width']) ? $size['width'] : $max_dim;
    $height = isset($size['height']) ? $size['height'] : $max_dim;
    $background = imagecreatetruecolor($width, $height);
	$white = imagecolorallocate($background, 255, 255, 255);
    imagefill($background, 0, 0, $white);
	//$background2=imagecolorallocate($background, 255, 255, 255);
    $path = Yii::getPathOfAlias('upload') . '/';
	$url = Yii::app()->params['frontUrl'] . 'uploads/';
	$path_manage=Yii::getPathOfAlias('filemanager') . '/source/';
    $image_name = basename($src);
    $safe_image_name = safe_file_name2($image_name);
    $new_image_name = ($width==$max_dim?'0':$width).'x'.($height==$max_dim?'0':$height).'-'.$safe_image_name.".jpg";
    
    
    $thumb_resize="{$path}/cover/resize";
    if ( !file_exists($thumb_resize) ) mkdir($thumb_resize, 0777, true);
    if ( !file_exists("$thumb_resize/$new_image_name") ) {
	    if($object_type=="banner" || $object_type=="origin" || $object_type=="product" || $object_type=="content")
	    {
		    $image = Yii::app()->image->load("{$path}{$object_type}/$src");

	    }
	    else{
		    $image = Yii::app()->image->load("{$path_manage}{$object_type}/$src");
		    	    }
        
	   $image->resize($width, $height)->quality(100);
	   $image->save("{$thumb_resize}/$new_image_name");
	}
	
    $firstUrl = "{$thumb_resize}/$new_image_name";
    
    
    $outputImage = $background;
    
    $first = imagecreatefromjpeg($firstUrl);
    $src_w = imagesx($first);
    $src_h = imagesy($first);
    
    $thumbnail_folder = "cover";
    $thumbnail_path = "{$path}{$thumbnail_folder}";
    if ( !file_exists($thumbnail_path) ) mkdir($thumbnail_path, 0777, true);
     imagecopy($outputImage,$first,(($width - $src_w)/ 2), (($height - $src_h) / 2),0,0, $src_w, $src_h);
   if ( !file_exists("$thumbnail_path/$new_image_name") ) {
	   imagejpeg($outputImage, $thumbnail_path."/".$new_image_name);
	}
    imagedestroy($outputImage);
	$url_img="{$url}{$thumbnail_folder}/{$new_image_name}";
	if ( $return_url ) {
		return $url_img;
	}
	if($have_src)
	{
		return CHtml::image("{$url}{$thumbnail_folder}/{$new_image_name}", $alt, $htmlOptions);
	}
	else return CHtml::image2("{$url}{$thumbnail_folder}/{$new_image_name}", $alt, $htmlOptions);
}
/*****************************************/
function img_crop($object_type, $src, $x, $y, $w, $h) {
	$upload_base_path = Image::getUploadBasePath($object_type);
	$upload_path = Image::getUploadPath($object_type);
	
	$image_name = basename($src);
	$safe_image_name = safe_file_name($image_name);
	$new_image_name = ($w).'x'.($h).'-'.$safe_image_name;
	
	$image_file = $upload_path . '/' . $new_image_name;
	$image_path = str_replace($upload_base_path, '', $image_file);
		
	if ( !file_exists($image_file) ) {
		$image = Yii::app()->image->load("{$upload_base_path}/".$src);
		$image->crop($w, $h, $y, $x)->quality(100);
		$image->save($image_file);
	}
	
	return $image_path;
}

function safe_file_name($filename) {
	$dot_pos = strrpos($filename, '.');
	$name_only = substr($filename, 0, $dot_pos);
	$extension = substr($filename, $dot_pos + 1);
	$safe_name = SiteHelper::generateSeoName($name_only);

	return $safe_name.'.'.$extension;

}
function safe_file_name2($filename) {
	$dot_pos = strrpos($filename, '.');
	$name_only = substr($filename, 0, $dot_pos);
	$extension = substr($filename, $dot_pos + 1);
	$safe_name = SiteHelper::generateSeoName($name_only);

	return $safe_name;

}
/**
 * This is the shortcut to Yii::t() with default category = 'stay'
 */
function t($message, $category = 'app', $params = array(), $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}

/**
 * This is the shortcut to Yii::app()->request->baseUrl
 * If the parameter is given, it will be returned and prefixed with the app baseUrl.
 */
function bu($url=null)
{
    static $baseUrl;
    if ($baseUrl===null)
        $baseUrl=Yii::app()->getRequest()->getBaseUrl();
    return $url===null ? $baseUrl : $baseUrl.'/'.ltrim($url,'/');
}

function tu($url=null) {
	static $themeUrl;
	if ($themeUrl===null)
        $themeUrl=Yii::app()->getTheme()->getBaseUrl();
	return $url===null ? $themeUrl : $themeUrl.'/'.ltrim($url,'/');
}

/**
 * Returns the named application parameter.
 * This is the shortcut to Yii::app()->params[$name].
 */
function param($name)
{
    return Yii::app()->params[$name];
}

function getParam($name, $default = null) {
	return trim(Yii::app()->request->getParam($name, $default));
}

function getQuery($name, $default = null) {
	return Yii::app()->request->getQuery($name, $default);
}

function getPost($name, $default = null) {
	return Yii::app()->request->getPost($name, $default);
}

function isAjaxRequest() {
	return Yii::app()->request->isAjaxRequest || getParam('is_ajax');
}

function getItemsPerPage() {
	return param('itemsPerPage');
}

/* DATETIME */
function parseDate($date, $default = null) {
	if ( $default === null ) $default = time();

	$timestamp = CDateTimeParser::parse($date, app()->params['altDateFormat']);
	return $timestamp ? $timestamp : $default;
}

function parseLongDate($date, $default = null) {
	if ( $default === null ) $default = time();

	$timestamp = CDateTimeParser::parse($date, app()->params['altLongDateFormat']);
	return $timestamp ? $timestamp : $default;
}

function formatDate($timestamp) {
	if ( $timestamp == 0 ) return '';
	return Yii::app()->dateFormatter->format(app()->params['altDateFormat'], $timestamp);
}

function formatLongDate($timestamp) {
	if ( $timestamp == 0 ) return '';
	return Yii::app()->dateFormatter->format(app()->params['altLongDateFormat'], $timestamp);
}

function formatWYSIWYG($content) {
	// replace image src url
	$content = str_replace('src="download/', 'src="'.param('frontUrl'). 'download/', $content);
	$content = str_replace('src="files/', 'src="'.param('frontUrl'). 'files/', $content);

	return $content;
}

/* NSPN */
function getNspnProductInfo($product_id) {
	Yii::import('common.extensions.EHttpClient.*');

	$api_url = param('nspnApiUrl');
	$client = new EHttpClient($api_url, array(
		'maxredirects' => 3,
		'timeout'      => 15,
		'adapter'      => 'EHttpClientAdapterCurl'));

	$client->setParameterGet(array(
		'dispatch' => 'api.getProductInfo',
		'api_key' => param('nspnApiKey'),
		'product_id' => $product_id,
	));

	$response = $client->request();

	if ( $response->isSuccessful() )
		$info = $response->getBody();
	else
		$info = '';

	return $info;
}

function getNspnUserInfo($user_login, $password) {
	Yii::import('common.extensions.EHttpClient.*');

	$api_url = param('nspnApiUrl');
	$client = new EHttpClient($api_url, array(
		'maxredirects' => 3,
		'timeout'      => 15,
		'adapter'      => 'EHttpClientAdapterCurl'));

	$client->setParameterGet(array(
		'dispatch' => 'api.getUserInfo',
		'api_key' => param('nspnApiKey'),
		'user_login' => $user_login,
		'password' => $password,
	));

	$response = $client->request();

	if ( $response->isSuccessful() )
		$info = unserialize($response->getBody());
	else
		$info = array('success' => false);

	return $info;
}

function getNspnBestsellerProducts($category_id, $limit = 5, $thumb_w = 120, $thumb_h = 160) {
	Yii::import('common.extensions.EHttpClient.*');

	$api_url = param('nspnApiUrl');
	$client = new EHttpClient($api_url, array(
		'maxredirects' => 3,
		'timeout'      => 15,
		'adapter'      => 'EHttpClientAdapterCurl'));

	$client->setParameterGet(array(
		'dispatch' => 'api.getBestsellers',
		'api_key' => param('nspnApiKey'),
		'cat_id' => $category_id,
		'limit' => $limit,
		'thumb_w' => $thumb_w,
		'thumb_h' => $thumb_h,
	));

	$response = $client->request();

	if ( $response->isSuccessful() )
		$info = unserialize($response->getBody());
	else
		$info = array('success' => false);

	return $info;
}

/* ID */
function idLogin($user_login, $password) {
	Yii::import('common.extensions.EHttpClient.*');

	$api_func = 'login';
	$api_url = param('idApiUrl') . $api_func;

	$client = new EHttpClient($api_url, array(
		'maxredirects' => 3,
		'timeout'      => 15,
		'adapter'      => 'EHttpClientAdapterCurl'));

	$client->setParameterGet(array(
		'api_key' => param('idApiKey'),
		'user_login' => $user_login,
		'password' => $password,
	));

	$response = $client->request();

	if ( $response->isSuccessful() )
		$info = CJSON::decode($response->getBody());
	else
		$info = array('success' => false);

	return $info;
}

function idApi($func, $params) {
	Yii::import('common.extensions.EHttpClient.*');

	$api_func = $func;
	$api_url = param('idApiUrl') . $api_func;

	$client = new EHttpClient($api_url, array(
		'maxredirects' => 3,
		'timeout'      => 15,
		'adapter'      => 'EHttpClientAdapterCurl'));

	$params['api_key'] = param('idApiKey');

	// normalize params
	foreach ($params as $k => $v) {
		if ( is_array($v) ) {
			$params[$k] = serialize($v);
		}
	}

//	var_dump(debug_backtrace());
//	var_dump($api_func);
//	var_dump($params);
//	die;

	$client->setMethod('POST');
	$client->setParameterPost($params);
	$response = $client->request();

	if ( $response->isSuccessful() )
		
		$r = CJSON::decode($response->getBody());
	else
		$r = array('success' => false);

	return $r;
}

function epubAsJSON() {
	$epub_folder = Yii::getPathOfAlias('file') . '/epub/';

	$search = "*.epub";
	$results = array();
	foreach (glob($epub_folder . $search) as $epub) {
		$name = basename($epub);
		$results[] = array(
			'value' => $name,
		);
	}

	return CJSON::encode($results);
}

/* STATIC GLOBAL VARIABLES */
function var_global($name, $value = null) {
	static $__var_globals;

	if ( $value ) {
		$__var_globals[$name] = $value;
	} elseif ( isset($__var_globals[$name]) ) {
		return $__var_globals[$name];
	}

	return null;
}

function onlineUsers() {
	$counter = app()->db->createCommand()
			->select('COUNT(id)')
			->from('{{sessions}}')
			->where('expire>:current_time')
			->queryRow(false, array(
				':current_time' => time(),
			));

	return !empty($counter) ? $counter[0] : 0;
}
function viewBookcafe() {
	$counter = app()->db->createCommand()
			->select('sum(visitor)')
			->from('{{stat_visit}}')
			->where('date(FROM_UNIXTIME(created_at)) =:current_time')
			->queryRow(false, array(
				':current_time' => date("Y-m-d"),
			));

	return !empty($counter) ? $counter[0] : 0;
}

/* RENT BOOK */
function getRentBookPrice($price) {
	$rent_prices = array(
		0 => array(
			3 => 2000,
			5 => 3000,
			7 => 5000,
		),
		20000 => array(
			3 => 3000,
			5 => 5000,
			7 => 7000,
		),
		50000 => array(
			3 => 5000,
			5 => 7000,
			7 => 10000,
		),
	);
	//New book rent price from 2014/06/23
	$rent_prices = array(
		0 =>array(
			1  => 2000,
			3  => 6000,
			5  => 10000,
			7  => 14000,
			10 => 20000,
			15 => 30000,
		)
	);
	$rent_price = array();
	foreach ($rent_prices as $k => $v) {
		if ( $price > $k ) $rent_price = $v;
	}
	
	return $rent_price;
}

/* PRICE */
function formatPrice($value, $append_currency = false) {
	$price = number_format($value, param('currency_decimals'), param('decimalPoint'), param('thousandsSeparator'));

	if ( $append_currency )
		$price .= ' ' . param('currency');

	return $price;
}

/* MISC */
function createPeriods($params)
{
	$today = getdate(TIME);
	$period = !empty($params['period']) ? $params['period'] : null;

	$time_from = !empty($params['time_from']) ? parseDate($params['time_from']) : 0;
	$time_to = !empty($params['time_to']) ? parseDate($params['time_to']) : TIME;

	// Current dates
	if ($period == 'D') {
		$time_from = mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'W') {
		$wday = empty($today['wday']) ? "6" : (($today['wday'] == 1) ? "0" : $today['wday'] - 1);
		$wstart = getdate(strtotime("-$wday day"));
		$time_from = mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']);
		$time_to = TIME;

	} elseif ($period == 'M') {
		$time_from = mktime(0, 0, 0, $today['mon'], 1, $today['year']);
		$time_to = TIME;

	} elseif ($period == 'Y') {
		$time_from = mktime(0, 0, 0, 1, 1, $today['year']);
		$time_to = TIME;

	// Last dates
	} elseif ($period == 'LD') {
		$today = getdate(strtotime("-1 day"));
		$time_from = mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']);
		$time_to = mktime(23, 59, 59, $today['mon'], $today['mday'], $today['year']);

	} elseif ($period == 'LW') {
		$today = getdate(strtotime("-1 week"));
		$wday = empty($today['wday']) ? 6 : (($today['wday'] == 1) ? 0 : $today['wday'] - 1);
		$wstart = getdate(strtotime("-$wday day", mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year'])));
		$time_from = mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']);

		$wend = getdate(strtotime("+6 day", $time_from));
		$time_to = mktime(23, 59, 59, $wend['mon'], $wend['mday'], $wend['year']);

	} elseif ($period == 'LM') {
		$today = getdate(strtotime("-1 month"));
		$time_from = mktime(0, 0, 0, $today['mon'], 1, $today['year']);
		$time_to = mktime(23, 59, 59, $today['mon'], date('t', strtotime("-1 month")), $today['year']);

	} elseif ($period == 'LY') {
		$today = getdate(strtotime("-1 year"));
		$time_from = mktime(0, 0, 0, 1, 1, $today['year']);
		$time_to = mktime(23, 59, 59, 12, 31, $today['year']);

	// Last dates
	} elseif ($period == 'HH') {
		$today = getdate(strtotime("-23 hours"));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'HW') {
		$today = getdate(strtotime("-6 day"));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'HM') {
		$today = getdate(strtotime("-29 day"));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'HC') {
		$today = getdate(strtotime('-' . $params['last_days'] . ' day'));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;
	} 
	else
	{
		//Set den gio cuoi cua ngay to_date
		$time_to = mktime(23, 59, 59, date("m", $time_to), date("d", $time_to), date("Y", $time_to));
	}

	return array($time_from, $time_to);
}

function toggleClass($class, $on_class = 'odd', $off_class = 'even') {
	return $class == $on_class ? $off_class : $on_class;
}
function getCatLevel($id_path) {
	$count = explode('/', $id_path);

	return count($count) - 1;
}

function percentage($n, $m, $round = 0, $sign = '%')
{
	if ( $m == 0 ) return 0 . $sign;
	return round(($n / $m) * 100, $round) . $sign;
}

function shortenText($text, $len, $suffix = '...') {
	if ( strlen($text) < $len ) return $text;

	$text = $text." ";
	$text = substr($text, 0, $len);
	$text = substr($text, 0, strrpos($text, ' '));
	$text = $text.$suffix;
	return $text;
}

function formatDescription($text) {
	
	$text = preg_replace('%<p([^>]+)?>((&nbsp;)+|\s+)?</p>%i', '', $text);
	
	return $text;
}

function fn_crc32($key)
{
	return sprintf('%u', crc32($key));
}

function selected($value, $data = null, $echo = true) {
	$selected = '';

	if ( ($data === null && $value) || $value == $data ) {
		$selected = 'selected="selected"';
	}

	if ( $echo )
		echo $selected;

	return $selected;
}

function add_query_arg() {
	$ret = '';
	$args = func_get_args();
	if ( is_array( $args[0] ) ) {
		if ( count( $args ) < 2 || false === $args[1] )
			$uri = $_SERVER['REQUEST_URI'];
		else
			$uri = $args[1];
	} else {
		if ( count( $args ) < 3 || false === $args[2] )
			$uri = $_SERVER['REQUEST_URI'];
		else
			$uri = $args[2];
	}

	if ( $frag = strstr( $uri, '#' ) )
		$uri = substr( $uri, 0, -strlen( $frag ) );
	else
		$frag = '';

	if ( 0 === stripos( $uri, 'http://' ) ) {
		$protocol = 'http://';
		$uri = substr( $uri, 7 );
	} elseif ( 0 === stripos( $uri, 'https://' ) ) {
		$protocol = 'https://';
		$uri = substr( $uri, 8 );
	} else {
		$protocol = '';
	}

	if ( strpos( $uri, '?' ) !== false ) {
		list( $base, $query ) = explode( '?', $uri, 2 );
		$base .= '?';
	} elseif ( $protocol || strpos( $uri, '=' ) === false ) {
		$base = $uri . '?';
		$query = '';
	} else {
		$base = '';
		$query = $uri;
	}

	_parse_str( $query, $qs );
//	$qs = urlencode_deep( $qs ); // this re-URL-encodes things that were already in the query string
	if ( is_array( $args[0] ) ) {
		$kayvees = $args[0];
		$qs = array_merge( $qs, $kayvees );
	} else {
		$qs[ $args[0] ] = $args[1];
	}

	foreach ( $qs as $k => $v ) {
		if ( $v === false )
			unset( $qs[$k] );
	}

	$ret = http_build_query( $qs );
	$ret = trim( $ret, '?' );
	$ret = preg_replace( '#=(&|$)#', '$1', $ret );
	$ret = $protocol . $base . $ret . $frag;
	$ret = rtrim( $ret, '?' );
	return $ret;
	
}

function stripslashes_deep($value) {
	if ( is_array($value) ) {
		$value = array_map('stripslashes_deep', $value);
	} elseif ( is_object($value) ) {
		$vars = get_object_vars( $value );
		foreach ($vars as $key=>$data) {
			$value->{$key} = stripslashes_deep( $data );
		}
	} elseif ( is_string( $value ) ) {
		$value = stripslashes($value);
	}

	return $value;
}

function urlencode_deep($value) {
	$value = is_array($value) ? array_map('urlencode_deep', $value) : urlencode($value);
	return $value;
}

function _parse_str( $string, &$array ) {
	parse_str( $string, $array );
	if ( get_magic_quotes_gpc() )
		$array = stripslashes_deep( $array );
}

function getDateOptions($type = 'Y') {
	$options = array();
	
	switch($type) {
		case 'Y':
			$cur_year = (int) date('Y');
			for ($i = 1940; $i <= $cur_year; $i++) {
				$options[$i] = sprintf('%s', $i);
			}
			break;
		
		case 'm':
			for ($i = 1; $i <= 12; $i++) {
				$options[$i] = sprintf('%s %d', t('Tháng'), $i);
			}
			break;
		
		case 'd':
			for ($i = 1; $i <= 31; $i++) {
				$options[$i] = sprintf('%s', $i);
			}
			break;
	}
	
	return $options;
}

/* SERIALIZE FUNCTIONS SET */
function maybe_unserialize( $original ) {
	if ( is_serialized( $original ) ) // don't attempt to unserialize data that wasn't serialized going in
		return @unserialize( $original );
	return $original;
}

function is_serialized( $data, $strict = true ) {
	// if it isn't a string, it isn't serialized
	if ( ! is_string( $data ) )
		return false;
	$data = trim( $data );
 	if ( 'N;' == $data )
		return true;
	$length = strlen( $data );
	if ( $length < 4 )
		return false;
	if ( ':' !== $data[1] )
		return false;
	if ( $strict ) {
		$lastc = $data[ $length - 1 ];
		if ( ';' !== $lastc && '}' !== $lastc )
			return false;
	} else {
		$semicolon = strpos( $data, ';' );
		$brace     = strpos( $data, '}' );
		// Either ; or } must exist.
		if ( false === $semicolon && false === $brace )
			return false;
		// But neither must be in the first X characters.
		if ( false !== $semicolon && $semicolon < 3 )
			return false;
		if ( false !== $brace && $brace < 4 )
			return false;
	}
	$token = $data[0];
	switch ( $token ) {
		case 's' :
			if ( $strict ) {
				if ( '"' !== $data[ $length - 2 ] )
					return false;
			} elseif ( false === strpos( $data, '"' ) ) {
				return false;
			}
			// or else fall through
		case 'a' :
		case 'O' :
			return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
		case 'b' :
		case 'i' :
		case 'd' :
			$end = $strict ? '$' : '';
			return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
	}
	return false;
}

function is_serialized_string( $data ) {
	// if it isn't a string, it isn't a serialized string
	if ( !is_string( $data ) )
		return false;
	$data = trim( $data );
	$length = strlen( $data );
	if ( $length < 4 )
		return false;
	elseif ( ':' !== $data[1] )
		return false;
	elseif ( ';' !== $data[$length-1] )
		return false;
	elseif ( $data[0] !== 's' )
		return false;
	elseif ( '"' !== $data[$length-2] )
		return false;
	else
		return true;
}

function maybe_serialize( $data ) {
	if ( is_array( $data ) || is_object( $data ) )
		return serialize( $data );

	// Double serialization is required for backward compatibility.
	// See http://core.trac.wordpress.org/ticket/12930
	if ( is_serialized( $data, false ) )
		return serialize( $data );

	return $data;
}

/* TIME DIFF */
function getTimeDiff($time1, $time2, $precision = 2) {

	if (!is_int($time1)) {
		$time1 = strtotime($time1);
	}
	if (!is_int($time2)) {
		$time2 = strtotime($time2);
	}

	if ($time1 > $time2) {
		list( $time1, $time2 ) = array($time2, $time1);
	}

	$intervals = array('năm', 'tháng', 'ngày', 'giờ', 'phút', 'giây');
	$diffs = array();

	foreach ($intervals as $interval) {
		$ttime = strtotime('+1 ' . $interval, $time1);
		$add = 1;
		$looped = 0;
		while ($time2 >= $ttime) {
			$add++;
			$ttime = strtotime("+" . $add . " " . $interval, $time1);
			$looped++;
		}

		$time1 = strtotime("+" . $looped . " " . $interval, $time1);
		$diffs[$interval] = $looped;
	}

	$count = 0;
	$times = array();
	foreach ($diffs as $interval => $value) {
		if ($count >= $precision) {
			break;
		}
		if ($value > 0) {
			if ($value != 1) {
				$interval .= "s";
			}
			$times[] = $value . " " . $interval;
			$count++;
		}
	}

	return implode(", ", $times);
}

function formatOrderType($type) {
	switch ($type) {
		case 'T': // thue
			return t('Thuê');

		case 'G': // tang - gift
			return t('Tặng');

		default:
			return t('Mua');
	}

	return t('Mua');
}

function formatProductStatus($type) 
{
	switch ($type) {
		case 'A':
			return t('Active');
		case 'H':
			return t('Hidden');
		case 'D':
			return t('Disabled');
		case 'P':
			return t('Pending');
		case 'S':
			return t('Success');
		case 'F':
			return t('Fail');
		default:
			return t('N/A');
	}
	return t('N/A');
}
function datetotime ($date, $format = 'DD-MM-YYYY',$to=false) {

    if ($format == 'YYYY-MM-DD') list($year, $month, $day) = explode('-', $date);
    if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $date);
    if ($format == 'YYYY.MM.DD') list($year, $month, $day) = explode('.', $date);
    
    if ($format == 'DD-MM-YYYY') list($day, $month, $year) = explode('-', $date);
    if ($format == 'DD/MM/YYYY') list($day, $month, $year) = explode('/', $date);
    if ($format == 'DD.MM.YYYY') list($day, $month, $year) = explode('.', $date);
    
    if ($format == 'MM-DD-YYYY') list($month, $day, $year) = explode('-', $date);
    if ($format == 'MM/DD/YYYY') list($month, $day, $year) = explode('/', $date);
    if ($format == 'MM.DD.YYYY') list($month, $day, $year) = explode('.', $date);
    if($to)
        return mktime(23, 59, 59, $month, $day, $year);
    else return mktime(0, 0, 0, $month, $day, $year);
}
function fn_convert_title($string) {
    $viet_strings = "a á à ả ã ạ â ấ ầ ẩ ẫ ậ ă ắ ằ ẳ ẵ ặ e é è ẻ ẽ ẹ ê ế ề ể ễ ệ i í ì ỉ ĩ ị o ó ò ỏ õ ọ ô ố ồ ổ ỗ ộ ơ ớ ờ ở ỡ ợ u ú ù ủ ũ ụ ư ứ ừ ử ữ ự đ A Á À Ả Ã Ạ Â Ấ Ầ Ẩ Ẫ Ậ Ă Ắ Ằ Ẳ Ẵ Ặ E É È Ẻ Ẽ Ẹ Ê Ế Ề Ể Ễ Ệ I Í Ì Ỉ Ĩ Ị O Ó Ò Ỏ Õ Ọ Ô Ố Ồ Ổ Ỗ Ộ Ơ Ớ Ờ Ở Ỡ Ợ U Ú Ù Ủ Ũ Ụ Ư Ứ Ừ Ử Ữ Ự Đ a á à ả ã ạ â ấ ầ ẩ ẫ ậ ă ắ ằ ẳ ẵ ặ e é è ẻ ẽ ẹ ê ế ề ể ễ ệ i í ì ỉ ĩ ị o ó ò ỏ õ ọ ô ố ồ ổ ỗ ộ ơ ớ ờ ở ỡ ợ u ú ù ủ ũ ụ ư ứ ừ ử ữ ự đ A Á À Ả Ã Ạ Â Ấ Ầ Ẩ Ẫ Ậ Ă Ắ Ằ Ẳ Ẵ Ặ E É È Ẻ Ẽ E ̣Ê Ế Ề Ể Ễ Ệ I Í Ì Ỉ Ĩ Ị O Ó Ò Ỏ Õ Ọ Ô Ố Ồ Ổ Ỗ Ộ Ơ Ớ Ờ Ở Ỡ Ợ U Ú Ù Ủ Ũ Ụ Ư Ứ Ừ Ử Ữ Ự Đ y ý ỳ ỷ ỹ ỵ Y Ý Ỳ Ỷ Ỹ Ỵ y ý ỳ ỷ ỹ ỵ Y Ý Ỳ Ỷ Ỹ Ỵ";
    $ansii_strings = "a a a a a a a a a a a a a a a a a a e e e e e e e e e e e e i i i i i i o o o o o o o o o o o o o o o o o o u u u u u u u u u u u u d A A A A A A A A A A A A A A A A A A E E E E E E E E E E E E I I I I I I O O O O O O O O O O O O O O O O O O U U U U U U U U U U U U D a a a a a a a a a a a a a a a a a a e e e e e e e e e e e e i i i i i i o o o o o o o o o o o o o o o o o o u u u u u u u u u u u u d A A A A A A A A A A A A A A A A A A E E E E E E E E E E E E I I I I I I O O O O O O O O O O O O O O O O O O U U U U U U D U U U U U U y y y y y y Y Y Y Y Y Y y y y y y y Y Y Y Y Y Y";

    $viet_strings_array = explode(" ", $viet_strings);
    $ansii_strings_array = explode(" ", $ansii_strings);

    $string = str_replace($viet_strings_array, $ansii_strings_array, $string);

    return $string;
}