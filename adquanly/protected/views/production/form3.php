<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	<div>
                        	<a href="<?php echo CController::CreateUrl('production/kichthuoc')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('List size') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('production/updatekichthuoc')?>"  class="btn btn-default"><?php echo t('Thêm mới size') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo CController::CreateUrl('production/updatekichthuoc')?><?php echo isset($info['id']) ? '&id='.$info['id']: ''?>" method="post" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <?php echo t('info_general')?>
                            </div>
                            <div class="panel-body">
                                
                            	<div class="form-group">
                            		 <label><?php echo t('Size');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info['size']) ? $info['size']: ''?>" name="item[size]" class="form-control" placeholder="<?php echo t('size');?> ...">
                            	   <label class="error cate_name"></label>
                                </div>
                            </div>
                        </div>
                        <button onclick="" style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
                        </form>
                    </div>
                </div>
            </div>
        

