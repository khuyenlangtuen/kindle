<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							     $this->renderPartial('//blocks/lang',array('url'=>$url,'lang'=>$lang));
							?>
                            </div>
                        	<div>
                        	<a href="<?php echo CController::CreateUrl('production/index')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('Product') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('production/formadd')?>"  class="btn btn-default"><?php echo t('add_new_product') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo $url;?>" method="post" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <?php echo t('info_general')?>
                            </div>
                            <div class="panel-body">
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
                                   
                            		 <label><?php echo t('Giá gốc');?><span style="color:red"></span></label>
                            		<input value="<?php echo isset($info->gia_goc) ? $info->gia_goc : 0?>" name="item[gia_goc]" class="form-control" >
                            	   <label class="error cate_name"></label>
                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('Giá bán');?><span style="color:red"></span></label>
                            		<input value="<?php echo isset($info->gia_ban) ? $info->gia_ban : 0?>" name="item[gia_ban]" class="form-control" >
                            	   <label class="error cate_name"></label>
                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('% khuyến mãi');?><span style="color:red"></span></label>
                            		<input value="<?php echo isset($info->khuyen_mai) ? $info->khuyen_mai : 0?>" name="item[khuyen_mai]" class="form-control" >
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
                            		 <label><?php echo t('Mô tả ngắn gọn');?></label>
                                     <textarea id="editor_content1" class="form-control" rows="3" name="lang[short_description]"><?php echo isset($info->language->short_description) ? $info->language->short_description : ''?></textarea>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('Thông tin chi tiết');?></label>
                                     <textarea id="editor_content2" class="form-control" rows="3" name="lang[description]"><?php echo isset($info->language->description) ? $info->language->description : ''?></textarea>
                                </div>
                                <div class="form-group">
                                     <label><?php echo t('Nhà sản xuất');?></label>
                                     <textarea id="editor_content5" class="form-control" rows="3" name="lang[nha_san_xuat]"><?php echo isset($info->language->nha_san_xuat) ? $info->language->nha_san_xuat : ''?></textarea>
                                </div>
								<div class="form-group">
                            		 <label><?php echo t('Ứng dụng');?></label>
                                     <textarea id="editor_content3" class="form-control" rows="3" name="lang[ung_dung]"><?php echo isset($info->language->ung_dung) ? $info->language->ung_dung : ''?></textarea>
                                </div>
								<div class="form-group">
                            		 <label><?php echo t('Download');?></label>
                                     <textarea id="editor_content4" class="form-control" rows="3" name="lang[download]"><?php echo isset($info->language->download) ? $info->language->download : ''?></textarea>
                                </div>
								
                                <div class="form-group">
                            		 <label><?php echo t('Status');?></label>
                            		 <select name="item[status]" class="form-control">
                                        <option <?php echo (isset($info['status']) && $info['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
                                        <option <?php echo (isset($info['status']) && $info['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
                                     </select>
                            	</div>
                            </div>
                            <div class="panel-heading">
                                <?php echo t('picture').' ('.t('without').')'?>
                            </div>
                            <div class="panel-body">
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
                                        <img style="min-height: 159px;max-height: 159px;"  id="id_images0" src="<?php echo isset($info->main_image_pair->thumb_image) ? param('LINK_IMG').$info->main_image_pair->thumb_image : Yii::app()->request->baseUrl.'/images/no-image.png'?>" width="100%" />
                                    </div>
                                </div>
                                <label><?php echo t('Add_picture');?></label>
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
                            <div class="panel-heading">
                                <?php echo t('info_seo')?>
                            </div>
                            <div class="panel-body">
                            	<div class="form-group">
                            		 <label><?php echo t('seo_name');?></label>
                            		<input value="<?php echo isset($info->language->seo_name) ? $info->language->seo_name : ''?>" name="lang[seo_name]" class="form-control" placeholder="...">
                            	   <label class="error seo_name"></label>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('seo_title');?></label>
                            		<input value="<?php echo isset($info->language->seo_title) ? $info->language->seo_title : ''?>" name="lang[seo_title]" class="form-control" placeholder="...">
                            	   <label class="error seo_title"></label>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('seo_description');?></label>
                                     <textarea class="form-control" rows="3" name="lang[seo_description]"><?php echo isset($info->language->seo_description) ? $info->language->seo_description : ''?></textarea>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('seo_keywords');?></label>
                                     <textarea class="form-control" rows="3" name="lang[seo_keywords]"><?php echo isset($info->language->seo_keywords) ? $info->language->seo_keywords : ''?></textarea>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('search_keys');?></label>
                                     <textarea class="form-control" rows="3" name="lang[search_keys]"><?php echo isset($info->language->search_keys) ? $info->language->search_keys : ''?></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <button onclick="" style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
                        </form>
                    </div>
                </div>
            </div>
           <script src="<?php echo Yii::app()->request->baseUrl; ?>/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "#editor_content1",theme: "modern",height: 150,
        plugins: [
                "advlist autolink link image lists charmap preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor colorpicker filemanager"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "filemanager | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

       /* templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ],*/
		external_filemanager_path:"<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/",
		   filemanager_title:"Thư viện ảnh" ,
		   external_plugins: { "filemanager" : "<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/plugin.min.js"}
});

</script>   
<script type="text/javascript">
tinymce.init({
        selector: "#editor_content2",theme: "modern",height: 200,
        plugins: [
                "advlist autolink link image lists charmap preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor colorpicker filemanager"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "filemanager | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

       /* templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ],*/
		external_filemanager_path:"<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/",
		   filemanager_title:"Thư viện ảnh" ,
		   external_plugins: { "filemanager" : "<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/plugin.min.js"}
});</script>   
<script type="text/javascript">
tinymce.init({
        selector: "#editor_content3",theme: "modern",height: 150,
        plugins: [
                "advlist autolink link image lists charmap preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor colorpicker filemanager"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "filemanager | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

       /* templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ],*/
		external_filemanager_path:"<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/",
		   filemanager_title:"Thư viện ảnh" ,
		   external_plugins: { "filemanager" : "<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/plugin.min.js"}
});</script>   
<script type="text/javascript">
tinymce.init({
        selector: "#editor_content4",theme: "modern",height: 150,
        plugins: [
                "advlist autolink link image lists charmap preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor colorpicker filemanager"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "filemanager | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

       /* templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ],*/
		external_filemanager_path:"<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/",
		   filemanager_title:"Thư viện ảnh" ,
		   external_plugins: { "filemanager" : "<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/plugin.min.js"}
});

</script>   


