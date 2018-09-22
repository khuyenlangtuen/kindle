<?php $categories = Category::getMenuCategories(8,42,$_SESSION['language']);?>
<div id="menu-left" > <strong class="stitle"><?php echo t('product category')?></strong>
<ul>
	<?php 
	$default="overflow: hidden; display: block;";
	if($categories)
	{
		foreach($categories as $key=>$category)
		{
			$cate_slug0=D_Untils::generateUrlSlug($category['category']);
		   $class = (getParam('cate_id') == $category['category_id'] ? ' active_cate' : '');
			?>
			<li class="menu-1" val="<?php echo $category['id_path'];?>"><a class="menu-toggle" href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$category['category_id'],'title'=>$cate_slug0)) ?>"><i class="fa fa-chevron-circle-right"></i><span class="title-cat <?php echo $class;?>"><?php echo $category['category'];?><span></a>
				<?php 
				if ( !empty($category['subcategories']) ) {
					
					
					?>		
				<div class="sub-toggle" style="<?php echo (getParam('cate_id') == $category['category_id'] || DModels::check_parent_id_cate(getParam('cate_id'),$category['category_id'])) ? $default : '';?>" >	
					<ul>
					<?php
					foreach ($category['subcategories'] as $cat) {
						$cate_slug=D_Untils::generateUrlSlug($cat['category']);
						
							$class2 = (getParam('cate_id') == $cat['category_id'] ? ' active_cate' : '');
						?>					
						<li class="menu-2" val="<?php echo $cat['parent_id'];?>"><a class="sub-menu-toggle" href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$cat['category_id'],'title'=>$cate_slug)) ?>"><i class="fa fa-caret-right"></i><span class="title-subcat <?php echo $class2;?>"><?php echo $cat['category'];?></span></a>
						<?php
						if(!empty($cat['subcategories']))
						{
							?>
							<div class="sub-toggle" style="<?php echo $default;?>">
							<ul>
								<?php
								foreach($cat['subcategories'] as $level3) {
										$cate_slug2=D_Untils::generateUrlSlug($level3['category']);
										$class3 = (getParam('cate_id') == $level3['category_id'] ? ' active_cate' : '');
									?>					
									<li ><a href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$level3['category_id'],'title'=>$cate_slug2)) ?>"><i class="fa fa-caret-right"></i><span class="title-subcat <?php echo $class3;?>"><?php echo $level3['category'];?></span></a></li>
									<?php
								}

								?>	
							</ul>
							</div>
							
							<?php
						}
						?>
						
						</li>
						<?php
					}

					?>					
					</ul>
				</div>
					<?php
				}
				?>		
			</li>
			<?php
		}
	}
	
	?>	
</ul>	
</div>