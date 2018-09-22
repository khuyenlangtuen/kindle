		  
			  <div class="gallery"> 
				<!-- /.Products row start ./-->
				<div class="row"> 
					<?php 
					if($list)
					{
						foreach($list as $item)
						{
							?>
							<!--Product -->
						  <div class="col-lg-4 col-md-4 col-sm-4">
							<ul class="pro-box" style="padding-top:0px;">
							  <li class="pro">
								<div class="products-discount"><div class="text-discount">-20%</div></div>
								<div class="block-image"> 
								<?php
								$this->renderPartial('//blocks/image', array(
									'pair' => $item->main_image_pair,
									'u'=>'image',
									'class'=>'img-responsive',
									'alt'=>$item->language->name,
								)); ?>				  
								  <div class="img-overlay-3-up pat-override"></div>
								  <div class="img-overlay-3-down pat-override"></div>
								  <ol class="static-style">
									<li class="white-rounded"><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item->id,'title'=>$item->language->seo_name)) ?>"><i class="fa fa-link"></i></a> </li>
									<li class="white-rounded"><a href="images/large/large1.gif" data-rel="prettyPhoto[gallery1]"><i class="fa fa-plus"></i></a> </li>
								  </ol>
								</div>
								<span class="addtocart"><a href="cart.html">Ấn Báo Giá</a></span> </li>
							  <li>
								<h4><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item->id,'title'=>$item->language->seo_name)) ?>"><?php echo ($item->language->name) ? shortenText($item->language->name,40)  : '...'?></a></h4>
							  </li>
							  <li class="pro-footer"><span class="price"><?php echo ($item['gia_ban']) ? number_format($item['gia_ban']).'<sup>đ</sup>'  : t('note price');?> </span></li>
							</ul>
						  </div>
						  <!--Product End --> 
							<?php
							
						}
					}
					?>
				  
					  
				</div>
				<!-- /.Products row end ./-->  
			  </div>
			  <div class="paging">
				<?php
				if($list)
				{
					
					$this->widget('ext.MyLinkPagerAjax', array(
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
		  