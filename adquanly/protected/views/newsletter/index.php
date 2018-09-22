<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	<div><a href="<?php echo CController::CreateUrl('general/formadd')?>"  class="btn btn-default"><?php echo t('Thêm mới cài đặt') ?></a></div>
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
                                            <th><?php echo t('stt') ?></th>
                                            <th><?php echo t('Email') ?></th>
                                            <th style="width: 100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($list)
                                        {
											$index=1;
                                            foreach( $list as $key=>$value)
                                            {
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><?php echo $index;?></td>
                                                    <td><a href="#"><?php echo $value->email;?></a></td>
													<td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('newsletter/del')?>" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            	<?php
                        						$index++;
                                            }
                        				}
                        				?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                            	<div style="float:right;margin-right: 20px;">
                            		
                            			<?php
										if($list)
                                        {
											$this->widget('ext.MyLinkPager', array(
													'currentPage'=>$pages->getCurrentPage(),
													'itemCount'=>$item_count,
													'pageSize'=>$pages->pageSize,
													'maxButtonCount'=>5,
													//'nextPageLabel'=>'My text >',
													'header'=>'',
													'htmlOptions'=>array('class'=>'pagination'),
												));
										}
                                        ?>
                                        
                            	</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

