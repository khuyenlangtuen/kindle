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
                        	
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#thongtinchung" data-toggle="tab"><?php echo t('Thông tin chung');?></a>
                                    </li>
                                    <li><a href="#hinhanh" data-toggle="tab"><?php echo t('Hình ảnh');?></a>
                                    </li>
                                    <!--li><a href="#seo" data-toggle="tab"><?php echo t('Seo');?></a>
                                    </li>
                                    <li><a href="#dichvutrongoi" data-toggle="tab"><?php echo t('Dịch vụ trọn gói');?></a>
                                    </li>
                                    <li><a href="#kho" data-toggle="tab"><?php echo t('Kho');?></a>
                                    </li-->
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="thongtinchung">
                                        <?php
                                        $this->renderPartial('//production/thongtinchung',array('info'=>$info,"categories"=>$categories));
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="hinhanh">
                                        <?php
                                        $this->renderPartial('//production/hinhanh',array('info'=>$info));
                                        ?>
                                    </div>
                                     <!--div class="tab-pane fade" id="seo">
                                        <?php
                                        $this->renderPartial('//production/seo',array('info'=>$info));
                                        ?>
                                    </div>
                                     <div class="tab-pane fade" id="dichvutrongoi">
                                        <?php
                                        $this->renderPartial('//production/dichvutrongoi',array('info'=>$info));
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="kho">
                                        <div style="margin-top:20px">
                                            <div class="form-group">
                                                <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                                                 <label><?php echo t('Số lượng tồn');?><span style="color:red">*</span></label>
                                                <input value="<?php echo isset($info->sl_ton) ? $info->sl_ton : ''?>" name="item[sl_ton]" class="form-control" placeholder="<?php echo t('Số lượng tồn');?> ...">
                                              
                                            </div>
                                            
                                            <div class="form-group">
                                               
                                                 <label><?php echo t('Số lượng đã bán');?><span style="color:red">*</span></label>
                                                <input value="<?php echo isset($info->sl_ban) ? $info->sl_ban : 0?>"  class="form-control" readonly>
                                               
                                            </div>
                                        </div>
                                    </div-->
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
        selector: "#editor_content3",theme: "modern",height: 200,
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
        selector: "#editor_content4",theme: "modern",height: 200,
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


