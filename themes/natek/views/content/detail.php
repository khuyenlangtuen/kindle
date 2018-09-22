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
		 <div class="col-lg-3 col-md-3 sidebar" style="padding-right:0px !important;width: 28%;"> 
		<div id="menu-left" class="ser-cats">
			<strong class="stitle"><?php echo $cate_name;?></strong>
			<?php
			$gioithieu=DModels::get_list_content_by_id(29,$_SESSION['language']);
            if(!empty($gioithieu)){
				?>
				<ul>
				<?php
					foreach($gioithieu as $key=>$item)
					{
						?>
						<li class="block">
							<a href="<?php echo $this->createUrl('/content/detail',array('id'=>$item['content_id'],'title'=>$item['seo_name'])) ?>"><label><i class="fa fa-arrow-circle-right"></i><?php echo $item['name'];?></label>	</a>				
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