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
		$cate_slug0=D_Untils::generateUrlSlug($categories[$cate_id]);
		?>
		
				<li class="dropdown">
				  <a href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$cate_id,"title"=>$cate_slug0)) ?>" class="dropdown-toggle"><?php echo $categories[$cate_id];?></a>
				  <ul class="dropdown-menu">
					  
					<li>
					<?php
						foreach ($categories as $key => $value) {
							if($key!=$cate_id)
							{
								$value=str_replace("-", "", $value);
								$cate_slug=D_Untils::generateUrlSlug($value);
								?>
								<a href="<?php echo $this->createUrl('/product/cate',array('cate_id'=>$key,"parent_cate"=>$cate_id,"title_parent"=>$cate_slug0,"title"=>$cate_slug)) ?>" title="<?php echo $value;?>"><?php echo $value;?></a>
								<?php
							}
							
						}
						?>	
						
					</li>
				  </ul>
				</li>
		<?php
	}
	
}
?>
