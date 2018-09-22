<?php
	$cate_pro=DModels::get_cate_by_cate_id(param('cate_id_sp'),$_SESSION['language']);
	$categories = DModels::get_list_cate_by_parent_id(param('cate_id_sp'),'',$_SESSION['language'],4);
	
?>
<section class="highlight">
        <div class="container">
	        <?php
		        if(!empty($cate_pro))
		        {
			        ?>
			        <div class="block-first text-center">
		                 <h2 class="section-heading"><?php echo $cate_pro['name'];?></h2>
		                 <p><?php echo $cate_pro['short_description'];?></p>
		                 <hr class="line-1">
		            </div>
			        <?php
		        }
		        if(!empty($categories))
		        {
			        ?>
			        <div class="outer-art-2 row">
				        <?php
					        foreach($categories as $row)
					        {
						        $pair=(object)array('thumb_image'=>$row['thumb_image'],'image_x'=>$row['image_x'],'image_y'=>$row['image_y'],'id'=>$row['i_id']);
								$link=$this->createUrl('/product/cate',array('cate_id'=>$row['c_id'],"title"=>$row['seo_name']));
						        ?>
						        <article class="art-2 col-sm-3">
				                    <h3><a href="<?php echo $link;?>" title=""><i class="icon icon-1"></i> <?php echo $row['name'];?></a></h3>
				                    <a href="<?php echo $link;?>" title="">
					                    <?php 
							               $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'origin', 'no_link' => true, 'width' => 263, 'height' => 172,'class'=>''));
											
							                ?></a>
				                    <p><?php echo $row['short_description'];?></p>
				                    <a class="btn btn-more" href="<?php echo $link;?>" title="">Xem thêm</a>
				                    <hr>
				                </article>
						        <?php
					        }
				        ?>
		                
		                
		            </div>
			        <?php
		        }
	        ?>
             
            
        </div>
    </section>