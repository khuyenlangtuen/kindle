<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							    $this->renderPartial('//blocks/lang',array('url'=>CController::CreateUrl('hoidap/index'),'lang'=>$lang));
							?>
                            </div>
                        	<div><a href="<?php echo CController::CreateUrl('hoidap/formadd')?>"  class="btn btn-default"><?php echo t('Thêm mới câu hỏi') ?></a></div>
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
                                            <th><?php echo t('Câu hỏi') ?></th>
                                            <th><?php echo t('câu trả lời') ?></th>
                                            <th style="width: 15%"><?php echo t('Trạng thái') ?></th>
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
                                                    <td>
	                                                    <p><?php echo $value->language->short_description;?></p>	                                                </td>
													</td>	
                                                    <td><p><?php echo $value->language->description;?></p></td>
													<td align="center">
                                                        <select url="<?php echo CController::CreateUrl('hoidap/updateStatus')?>" class="form-control sl_change" val="<?php echo $value['id'];?>">
                                                            <option <?php echo ($value['status']==1) ? 'selected' : ''?> value="1"><?php echo t('Hiển thị');?></option>
                                                            <option <?php echo ($value['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Tắt');?></option>
                                                         </select>
                                                    </td>
                                                    <td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('hoidap/del')?>" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    	<a title="cập nhật" href="<?php echo CController::CreateUrl('hoidap/formupdate',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
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
           

