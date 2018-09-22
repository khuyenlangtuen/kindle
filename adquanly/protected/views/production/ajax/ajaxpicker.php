
                            	 <div class="table-responsive" style="overflow: hidden;">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php echo t('id') ?></th>
                                            <th><?php echo t('product_code') ?></th>
                                            <th><?php echo t('Product') ?></th>
                                            <th><?php echo t('price') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($data['list_product'])
                                        {
                                            $list_product_id=DModels::get_list_id_block_product($data['block_type'],$data['option_id']);
                                            foreach( $data['list_product'] as $key=>$value)
                                            {
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><input type="checkbox" val="<?php echo $value['id'];?>" class="chk_id_product" <?php echo in_array($value['id'],$list_product_id ) ? 'checked="checked"' : '' ?> /></td>
                                                    <td><?php echo $value['id'];?></td>
                                                    <td><?php echo $value['product_code'];?></td>
                                                    <td><a href="<?php echo CController::CreateUrl('production/formupdate',array('id'=>$value['id']))?>"><?php echo $value->language->name;?></a></td>
                                                    <td><?php echo number_format($value['gia_ban']);?></td>
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
								<div class="row">
                                    <div style="float:left;  margin-left: 16px;"><button onclick="<?php echo $data['onclick'];?>" class="btn btn-primary"><?php echo t('Save');?></button></div>
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
							
