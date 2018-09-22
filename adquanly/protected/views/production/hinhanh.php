<div style="margin-top:20px">
	<span style="color:red">Chú ý: tất cả hình ảnh phải có kích thước (width:450px và height: 329px) để hiện thị lên site cho đẹp</span>
	
</div>
<div style="margin-top:20px">
	
<label><?php echo t('Main_picture');?></label>
                                
                                <div class="row show-grid">
                                    <div class="col-md-9 col-md-push-3" style="height: 181px;">
                                    <?php
                                    if(!empty($info->main_image_pair)){
                                        ?>
                                        <input type="hidden" name="images[0][id]" value="<?php echo $info->main_image_pair->id?>" />
                                        <?php
                                    }
                                    ?>
                                        <input type="hidden" name="images[0][object_type]" value="P" />
                                        <input type="hidden" name="images[0][type]" value="M" />
                                        <input id="uploadBtn0" onchange="show_image(this,0)" val="0" class="form-control uploadBtn" type="file" name="thumb_img[0]"/>
                                        <label><?php echo t('note');?></label>
                                        <input class="form-control" value="<?php echo isset($info->main_image_pair->alt) ? $info->main_image_pair->alt : ''?>" name="images[0][alt]" placeholder="<?php echo t('note');?> ........"/>
                                    </div>
                                    <div class="col-md-3 col-md-pull-9">
                                        <img  style="min-height: 159px;max-height: 159px;" id="id_images0" src="<?php echo isset($info->main_image_pair->thumb_image) ? param('LINK_IMG').$info->main_image_pair->thumb_image : Yii::app()->request->baseUrl.'/images/no-image.png';?>" width="100%" />
                                    </div>
                                </div>                                
                                <label><?php echo t('Album ảnh');?></label>
                                <div id="add_image">
                                    <?php
                                    $index=isset($info->imageCount) ? $info->imageCount : 1;
                                    //echo $index;
                                    if(!empty($info->addition_image_pair))
                                    {
                                        foreach($info->addition_image_pair as $key=>$row)
                                        {
                                            $i=$key+1;
                                            ?>
                                            <div id="add_image_<?php echo $i?>" class="row show-grid">
                                                
                                                <div class="col-md-9 col-md-push-3" style="height: 181px;">
                                                    <input type="hidden" name="images[<?php echo $i?>][id]" value="<?php echo $row->id?>" />
                                                    <input type="hidden" name="images[<?php echo $i?>][object_type]" value="<?php echo $row->object_type?>" />
                                                    <input type="hidden" name="images[<?php echo $i?>][type]" value="<?php echo $row->type?>" />
                                                    <div style="float: right;"><a style="color:red" href="javascript:" onclick="del_update_image(<?php echo $i?>,<?php echo $row->id?>,'<?php echo $row->object_type?>');"><i class="fa fa-trash-o"></i></a></div>
                                                    <input id="uploadBtn1" onchange="show_image(this,<?php echo $i?>)" val="<?php echo $i?>" class="form-control uploadBtn" type="file" name="thumb_img[<?php echo $i?>]"/>
                                                    <label><?php echo t('note');?></label>
                                                    <input class="form-control" value="<?php echo $row->alt?>" name="images[<?php echo $i?>][alt]" placeholder="<?php echo t('note');?> ........"/>
                                                </div>
                                                <div class="col-md-3 col-md-pull-9">
                                                    <img style="min-height: 159px;max-height: 159px;"  id="id_images<?php echo $i?>" src="<?php echo isset($row->thumb_image) ? param('LINK_IMG').$row->thumb_image : Yii::app()->request->baseUrl.'/images/no-image.png'?>" width="100%" />
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        
                                    }
                                    ?>
                                </div>
                                <div style="float: right" id="btn_add_image"><a href="javascript:" onclick="add_image(<?php echo $index?>,'P');"><i class="fa fa-plus"></i></a></div>
</div>