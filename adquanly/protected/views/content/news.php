<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							     $this->renderPartial('//blocks/lang',array('url'=>CController::CreateUrl('content/news'),'lang'=>$lang));
							?>
                            </div>
                        	<div><a href="<?php echo CController::CreateUrl('content/formaddnews')?>"  class="btn btn-default"><?php echo t('Thêm mới bài biết') ?></a></div>
                            <?php
                                 $this->renderPartial('search_form_news',array("filter"=>$filter));
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
                                            
                                            <th><?php echo t('Tiêu đề') ?></th>
                                            <th><?php echo t('Tác giả') ?></th>
                                            <th><?php echo t('Chuyên mục') ?></th>
											<th><?php echo t('Ngày') ?></th>
											<!--th><?php echo t('Ngày tạo') ?></th-->
											
                                            <th style="width: 100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($list)
                                        {
                                            foreach( $list as $key=>$value)
                                            {
												$cate_name=DModels::get_cate_name_cate_parent_by_cate_id($value['id_cate'],Yii::app()->user->getState('lang'));
                                            	$author_name=DModels::get_author_by_id($value['owner_id']);
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><?php echo $value['content_id'];?></td>
                                                    
                                                    <td><a href="<?php echo CController::CreateUrl('content/formupdatenews',array('id'=>$value['content_id']))?>"><?php echo $value->language->name;?></a></td>
                                                    <td><?php echo $author_name;?></td>
                                                    <td><?php echo $cate_name;?></td>
													<td>
														<?php 
															if($value['status']==1)
															{
																echo "Đã đăng";
																echo "<br/>";
																echo date("d/m/Y H:s:i",strtotime($value['publish_at']));
															}
															else{
																echo "Chưa đăng";
															}
															
														?>
													</td>
                                                    <!--td><?php echo $value['created_at'];?></td-->
                                                    <td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('content/del')?>" val="<?php echo $value['content_id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    	<a title="c?p nh?t" href="<?php echo CController::CreateUrl('content/formupdatenews',array('id'=>$value['content_id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
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
           

