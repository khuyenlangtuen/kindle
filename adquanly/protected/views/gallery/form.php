<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
							<div style="margin-bottom: 20px;">
                            <?php
							   $a=0;  //$this->renderPartial('//blocks/lang',array('url'=>$url,'lang'=>$lang));
							?>
                            </div>
                        	<div>
                        	<a href="<?php echo CController::CreateUrl('gallery/index')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('Gallery') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('gallery/formadd')?>"  class="btn btn-default"><?php echo t('Add new image') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo $url;?>" method="post" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            <div class="panel-body">
								<div class="form-group">
                                    <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                            		 <label><?php echo t('Tên album');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->language->name) ? $info->language->name : ''?>" name="lang[name]" class="form-control" placeholder="<?php echo t('Tên album');?> ...">
                            	   <label class="error cate_name"></label>
                                </div>
								<div class="form-group">
                            		 <label><?php echo t('Mô tả album');?></label>
                                     <textarea id="editor_content" class="form-control" rows="3" name="lang[description]"><?php echo isset($info->language->description) ? $info->language->description : ''?></textarea>
                                </div>
								<?php
								if(isset($info->id))
								{
									?>
									<div class="form-group">
										 <a id="abc" class="btn btn-default" href="<?php echo Yii::app()->params['LINK_SOURCE_ANH'] ?>/filemanager/dialog.php?type=1"><i class="fa fa-files-o fa-fw"></i> Upload image</a>
									</div>
									<?php
								}
								?>
								
								
								<div class="row show-grid">
									<?php
									if(isset($info->id))
									{
										$handle = opendir(Yii::getPathOfAlias('filemanager').'/source/albums/id_'.$info->id);
										
										while($file = readdir($handle)){
											if($file !== '.' && $file !== '..'){
												echo '<a rel="example_group" href='.Yii::app()->params['LINK_SOURCE_ANH'].'/source/albums/id_'.$info->id.'/'.$file.'><img src="'.Yii::app()->params['LINK_SOURCE_ANH'].'/source/albums/id_'.$info->id.'/'.$file.'" border="0" width="100" /></a>';
											}
										}
									}
									?>
								</div>
                            	
                                
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
        selector: "#editor_content",theme: "modern",height: 200,
        plugins: [
                "advlist autolink link image lists charmap preview hr anchor pagebreak",
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

