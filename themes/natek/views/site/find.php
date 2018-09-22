<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo t('Search');?></h2>
                 <p></p>
                 <hr class="line-1">
            </div>
             <div class="row">
                <section class="content col-sm-8">
                   
                    <div class="block-list">
						<ul class="list-filter">
							<li class='active' ><a style="border-right:none" title=""><?php echo t('Find result');?> : </a></li>
							<li><a style="text-transform: none;" title=""><?php echo (isset($search)) ? $search:"";?> </a></li>
							
						</ul>
						<div class="ctn-list">
							<?php
								if(!empty($list))
								{
									foreach($list as $row)
									{
										$t="";
										$cate_name="";
										$link_cate="";
										if($row->object_type=='F')
										{
											$link=$this->createUrl('/content/detailfaq',array('id'=>$row->object_id));
											$link_url=Yii::app()->getRequest()->getHostInfo().$link;
											$t="faq";
											$cate_name=t('FAQ');
											$link_cate=$this->createUrl('/content/faq');
										}
										else if($row->object_type=='P'){
											$link=$this->createUrl('/product/detail',array('id'=>$row->object_id,'title'=>$row->seo_name));
											$link_url=Yii::app()->getRequest()->getHostInfo().$link;
											$t="product";
											$cate_name=t('Product');
											$link_cate=$this->createUrl('/product/index');
										}
										else{
											$link=$this->createUrl('/content/detailnews',array('id'=>$row->object_id,'title'=>$row->seo_name));
											$link_url=Yii::app()->getRequest()->getHostInfo().$link;
											$t="content";
											$cate_name=t('News');
											$link_cate=$this->createUrl('/content/news');
										}
										
										?>
										<article class="art-4 art-4-left">
											<a href="<?php echo $link;?>" title="">
												<?php $this->renderPartial('//blocks/image', array(
					        						'pair' => $row->main_image_pair,
					        						'object_type' => $t,
					                                'alt'=>$row->name,
					        					)); ?>
											</a>
											<div class="ctn-art-4">
												<!--h3><a href="#" title="">Lorem ipsum</a></h3-->
												<p><?php echo $row->short_description;?></p>
												<ul class="list-social list-inline">
													<li>
														<a href="<?php echo $link_cate;?>" title=""><?php echo $cate_name;?></a>
													</li>
													<li>
														Chia sẻ: 
														<a class="btn-fb" href="http://www.facebook.com/sharer.php?u=<?php echo $link_url;?>"><i class="fa fa-facebook"></i></a>
														<a class="btn-tw" href="http://twitter.com/home?status=<?php echo $link_url;?>"><i class="fa fa-twitter"></i></a>
														<a class="btn-gplus" href="https://plus.google.com/share?url=<?php echo $link_url;?>"><i class="fa fa-google-plus"></i></a>
													</li>
													
												</ul>
											</div>
											
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
							
							<!-- <nav class="paging">
								<ul class="pagination">              
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li>....</li>
									<li><a href="#">20</a></li>                  
								</ul>
							</nav> -->
						</div>
					</div>
					
                </section>
                <aside class="sidebar sidebar-1 col-sm-4">
                    
					
                    <?php $this->renderPartial("//blocks/sidebar_sp") ?>
                </aside>
            </div>
        </div>
    </section>
    