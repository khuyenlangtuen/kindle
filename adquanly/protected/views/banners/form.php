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
                        	<a href="<?php echo CController::CreateUrl('banners/index')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('Banners') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('banners/formadd')?>"  class="btn btn-default"><?php echo t('Add new banner') ?></a></div>
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
                                    <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                            		 <label><?php echo t('Banner name');?><span style="color:red">*</span></label>
                                     <input value="<?php echo isset($info->language->name) ? $info->language->name : ''?>" name="lang[name]" class="form-control" placeholder="<?php echo t('Banner name');?> ...">
                            		
                            	   <label class="error cate_name"></label>
                                </div>
                                <div class="form-group">
                                   
                            		 <label><?php echo t('Link');?></label>
                            		<input value="<?php echo isset($info->link_url) ? $info->link_url : '#';?>" name="item[link_url]" class="form-control" placeholder="<?php echo t('Link url');?> ...">
                            	   <label class="error cate_name"></label>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('Target');?></label>
                            		 <select name="item[target]" class="form-control">
                                        <option <?php echo (isset($info['target']) && $info['target']=='') ? 'selected' : ''?> value=""><?php echo t('Open in current window');?></option>
                                        <option <?php echo (isset($info['target']) && $info['target']=='_blank') ? 'selected' : ''?> value="_blank"><?php echo t('Open in new window');?></option>
                                     </select>
                            	</div>
                                <div class="form-group">
                            		 <label><?php echo t('Description');?></label>
                                     <textarea id="editor_content1"  class="form-control" rows="3" name="lang[description]"><?php echo isset($info->language->description) ? $info->language->description : ''?></textarea>
                                </div>
                                <div class="form-group">
                                   
                            		 <label><?php echo t('priority');?></label>
                            		<input value="<?php echo isset($info->priority) ? $info->priority : 0;?>" name="item[priority]" class="form-control" placeholder="<?php echo t('product_code');?> ...">
                            	   <label class="error cate_name"></label>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('position');?></label>
                            		 <select name="item[position]" class="form-control">
                                        <option <?php echo (isset($info['position']) && $info['position']=='main_home') ? 'selected' : ''?> value="main_home"><?php echo t('Main banner (1170x600)');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='khuyenmai_home') ? 'selected' : ''?> value="khuyenmai_home"><?php echo t('Banner Khuyến mãi');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='top_child') ? 'selected' : ''?> value="top_child"><?php echo t('Top');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='left_child') ? 'selected' : ''?> value="left_child"><?php echo t('Left');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='right_child') ? 'selected' : ''?> value="right_child"><?php echo t('Sidebar Right (360x263)');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='bottom_child') ? 'selected' : ''?> value="bottom_child"><?php echo t('Bottom');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='mid_child') ? 'selected' : ''?> value="mid_child"><?php echo t('Middle');?></option>
                                        <option <?php echo (isset($info['position']) && $info['position']=='banner_nsx') ? 'selected' : ''?> value="banner_nsx"><?php echo t('Nhà sản xuất');?></option>
                                     </select>
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
                                <?php echo t('picture')?><span style="color:red">*</span>
                            </div>
                            <div class="panel-body">
                                <div class="row show-grid">
                                    <img  style="max-width: 800px" id="id_images0" src="<?php echo isset($info->main_image_pair->thumb_image) ? param('LINK_IMG_BANNER').$info->main_image_pair->thumb_image : Yii::app()->request->baseUrl.'/images/no-image.png'?>" />
                                </div>
                            	<div class="row show-grid">
                                   
                                    <?php
                                    if(!empty($info->main_image_pair)){
                                        ?>
                                        <input type="hidden" name="images[0][id]" value="<?php echo $info->main_image_pair->id?>" />
                                        <?php
                                    }
                                    ?>
                                        <input type="hidden" name="images[0][object_type]" value="B" />
                                        <input type="hidden" name="images[0][type]" value="M" />
                                        <input id="uploadBtn0" onchange="show_image(this,0)" val="0" class="form-control uploadBtn" type="file" name="thumb_img[0]"/>
                                        <label><?php echo t('note');?></label>
                                        <input class="form-control" value="<?php echo isset($info->main_image_pair->alt) ? $info->main_image_pair->alt : ''?>" name="images[0][alt]" placeholder="<?php echo t('note');?> ........"/>
                                    
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

