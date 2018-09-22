<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	 </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?php echo CController::CreateUrl('setting/configemail')?>" method="post" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <?php echo t('Cấu hình email')?>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input value="<?php echo isset($id) ? $id : ''?>" name="item[id]" type="hidden" class="form-control" >
                            		<label><?php echo t('Host');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->host) ? $info->host : ''?>" name="item[host]" class="form-control" placeholder=" ...">

                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('Port');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->port) ? $info->port : 0?>" name="item[port]" class="form-control" >

                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('User name');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->username) ? $info->username : ''?>" name="item[username]" class="form-control" >
                            	   <label class="error cate_name"></label>
                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('password');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->password) ? $info->password : ""?>" name="item[password]" class="form-control" >
                            	   <label class="error cate_name"></label>
                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('Email from');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->from) ? $info->from : ""?>" name="item[from]" class="form-control" >
                            	   <label class="error cate_name"></label>
                                </div>
								<div class="form-group">
                                   
                            		 <label><?php echo t('From name');?><span style="color:red">*</span></label>
                            		<input value="<?php echo isset($info->fromname) ? $info->fromname : ""?>" name="item[fromname]" class="form-control" >
                            	   <label class="error cate_name"></label>
                                </div>
                            </div>
                           
                            
                            
                        </div>
                        <button onclick="" style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
                        </form>
                    </div>
                </div>
            </div>
         


