<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	<div>
                        	<a href="<?php echo CController::CreateUrl('production/mausac')?>"><i class="fa fa-backward"></i>&nbsp;<?php echo t('back').': '.t('List màu') ?></a>
							&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo $title;?></span>
                            </div>
                            <div><a href="<?php echo CController::CreateUrl('production/updatemausac')?>"  class="btn btn-default"><?php echo t('Thêm mới màu sắc') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo CController::CreateUrl('production/updatemausac')?><?php echo isset($info['id']) ? '&id='.$info['id']: ''?>" method="post" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <?php echo t('info_general')?>
                            </div>
                            <div class="panel-body">
                                
                            	<div class="form-group">
                            		 <label><?php echo t('Màu sắc');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info['name']) ? $info['name']: ''?>" name="item[name]" class="form-control" placeholder="<?php echo t('Name');?> ...">
                            	   <label class="error cate_name"></label>
                                </div>
                            </div>
                        </div>
                        <button onclick="" style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
                        </form>
                    </div>
                </div>
            </div>
        

