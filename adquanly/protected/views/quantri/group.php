<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	
                        	<a href="#modal_add" data-toggle="modal" class="btn btn-default"><?php echo t('add_new_group') ?></a>
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
                                            <th><?php echo t('Group_member') ?></th>
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
                                                    <td><a href="<?php echo CController::CreateUrl('quantri/updategroup',array('id'=>$value['id']))?>"><?php echo $value['group_name'];?></a></td>
                                                    <td align="center">
                                                    	<select url="<?php echo CController::CreateUrl('quantri/updateStatusGroup')?>" class="form-control sl_change" val="<?php echo $value['id'];?>">
                                                            <option <?php echo ($value['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
                                                            <option <?php echo ($value['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
                                                         </select>
                                                    </td>
                                                    <td class="center">
                                                    	<a title="xóa" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del"><i class="fa fa-times"></i></a>
                                                    	<a title="cập nhật" href="<?php echo CController::CreateUrl('quantri/updategroup',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
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
$content_dialog=$this->renderPartial('//quantri/form/form_addgroup',array('url'=>CController::CreateUrl('quantri/addgroup')),true);
$this->renderPartial('//blocks/dialog',array("title"=>t('add_new_group'),"content_dialog"=>$content_dialog,'id'=>'modal_add'));
?>

