<?php
	$cur_link=Yii::app()->request->url;
$cur_link=str_replace("?lg=vn","",$cur_link);
$cur_link=str_replace("?lg=en","",$cur_link);
$cur_link=str_replace("&lg=vn","",$cur_link);
$cur_link=str_replace("&lg=en","",$cur_link);

?>
<!doctype html>
<!--[if IE 7]><html lang="en" class="ie7"></html><![endif]-->
<!--[if IE 8]><html lang="en" class="ie8"></html><![endif]-->
<!--[if IE 9]><html lang="en" class="ie9"></html><![endif]-->
<!-- [if gt IE 9] <!-->
<html lang="en">
  <!-- <![endif]-->
<head>
    <meta charset="utf-8" />
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
	<meta name="robots" content="index, follow" />
	<meta name="author" content="1990.agency" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="shortcut icon" href="<?php echo tu() ?>/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/print.css" media="print">
	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/lib.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/plugin.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo tu() ?>/css/screen.css" media="screen" />
	<!--[if lt IE 9]>
	 <script src="../js/html5shiv.js" type="text/javascript"></script>
	 <script src="../js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<script>
	    var index_script = '<?php echo bu('/') ?>';
	    var image_path = '<?php echo tu() ?>/';
	    
	</script>
	<style>
		.fileUpload {
    position: relative;
    overflow: hidden;
    //margin: 10px;
    background-color: #C0C0C0;
    padding-top:2px; 
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
		
	</style>
</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top main-nav">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo bu('/');?>"><img src="<?php echo tu() ?>/images/logo.png"  alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-right" action="<?php echo $this->createUrl('/site/find') ?>" method="get" role="search">
                    <div class="form-group">
                      <input type="text" class="form-control" name="q" placeholder="Tìm kiếm">
                    </div>
                    <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-search"></i></a>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo $this->createUrl('/content/gioithieu') ?>"><?php echo t("Introduce");?></a>
                    </li>
                    <li class="<?php echo ($this->menu=="doitac") ? "active":"";?>">
                        <a href="<?php echo $this->createUrl('/content/doitac') ?>"><?php echo t("Partner");?></a>
                    </li>
                    <li class="dropdown <?php echo ($this->menu=="sanpham") ? "active":"";?>" >
                        <a tabindex="0" data-toggle="dropdown" data-submenu href="<?php echo $this->createUrl('/product/index') ?>" class="dropdown-toggle disabled"><i class="icon icon-paper"></i> <span><?php echo t("Product");?></span></a>
                        <a class="dropdown-toggle outer-caret" data-toggle="dropdown" href="javascript:void(0)"><b class="caret"></b></a>                
                        <?php
	                        $categories = DModels::get_list_cate_by_parent_id(param('cate_id_sp'),'',$_SESSION['language']);
	                        if(!empty($categories))
	                        {
		                        ?>
		                        <ul class="dropdown-menu">
			                        <?php
				                        foreach($categories as $row)
				                        {
					                        $link=$this->createUrl('/product/cate',array('cate_id'=>$row['c_id'],"title"=>$row['seo_name']));
						        
					                        ?>
					                        <li><a title="<?php echo $row['name'];?>" href="<?php echo $link;?>"><?php echo $row['name'];?></a></li>
					                        <?php
				                        }
			                        ?>
		                                              
		                        </ul>
		                        <?php
	                        }
                        ?>
                        
                    </li>
                    <li class="<?php echo ($this->menu=="news") ? "active":"";?>">
                        <a href="<?php echo $this->createUrl('/content/news') ?>"><?php echo t("News");?></a>
                    </li>
                    <li class="<?php echo ($this->menu=="faq") ? "active":"";?>">
                        <a href="<?php echo $this->createUrl('/content/faq') ?>"><?php echo t("FAQ");?></a>
                    </li>
                    <li>
                        <a href="<?php echo $this->createUrl('/content/lienhe') ?>"><?php echo t("Contact");?></a>
                    </li>
                </ul>
               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

     
    <?php echo $content ?>

    <footer class="footer">
        <div class="container">
            <h4>Natek</h4>
            <div class="row">
                <ul class="col-sm-4">
                    <li><address>2nd Floor, Ngoc Dong Duong Building, 76 CMT8, Ward 6, District 3, HCMC.</address></li>
                    <li><a href="mailto:hello@ 1990.agency" title="">E: hello@ 1990.agency</a></li>
                    <li><a href="tel:0839 309 071" title="">T: 0839 309 071</a></li>
                </ul>
                <ul class="col-sm-1">
                    <li><a href="<?php echo $this->createUrl('/content/gioithieu') ?>" title=""><?php echo t("Introduce");?></a></li>
                    <li><a href="<?php echo $this->createUrl('/content/doitac') ?>" title=""><?php echo t("Partner");?></a></li>
                    <li><a href="<?php echo $this->createUrl('/product/index') ?>" title=""><?php echo t("Product");?></a></li>
                </ul>
                <ul class="col-sm-1">
                    <li><a href="<?php echo $this->createUrl('/content/news') ?>" title=""><?php echo t("News");?></a></li>
                    <li><a href="<?php echo $this->createUrl('/content/faq') ?>" title=""><?php echo t("FAQ");?></a></li>
                    <li><a href="<?php echo $this->createUrl('/content/lienhe') ?>" title=""><?php echo t("Contact");?></a></li>
                </ul>
                <div class="col-sm-6">
                    <div class="inner">
                         <h5>Follow us</h5>
                        <form class="frm-mail">
                            <input class="txt-mail" type="text" name="">
                        </form>
                        <a class="btn-fb" href="#"><i class="fa fa-facebook"></i></a>
                        <a class="btn-tw" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="btn-gplus" href="#"><i class="fa fa-google-plus"></i></a>
                        <ul class="list-lag">
	                        <?php
		                        $kytu="?";
		                        if (strpos($cur_link, '?') !== false) {
								    $kytu="&";
								}
	                        ?>
                            <li><a href="<?php echo $cur_link.$kytu.'lg=en' ?>"> <img src="<?php echo tu() ?>/images/flg-eng.jpg"  alt=""></a></li>
                            <li><a href="<?php echo $cur_link.$kytu.'lg=vn' ?>"> <img src="<?php echo tu() ?>/images/flg-vn.jpg"  alt=""></a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
    <a class="btn-top" href="javascript:void(0)" title=""><i class="fa fa-chevron-up"></i></a>
	<script type="text/javascript" src="<?php echo tu() ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo tu() ?>/js/lib.js"></script>
	<script type="text/javascript" src="<?php echo tu() ?>/js/plugin.js"></script>
	<script type="text/javascript" src="<?php echo tu() ?>/js/start.js"></script>
	<script type="text/javascript" src="<?php echo tu() ?>/js/fontend.js"></script>
</body>
</html>
