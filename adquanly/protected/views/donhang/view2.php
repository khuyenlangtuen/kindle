<?php 
$list_sp=json_decode($order_info['order_info']);
$user_info=json_decode($order_info['user_info']);

?>
<div class="panel-body" style="padding:5px;">
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Mã đơn hàng:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $order_info['id']?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Tài khoản:</div>
        <div class="col-md-8 .col-md-push-3">Khách</div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Tên khách hàng:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->fullname?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Chức vụ:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo ($user_info->position) ? $user_info->position:'...'?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Tên công ty:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->company?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Điện thoại:</div>
        <div class="col-md-8 .col-md-push-3"><?php echo $user_info->tel?></div>
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
		<div class="col-md-4 .col-md-pull-9">Nội dung:</div>
        <div class="col-md-8 .col-md-push-3" style="word-break: break-all;"><?php echo ($user_info->comment) ? $user_info->comment: '........'?></div>
	</div>
	<div class="row show-grid" style="margin:2px 0">
		<div class="col-md-4 .col-md-pull-9">Tình trạng:</div>
        <div class="col-md-8 .col-md-push-3"><select url="<?php echo CController::CreateUrl('donhang/updateStatus')?>" class="sl_change" val="<?php echo $order_info['id'];?>">
                                                            <option <?php echo ($order_info['status2']==1) ? 'selected' : ''?> value="1"><?php echo t('Đã xữ lý');?></option>
                                                            <option <?php echo ($order_info['status2']==2) ? 'selected' : ''?> value="2"><?php echo t('Chưa xữ lý');?></option>
                                                            <option <?php echo ($order_info['status2']==3) ? 'selected' : ''?> value="3"><?php echo t('Đơn hàng rác');?></option>
                                                         </select></div>
	</div>
	<div class="table-responsive" style="overflow: hidden;">
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr>
					<th><?php echo t('id') ?></th>
					<th><?php echo t('Hình ảnh') ?></th>
					<th><?php echo t('Tên sản phẩm') ?></th>
					<th><?php echo t('Số lượng') ?></th>
					<th><?php echo t('Giá bán') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($list_sp)
				{
					foreach( $list_sp->giohang as $key=>$value)
					{
						
							$product_info=DModels::get_product_by_id($value->product_id);
							$c='odd';
							if($key%2==0)
								$c='even';
							?>
							<tr class="<?php echo $c;?> gradeA">
								<td><?php echo $value->product_id;?></td>
								<td><img src="<?php echo param('LINK_IMG').$product_info['thumb_image'];?>" width="80" /></td>
								<td><a href="<?php echo CController::CreateUrl('production/formupdate',array('id'=>$value->product_id))?>"><?php echo $product_info['name'];?></a></td>
								<td><?php echo $value->amount;?></td>
								<td><?php echo number_format($value->price)."<sup>đ</sup>";?></td>
								
							</tr>
							<?php
						
						
					}
					?>
					<tr>
						<td colspan="4">Tổng tiền</td>
						<td><?php echo number_format($list_sp->total)."<sup>đ</sup>"?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
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