<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	<div>
                        	<a href="<?php echo CController::CreateUrl('production/chuongtrinhkm')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('List chương trình km') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('production/updatectkm')?>"  class="btn btn-default"><?php echo t('Thêm mới chương trình') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="panel panel-default">
                            
                            
                            <div class="panel-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#thongtinchung" data-toggle="tab"><?php echo t('Thông tin chung');?></a>
                                    </li>
                                    <li><a href="#detail_km" data-toggle="tab"><?php echo t('Chi tiết khuyến mãi');?></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="thongtinchung">
	                                    <form action="<?php echo CController::CreateUrl('production/updatectkm')?><?php echo isset($info['id']) ? '&id='.$info['id']: ''?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
		                            		 <label><?php echo t('Tên chương trình');?><span style="color:red">*</span></label>
		                            		<input value="<?php echo isset($info['name']) ? $info['name']: ''?>" name="item[name]" class="form-control" placeholder="<?php echo t('tên chương trình');?> ...">
		                            	   
		                                </div>
		                                <div class="form-group">
		                                     <label><?php echo t('Loại khuyến mãi');?><span style="color:red">*</span></label>
		                                     <select name="item[promotion_type]" class="form-control" onchange="change_loai_km(this.value)">
			                                     <option value=""><?php echo t('Chọn loại khuyến mãi');?></option>
		                                        <option <?php echo (isset($info['promotion_type']) && $info['promotion_type']=="val") ? 'selected' : ''?> value="val"><?php echo t('Theo giá trị');?></option>
		                                        <option <?php echo (isset($info['promotion_type']) && $info['promotion_type']=="code") ? 'selected' : ''?> value="code"><?php echo t('Theo mã code');?></option>
		                                     </select>
		                                </div>
		                                <div class="form-group" id="id_range_value" style="display: <?php echo (isset($info['promotion_type']) && $info['promotion_type']=="val") ? 'block' : 'none'?>">
		                            		 <label><?php echo t('Giá trị từ');?></label> :
		                            		<input value="<?php echo isset($info['start_value']) ? $info['start_value']: '0'?>" name="item[start_value]" placeholder="<?php echo t('Nhập giá trị từ');?> ...">
		                            	   <label><?php echo t('Giá trị đến');?></label> :
		                            		<input value="<?php echo isset($info['end_value']) ? $info['end_value']: '0'?>" name="item[end_value]" placeholder="<?php echo t('Nhập giá trị đến');?> ...">
		                                </div>
		                                <div class="form-group">
		                            		 <label><?php echo t('Ngày bắt đầu');?><span style="color:red">*</span></label>
		                            		<?php
													$fromDateValue=isset($info['start_date']) ? date("Y-m-d",strtotime($info['start_date'])): '';
													$this->widget('zii.widgets.jui.CJuiDatePicker', array(
													    'name' => 'item[start_date]',
													    'value' => $fromDateValue,
													    'options' => array('dateFormat' => 'yy-mm-dd'),
													    'htmlOptions' => array(
													        'size' => '20',         // textField size
													        'maxlength' => '10',    // textField maxlength
													        'readonly'=>"enable",
													    ),
													));
													?>
		                            	     <span>- Thời gian từ:</span>
		                            	     <input style="width:25px" value="<?php echo isset($info['start_date']) ? date("h",strtotime($info['start_date'])): '00'?>" name="item[start_hour]" >:
		                            	     <input style="width:25px" value="<?php echo isset($info['start_date']) ? date("i",strtotime($info['start_date'])): '00'?>" name="item[start_min]" >
		                                </div>
		                                <div class="form-group">
		                            		 <label><?php echo t('Ngày kết thúc');?><span style="color:red">*</span></label>
		                            		<?php
													$endDateValue=isset($info['end_date']) ? date("Y-m-d",strtotime($info['end_date'])): '';
													$this->widget('zii.widgets.jui.CJuiDatePicker', array(
													    'name' => 'item[end_date]',
													    'value' => $endDateValue,
													    'options' => array('dateFormat' => 'yy-mm-dd'),
													    'htmlOptions' => array(
													        'size' => '20',         // textField size
													        'maxlength' => '10',    // textField maxlength
													        'readonly'=>"enable",
													    ),
													));
													?>
		                            	   <span>- Thời gian đến:</span>
		                            	   <input style="width:25px" value="<?php echo isset($info['end_date']) ? date("h",strtotime($info['end_date'])): '00'?>" name="item[end_hour]" >:
		                            	     <input style="width:25px" value="<?php echo isset($info['end_date']) ? date("i",strtotime($info['end_date'])): '00'?>" name="item[end_min]" >
		                                </div>
		                                <div class="form-group">
		                            		 <label><?php echo t('Giảm giá theo VNĐ');?><span style="color:red">*</span></label>
		                            		<input value="<?php echo isset($info['gia_vnd']) ? $info['gia_vnd']: '0'?>" name="item[gia_vnd]" class="form-control" placeholder="<?php echo t('Nhập giá tiền giảm');?> ...">
		                            	   
		                                </div>
		                                <div class="form-group">
		                            		 <label><?php echo t('Giảm giá theo %');?><span style="color:red">*</span></label>
		                            		<input value="<?php echo isset($info['phan_tram']) ? $info['phan_tram']: '0'?>" name="item[phan_tram]" class="form-control" placeholder="<?php echo t('Nhập % giảm giá');?> ...">
		                            	   
		                                </div>
		                                <div class="form-group">
		                                     <label><?php echo t('Chỉ áp dụng cho:');?></label>
		                                     <select name="item[only_apply]" class="form-control">
		                                        <option <?php echo (isset($info['only_apply']) && $info['only_apply']==1) ? 'selected' : ''?> value="1"><?php echo t('Trong trang chi tiết sản phẩm');?></option>
		                                        <option <?php echo (isset($info['only_apply']) && $info['only_apply']==2) ? 'selected' : ''?> value="2"><?php echo t('Trong trang giỏ hàng');?></option>
		                                        <option <?php echo (isset($info['only_apply']) && $info['only_apply']==3) ? 'selected' : ''?> value="3"><?php echo t('Phí vận chuyển');?></option>
		                                        
		                                     </select>
		                                </div>
		                                <div class="form-group">
		                                     <label><?php echo t('Status');?></label>
		                                     <select name="item[status]" class="form-control">
		                                        <option <?php echo (isset($info['status']) && $info['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
		                                        <option <?php echo (isset($info['status']) && $info['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
		                                     </select>
		                                </div>
		                                <button  style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
		                                </form>
                                    </div>
                                    <div class="tab-pane fade" id="detail_km">
                                       <?php 
	                                       if(isset($info['promotion_type']) && $info['promotion_type']=="code")
	                                       {
		                                       ?>
		                                       <form action="<?php echo CController::CreateUrl('production/addcouponcode')?><?php echo isset($info['id']) ? '&id='.$info['id']: ''?>" method="post" enctype="multipart/form-data">
			                                       <div class="form-group" style="margin-top: 10px">
					                            		 <label><?php echo t('Mã giảm giá / List Mã giảm giá (các mã được nối với nhau bởi dấu ",")');?><span style="color:red;margin-left: 5px">*</span></label>
					                            		<input type="hidden" name="item[id_ctkm]" value="<?php echo (isset($info['id'])) ? $info['id'] : ''?>"/>
					                            	     <textarea class="form-control" rows="3" name="item[list_code]"></textarea>
					                                </div>
					                                 <button  style="float: right" type="submit" class="btn btn-primary"><?php echo t('Thêm 1 hoặc nhiều Mã coupon ');?></button>
		                                       </form>
		                                       <?php
			                                    $list_detail=Khuyenmaidetail::model()->findAllByAttributes(array('id_ctkm' => $info['id']));
			                                    $this->renderPartial('list_detail_ctkm',array("list"=>$list_detail,"id_ctkm"=>$info['id']));
	                                       }
                                       ?>
                                    </div>
                                </div>
                            	
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        
<script type="text/javascript">
	function change_loai_km(value){
		if(value=="val")
		{
			$("#id_range_value").show();
		}
		else{
			$("#id_range_value").hide();
		}
	}
</script>
