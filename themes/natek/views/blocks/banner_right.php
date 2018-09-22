
	<?php 
        $banners=DModels::get_list_banners_by_position('right_child',$_SESSION['language']);
        if(!empty($banners))
        {
			?>
			<div>
	<div class="gap-30"></div>
	<strong class="stitle"><?php echo t('ads');?></strong>
			<?php
            foreach ($banners as $banner)
            {
                ?>
                <a href="<?php echo $banner->link_url;?>" target="<?php echo $banner->target;?>">
                        	<?php $this->renderPartial('//blocks/image', array(
        						'pair' => $banner->main_image_pair,
        						'object_type' => 'banner',
                                'alt'=>$banner->language->name,
        					)); ?>							</a>
    		  <?php 
            
            } 
			?>
			</div>
			<?php
        }
        ?>
