<div style="margin-top:20px">
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