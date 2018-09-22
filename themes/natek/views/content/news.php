<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo $menu_info['name'];?></h2>
                 <p><?php echo $menu_info['short_description'];?></p>
                 <hr class="line-1">
            </div>
            <?php
	            if(!empty($list))
	            {
		            foreach($list as $key=>$row)
		            {
			            $pair=(object)array('thumb_image'=>$row['thumb_image'],'image_x'=>$row['image_x'],'image_y'=>$row['image_y'],'id'=>$row['i_id']);
						
						$image=$this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true, 'width' => 130, 'height' => 130), true);
			            $link=$this->createUrl('/content/detailnews',array('id'=>$row['content_id'],'title'=>$row['seo_name']));
			            if($key==0)
			            {
				            $image=$this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true, 'width' => 547, 'height' => 369), true);
			            
				            ?>
				             <article class="art-feature-left art-feature-left-1">
				                <a href="<?php echo $link;?>"><img  src="<?php echo $image;?>"  alt=""></a>
				                <div>
				                    <h3><a href="<?php echo $link;?>" title=""><?php echo $row['name'];?></a></h3>
				                    <p><?php echo $row['short_description'];?></p> 
				                    <a class="btn btn-more" href="<?php echo $link;?>" title=""><?php echo t('More');?></a>
				                </div>   
				            </article>
				           <div class="row">
				            <?php
			            }
			            else{
				            ?>
				            <article class="art-4 art-4-left col-sm-6">
			                    <a href="<?php echo $link;?>" title=""><img src="<?php echo $image;?>" alt=""></a>
			                    <h3><a href="<?php echo $link;?>" title=""><?php echo $row['name'];?></a></h3>
			                    <p><?php echo shortenText($row['short_description'],150);?></p>
			                     <a class="btn btn-more" href="<?php echo $link;?>" title=""><?php echo t('More');?></a>
			                </article>
				            <?php
			            }
		            }
		            ?>
		            </div>
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
    </section>