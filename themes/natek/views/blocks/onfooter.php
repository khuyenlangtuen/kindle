<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style>
.blk-news{ 	background: url(<?php echo t('image news'); ?>) no-repeat left top;}
.blk-support{ 	background: url(<?php echo t('image support'); ?>) no-repeat left top;}
.blk-doitac{ 	background: url(<?php echo t('image partner'); ?>) no-repeat left top;}
</style>
<script type="text/javascript" src="themes/v1/js/sliderimage/jquery-1.4.2.min.js"></script>
<section class="home-products gallery" style="width:1170px; margin: 0 auto;">
	<div class="blk-news">
		<?php echo DModels::get_general('news_on_footer',$_SESSION['language']);?>
	</div>
	<div class="blk-support">
		<?php echo DModels::get_general('hotline',$_SESSION['language']);?>
		<div class="blk-subscribe"><b><?php echo t('input email recive news').":";?></b>	
			<p class="home-newsletter"></p>
			<form action="<?php echo $this->createUrl('/site/newsletter')?>" id="newsletter_form" method="post">
				<input type="text" id="newsletter_email" name="item[email]" value="">
				<input onclick="return check_form_newsletter();" type="submit" value="<?php echo t('register')?>">
			</form>
			<p></p>	
		</div>
	</div>
	<div class="blk-doitac">		
        <div id="slider-partner" class="item">
            <ul id="content-slider-2" class="content-slider" style="height:115px !important;">
			<?php
			$partners=DModels::get_list_banners_by_position('partner',$_SESSION['language']);
			if(!empty($partners))
			{
				for($i=0;$i<count($partners); $i++)
				{
					$j=$i+1;
					?>			
					<li>
						<a href="<?php echo $partners[$i]->link_url;?>" target="<?php echo $partners[$i]->target;?>">
						<?php $this->renderPartial('//blocks/image', array(

							'pair' => $partners[$i]->main_image_pair,

							'object_type' => 'banner',

							'alt'=>$partners[$i]->language->name,


						)); ?>
						</a>
					</li>
					<?php
				}
				
			}
			?>
            </ul>
        </div>	
	</div>	
</section>
<script>
function check_form_newsletter()
{
	if($('#newsletter_email').val()=='')
	{
		alert('<?php echo t('email not empty');?>');
		return false;
	}
	else{
		var rege = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(!rege.test($("#newsletter_email").val()))
		{
			alert('<?php echo t('email not format');?>');
			return false;
		}
	}
}
</script>