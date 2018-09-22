<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <input type="hidden" id="block_type" value="<?php echo $data['block_type']?>" />
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body" id="panel-body">
                            	 <div class="table-responsive" style="overflow: hidden;">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php echo t('id') ?></th>
                                            <th><?php echo t('product_code') ?></th>
                                            <th><?php echo t('Product') ?></th>
                                            <th><?php echo t('price') ?></th>
                                            <th><?php echo t('list price') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($data['list_product'])
                                        {
                                            $list_product_id=DModels::get_list_id_block_product($data['block_type']);
                                            foreach( $data['list_product'] as $key=>$value)
                                            {
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><input type="checkbox" val="<?php echo $value['id'];?>" class="chk_id_product" <?php echo in_array($value['id'], $list_product_id) ? 'checked="checked"' : '' ?> /></td>
                                                    <td><?php echo $value['id'];?></td>
                                                    <td><?php echo $value['product_code'];?></td>
                                                    <td><a href="<?php echo CController::CreateUrl('production/formupdate',array('id'=>$value['id']))?>"><?php echo $value->language->name;?></a></td>
                                                    <td><?php echo number_format($value['gia_ban']);?></td>
                                                    <td><?php echo number_format($value['gia_goc']);?></td>
                                                </tr>
                                            	<?php
                        						
                                            }
                        				}
                        				?>
                                        
                                    </tbody>
                                </table>
								
                            </div>
							<?php
							if($data['list_product'])
							{
								
								?>
                                <div style="float:left;  margin-left: 16px;"><button onclick="add_product_picker()" class="btn btn-primary"><?php echo t('Save');?></button></div>
								<div class="row">
									<div style="float:right;margin-right: 20px;">
										
											<?php
											$this->widget('ext.MyLinkPagerAjax', array(
													'currentPage'=>$data['pages']->getCurrentPage(),
													'itemCount'=>$data['total_product'],
													'pageSize'=>$data['pages']->pageSize,
													'maxButtonCount'=>5,
													'header'=>'',
													'htmlOptions'=>array('class'=>'pagination'),
												));
											?>
											
									</div>
								</div>
								<?php
							}
							?>
							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
