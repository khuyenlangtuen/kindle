<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            
                        	<div><a href="<?php echo CController::CreateUrl('production/updatekichthuoc')?>"  class="btn btn-default"><?php echo t('Thêm mới size') ?></a></div>
							
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
                                            <th><?php echo t('Size') ?></th>
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
                                                    <td><a href="<?php echo CController::CreateUrl('production/updatekichthuoc',array('id'=>$value['id']))?>"><?php echo $value['size'];?></a></td>
													<td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('production/delkichthuoc')?>" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    	<a title="cập nhật" href="<?php echo CController::CreateUrl('production/updatekichthuoc',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
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
           

