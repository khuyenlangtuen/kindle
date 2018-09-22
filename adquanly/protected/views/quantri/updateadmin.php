<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	<input type="hidden" id="id_admin" value="<?php echo $info->id;?>" />
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#update_admin" data-toggle="tab"><?php echo t('info_general');?></a>
                                    </li>
                                    <li><a href="#list_nhom" data-toggle="tab"><?php echo t('list_nhom');?></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="update_admin">
                                        <h4></h4>
                                        <?php
    									$this->renderPartial('//quantri/form/form_addadmin',array('url'=>CController::CreateUrl('quantri/updateadmin'),'info'=>$info,'id_form'=>'frm_update_admin','onclick'=>"return check_form_add_admin('#frm_update_admin');"));
    									?>
                                    </div>
                                    <div class="tab-pane fade" id="list_nhom">
                                        
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th><?php echo t('Group_member') ?></th>
                                                    <th><?php echo t('Status') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  <?php
                                                  //var_dump($arr_group_id);
                                                    if($model)
                                                    {
                                                        foreach($model as $value)
                                                        {
                                                            ?>
                                                            <tr>
                                                            <td><a href="<?php echo CController::CreateUrl('quantri/updategroup',array('id'=>$value['id']))?>"><?php echo $value['group_name'];?></a></td>
                                                                <td>
                                                                    <input type="checkbox" class="chk_group" name="admin_admingroups[]" value="<?php echo $value['id'];?>" <?php echo in_array($value['id'], $arr_group_id) ? 'checked="checked"' : '' ?> />
                                                                    <label for="admin_admingroups_<?php echo $value['id'];?>"><?php echo t('On');?></label>
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
            </div>
            
<?php 
// them moi
$content_dialog=$this->renderPartial('//quantri/form/form_addadmin',array('url'=>CController::CreateUrl('quantri/addadmin'),'id_form'=>'frm_add_new_admin','onclick'=>"return check_form_add_admin('#frm_add_new_admin');"),true);
$this->renderPartial('//blocks/dialog',array("title"=>t('add_new_admin'),"content_dialog"=>$content_dialog,'id'=>'modal_add_admin'));
?>
