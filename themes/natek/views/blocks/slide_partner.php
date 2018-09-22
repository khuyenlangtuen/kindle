<?php 
    $banners=DModels::get_list_banners_by_position('partner',$_SESSION['language']);
    if(!empty($banners))
    {
	    ?>
	    <section class="highlight highlight-brand">
	        <div class="container">
	             <ul class="list-brand">
	               	<?php
		               	foreach ($banners as $banner)
				        {
				            ?>
				            <li><a href="<?php echo $banner->link_url;?>" title="<?php echo $banner->language->name;?>" target="<?php echo ($banner->target) ? $banner->target : "";?>">
				            	<?php $this->renderPartial('//blocks/image', array(
				    						'pair' => $banner->main_image_pair,
				    						'object_type' => 'banner',
				                            'alt'=>$banner->language->name,
				                            'class'=>'',
				                            'width'=>102,
				                            'height'=>56,
				    					)); ?>	
				    				</a></li>   
						  <?php 
				        
				        } 
	               	?>
	            </ul>
	        </div>
	    </section>
	    <?php
        
    }
    ?>   

