<table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
<?php if ( isset($show_head) && $show_head ) : ?>
                                    <thead>
                                        <tr>
                                            <th width="5%"><?php echo t('id') ?></th>
                                            <th width="10%"><?php echo t('Show menu') ?></th>
											<th width="45%"><?php echo t('Category') ?></th>
											<!--th width="10%"><?php echo t('Product_count') ?></th-->
                                            <th width="15%"><?php echo t('Status') ?></th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
       <?php endif; ?>                    
<?php if ( isset($value) ) : ?>	   
                                    <tbody>
                                    	
										<tr class="<?php echo $c;?> gradeA">
											<td width="5%"><?php echo $value['id'];?></td>
											<td width="10%"><?php echo ($value['show_in_menu']==1) ? 'Y' : 'N'?></td>
											<td width="45%">
                                            <span style="<?php echo 'padding-left:'.(25 * getCatLevel($value->id_path)).'px;'; ?>">
                                                <?php 
                                                if ( !empty($value->subcats) ) {
                                                    if($value->cate_type=='content')
                                                    {
                                                        ?>
                                                        <i onclick="expand_demuc2(<?php echo $value['id'];?>)" id="expand_<?php echo $value['id'];?>" style="cursor: pointer;" class="fa fa-plus-square"></i>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <i onclick="expand_demuc(<?php echo $value['id'];?>)" id="expand_<?php echo $value['id'];?>" style="cursor: pointer;" class="fa fa-plus-square"></i>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    <i onclick="collapse_demuc(<?php echo $value['id'];?>);" style="cursor: pointer;display: none;" id="colpand_<?php echo $value['id'];?>" class="fa fa-minus-square"></i>
                                                    
                                                    <?php
                                                }
                                                
                                                ?>
                                            </span>
                                            <span><a href="<?php echo CController::CreateUrl('category/formupdate',array('id'=>$value['id']))?>"><?php echo $value->language->name;?></a>
                                            </span>
                                            </td>
											<!--td width="10%"><?php echo $value['product_count'];?></td-->
											<td width="15%">
												<select url="<?php echo CController::CreateUrl('category/updateStatus')?>"  class="form-control" id="sl_change_<?php echo $value['id'];?>" onchange="update_status_demuc(<?php echo $value['id'];?>)">
													<option <?php echo ($value['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
													<option <?php echo ($value['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
												 </select>
											</td>
											<td width="10%">
												<a title="xóa" url="<?php echo CController::CreateUrl('category/del')?>"  class="btn btn-warning btn-circle" id="id_del_<?php echo $value['id'];?>" onclick="del_demuc2(<?php echo $value['id'];?>)"><i class="fa fa-times"></i></a>
												<a title="Cập nhật" href="<?php echo CController::CreateUrl('category/formupdate',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
											</td>
										</tr>
                                    </tbody>
<?php endif; ?>      
                                </table>
<?php if ( !empty($value->subcats) ) : ?>
<div id="cat_<?php echo $value->id ?>"></div>
<?php endif; ?>