<section class="products">
	<div id="products-page" class="container" style="margin-bottom:15px">
		<div class="row"> 
			<div id="form-register">
				<span class="title-lienhe"><?php echo t('login');?></span>
				<div style="color:red" id="errors"></div>
				<div style="color:blue"><?php echo (isset($_REQUEST['tb']) && $_REQUEST['tb']==1) ? t('register success'):'';?></div>
				<form action="<?php echo $this->createUrl('/user/login')?>" method="post">
					<div class="login-form">
						<input name="item[username]" type="text" placeholder="Username" size="25">
						<input name="item[password]" type="password" placeholder="Password" size="25">
						<input type="submit" value="Login" class="btn">
					</div>				
					
				  </form>
			</div>		
		</div>
    </div>
</div>
</section>
