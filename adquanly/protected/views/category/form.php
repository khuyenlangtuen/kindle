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
                            
                            <div class="panel-heading">
                                <?php echo t('info_general')?>
                            </div>
                            <div class="panel-body">
                            	<div class="form-group">
                                    <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                            		 <label><?php echo t('cate_name');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->language->name) ? $info->language->name : ''?>" name="lang[name]" class="form-control" placeholder="...">
                            	   <label class="error cate_name"></label>
                                </div>
                                
                                <div class="form-group">
                            		 <label><?php echo t('cate_parent');?></label>
                            		 <select name="item[parent_id]" class="form-control">
                                        <?php
                                            foreach($categories as $key=>$row)
                                            {
                                                ?>
                                                    <option <?php echo (isset($info['parent_id']) && $info['parent_id']==$key) ? 'selected' : ''?> value="<?php echo $key?>"><?php echo $row?></option>
                                                <?php
                                            }
                                        ?>
                                     </select>
                            	</div>
                                <div class="form-group">
                            		 <label><?php echo t('Description');?></label>
                                     <textarea class="form-control" rows="3" name="lang[short_description]"><?php echo isset($info->language->short_description) ? $info->language->short_description : ''?></textarea>
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
                            	<div class="row show-grid">
                                    <div class="col-md-9 col-md-push-3" style="height: 181px;">
                                    <?php
                                    if(!empty($info->main_image_pair)){
                                        ?>
                                        <input type="hidden" name="images[0][id]" value="<?php echo $info->main_image_pair->id?>" />
                                        <?php
                                    }
                                    ?>
                                        <input type="hidden" name="images[0][object_type]" value="C" />
                                        <input type="hidden" name="images[0][type]" value="M" />
                                        <input id="uploadBtn0" onchange="show_image(this,0)" val="0" class="form-control uploadBtn" type="file" name="thumb_img[0]"/>
                                        <label><?php echo t('note');?></label>
                                        <input class="form-control" value="<?php echo isset($info->main_image_pair->alt) ? $info->main_image_pair->alt : ''?>" name="images[0][alt]" placeholder="<?php echo t('note');?> ........"/>
                                    </div>
                                    <div class="col-md-3 col-md-pull-9">
                                        <img style="min-height: 159px;max-height: 159px;"  id="id_images0" src="<?php echo isset($info->main_image_pair->thumb_image) ? param('LINK_IMG_UPLOAD').'origin/'.$info->main_image_pair->thumb_image : Yii::app()->request->baseUrl.'/images/no-image.png'?>" width="100%" />
                                    </div>
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
                            <div class="panel-heading">
                                <?php echo t('info_extra')?>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                            		 <label><?php echo t('Priority');?></label>
                            		<input value="<?php echo isset($info['priority']) ? $info['priority'] : 0;?>" name="item[priority]" class="form-control" />
                                </div>
                            	<div class="form-group">
                            		 <label><?php echo t('Show in menu');?></label>
                            		 <select name="item[show_in_menu]" class="form-control">
                                        
                                        <option <?php echo (isset($info['show_in_menu']) && $info['show_in_menu']==0) ? 'selected' : ''?> value="0"><?php echo t('not_show');?></option>
										<option <?php echo (isset($info['show_in_menu']) && $info['show_in_menu']==1) ? 'selected' : ''?> value="1"><?php echo t('show');?></option>
                                     </select>
                            	</div>
                            </div>
                            
                        </div>
                        <button onclick="" style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
                        </form>
                    </div>
                </div>
            </div>
           

