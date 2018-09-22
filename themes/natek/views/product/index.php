<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo $cate_info['name'];?></h2>
                 <p><?php echo $cate_info['short_description'];?></p>
                 <hr class="line-1">
            </div>
            <!--article class="art-feature">
                <img  src="images/photo/photo-3.jpg"  alt="">
            </article-->
            <?php
	            if(!empty($list))
	            {
		            ?>
		            <div class="row">
		            <?php
		            foreach($list as $row)
		            {
			             //$pair=(object)array('thumb_image'=>$row['thumb_image'],'image_x'=>$row['image_x'],'image_y'=>$row['image_y'],'id'=>$row['i_id']);
						 $link=$this->createUrl('/product/detail',array('id'=>$row->id,'title'=>$row->language->seo_name));
						        
			           ?>
					   <article class="art-4 col-sm-4">
		                    <a class="thumb" href="<?php echo $link;?>" title="">
			                    <?php $this->renderPartial('//blocks/image', array(
                                                'pair' => $row->main_image_pair,
                                                'object_type' => 'product',
                                                'width'=>360,
                                                'height'=>235,
                                                 'alt'=>$row->language->name,
                                                 'class'=>'',
                                              )); ?>
		                    </a>
		                    <h3><a href="<?php echo $link;?>" title=""><?php echo $row->language->name;?></a></h3>
		                    <p><?php echo $row->language->short_description;?></p>
		                    <a class="btn btn-more" href="<?php echo $link;?>" title="">Xem thêm</a>
		                </article>
					   
					   <?php 
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
            <!--div class="row">
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                    <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
			</div>	
			<div class="row">
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                    <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
            </div>
           <div class="row">
               <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                    <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
            </div>
            <div class="row">
               <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                    <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
                <article class="art-4 col-sm-4">
                    <a href="#" title=""><img  src="images/photo/img-7.jpg"  alt=""></a>
                    <h3><a href="#" title="">Lorem ipsum</a></h3>
                   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore magn ...</p>
                   <a class="btn btn-more" href="#" title="">Xem thêm</a>
                </article>
            </div-->
            
			
        </div>
    </section>