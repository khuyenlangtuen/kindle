<aside class="sidebar col-sm-4">
  <?php
  $kichthuoc=DModels::get_list_kichthuoc_kem_sl($cate_id);
  $mausac=DModels::get_list_mausac_kem_sl($cate_id);
  $khuvuc=DModels::get_list_khuvuc_kem_sl($cate_id);
 // echo $cate_id;die();
$categories = Category::getCategoriesList(false,$_SESSION['language'],'',$cate_id);
if(!empty($categories) && count($categories) > 2)
{
	//var_dump($categories);die();
	
  $cate_slug0=D_Untils::generateUrlSlug($categories[$cate_id]);
  ?>
  <div class="block-bar">
            <h2><span> <?php echo $categories[$cate_id];?></span></h2>
            <ul class="list-style">
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
  </div>
  <?php
}
  ?>
          
          <div class="block-bar block-bar-1">
            <h2 class="btn-acc"><span> Khu vực Lọc </span><i class="fa fa-angle-up"></i></h2>
            <div class="ctn">
              <ul class="list-filter">
                <?php
                   if($khuvuc)
                   {
                        foreach ($khuvuc as $key => $value) {
                          ?>
                          <li><a href="javascript:" class="action_filter" name="location" val_local="<?php echo $value['id'];?>" title="<?php echo $value['name']." (".$value['sl_sp'].")"?>"><?php echo $value['name']." (".$value['sl_sp'].")"?></a></li>
                          <?php
                        }
                   }
                   else{
                      ?>
                      <li><a href="#" title="">Chưa cập nhật</a></li>
                      <?php
                   }
                ?>
              </ul>
            </div>
          </div>
          <div class="block-bar block-bar-1">
            <h2 class="btn-acc"><span> Kích thước Lọc </span><i class="fa fa-angle-up"></i></h2>
            <div class="ctn">
              <ul class="list-filter">
                <?php
                   if($kichthuoc)
                   {
                        foreach ($kichthuoc as $key => $value) {
                          ?>
                          <li><a href="javascript:" class="action_filter" name="size" val_size="<?php echo $value['id'];?>" title="<?php echo $value['size']." (".$value['sl_sp'].")"?>"><?php echo $value['size']." (".$value['sl_sp'].")"?></a></li>
                          <?php
                        }
                   }
                   else{
                      ?>
                      <li><a href="#" title="">Chưa cập nhật</a></li>
                      <?php
                   }
                ?>
              </ul>
            </div>
          </div>
          <div class="block-bar block-bar-1">
            <h2 class="btn-acc"><span> Màu sắc Lọc </span><i class="fa fa-angle-up"></i></h2>
            <div class="ctn">
              <ul class="list-filter">
                <?php
                   if($mausac)
                   {
                        foreach ($mausac as $key => $value) {
                          ?>
                          <li><a href="javascript:" class="action_filter" name="mausac" val_color="<?php echo $value['id'];?>" title="<?php echo $value['name']." (".$value['sl_sp'].")"?>"><?php echo $value['name']." (".$value['sl_sp'].")"?></a></li>
                          <?php
                        }
                   }
                   else{
                      ?>
                      <li><a href="#" title="">Chưa cập nhật</a></li>
                      <?php
                   }
                ?>
              </ul>
            </div>
          </div>
          <div class="block-bar block-bar-1">
            <h2 class="btn-acc"><span> Giá tiền Lọc </span><i class="fa fa-angle-up"></i></h2>
            <div class="ctn">
               <b>10&nbsp;₫</b> <input id="ex2" type="text" class="span2 ex2" value="" data-slider-min="0" data-slider-max="9000000" data-slider-step="50000" data-slider-value="[<?php echo (isset($params['min'])) ? $params['min'] : 10?>,<?php echo (isset($params['max'])) ? $params['max'] : 9000000?>]"/> <b>9.000.000&nbsp;₫</b>
            </div>
          </div>
        </aside>