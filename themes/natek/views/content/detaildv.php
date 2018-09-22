<section class="products">
    <div id="products-page" class="container">
      <div class="row"> 
        <!-- /.Products Left Start ./-->
        <div class="col-lg-9 col-md-9">
          <div class="pro-title">
            <h1><?php echo $detail['name']?></h1>
          </div>
          <div id="paging_content">
              <?php
			  if($detail)
			  {
				 echo $detail['description'];
			  }
			  ?>
          </div>
		  <?php $this->renderPartial("//blocks/tool_social",array('link_url'=>$link_url)) ?>
        </div>
        <!-- /.products Left End ./--> 
        
        <!-- /.sidebar Start ./-->
		 <div class="col-lg-3 col-md-3 sidebar"> 
		<div id="menu-left" class="ser-cats">
			<strong class="stitle"><?php echo $title;?></strong>
			<?php
			$dv=DModels::get_list_news_by_cate_id(15,$_SESSION['language'],array('offset'=>0,'limit'=>9));
            if(!empty($dv)){
				?>
				<ul>
				<?php
					foreach($dv as $key=>$item)
					{
						$class = (getParam('id') == $item['content_id'] ? ' active_cate' : '');
						?>
						<li class="block">
							<a  class="<?php echo $class;?>" href="<?php echo $this->createUrl('/content/detaildv',array('id'=>$item['content_id'],'title'=>$item['seo_name'])) ?>"><label><i class="fa fa-arrow-circle-right"></i><?php echo $item['name'];?></label>	</a>				
						</li>
						<?php
					}
				?>
				</ul>
				<?php
			}
			?>
			
		</div>
		<?php $this->renderPartial("//blocks/banner_right") ?> 
		</div>
        <!-- /.sidebar End ./--> 
      </div>
    </div>
  </section>