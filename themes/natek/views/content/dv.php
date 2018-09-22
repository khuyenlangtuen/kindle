<section class="products">
    <div id="products-page" class="container" style="margin-bottom:15px">
      <div class="row"> 
        <!-- /.Products Left Start ./-->
          <div class="pro-title">
            <h1><?php echo $cate_name?></h1>
          </div>
          <div id="paging_content">
			<?php
			if($list)
			{
				foreach($list as $item)
				{
					$pair=(object)array('thumb_image'=>$item['thumb_image'],'image_x'=>$item['image_x'],'image_y'=>$item['image_y'],'id'=>$item['i_id']);
					?>
					  <div id="page-ungdung" class="col-md-3" style="text-align: center;">
						<div>
						<a href="<?php echo $this->createUrl('/content/detaildv',array('title'=>$item['seo_name'],'id'=>$item['content_id'])) ?>">
									<?php
									$this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'width' => 345, 'height' => 175));
									?>
								</a>
						</div>
						
						<div class="title-ungdung"><a href="<?php echo $this->createUrl('/content/detaildv',array('title'=>$item['seo_name'],'id'=>$item['content_id'])) ?>"><span class="title-ud"><?php echo ($item['name']) ? $item['name'] : '...'?></span></a></div>
					</div>
					<?php
				}
			}
			?>
              <div style="clear:both"></div>
            <div class="paging">
                <?php
                if($list)
                {
                    
    				$this->widget('ext.MyLinkPager', array(
    						'currentPage'=>$pages->getCurrentPage(),
    						'itemCount'=>$item_count,
    						'pageSize'=>$pages->pageSize,
    						'maxButtonCount'=>5,
    						'header'=>'',
    						'htmlOptions'=>array('class'=>'pagination'),
    					));
               }
    				?>
              </div>  
          </div>
        <!-- /.products Left End ./--> 
        
        
      </div>
    </div>
  </section>