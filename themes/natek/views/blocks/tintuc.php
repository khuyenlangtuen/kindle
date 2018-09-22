<?php
$list_hoatdong=DModels::get_list_news_by_cate_id(37,$_SESSION['language']);
$list_tintuc=DModels::get_list_news_by_cate_id(36,$_SESSION['language']);

?>
<section class="highlight-2">
				<div class="row">
					<div class="block-new col-sm-6">
						<h3><span>CÁC HOẠT ĐỘNG</span></h3>
						<div class="flexslider flexslider-2">
							<ul class="slides">
								<?php
								foreach ($list_hoatdong as $key => $item) {
									$pair=(object)array('thumb_image'=>$item['thumb_image'],'image_x'=>$item['image_x'],'image_y'=>$item['image_y'],'id'=>$item['i_id']);
									?>
									<li>
										<div class="row">
											<a class="col-sm-6" href="#" title="">
												<?php
												$this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'width' => 600, 'height' => 400,"class"=>"lazy"));
												?>
											</a>
											<div class="col-sm-6">
											<h4><?php echo $item['name']?></h4>
											<p><?php echo $item['short_description']?></p>
											<a class="more" href="#" title="">ĐỌC THÊM</a>
											</div>
										</div>
									</li>  
									<?php
								}
								?>    
							</ul>
						</div>
					</div>
					<div class="block-new col-sm-6">
						<h3><span>TIN TỨC CƯỚI</span></h3>
						<div class="flexslider flexslider-3">
							<ul class="slides">
								<?php
								foreach ($list_tintuc as $key => $item) {

									?>
									<li>
										<div class="row">
											<div class="outer col-sm-6">
												<div class="inner">
													<h4><?php echo $list_tintuc[$key]['name']?></h4>
													<p><?php echo $list_tintuc[$key]['short_description']?></p>
												</div>
												<p class="author">An tuan Doe</p>
												<span class="date">12.04.2013</span>
											</div>
											<?php
											$j=$key+1;
												if($j<count($list_tintuc))
												{
													?>

													<div class="outer col-sm-6">
														<div class="inner">
															<h4><?php echo $list_tintuc[$j]['name']?></h4>
															<p><?php echo $list_tintuc[$j]['short_description']?></p>
														</div>
														<p class="author">An tuan Doe</p>
														<span class="date">12.04.2013</span>
													</div>
													<?php
												}
											?>
											
										</div>
									</li> 

									<?php
								}
								?>
								         
							</ul>
						</div>
					</div>
				</div>
			</section>