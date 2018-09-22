
<?php
	$banners=DModels::get_list_banners_by_position('main_home',$_SESSION['language']);
    if(!empty($banners))
    {
        ?>
        <header class="header-1">
		        <div class="flexslider flexslider-top">
		            <ul class="slides">
			            <?php
				            
				            foreach ($banners as $banner)
				            {
					            $image=($banner->main_image_pair->thumb_image) ? $banner->main_image_pair->thumb_image : "banner_no_image.jpg";
				                $link_image="/uploads/banner/".$image;
				                ?>
				                 
								<li style="background-image: url('<?php echo $link_image ?>'); background-size: cover;">
				                    <a href="<?php echo $banner->link_url;?>" title="<?php echo $banner->language->name;?>" target="<?php echo ($banner->target) ? $banner->target : "";?>">
					                    <div class="header-content-inner">
					                        <?php
						                        echo  $banner->language->description;
					                        ?>
					                        <hr class="line-1">
					                    </div>
				                    </a>
				                </li>
				    		  <?php 
				            
				            } 
			            ?>
			         </ul>    
		        </div>    
		</header>
        <?php
    }
?>
