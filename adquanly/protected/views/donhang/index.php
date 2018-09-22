<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <?php
                                $this->renderPartial('search_form',array("filter"=>$filter,"type"=>$type));
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
											<th><?php echo t('Mã đơn hàng') ?></th>
											<th><?php echo t('Ngày mua hàng') ?></th>
												
                                            <th><?php echo t('Tình trạng') ?></th>
                                            <th style="width: 100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($list)
                                        {
                                            foreach( $list as $key=>$value)
                                            {
												$onclick='show_list_sp('.$value['id'].')';
												
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><?php echo $value['id'];?></td>
                                                    <td><?php echo $value['ma_don_hang'];?></td>
                                                    <td><?php echo $value['created_at'];?></td>
													<td>
                                                        <?php 
                                                        if($value['status2']==1) echo t('Đã xữ lý');
                                                        else if($value['status2']==2) echo t('Chưa xữ lý');
                                                        else if($value['status2']==-1) echo t('Đơn hàng rác');
                                                        

                                                        ?></td>
                                                    <td class="center">
                                                    	<a href="#modal_view" onclick='<?php echo $onclick;?>' data-toggle="modal" class="btn btn-success btn-circle">view</a>
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
           
<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                               
	<div class="modal-dialog">
		
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo ($status==1) ? t('Xem đơn hàng'):t('Xem báo giá');?></h4>
			</div>
			<div class="modal-body" style="font-size: 16px">
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
			</div>
		</div>
		
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
