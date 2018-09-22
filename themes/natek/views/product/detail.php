<section class="highlight highlight-1">
        <div class="container">
            <div class="row">
                <section class="content col-sm-8">
                    <div class="fck">
                        <h1><?php echo $info['name'];?></h1>
                        <hr>
                        <span class="date">Hồ Chí Minh, <?php echo date("d/m/Y",strtotime($info['created_at']));?></span>
                        <div class="block-product">
	                        <?php
		                        if(!empty($list_image))
		                        {
			                        ?>
			                        <div class="outer-slider">
		                                <div id="slider" class="flexslider">
		                                  <ul class="slides">
			                                  <?php
				                                  foreach($list_image as $item)
				                                  {
					                                  $pair=(object)array('thumb_image'=>$item->thumb_image,'image_x'=>"",'image_y'=>"",'id'=>$item->id);
					                                  ?>
					                                  <li>
					                                  	<?php
						                                  	$this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'product', 'no_link' => true, 'width' => 450, 'height' => 329,'class'=>""));	
					                                  	?>
					                                  </li>
					                                  <?php
				                                  }
			                                  ?>
		                                  </ul>
		                                </div>
		                                <div id="carousel" class="flexslider">
		                                  <ul class="slides">
		                                    <?php
				                                  foreach($list_image as $item)
				                                  {
					                                  $pair=(object)array('thumb_image'=>$item->thumb_image,'image_x'=>"",'image_y'=>"",'id'=>$item->id);
					                                  ?>
					                                  <li>
					                                  	<?php
						                                  	$this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'product', 'no_link' => true, 'width' => 86, 'height' => 63,'class'=>""));	
					                                  	?>
					                                  </li>
					                                  <?php
				                                  }
			                                  ?>

		                                  </ul>
		                                </div>
		                            </div>
			                        <?php
		                        }
	                        ?>
                            
                            <div class="ctn-slider">
                                <p><?php echo t('Product code');?>: <?php echo $info['product_code'];?></p>
                                <p><?php echo t('Category');?>: <?php echo $cate_info['name'];?></p>
                                <p><?php echo t('Unit price');?>: <?php echo number_format($info['gia_ban']);?>Đ</p>
                                <p><?php echo t('Short description');?>: <?php echo $info['short_description'];?></p>
                            </div>
                           

                        </div>
                        <?php echo $info['description'];?>
                        <span class="author text-right"><?php echo DModels::get_author_by_id($info['owner_id']);?></span>
                    </div>
                    <?php $this->renderPartial("//blocks/tool_social",array('link_url'=>$link_url)); ?>
                    
                    <div class="block-others">
                        <h2><a href="#" title=""><?php echo t('Other products');?></a></h2>
                        <div class="row">
	                        <?php
		                        if(!empty($list_orther_product))
		                        {
			                        foreach($list_orther_product as $item)
			                        {
				                        $pair=(object)array('thumb_image'=>$item['thumb_image'],'image_x'=>$item['image_x'],'image_y'=>$item['image_y'],'id'=>$item['i_id']);
										$link=$this->createUrl('/product/detail',array('id'=>$item['p_id'],'title'=>$item['seo_name']));
						 
				                        ?>
				                        <article class="art-5 col-sm-4">
			                                 <a class="thumb" href="<?php echo $link;?>">
				                                 <?php $this->renderPartial('//blocks/image', array(
	                                                'pair' => $pair,
	                                                'object_type' => 'product',
	                                                'width'=>230,
	                                                'height'=>168,
	                                                 'alt'=>$item['name'],
	                                                 'class'=>'',
	                                              )); ?>
			                                 </a>
			                                <h3><a href="<?php echo $link;?>" title=""><?php echo $item['name'];?></a></h3>
			                                <p><?php echo shortenText($item['short_description'],70);?></p>
			                                <a class="btn btn-more" href="<?php echo $link;?>" title=""><?php echo t('More');?></a>
			                            </article>
				                        <?php
			                        }
		                        }
	                        ?>
                            
                        </div>
                    </div>
                    <div class="block-comment">
                        <div class="fb-comments" data-href="<?php echo $link_url;?>" data-width="750" data-numposts="5"></div>
                    
                    </div>
                </section>
                <aside class="sidebar col-sm-4">
                    <div class="block-bar">
                        <h2><a href="<?php echo $this->createUrl('/product/index') ?>" title="<?php echo t('Product');?>"><?php echo t('Product');?></a></h2>
                        
		                        <?php
		                        $categories = DModels::get_list_cate_by_parent_id(param('cate_id_sp'),'',$_SESSION['language']);
		                        if(!empty($categories))
		                        {
			                        ?>
			                        <ul class="list-new">
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
	                        
                            
                        
                    </div>
                    <?php $this->renderPartial("//blocks/sidebar_sp") ?> 
                </aside>
            </div>
        </div>
    </section>