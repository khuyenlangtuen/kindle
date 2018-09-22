<ul class="pro-box">
	<li class="pro">
	  <div class="block-image">
	  	<a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['p_id'],'title'=>$item['seo_name'])) ?>">
         <?php 
        // echo $item['thumb_image'];
         $tag_discount="";
		if($item['gia_ban']>0 && $item['gia_ban']>0)
		{
			$discount=ceil((($item['gia_goc']-$item['gia_ban'])*100)/$item['gia_goc']);
			$tag_discount='<div class="products-discount" style="right:9px"><div class="text-discount">'.$discount.'%</div></div>';
		}
		echo $tag_discount;
        $pair=(object)array('thumb_image'=>$item['thumb_image'],'image_x'=>$item['image_x'],'image_y'=>$item['image_y'],'id'=>$item['i_id']);
         
         $this->renderPartial('//blocks/image', array(
        						'pair' => $pair,
                                'u'=>'image',
                                'class'=>'img-responsive',
                                'alt'=>$item['name'],
        					)); ?></a>
		<!--div class="img-overlay-3-up pat-override"></div>
		<div class="img-overlay-3-down pat-override"></div>
		<ol class="static-style">
		  <li class="white-rounded"><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['p_id'],'title'=>$item['seo_name'])) ?>"><i class="fa fa-link"></i></a> </li>
		  <li class="white-rounded"><a href="<?php echo tu() ?>/images/large/large1.gif" data-rel="prettyPhoto[gallery1]" ><i class="fa fa-plus"></i></a> </li>
		</ol-->
	  </div>	
	  <!--span class="addtocart"><a href="#">Ấn Báo Giá</a></span--> </li>
	<li>
	  <h4><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['p_id'],'title'=>$item['seo_name'])) ?>"><?php echo ($item['name']) ? shortenText($item['name'],40)  : '...'?></a></h4>
	</li>
	<li style="text-align:left">
    <h4 style="text-align:left;text-transform: none;"><?php echo DModels::get_general('nha_san_xuat',$_SESSION['language'],true)?> <?php echo ($item['nha_san_xuat']) ? shortenText($item['nha_san_xuat'],40)  : ''?></h4>
  </li>	
	<!--li><?php echo ($item['description']) ? shortenText($item['description'],40)  : '...'?></li-->
		
	<li class="pro-footer">
		<span class="price">
			<?php
				if($item['gia_ban'] == 0) {
					echo "Báo giá";
				} else {
					echo ($item['gia_ban']) ? number_format($item['gia_ban'])  : t('0');
				}
			?>
		</span>
	</li>	
  </ul>