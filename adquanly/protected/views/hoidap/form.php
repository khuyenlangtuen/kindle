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
                        	<a href="<?php echo CController::CreateUrl('hoidap/index')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('Danh sách câu hỏi') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('hoidap/formadd')?>"  class="btn btn-default"><?php echo t('Thêm mới câu hỏi') ?></a></div>
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
                                <?php echo t('Thông tin hỏi đáp')?>
                            </div>
                            <div class="panel-body">
                                <!--div class="form-group">
                                     <label><?php echo t('Email:');?><span style="color:red">*</span></label>
                                    <input class="form-control" value="<?php echo isset($info['email']) ? $info['email'] : ''?>" name="item[email]"/>
                                   
                                </div-->
                            	<div class="form-group">
	                            	<input type="hidden" value="<?php echo isset($info['email']) ? $info['email'] : ''?>" name="item[email]"/>
                                   
                                    <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                            		 <label><?php echo t('Câu hỏi:');?><span style="color:red">*</span></label>
                            		<textarea class="form-control" rows="3" name="lang[short_description]"><?php echo isset($info->language->short_description) ? $info->language->short_description : ''?></textarea>
                            	   <label class="error cate_name"></label>
                                </div>
                                <div class="form-group">
                            		 <label><?php echo t('Câu trả lời:');?></label>
                                     <textarea id="editor_content" class="form-control" rows="3" name="lang[description]"><?php echo isset($info->language->description) ? $info->language->description : ''?></textarea>
                                </div>
                                <div class="form-group">
                                <div class="row show-grid">
                                    <img  style="max-width: 800px" id="id_images0" src="<?php echo isset($info->main_image_pair->thumb_image) ? param('LINK_IMG_UPLOAD').'faq/'.$info->main_image_pair->thumb_image : Yii::app()->request->baseUrl.'/images/no-image.png'?>" />
                                </div>
                            	<div class="row show-grid">
                                   
                                    <?php
                                    if(!empty($info->main_image_pair)){
                                        ?>
                                        <input type="hidden" name="images[0][id]" value="<?php echo $info->main_image_pair->id?>" />
                                        <?php
                                    }
                                    ?>
                                        <input type="hidden" name="images[0][object_type]" value="F" />
                                        <input type="hidden" name="images[0][type]" value="M" />
                                        <input id="uploadBtn0" onchange="show_image(this,0)" val="0" class="form-control uploadBtn" type="file" name="thumb_img[0]"/>
                                        <!--label><?php echo t('note');?></label-->
                                        <input type="hidden" value="<?php echo isset($info->main_image_pair->alt) ? $info->main_image_pair->alt : ''?>" name="images[0][alt]" placeholder="<?php echo t('note');?> ........"/>
                                    
                                </div>
                                </div>
                                <div class="form-group">
                                     <label><?php echo t('Status');?></label>
                                     <select name="item[status]" class="form-control">
                                        <option <?php echo (isset($info['status']) && $info['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
                                        <option <?php echo (isset($info['status']) && $info['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
                                     </select>
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
        selector: "#editor_content",theme: "modern",height: 200,
        relative_urls : false,
		 remove_script_host : false,
        plugins: [
                "advlist autolink link image lists charmap preview code hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor filemanager"
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

