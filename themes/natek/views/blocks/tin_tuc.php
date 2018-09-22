<?php
	$list_news=DModels::get_list_news_other_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language'],0,8);
	$menu_info=DModels::get_cate_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language']);
?>
<section class="highlight highlight-new">
        <div class="container">
             <div class="block-first text-center">
                <h2 class="section-heading"><?php echo $menu_info['name'];?></h2>
                <p><?php echo $menu_info['short_description'];?></p>
                <hr class="line-1">
            </div>
            <div class="flexslider carousel">
                <ul class="slides">
	                <?php
		                if(!empty($list_news))
		                {
			                foreach($list_news as $row)
			                {
				                $link=$this->createUrl('/content/detailnews',array('id'=>$row['content_id'],'title'=>$row['seo_name']));
			            
				                ?>
				                <li>
			                        <article class="art-3">
			                            <h3><a href="<?php echo $link;?>" title=""><?php echo $row['name'];?></a></h3>
			                            <p><?php echo shortenText($row['short_description'],180);?></p>
			                            <a class="btn btn-more" href="<?php echo $link;?>" title=""><?php echo t('More');?></a>
			                        </article>
			                    </li>
								<?php
			                }
			                
		                }
	                ?>
                    
                    
                </ul>
            </div>
        </div>
    </section>