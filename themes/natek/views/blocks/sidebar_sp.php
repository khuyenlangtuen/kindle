<?php
	$banners=DModels::get_list_banners_by_position('right_child',$_SESSION['language']);
	if(!empty($banners))
    {
	    foreach ($banners as $banner)
        {
	        ?>
	        <div class="block-bar">
			     <a href="<?php echo $banner->link_url;?>" target="<?php echo $banner->target;?>">
                        	<?php $this->renderPartial('//blocks/image', array(
        						'pair' => $banner->main_image_pair,
        						'object_type' => 'banner',
                                'alt'=>$banner->language->name,
        					)); ?>							</a>
			</div>
	        <?php
        }
	}
?>

