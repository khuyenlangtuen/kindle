<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header" style="margin:0">
                            <div>
                                <div class="form-group" style="float:left;width:50%;margin-right:15px">
                                     <label><?php echo t('Tiêu đề ');?></label>
                                     <input type="hidden" id="block_type" value="options"> 
                                      <input type="hidden" id="option_id" value="<?php echo (isset($data['option_id']) && $data['option_id']) ? $data['option_id'] : 0;?>"> 
                                      <input type="hidden" id="product_id" value="<?php echo $data['product_id']?>"> 
                                      
                                    <input type="text" id="option_name" value="<?php echo (isset($data['option_name']) && $data['option_name']) ? $data['option_name'] : '';?>" class="form-control" placeholder="Thêm tiêu đề option...">  
                                </div>
                                <div class="form-group" style="float:left;width:40%;margin-right:15px">
                                     <label><?php echo t('Thứ tự hiển thị ');?></label>
                                    <input type="text" id="option_priority" value="<?php echo (isset($data['option_priority']) && $data['option_priority']) ? $data['option_priority'] : 1;?>" class="form-control" placeholder="Thứ tự hiển thị trên web...">  
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <div>
                                <fieldset>
                                    <legend>Tìm kiếm</legend>
                                    <div>
                                        <div class="form-group" style="float:left;width:50%;margin-right:15px">
                                             <label><?php echo t('Tên sản phẩm ');?></label>
                                            <input type="text" id="id_ten_sanpham" value="" class="form-control" placeholder="Nhập tên sản phẩm để tìm kiếm">  
                                        </div>
                                        <div class="form-group" style="float:left">
                                             <label><?php echo t('Đề mục sản phẩm');?></label>
                                             <select id="id_theloai" class="form-control">
                                                <?php
                                                    //var_dump($categories);
                                                    $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'',1);
                                                    foreach($categories as $key=>$row)
                                                    {
                                                        if(isset($info->cate_id) && $key==$info->cate_id)
                                                        {
                                                            ?>
                                                            <option selected="" value="<?php echo $key?>"><?php echo $row?></option>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <option value="<?php echo $key?>"><?php echo $row?></option>
                                                            <?php
                                                        }
                                                        
                                                    }
                                                ?>
                                             </select>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                    <div>
                                         <div class="form-group" style="float:left;margin-right:15px">
                                             <label><?php echo t('Giá từ ');?></label>
                                            <input type="text" id="id_gia_tu" value="" class="form-control" placeholder="nhập giá từ...">  
                                        </div>
                                         <div class="form-group" style="float:left">
                                             <label><?php echo t('Giá đến ');?></label>
                                            <input type="text" id="id_gia_den" value="" class="form-control" placeholder="nhập giá đến...">  
                                        </div>
                                        <div class="form-group" style="float:left;margin-top: 25px;margin-left:15px">
                                            <a href="javascript:phantrang(1)" class="btn btn-warning"><?php echo t("Tìm");?></a>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                </fieldset>
                            </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($data['list_product'])
                                        {
                                            $list_product_id=DModels::get_list_id_block_product($data['block_type'],$data['option_id']);
                                            //var_dump($list_product_id);
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
                                <div style="float:left;  margin-left: 16px;"><button onclick="add_product_picker_and_option()" class="btn btn-primary"><?php echo t('Save');?></button></div>
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
