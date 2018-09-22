<?php
	$page = (isset($_GET['page']) ? $_GET['page'] : 1);
	if($page >= 1) $page=($page-1)*param('limit_sk');
	$obj=array('limit'=>param('limit_sk'),'offset'=>$page);
	$tin_sk=DModels::get_list_content_by_id(3,'vn',$obj);
	$total_recorde=DModels::count_list_content_by_id(3);
	$pages=new MyPagination($total_recorde);
    $pages->pageSize=param('limit_sk');
?>
         <section id="section5" class="center_section">
        	<div id="page_sukien" class="container clear">
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
				                            <a style="color: #fff;text-decoration: none" class="main_bg white join_btn html5lightbox" href="<?php echo $link;?>">THAM GIA</a>
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
				                        <a style="color: #fff;text-decoration: none" class="main_bg white join_btn html5lightbox" href="<?php echo $link;?>">THAM GIA</a>
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
				        	
			        	}
			        	?>
			        	
		                
			        	<?php
		        	}
	        	?>
            	
            </div>
        </section>
        
        <div class="copy_right white">
               
            <ul class="social_buttons clear white">
                
                <li class="fr"><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                <li class="fr"><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                <li class="fr"><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                <li class="fr copy_right_text">&copy; 2016 happylive.com</li>
                
            </ul>  
        </div>
        <a class="back_top_btn fa fa-chevron-circle-up"></a>