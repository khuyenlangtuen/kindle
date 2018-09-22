<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo t('FAQ');?></h2>
                 <p></p>
                 <hr class="line-1">
            </div>
             <div class="row">
                <section class="content col-sm-8">
                    <div class="block-search">
                        <form class="frm-search" method="get" action="<?php echo $this->createUrl('/content/faqother');?>">
                            <span><i class="fa fa-search"></i><input class="txt-search" type="text" name="q" value="<?php echo (isset($q)) ? $q:"";?>"  placeholder="<?php echo t('Search');?>"></span>
                            <button class="btn-search"><?php echo t('Search');?></button>
                        </form>
                    </div>
                    <div class="block-list">
						<ul class="list-filter">
							<li <?php echo ($type=="faq") ? "class='active'" : "";?> ><a href="<?php echo $this->createUrl('/content/faq');?>" title=""><?php echo t('Newest');?></a></li>
							<li <?php echo ($type=="faqother") ? "class='active'" : "";?>><a href="<?php echo $this->createUrl('/content/faqother');?>" title=""><?php echo t('Others');?></a></li>
						</ul>
						<div class="ctn-list">
							<?php
								if(!empty($list_cauhoi))
								{
									foreach($list_cauhoi as $row)
									{
										$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/detailfaq',array('id'=>$row->id));
										$link=$this->createUrl('/content/detailfaq',array('id'=>$row->id));
										?>
										<article class="art-4 art-4-left">
											<a href="<?php echo $link;?>" title="">
												<?php $this->renderPartial('//blocks/image', array(
					        						'pair' => $row->main_image_pair,
					        						'object_type' => 'faq',
					                                'alt'=>$row->language->name,
					        					)); ?>
											</a>
											<div class="ctn-art-4">
												<!--h3><a href="#" title="">Lorem ipsum</a></h3-->
												<p><?php echo $row->language->short_description;?></p>
												<ul class="list-social list-inline">
													<li>
														<a href="<?php echo $link;?>" title="">Xem (41)</a>
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
                    <div class="block-bar">
                        <form class="frm-general frm-question" method="post" enctype="multipart/form-data" action="<?php echo $this->createUrl('/content/setquestion');?>">
							<h3><?php echo t('Set question');?></h3>
							<div class="form-group">
								<textarea required class="form-control txtarea" name="lang[short_description]" placeholder="<?php echo t('Input content is your question');?>"></textarea>
							</div>
							<div class="form-group" id="show_image" hidden >
								<img style="width: 120px" src="" id="id_images7" />
							</div>
							<div class="outer-btn">
								<div class="fileUpload btn btn-insert">
								    <span><?php echo t('Insert image');?></span>
								    <input type="hidden" name="images[0][object_type]" value="F" />
                                        <input type="hidden" name="images[0][type]" value="M" />
                                        <input type="hidden" name="images[0][alt]" value="" />
								    <input type="file" onchange="show_image(this,7)" class="upload" name="thumb_img[0]" required />
								</div>
								<button class="btn btn-send"><?php echo t('Send');?></button>
							</div>
							<?php
								//var_dump(Yii::app()->user->getState('dat_cau_hoi'));
								if(Yii::app()->user->getState('dat_cau_hoi')!=="")
								{
									$tb=Yii::app()->user->getState('dat_cau_hoi');
									if($tb['type']=="01")
									{
										?>
										<span style="color:#358595"><?php echo $tb['message']?></span>
										<?php
									}
									else
									{
										?>
										<span style="color:red"><?php echo $tb['message']?></span>
										<?php
									}
									Yii::app()->user->setState('dat_cau_hoi', "");
								}
							?>
							<div class="outer-btn">
								
							</div>
						</form>
                    </div>
					
                    <?php $this->renderPartial("//blocks/sidebar_sp") ?>
                </aside>
            </div>
        </div>
    </section>
    