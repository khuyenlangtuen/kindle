<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('upload', dirname(__FILE__).'/../../uploads');
Yii::setPathOfAlias('common', dirname(__FILE__).'/../../common');
Yii::setPathOfAlias('filemanager', dirname(__FILE__).'/../../rfilemanager');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>t('company name'),

	// preloading 'log' component
	'preload'=>array('log'),
    'language' => NGON_NGU,
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'ext.YiiMailer.YiiMailer',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		/**/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'facebook'=>array(
		    'class' => 'ext.yii-facebook-opengraph.SFacebook',
		    'appId'=>'771260352885542', // needed for JS SDK, Social Plugins and PHP SDK
		    'secret'=>'178984ade65d86b40c9ed2b4afc28a40', // needed for the PHP SDK
		    'fileUpload'=>true, // needed to support API POST requests which send files
		    //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
		    'locale'=>'vi_VN', // override locale setting (defaults to en_US)
		    //'jsSdk'=>true, // don't include JS SDK
		    //'async'=>true, // load JS SDK asynchronously
		    'jsCallback'=>true, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
		    //'status'=>true, // JS SDK - check login status
		    'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
		    //'oauth'=>true,  // JS SDK - enable OAuth 2.0
		    'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
		    //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
		    //'html5'=>true,  // use html5 Social Plugins instead of XFBML
		    //'ogTags'=>array(  // set default OG tags
		        //'title'=>'MY_WEBSITE_NAME',
		        //'description'=>'MY_WEBSITE_DESCRIPTION',
		        //'image'=>'URL_TO_WEBSITE_LOGO',
		    //),
		  ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
                'trang-chu'=>'site/index',
				'san-pham'=>'product/index',
				'dich-vu'=> 'content/dv',
				'partner/page-<page:\d+>'=> 'content/doitac',
				'partner'=> 'content/doitac',
				'gioi-thieu'=> 'content/gioithieu',
				'gioi-thieu/<title:.*?>-<id:\d+>'=> 'content/detail',
				'dich-vu/<title:.*?>-<id:\d+>'=> 'content/detaildv',
				'tin-tuc/<title:.*?>-A<id:\d+>'=> 'content/detailnews',
				'tin-tuc/<title:.*?>-<id:\d+>'=> 'content/news',
				'tin-tuc'=> 'content/news',
				'du-an/<title:.*?>-<id:\d+>'=> 'content/detailud',
				'lien-he'=> 'content/lienhe',
				'dang-ky'=>'user/register',
				'<title:.*?>-P<id:\d+>'=>'product/detail',
				'<title:.*?>-C<cate_id:\d+>P<page:\d+>'=>'product/cate',
				'<title:.*?>-C<cate_id:\d+>'=>'product/cate',
				'hoi-dap'=>'content/faq',
				'cau-hoi-khac'=>'content/faqother',
				'hoi-dap/chi-tiet-F<id:\d+>'=>'content/detailfaq',
				'bao-gia'=>'cart/hoigia',
				'tim-kiem'=>'site/find',
				'quen-mat-khau'=>'user/forgetpass',
				'ho-so'=>'user/profile',
				'su-kien/<id:\d+>'=> 'content/detailSukien',
				
			),
			'urlSuffix' => '.html',
            'showScriptName'=>false,
			'caseSensitive'=>false,
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

        'db'=>require(dirname(__FILE__).'/../../common/config/db.php'),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
            //'directoryLevel' => 1,
            ),
		/**/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'image' => array(
			'class' => 'common.extensions.image.CImageComponent',
			'driver' => 'GD',
			'params' => array('directory', dirname(__FILE__).'/../../uploads'),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'frontUrl' => 'http://natek.alldemo.xyz/',
		'LINK_SOURCE_ANH'=>'http://natek.alldemo.xyz/rfilemanager',
        'limit_on_page'=>10,
        'limit_sk'=>2,
        'FEE_SHIPPING'=>100000,
        'id_gioi_thieu'=>11,
        'cate_id_sp'=>7,
        'id_chuyen_muc_tintuc'=>12,
	),
	'theme'=>THEMES,
);