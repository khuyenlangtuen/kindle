<?php
$user_info=User::model()->findByPk(Yii::app()->user->getState('user_id'));

?>

<section class="prod-graybg">
	<!-- /.Product details Start ./-->
	<div id="products-details" class="pro-details">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-12 col-md-12">
			<div class="row">
			   <table class="cartdetail">
                  <tbody><tr class="title-cart">    
                  	<td style="border-right:1px solid #fff;"><span><?php echo t('STT');?></span></td>
                    <td style="border-right:1px solid #fff;"><span class="prothumb"><?php echo t('product image');?></span></td>
                    <td style="border-right:1px solid #fff;"><span class="ten"><?php echo t('product name');?></span></td>
                    <td style="border-right:1px solid #fff;"><span class="soluong"><?php echo t('product amount');?></span></td>
                    <td><span class="cartact"><?php echo t('remove');?></span></td>
                  </tr>
                 <?php
                 $stt=0;
                 $cart = Cart::getCart(); 
                 $list_cart=$cart['baogia'];
                 if($list_cart)
                 {
                    foreach($list_cart as $key=>$item)
                    {
                    	$stt+=1;
                        $info_pro=DModels::get_product_by_id($item['product_id'],$_SESSION['language']);
                        ?>
                        <tr class="row-cart" id="row-cart<?php echo $item['product_id'];?>">  
                        	<td><?php echo $stt;?></td>  
                            <td>
                                <span class="prothumb">
                                    <a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['product_id'],'title'=>$info_pro['seo_name'])) ?>" title="<?php echo $info_pro['name']?>" class="img">
                                        <?php 
                                            $pair=(object)array('thumb_image'=>$info_pro['thumb_image'],'image_x'=>$info_pro['image_x'],'image_y'=>$info_pro['image_y'],'id'=>$info_pro['i_id']);
                                             $this->renderPartial('//blocks/image', array(
                                            						'pair' => $pair,
                                                                    'width'=>'150',
                                                                    'height'=>'150',
                                                                    'alt'=>$info_pro['name'],
                                            					)); 
                                       ?>
                                        
                                        </a>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['product_id'],'title'=>$info_pro['seo_name'])) ?>" title="<?php echo $info_pro['name'];?>">
                                   <?php echo $info_pro['name'];?>
                                </a>
                            </td>   
                            <td>
                                <input class="tech" type="text" value="<?php echo $item['amount'];?>" id="requests<?php echo $item['product_id']?>" onkeyup="update_sl(<?php echo $item['product_id']?>)"/>
                            </td>
                            <td><span class="cartact">
                                <a href="javascript:del_sp(<?php echo $item['product_id']?>)" title="<?php echo t('product remove');?>" class="close">
                                    X
                                </a></span></td>
                          </tr>
                           
                        <?php
                    }
                 }
				 else{
					?>
						<tr><td colspan='4' style="color:red"><?php echo t('cart empty');?></td></tr>
					<?php
				 }
                 ?>
                  
                </tbody>
            </table>
			</div>
			<div><a href="<?php echo $this->createUrl('/product/index')?>"><?php echo t('continue');?></a><div>
			<div class=" gap-30"></div>	
				<div class="request">
					<input id="val_cap" type="hidden" value="<?php echo Yii::app()->user->getState('val_cap');?>">
					<form name="request" method="post" action="<?php echo $this->createUrl('/cart/addbaogia')?>">
						<div class="mess"><?php echo t('note request quote');?></div>
						<div style="color:red" id="errors"></div>
						<table>
							<tbody><tr>
								<td class="name"><?php echo t('full name');?><span style="color:red">*</span></td>
								<td class="box"><input type="text" name="item[fullname]" id="fullname" value="<?php echo (isset($user_info->fullname)) ? $user_info->fullname:'';?>" tabindex="1"></td>
								<td class="name"><?php echo t('position');?></td>
								<td><input type="text" name="item[position]" id="position" value="" tabindex="4"></td>
							</tr>
							<tr>
								<td class="name"><?php echo t('company');?><span style="color:red">*</span></td>
								<td class="box"><input type="text" name="item[company]" id="company" value="" tabindex="2"></td>
								<td class="name"><?php echo t('tel');?><span style="color:red">*</span></td>
								<td><input type="text" name="item[tel]" id="tel" value="<?php echo (isset($user_info->phone)) ? $user_info->phone:'';?>" tabindex="5"></td>
							</tr>
							<tr>
								<td class="name"><?php echo t('address');?><span style="color:red">*</span></td>
								<td class="box"><input type="text" name="item[address]" id="address" value="<?php echo (isset($user_info->address)) ? $user_info->address:'';?>" tabindex="3"></td>
								<td class="name">Email<span style="color:red">*</span></td>
								<td><input type="text" name="item[email]" id="email" value="<?php echo (isset($user_info->email)) ? $user_info->email:'';?>" tabindex="6"></td>
							</tr>
							<tr>
								<td class="name"><?php echo t('comment');?></td>
								<td colspan="3"><textarea name="item[comment]" id="comment" tabindex="7"></textarea></td>            
							</tr>
							<tr>
								<td width="87"></td>
								<td colspan="3">            
								<div><span id="cap_tc" style="margin-left:10px" onclick="reload_cap('#cap_tc')"><img src="<?php echo Yii::app()->request->baseUrl; ?>/cap/captcha.png?v<?php echo rand(5000,9000)?>" /></span></div>
								<div><p style="margin-top:5px"><input type="text" name="captcha" id="captcha" class="string captcha" style="width:70px !important"></p></div>
								</td>            
							</tr>
							<tr>
								<td width="87"></td>
								<td colspan="3"><input type="submit" value="<?php echo t('question price');?>"  class="baogia" onclick="return check_form_baogia();" /></td>            
							</tr>
						</tbody></table>
					</form>
					</div>
		  </div>	  
		</div>
	  </div>
	</div>
	<!-- /.Products Details End ./-->

</section>
<script>
function reload_cap(id)
{
	$.ajax({
		url: '<?php echo CController::CreateUrl('cart/recatpcha')?>',
		type: 'post',
		data: {},
		success: function (data) {
				$(id).html("<img src='"+data+"' />");
			},
		error: function () {}
	});
}
function update_sl(id)
{
	var sl=$('#requests'+id).val();
	$.ajax({
		url: '<?php echo CController::CreateUrl('cart/updatesl')?>',
		type: 'post',
		data: {id:id,sl:sl},
		success: function (data) {
				
			},
		error: function () {}
	});
}
function del_sp(id)
{
	$.ajax({
		url: '<?php echo CController::CreateUrl('cart/delsp')?>',
		type: 'post',
		data: {id:id},
		success: function (data) {
				$('#row-cart'+id).remove();
			},
		error: function () {}
	});
}

</script>