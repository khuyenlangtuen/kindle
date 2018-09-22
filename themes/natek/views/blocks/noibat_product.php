<?php
extract(array(
	'i_class' => '',
	'cate_id'=>0,
), EXTR_SKIP);
if($cate_id > 0 )
{
	$categories = Category::getCategoriesList(false,$_SESSION['language'],'',$cate_id);
	if(!empty($categories))
	{
		//var_dump($categories);die();
		$list_product=DModels::get_product_noi_bat_by_cateid($cate_id,$_SESSION['language']);
		$cate_slug0=D_Untils::generateUrlSlug($categories[$cate_id]);
		?>
		<section class="highlight-1">
					<h2><i class="<?php echo $i_class;?>"></i> <span><?php echo $categories[$cate_id];?></span><a class="link-more" href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$cate_id,"title"=>$cate_slug0)) ?>">Xem thêm >></a></h2>
					<ul class="list-left list-left-style">	
						<?php
						foreach ($categories as $key => $value) {
							if($key!=$cate_id)
							{
								$value=str_replace("-", "", $value);
								$cate_slug=D_Untils::generateUrlSlug($value);
								?>
								<li><a href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$key,"parent_cate"=>$cate_id,"title_parent"=>$cate_slug0,"title"=>$cate_slug)) ?>" title="<?php echo $value;?>"><?php echo $value;?></a></li>
								<?php
							}
							
						}
						?>		
						
					</ul>
					<ul class="list-right">
						<?php
						foreach ($list_product as $key => $value) {
							?>
								<li><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$value->id,'title'=>$value->language->seo_name)) ?>" title="<?php echo $value->language->name;?>">
									<?php $this->renderPartial('//blocks/image_new', array(
	        						'pair' => $value->main_image_pair,
	        						'object_type' => 'product',
	        						'width'=>350,
	        						'height'=>350,
	                                'alt'=>$value->language->name,
	                                'class'=>'lazy',
	        					)); ?>	
								</a></li>	
							<?php
						}
						?>
					</ul>
				</section>

		<?php
	}
	
}
?>
