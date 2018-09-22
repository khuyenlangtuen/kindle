<div class="container-fluid">
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
                                            <th><?php echo t('Tên khách hàng') ?></th>
											 <th><?php echo t('Tên tài khoản') ?></th>
                                            <th><?php echo t('Email') ?></th>
                                             <th><?php echo t('Created_at') ?></th>
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
                                                    <td><a href="#"><?php echo $value['fullname'];?></a></td>
                                                    <td><a href="#"><?php echo $value['username'];?></a></td>
													<td><a href="#"><?php echo $value['email'];?></a></td>
                                                    <td><?php echo date("d/m/Y",strtotime($value['created_at']));?></td>
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
            


