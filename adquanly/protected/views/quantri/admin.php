<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	
                        	<a href="#modal_add_admin" data-toggle="modal" class="btn btn-default"><?php echo t('add_new_admin') ?></a>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            	 <div class="table-responsive" style="overflow: hidden;">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo t('id') ?></th>
                                            <th><?php echo t('Admin_name') ?></th>
                                            <th><?php echo t('Email') ?></th>
                                             <th><?php echo t('Created_at') ?></th>
                                            <th style="width: 200px"><?php echo t('Status') ?></th>
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
                                                    <td><a href="<?php echo CController::CreateUrl('quantri/adminDetail',array('id'=>$value['id']))?>"><?php echo $value['fullname'];?></a></td>
                                                    <td><a href="<?php echo CController::CreateUrl('quantri/adminDetail',array('id'=>$value['id']))?>"><?php echo $value['username'];?></a></td>
                                                    <td><?php echo date("d/m/Y",strtotime($value['created_at']));?></td>
                                                    <td align="center">
                                                    	<select class="form-control admin_sl_change" val="<?php echo $value['id'];?>">
                                                            <option <?php echo ($value['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
                                                            <option <?php echo ($value['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
                                                         </select>
                                                    </td>
                                                    <td class="center">
                                                    	<a title="xóa" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_amin"><i class="fa fa-times"></i></a>
                                                    	<a title="cập nhật" href="<?php echo CController::CreateUrl('quantri/adminDetail',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                </tr>
                                            	<?php
                        						
                                            }
                        				}
                        				?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
<?php 
// them moi
$content_dialog=$this->renderPartial('//quantri/form/form_addadmin',array('url'=>CController::CreateUrl('quantri/addadmin'),'id_form'=>'frm_add_new_admin','onclick'=>"return check_form_add_admin('#frm_add_new_admin');"),true);
$this->renderPartial('//blocks/dialog',array("title"=>t('add_new_admin'),"content_dialog"=>$content_dialog,'id'=>'modal_add_admin'));

?>

