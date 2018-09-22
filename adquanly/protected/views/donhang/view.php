<?php 

$user_info=json_decode($order_info['user_info']);
//var_dump($list_sp);
?>
<div class="panel-body" style="padding:5px;">
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Mã đơn hàng:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $order_info['ma_don_hang']?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Số lượng sách:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->delivery_quantity?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Tên khách hàng:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->full_name?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Điện thoại:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->phone?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Email:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->email?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Địa chỉ:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo ($user_info->address) ? $user_info->address : '...'?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Địa chỉ nhận hàng:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo ($user_info->delivery_address) ? $user_info->delivery_address : '...'?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Ghi chú:</div>
        <div class="col-md-8 .col-md-push-3" style="word-break: break-all;"><?php echo ($user_info->delivery_note) ? $user_info->delivery_note: '........'?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Phương thức thanh toán:</div>
        <div class="col-md-8 .col-md-push-3" style="word-break: break-all;">
	        <?php  
		        if($user_info->pay_method==1) echo "Thanh toán tiền mặt khi nhận hàng";
		        else if($user_info->pay_method==2) echo "Thẻ ATM đăng ký Internet Banking";
		        else if($user_info->pay_method==3) echo "Thanh toán bằng thẻ quốc tế Visa, MasterCard, JCB";
	        ?>
	    </div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Tình trạng:</div>
        <div class="col-md-8 .col-md-push-3"><select url="<?php echo CController::CreateUrl('donhang/updateStatus')?>" class="sl_change" val="<?php echo $order_info['id'];?>">
                                                            <option <?php echo ($order_info['status2']==1) ? 'selected' : ''?> value="1"><?php echo t('Đã xữ lý');?></option>
                                                            <option <?php echo ($order_info['status2']==2) ? 'selected' : ''?> value="2"><?php echo t('Chưa xữ lý');?></option>
                                                         	<option <?php echo ($order_info['status2']==3) ? 'selected' : ''?> value="3"><?php echo t('Cho vào giỏ rác');?></option>
                                                         </select></div>
	</div>
	
 </div>
 <script>
 $(".sl_change").each(function(){
                var id=$(this).attr('val');
                var url=$(this).attr('url');
				$(this).change(function(){
				    var status=$(this).val();
                    update_status(id,status,url);
				//	alert(id);
                });
                
            });
 </script>