<section class="highlight highlight-1">
        <div class="container">
            <div class="row">
                <section class="content col-sm-8">
                    <div class="fck">
                        <h1><?php echo t("Question");?>:</h1>
                        <span class="date">Hồ Chí Minh, <?php echo date("d/m/Y",strtotime($detail->created_at));?></span>
                        <?php $this->renderPartial('//blocks/image', array(
					        						'pair' => $detail->main_image_pair,
					        						'object_type' => 'faq',
					                                'alt'=>$detail->language->name,
					                                "width"=>200,
					        					)); ?>
					        					<br/>
                        <?php echo $detail->language->short_description;?>
                        <hr>
                        <h1><?php echo t("Reply");?>:</h1>
                        <?php echo $detail->language->description;?>
                    </div>
                    <?php $this->renderPartial("//blocks/tool_social",array('link_url'=>$link_url)); ?>
                    
                    <div class="block-others">
                        <h2><a href="#" title="<?php echo t('Others');?>"><?php echo t('Other Question');?></a></h2>
                        <div class="row">
	                        <?php
		                        if(!empty($list_cau_hoi_khac))
		                        {
			                        ?>
			                        <ul class="list-new">
			                        <?php
			                        foreach($list_cau_hoi_khac as $row)
			                        {
				                        $link=$this->createUrl('/content/detailfaq',array('id'=>$row->id));
										
				                        ?>
				                        <li><a href="<?php echo $link;?>" title="<?php echo $row->language->short_description;?>"><?php echo shortenText($row->language->short_description,120);?></a></li>
                            

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
                   
                    <?php $this->renderPartial("//blocks/sidebar_sp") ?> 
                </aside>
            </div>
        </div>
    </section>
