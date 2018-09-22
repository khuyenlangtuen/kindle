<?php 
$this->breadcrumbs=array(
array('name' => t('Home'), 'url' => array('site/index')),
array('name' => DModels::get_general('forget_password',$_SESSION['language'],true) ) ); ?>
<section class="products">    
	<div id="products-page" class="container" style="margin-bottom:15px">      
		<div class="row">
		<div id="paging_content" style="text-align:center;padding:40px 0;min-height:200px">
			
			<form action="<?php echo $this->createUrl('/user/forgetpass')?>" method="post" id="cartform" name="cartform">
				<div id="errors_email_fp"><?php echo (isset($mess)) ? $mess : ''?></div>
				<div>
					<span style="width:150px;"><?php echo t('Email');?> <font color="#ff0000">*</font></span>
					<span><input type="text" name="email" id="email_fp" size="40" maxlength="255" value="" class="string_active"></span>
					<span`><input type="submit" onclick="return check_form_forgetpass();" name="submit" value="<?php echo DModels::get_general('submit',$_SESSION['language'],true);?>"></span>
							
				</div>
								
								
			</from>

	</div>      
</div>    
</div>  
</section>	