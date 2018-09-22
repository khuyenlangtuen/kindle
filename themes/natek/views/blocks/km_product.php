<?php 
$list_new=DModels::get_block_product_fontend('promotion',$_SESSION['language']);
?>
<div id="slider1_container_3" style="position: relative; top: -52px; left: -15px; width: 1165px; height: 373px; overflow: hidden; ">
			<!-- Loading Screen -->
			<div u="loading" style="position: absolute; top: 0px; left: 0px;">
				<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
							background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
				</div>
				<div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
							top: 0px; left: 0px;width: 100%;height:100%;">
				</div>
			</div>
			<!-- Slides Container -->
			<div u="slides" style="cursor: move; position: absolute; left: 47px; top: 0px; width: 1090px; height: 373px; overflow: hidden;z-index: 998">
			     <?php 
                      if($list_new)
                      {
                        foreach($list_new as $row)
                        {
                            ?>
                        	<div class="row" >
            					<div class=" col-lg-3 col-md-3 col-sm-6 fadeInUp ">
            					  
                                        <?php $this->renderPartial("//blocks/item_product",array('item'=>$row));?>
                                    
            					</div>
            				</div>
                            <?php
                        }
                                
                              }
                        
                        
                      ?>
							
			</div>
			<div u="navigator" class="jssorb03" style="position: absolute; bottom: 4px; right: 6px;">
				<!-- bullet navigator item prototype -->
				<div u="prototype" style="position: absolute; width: 21px; height: 21px; text-align:center; line-height:21px; color:white; font-size:12px;"><numbertemplate></numbertemplate></div>
			</div>
			<!-- Bullet Navigator Skin End -->
			<!-- Arrow Left -->
			<span u="arrowleft" class="jssora03l" style="width: 30px; height: 30px; top: 150px !important; left: 0px;">
			</span>
			<!-- Arrow Right -->
			<span u="arrowright" class="jssora03r" style="width: 30px; height: 30px; top: 150px !important; right: 0px;">
			</span>
		</div>