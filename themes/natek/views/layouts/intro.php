<!doctype html>
<!--[if IE 7]><html lang="en" class="ie7"></html><![endif]-->
<!--[if IE 8]><html lang="en" class="ie8"></html><![endif]-->
<!--[if IE 9]><html lang="en" class="ie9"></html><![endif]-->
<!-- [if gt IE 9] <!-->
<html lang="en">
  <!-- <![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="google-site-verification" content="QptEguSXsqEThiEjl3H7PPYF4ktrDV-F-ySj0iaJVDo" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php if ( !empty($this->seo_data) ) {
	foreach ($this->seo_data as $k => $v) {
	   
		if ( !empty($v) )
        {
            if($k=='description' || $k=='keywords')
                printf('<meta name="%s" content="%s" />', $k, CHtml::encode($v));
            
            printf('<meta property="%s" content="%s" />', $k, CHtml::encode($v));
        }
			
	}	
} 
else{
	?>
    <meta name="keywords" content="">
	<meta name="description" content="" />
	<meta property="og:description" content="" />

	<?php
}
?>
	<meta name="robots" content="noindex, nofollow" />
	<meta name="author" content="KentNguyen" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="shortcut icon" href="<?php echo tu() ?>/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/font-awesome.min.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/jquery.custom-scrollbar.css" media="screen" />

	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/style.css?v=15.04.2016" media="screen" />
		<!--link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/lib.css" media="screen" /-->
	<script>
    var index_script = '<?php echo bu('/') ?>';
</script>
<script src="<?php Yii::app()->clientScript->registerScriptFile(tu()."/js/jquery.js");?>"></script>
<script src="<?php Yii::app()->clientScript->registerScriptFile(tu()."/js/lib.js");?>"></script>
	<script src="<?php Yii::app()->clientScript->registerScriptFile(tu()."/js/smooth.js");?>"></script>
	<script src="<?php Yii::app()->clientScript->registerScriptFile(tu()."/js/animate_fade.js");?>"></script>
	<script src="<?php Yii::app()->clientScript->registerScriptFile(tu()."/js/fontend.js");?>"></script>
	<script src="<?php Yii::app()->clientScript->registerScriptFile(tu()."/html5lightbox/html5lightbox.js");?>"></script>
<style>
	#section5 .right .layer_content{
		bottom: 87px !important;
	}
	body{
		padding: 0 !important;
	}
	a:hover{
		text-decoration: none;
	}
	.close {
  float: right;
  font-size: 21px;
  font-weight: bold;
  line-height: 1;
  color: #000;
  text-shadow: 0 1px 0 #fff;
  filter: alpha(opacity=20);
  opacity: .2;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
  filter: alpha(opacity=50);
  opacity: .5;
}
button.close {
  -webkit-appearance: none;
  padding: 0;
  cursor: pointer;
  background: transparent;
  border: 0;
}
.modal-open {
  overflow: hidden;
}
.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: none;
  overflow: hidden;
  -webkit-overflow-scrolling: touch;
  outline: 0;
}
.modal.fade .modal-dialog {
  -webkit-transition: -webkit-transform .3s ease-out;
       -o-transition:      -o-transform .3s ease-out;
          transition:         transform .3s ease-out;
  -webkit-transform: translate(0, -25%);
      -ms-transform: translate(0, -25%);
       -o-transform: translate(0, -25%);
          transform: translate(0, -25%);
}
.modal.in .modal-dialog {
  -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
       -o-transform: translate(0, 0);
          transform: translate(0, 0);
}
.modal-open .modal {
  overflow-x: hidden;
  overflow-y: auto;
}
.modal-dialog {
  position: relative;
  width: auto;
  margin: 10px;
}
.modal-content {
  position: relative;
  background-color: #fff;
  -webkit-background-clip: padding-box;
          background-clip: padding-box;
  border: 1px solid #999;
  border: 1px solid rgba(0, 0, 0, .2);
  border-radius: 6px;
  outline: 0;
  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
          box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
}
.modal-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1040;
  background-color: #000;
}
.modal-backdrop.fade {
  filter: alpha(opacity=0);
  opacity: 0;
}
.modal-backdrop.in {
  filter: alpha(opacity=50);
  opacity: .5;
}
.modal-header {
  min-height: 16.42857143px;
  padding: 15px;
  border-bottom: 1px solid #e5e5e5;
}
.modal-header .close {
  margin-top: -2px;
}
.modal-title {
  margin: 0;
  line-height: 1.42857143;
}
.modal-body {
  position: relative;
  padding: 15px;
}
.modal-footer {
  padding: 15px;
  text-align: right;
  border-top: 1px solid #e5e5e5;
}
.modal-footer .btn + .btn {
  margin-bottom: 0;
  margin-left: 5px;
}
.modal-footer .btn-group .btn + .btn {
  margin-left: -1px;
}
.modal-footer .btn-block + .btn-block {
  margin-left: 0;
}
.modal-scrollbar-measure {
  position: absolute;
  top: -9999px;
  width: 50px;
  height: 50px;
  overflow: scroll;
}
@media (min-width: 768px) {
  .modal-dialog {
    width: 600px;
    margin: 30px auto;
  }
  .modal-content {
    -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
  }
  .modal-sm {
    width: 300px;
  }
}
@media (min-width: 992px) {
  .modal-lg {
    width: 900px;
  }
  .modal-lg2 {
    width: 853px;
  }
}
</style>
</head>
<body>
	<div id="primary" class="main_page">
	<?php echo $content ?>
	</div>
	<div class="modal fade" tabindex="-1" id="id_errors_mess" role="dialog" aria-labelledby="myModal_item">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
			<h4 style="text-align: center" class="modal-title" id="myModal_item">Thông báo</h4>
			
		  </div>
		  <div class="modal-body">		
				<div class="form-group style-col" id="id_errors_code" style="text-align: center">
					
				</div>		
		  </div>
		</div>
	  </div>
	</div>
</body>
</html>
