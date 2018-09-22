<table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
<?php if ( isset($show_head) && $show_head ) : ?>
                                    <thead>
                                        <tr>
											<th width="45%"><?php echo t('Tên') ?></th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
       <?php endif; ?>                    
<?php if ( isset($value) ) : ?>	   
                                    <tbody>
                                    	
										<tr class="<?php echo $c;?> gradeA">
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
                                            <span><a href="<?php echo CController::CreateUrl('category/capnhatchuyenmuc',array('id'=>$value['id']))?>"><?php echo $value->language->name;?></a>
                                            </span>
                                            </td>
											
											<td width="10%">
												<a title="xóa" url="<?php echo CController::CreateUrl('category/del')?>"  class="btn btn-warning btn-circle" id="id_del_<?php echo $value['id'];?>" onclick="del_demuc2(<?php echo $value['id'];?>)"><i class="fa fa-times"></i></a>
												<a title="Cập nhật" href="<?php echo CController::CreateUrl('category/capnhatchuyenmuc',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
											</td>
										</tr>
                                    </tbody>
<?php endif; ?>      
                                </table>
<?php if ( !empty($value->subcats) ) : ?>
<div id="cat_<?php echo $value->id ?>"></div>
<?php endif; ?>