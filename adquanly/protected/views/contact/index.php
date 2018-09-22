<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
	                         <form action="<?php echo $url;?>" method="post">
                        
	                        <div class="row form-group">
		                        <div class="col-sm-2" style="font-size: 20px;margin-bottom: 10px"><?php echo t('Liên hệ');?></div>
                                <div class="col-md-8">
	                                <span style="float: right">
	                            <?php
								     $this->renderPartial('//blocks/lang',array('url'=>$url,'lang'=>$lang));
								?>
	                                </span>
	                            </div>
	                        </div>
	                        <div class="row form-group">
		                        <div class="col-sm-2"><?php echo t('Mô tả trang');?><span style="color:red">*</span></div>
                                <div class="col-md-8">
	                                <input type="hidden" value="<?php echo Yii::app()->user->getState('lang')?>" name="lang[lang_code]" />
                        		
                        		 
                                 <textarea name="lang[short_description]" class="form-control" placeholder="<?php echo t('Nhập mô tả ngắn');?> ..."><?php echo isset($info->language->short_description) ? $info->language->short_description : ''?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                               <div class="col-sm-2"><?php echo t('Đoạn giới thiệu');?><span style="color:red">*</span></div>
                               <div class="col-md-8">
                                 <textarea name="lang[description]" class="form-control" placeholder="<?php echo t('Nhập đoạn giới thiệu');?> ..."><?php echo isset($info->language->description) ? $info->language->description : ''?></textarea>
                               </div>
                            </div>
                            <div class="row form-group">
                               <div class="col-sm-2"><?php echo t('Địa chỉ');?><span style="color:red">*</span></div>
                               <div class="col-md-8">
                                 <input  name="lang[ung_dung]" value="<?php echo isset($info->language->ung_dung) ? $info->language->ung_dung : ''?>" class="form-control" placeholder="<?php echo t('Nhập địa chỉ');?> ...">
                               </div>
                            </div>
                            <div class="row form-group">
                               <div class="col-sm-2"><?php echo t('Email');?><span style="color:red">*</span></div>
                               <div class="col-md-8">
                                 <input  name="lang[name]" value="<?php echo isset($info->language->name) ? $info->language->name : ''?>" class="form-control" placeholder="<?php echo t('Nhập email');?> ...">
                               </div>
                            </div>
                            <div class="row form-group">
                               <div class="col-sm-2"><?php echo t('Số điện thoại');?><span style="color:red">*</span></div>
                               <div class="col-md-8">
                                 <input  name="lang[seo_name]" value="<?php echo isset($info->language->seo_name) ? $info->language->seo_name : ''?>" class="form-control" placeholder="<?php echo t('Nhập số điện thoại');?> ...">
                               </div>
                            </div>
                            <div class="row form-group">
                               <div class="col-sm-2"><?php echo t('Địa chỉ nhận thư');?><span style="color:red">*</span></div>
                               <div class="col-md-8">
                                 <textarea name="lang[download]" class="form-control" placeholder="<?php echo t('Nhập địa chỉ nhận thư');?> ..."><?php echo isset($info->language->download) ? $info->language->download : ''?></textarea>
                               </div>
                            </div>
                            <div class="row form-group">
	                            <div class="col-sm-2">	&nbsp;</div>
	                            <div class="col-sm-8">
		                            <button class="btn btn-danger" style="float: right">Cập nhật</button>
	                            </div>
	                            
                            </div>
	                         </form>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            	 <div class="table-responsive" style="overflow: hidden;">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo t('id') ?></th>
											<th><?php echo t('Thông tin liên hệ') ?></th>
											<th><?php echo t('Nội dung') ?></th>
											<th><?php echo t('Ngày liên hệ') ?></th>
                                            <th style="width: 100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($list)
                                        {
                                            foreach( $list as $key=>$value)
                                            {
                                            	$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                                    <td><?php echo $value['id'];?></td>
													<td>
														<div> <?php echo $value['fullname'];?></div>
														<div> <a href="mailto:<?php echo $value['email'];?>"><?php echo $value['email'];?></a></div>
														<div>Phone : <?php echo $value['phone'];?></div>
														<div>Đ/c : <?php echo $value['address'];?></div>
													</td>
													<td><?php echo $value['message'];?></td>
													
                                                    <td><?php echo $value['created_at'];?></td>
													
                                                    <td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('contact/del')?>" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            	<?php
                                            }
                        				}
                        				?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                            	<div style="float:right;margin-right: 20px;">
                            			<?php
                                        $this->widget('ext.MyLinkPager', array(
		                                        'currentPage'=>$pages->getCurrentPage(),
		                                        'itemCount'=>$item_count,
		                                        'pageSize'=>$pages->pageSize,
		                                        'maxButtonCount'=>5,
		                                        //'nextPageLabel'=>'My text >',
		                                        'header'=>'',
		                                        'htmlOptions'=>array('class'=>'pagination'),
		                                    ));
                                        ?>
                            	</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
