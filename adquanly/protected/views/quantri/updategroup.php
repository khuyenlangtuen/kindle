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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#update_group" data-toggle="tab"><?php echo t('update_group');?></a>
                                    </li>
                                    <li><a href="#phan_quyen" data-toggle="tab"><?php echo t('phan_quyen');?></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="update_group">
                                        <h4></h4>
                                        <?php
    									$this->renderPartial('//quantri/form/form_addgroup',array('url'=>CController::CreateUrl('quantri/update'),'info'=>$info));
    									?>
                                    </div>
                                    <div class="tab-pane fade" id="phan_quyen">
                                        <form action="<?php echo CController::CreateUrl('quantri/updatePermission');?>" method="post">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                    			<th width="1%" class="table-group-checkbox">
                                                    <input type="hidden" name="group_id" value="<?php echo $info['id'];?>" />
                                    				<input type="checkbox" class="checkbox cm-check-items" title="Check / uncheck all" value="Y" name="check_all">
                                    			</th>
                                    			<th width="100%" colspan="5"><?php echo t('Permission') ?></th>
                                    		</tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($privileges as $section => $_privileges) {

                                        			echo '<tr class="table-group-header"><td colspan="6">'.t($section).'</td></tr>';
                                        
                                        			$loop = ceil(count($_privileges) / 3) * 3;
                                        
                                        			for ($i = 0; $i < $loop; $i++) : ?>
                                        				<?php if ( $i % 3 == 0 ) : ?>
                                        				<tr class="object-group-elements">
                                        				<?php endif; ?>
                                        
                                        				<?php if ( isset($_privileges[$i]) ) : ?>
                                        					<?php $pri = $_privileges[$i]; ?>
                                        					<td width="1%" class="table-group-checkbox">
                                        						<input type="checkbox" id="set_privileges_<?php echo $pri->privilege; ?>" class="checkbox cm-item" value="Y" <?php echo in_array($pri->privilege, $model->group_privileges) ? 'checked="checked"' : '' ?> name="set_privileges[<?php echo $pri->privilege; ?>]">
                                        					</td>
                                        					<td width="33%"><label for="set_privileges_<?php echo $pri->privilege; ?>"><?php echo $pri->description; ?></label></td>
                                        				<?php else : ?>
                                        					<td colspan="2">&nbsp;</td>
                                        				<?php endif; ?>
                                        
                                        				<?php if ( $i %3 == 2 ) : ?>
                                        				</tr>
                                        				<?php endif; ?>
                                        
                                        			<?php endfor;
                                        
                                        		} ?>
                                        </tbody>
                                        </table>
                                        <button style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
                                        </form>
                                    </div>
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
