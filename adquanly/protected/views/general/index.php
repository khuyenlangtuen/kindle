<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							     $this->renderPartial('//blocks/lang',array('url'=>CController::CreateUrl('general/index'),'lang'=>$lang));
							?>
                            </div>
                        	<div><a href="<?php echo CController::CreateUrl('general/formadd')?>"  class="btn btn-default"><?php echo t('Thêm mới cài đặt') ?></a></div>
							<?php
							     $this->renderPartial('search_form',array("filter"=>$filter));
							?>
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
                                            <th><?php echo t('Name') ?></th>
                                            <th><?php echo t('position') ?></th>
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
                                                    <td><a href="<?php echo CController::CreateUrl('general/formupdate',array('id'=>$value['id']))?>"><?php echo $value->language->name;?></a></td>
                                                    <td><?php echo $value['position'];?></td>
													<td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('general/del')?>" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    	<a title="cập nhật" href="<?php echo CController::CreateUrl('general/formupdate',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                </tr>
                                            	<?php
                        						
                                            }
                        				}
                        				?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                            	<div style="float:right;margin-right: 20px;">
                            		
                            			<?php
                                        $this->widget('ext.MyLinkPager', array(
		                                        'currentPage'=>$pages->getCurrentPage(),
		                                        'itemCount'=>$item_count,
		                                        'pageSize'=>$pages->pageSize,
		                                        'maxButtonCount'=>5,
		                                        //'nextPageLabel'=>'My text >',
		                                        'header'=>'',
		                                        'htmlOptions'=>array('class'=>'pagination'),
		                                    ));
                                        ?>
                                        
                            	</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

