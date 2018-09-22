<section id="section3" class="center_section">
        	<div class="layer"></div>
        	<div class="container">
                        <div class="title_wrap clear">
                            <h3 class="big_title fl" data-scrollreveal="enter right after 0.15s over 1s">TÔN VINH</h3>
                            <p class="description fr" data-scrollreveal="enter left after 0.15s over 1s">
                                Tiến sĩ Alan Phan thật sự xứng đáng được gọi là 'một viên ngọc quý, một ngọn hải đăng của cộng đồng người Việt'. Đó chắc chắn không phải ý kiến chủ quan, hãy điểm qua những sự tôn vinh của mọi người dành cho tiến sĩ.
                            </p>
                        </div>
                        
                        <div class="content_wrap clear" id="page_tonvinh">
                        	<?php
	                        	$page = (isset($_GET['page']) ? $_GET['page'] : 1);
								if($page >= 1) $page=($page-1)*param('limit_on_page');
								$obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
	                        	$tin_tonvinh=DModels::get_list_content_by_id(2,'vn',$obj);
	                        	$total_recorde=DModels::count_list_content_by_id(2);
								$pages=new MyPagination($total_recorde);
					            $pages->pageSize=param('limit_on_page');
	                        	if(!empty($tin_tonvinh))
	                        	{
		                        	?>
		                        	<div id="detail_tonvinh" class="right detail_post fr" data-scrollreveal="enter right after 0.15s over 1s">
		                                <h4 class="title"><?php echo $tin_tonvinh[0]["name"];?></h4>
		                                <div class="post_content clear">
		                                	<?php
												echo str_replace("../rfilemanager", param("LINK_SOURCE_ANH"), $tin_tonvinh[0]["description"]) ;
																
											?> 
		                                </div>
		                            </div><!--right-->
		                            
		                        	
		                            <div class="left fl">
		                            	<div class="show_posts">
			                            	<?php
				                            	foreach($tin_tonvinh as $key=>$row)
				                            	{
					                            	$pair=(object)array('thumb_image'=>$row['thumb_image'],'image_x'=>$row['image_x'],'image_y'=>$row['image_y'],'id'=>$row['i_id']);
					                            	//var_dump($pair) ;
					                            	$active="";
					                            	$ms="over 1s";
					                            	if($key==0)
					                            	{
						                            	$active="active";
						                            	$ms="over 0.5s";
					                            	}
					                            	?>
					                            	<div id="tv_row_<?php echo $row['content_id'];?>" class="post <?php echo $active;?>" data-scrollreveal="enter bottom after 0.15s <?php echo $ms;?>">
				                                    	<div class="tmb_wrap clear">
				                                            <div class="tmb fl">
				                                            	<a href="javascript:show_t(<?php echo $row['content_id'];?>)">
				                                            	<?php
																$this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'content','have_src'=>true, 'no_link' => true, 'width' => 133, 'height' => 104));
																?>
				                                            	</a>
				                                            </div>
				                                            <div class="fl">
				                                            	<a style="color: #fff;text-decoration: none" href="javascript:show_t(<?php echo $row['content_id'];?>)"><h4 class="title"><?php echo $row['name']?></h4></a>
				                                            </div>
				                                        </div>
				
				                                        <p class="excerpt">
					                                        <?php
													        	//echo str_replace("../rfilemanager", param("LINK_SOURCE_ANH"), $row["description"]) ;
																echo $row["short_description"];
												        	?>  
				                                        </p>
				                                    </div> 
					                            	<?php
				                            	}
			                            	?>
		                                </div> <!--end show posts-->    
		                                    <div class="page_navi" data-scrollreveal="enter left after 0.15s over 1s">
		                                        <?php
			                                        $this->widget('ext.MyLinkPagerAjax', array(
							    						'currentPage'=>$pages->getCurrentPage(),
							    						'itemCount'=>$total_recorde,
							    						'pageSize'=>$pages->pageSize,
							    						'maxButtonCount'=>3,
							    						'header'=>'',
							    						'htmlOptions'=>array('class'=>'page'),
							    					));

		                                        ?>
		                                        <!--span class="page active"><a href="#">1</a></span>
		                                        <span class="page"><a href="#">2</a></span>
		                                        <span class="page"><a href="#">3</a></span-->
		                                    </div>              
		                            </div> <!--left-->
		                        	<?php
	                        	}
                        	?>
                        	
                            
                        </div> <!--content wrap-->
            </div> <!--Container-->
        </section>