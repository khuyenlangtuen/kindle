 <div class="table-responsive" style="overflow: hidden;margin-top: 60px">
	 <div><button url="<?php echo CController::CreateUrl('production/delallCouponcode')?>" val="<?php echo $id_ctkm;?>"  style="margin: 5px" type="submit" class="btn btn-danger del_demuc"><?php echo t('Xóa tất cả Mã coupon');?></button></div>
                                <table class="table table-striped table-bordered table-hover" id="id_detail_ctkm">
                                    <thead>
                                        <tr>
                                            <th><?php echo t('id') ?></th>
                                            <th><?php echo t('Mã giảm giá') ?></th>
                                            <th><?php echo t('Trạng thái') ?></th>
                                            <th style="width: 100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
	                                    	
                                        if($list)
                                        {
                                            foreach( $list as $key=>$value)
                                            {
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><?php echo $value['id'];?></td>
                                                    <td><?php echo $value['coupon_code'];?></td>
                                                    <td><?php echo ($value['status']==1) ? "Đã sử dụng":"Chưa sử dụng";?></td>
													<td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('production/delcouponcode')?>" val="<?php echo $value['id'];?>" class="btn btn-danger btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            	<?php
                        						
                                            }
                        				}
                        				?>
                                        
                                    </tbody>
                                </table>
                            </div>
           
<script>
    $(document).ready(function() {
        $('#id_detail_ctkm').DataTable({
                responsive: true
        });
    });
    </script>
