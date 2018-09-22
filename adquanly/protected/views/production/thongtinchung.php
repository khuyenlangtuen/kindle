<div style="margin-top:20px">
<div class="form-group">
                                   
                                     <label><?php echo t('product_code');?><span style="color:red">*</span></label>
                                    <input value="<?php echo isset($info->product_code) ? $info->product_code : ''?>" name="item[product_code]" class="form-control" placeholder="<?php echo t('product_code');?> ...">
                                   <label class="error cate_name"></label>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                                     <label><?php echo t('product_name');?><span style="color:red">*</span></label>
                                    <input value="<?php echo isset($info->language->name) ? $info->language->name : ''?>" name="lang[name]" class="form-control" placeholder="<?php echo t('product_name');?> ...">
                                   <label class="error cate_name"></label>
                                </div>
                                
                                <div class="form-group">
                                   
                                     <label><?php echo t('Đơn giá');?><span style="color:red">*</span></label>
                                    <input value="<?php echo isset($info->gia_ban) ? number_format($info->gia_ban) : 0?>" name="item[gia_ban]" class="form-control" >
                                   <label class="error cate_name"></label>
                                </div>
                                                                 
                                <div class="form-group">
                                     <label><?php echo t('cate_parent');?></label>
                                     <select name="item[cate_id]" class="form-control">
                                        <?php
                                            //var_dump($categories);
                                            
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
                                <div class="form-group">
                                     <label><?php echo t('Mô tả ngắn gọn sản phẩm');?></label>
                                     <textarea class="form-control" rows="3" name="lang[short_description]"><?php echo isset($info->language->short_description) ? $info->language->short_description : ''?></textarea>
                                </div>
                                <div class="form-group">
                                     <label><?php echo t('Mô tả chi tiết sản phẩm');?></label>
                                     <textarea id="editor_content2" class="form-control" rows="3" name="lang[description]"><?php echo isset($info->language->description) ? $info->language->description : ''?></textarea>
                                </div>
                                
                                <div class="form-group">
                                     <label><?php echo t('Status');?></label>
                                     <select name="item[status]" class="form-control">
                                        <option <?php echo (isset($info['status']) && $info['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
                                        <option <?php echo (isset($info['status']) && $info['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
                                     </select>
                                </div>
                            </div>