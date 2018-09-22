<section class="highlight highlight-1">
        <div class="container">
            <div class="row">
                <section class="content col-sm-8">
                    <div class="fck">
                        <h1><?php echo $detail['name']?></h1>
                        <hr>
                        <span class="date">Hồ Chí Minh, <?php echo date("d/m/Y",strtotime($detail['created_at']));?></span>
                        <?php echo $detail['description'];?>
                        <span class="author text-right"><?php echo DModels::get_author_by_id($detail['owner_id']);?></span>
                    </div>
                    <?php $this->renderPartial("//blocks/tool_social",array('link_url'=>$link_url)); ?>
                    <div class="block-others">
                        <h2><a href="#" title="<?php echo t('Related news');?>"><?php echo t('Related news');?></a></h2>
                        <div class="row">
	                        <?php
		                        if(!empty($list_other_news))
		                        {
			                        foreach($list_other_news as $row)
			                        {
				                        $link=$this->createUrl('/content/detailnews',array('id'=>$row['content_id'],'title'=>$row['seo_name']));
			            
				                        ?>
				                        <article class="art-5 col-sm-4">
			                                <h3><a href="<?php echo $link;?>" title=""><?php echo $row['name'];?></a></h3>
			                                <p><?php echo shortenText($row['short_description'],120);?></p>
			                                <a class="btn btn-more" href="<?php echo $link;?>" title=""><?php echo t('More');?></a>
			                            </article>
				                        <?php
			                        }
		                        }
	                        ?>
                            
                        </div>
                    </div>
                    <div class="block-comment">
                       <div class="fb-comments" data-href="<?php echo $link_url;?>" data-width="750" data-numposts="5"></div>
                    </div>
                </section>
                <aside class="sidebar col-sm-4">
                    <div class="block-bar">
                        <h2><a href="#" title="<?php echo t('Other news');?>"><?php echo t('Other news');?></a></h2>
                        <ul class="list-new">
	                        <?php
		                        if(!empty($list_other_news_r))
		                        {
			                        foreach($list_other_news_r as $row)
			                        {
				                        $link=$this->createUrl('/content/detailnews',array('id'=>$row['content_id'],'title'=>$row['seo_name']));
			            
				                        ?>
				                        <li><a href="<?php echo $link;?>" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></li>
                            
				                        <?php
			                        }
		                        }
	                        ?>
                           
                        </ul>
                    </div>
                    <?php $this->renderPartial("//blocks/sidebar_sp") ?> 
                </aside>
            </div>
        </div>
    </section>
