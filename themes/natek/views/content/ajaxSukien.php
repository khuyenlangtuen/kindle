

<?php
		        	if(!empty($tin_sk))
		        	{
			        	foreach($tin_sk as $key=>$row)
			        	{
				        	$pair=(object)array('thumb_image'=>$row['thumb_image'],'image_x'=>$row['image_x'],'image_y'=>$row['image_y'],'id'=>$row['i_id']);
					        $link=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/detailSukien',array('id'=>$row['content_id']));                   	
				        	if($key==0)
				        	{
					        	?>
					        	<div class="left fl" data-scrollreveal="enter right after 0.15s over 1s">
				                	<h3 class="big_title">SỰ KIỆN</h3>
				                    <div class="clear">
				                        <div class="content_wrap">                    
				                            <h4 class="title"><?php echo $row['name']?></h4>
				                            <p class="excerpt"><?php echo $row['short_description']?></p>
				                            <a style="color: #fff;text-decoration: none" class="main_bg white join_btn html5lightbox" href="javascript:html5Lightbox.showLightbox(7, '<?php echo $link;?>', '');">THAM GIA</a>
				                        </div>
				                        <div class="tmb1">
					                        <?php
											$this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'content','have_src'=>true, 'no_link' => true, 'width' => 432, 'height' => 322));
											?>
				                        </div>
				                   </div>
				                </div>
								<?php
				        	}
				        	if($key==1)
				        	{
					        	?>
					        	<div class="right fr" data-scrollreveal="enter left after 0.15s over 1s">
				                	<div class="tmb2">
				                    	 <?php
											$this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'content','have_src'=>true, 'no_link' => true, 'width' => 452, 'height' => 603));
											?>
				                    </div>
				                    <div class="layer_content">
				                    	<h4 class="title"><?php echo $row['name']?></h4>
				                        <p class="excerpt"><?php echo $row['short_description']?></p>
				                        <a style="color: #fff;text-decoration: none" class="main_bg white join_btn html5lightbox" href="javascript:html5Lightbox.showLightbox(7, '<?php echo $link;?>', '');">THAM GIA</a>
				                     </div><!--layer_content-->
				                        
				                    <div class="page_navi">
				                        <?php
		                                    $this->widget('ext.MyLinkPagerAjax2', array(
					    						'currentPage'=>$pages->getCurrentPage(),
					    						'itemCount'=>$total_recorde,
					    						'pageSize'=>$pages->pageSize,
					    						'maxButtonCount'=>3,
					    						'header'=>'',
					    						'htmlOptions'=>array('class'=>'page'),
					    					));
		
		                                ?>
				                    </div>   
				                </div>
					        	<?php
				        	}
				        	if(count($tin_sk) == 1){
					        	?>
					        	<div class="right fr" data-scrollreveal="enter left after 0.15s over 1s">
				                	
				                    <div class="page_navi">
				                        <?php
		                                    $this->widget('ext.MyLinkPagerAjax2', array(
					    						'currentPage'=>$pages->getCurrentPage(),
					    						'itemCount'=>$total_recorde,
					    						'pageSize'=>$pages->pageSize,
					    						'maxButtonCount'=>3,
					    						'header'=>'',
					    						'htmlOptions'=>array('class'=>'page'),
					    					));
		
		                                ?>
				                    </div>   
				                </div>

					        	<?php
				        	}
				        	
			        	}
			        	?>
			        	
		                
			        	<?php
		        	}
	        	?>