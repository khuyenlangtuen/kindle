<?php
	$tin_gioi_thieu=DModels::get_content_by_id(param('id_gioi_thieu'),$_SESSION['language']);
	if(!empty($tin_gioi_thieu))
	{
		$pair=(object)array('thumb_image'=>$tin_gioi_thieu['thumb_image'],'image_x'=>$tin_gioi_thieu['image_x'],'image_y'=>$tin_gioi_thieu['image_y'],'id'=>$tin_gioi_thieu['i_id']);
					
		?>
		<section class="highlight">
	        <div class="container">
	             <div class="block-first text-center">
	                 <h2 class="section-heading"><?php echo  $tin_gioi_thieu['name'];?></h2>
	                 <p><?php echo  $tin_gioi_thieu['short_description'];?></p>
	                 <hr class="line-1">
	            </div>
	            <article class="art-1">
	               <?php 
		               $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'width' => 871, 'height' => 315,'class'=>'img-full'));
						
		                ?>
	                <div class="ctn">
	                    <div class="center">
	                        <p><?php echo $tin_gioi_thieu['description'];?></p>
	                        <a class="btn btn-large btn-more" href="<?php echo $this->createUrl('/content/gioithieu') ?>" title=""><?php echo t('More')?></a>
	                    </div>
	                    
	                </div>
	            </article>
	        </div>
	    </section>
		<?php
	}
?>

