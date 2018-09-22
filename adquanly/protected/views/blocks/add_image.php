<div id="add_image_<?php echo $index?>" class="row show-grid">
                                        
    <div class="col-md-9 col-md-push-3" style="height: 181px;">
        <input type="hidden" name="images[<?php echo $index?>][object_type]" value="<?php echo $object_type?>" />
        <input type="hidden" name="images[<?php echo $index?>][type]" value="A" />
        <div style="float: right;"><a style="color:red" href="javascript:" onclick="del_add_image(<?php echo $index?>,'<?php echo $object_type?>');"><i class="fa fa-trash-o"></i></a></div>
        <input id="uploadBtn1" onchange="show_image(this,<?php echo $index?>)" val="<?php echo $index?>" class="form-control uploadBtn" type="file" name="thumb_img[<?php echo $index?>]"/>
        <label><?php echo t('note');?></label>
        <input class="form-control" name="images[<?php echo $index?>][alt]" placeholder="<?php echo t('note');?> ........"/>
    </div>
    <div class="col-md-3 col-md-pull-9">
        <img style="min-height: 159px;max-height: 159px;"  id="id_images<?php echo $index?>" src="<?php echo Yii::app()->request->baseUrl.'/images/no-image.png'?>" width="100%" />
    </div>
</div>