<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo t('Partner');?></h2>
                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat...</p>
                 <hr class="line-1">
            </div>
            <article class="art-feature">
                <img  src="<?php echo tu();?>/images/photo/photo-2.jpg"  alt="">
            </article>
            <div class="row">
	            <?php 
		            if(!empty($list))
		            {
			            foreach($list as $row)
			            {
				            ?>
				            <article class="art-brand col-sm-4">
			                    <a href="<?php echo $row->link_url;?>" title="<?php echo $row->language->name;?>" target="<?php echo ($row->target) ? $row->target : "";?>">
				                    <?php
					                    $this->renderPartial('//blocks/image', array(
				    						'pair' => $row->main_image_pair,
				    						'object_type' => 'banner',
				                            'alt'=>$row->language->name,
				                            'class'=>'',
				                            'width'=>360,
				                            'height'=>240,
				    					)); ?>
					                    
				                    
				                    
			                    </a>
			                    <h3><a href="<?php echo $row->link_url;?>" title=""><?php echo $row->language->name;?></a></h3>
			                   
			                </article>
				            <?php
			            }
			            ?>
				            <nav class="paging">
				                <?php
							            $this->widget('ext.MyLinkPager', array(
					                  'currentPage'=>$pages->getCurrentPage(),
					                  'itemCount'=>$item_count,
					                  'pageSize'=>$pages->pageSize,
					                  'maxButtonCount'=>5,
					                  'header'=>'',
					                  'htmlOptions'=>array('class'=>'pagination'),
					                ));
						            ?>
				            </nav>
			            <?php
		            }
	            ?>
                
			</div>	
			
			
        </div>
    </section>