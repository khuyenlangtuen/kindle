<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                        	<div><a href="<?php echo CController::CreateUrl('gallery/formadd')?>"  class="btn btn-default"><?php echo t('Add new image') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            	<?php
                                if($model)
                                {
                                    foreach($model as $key=>$item)
                                    {
                                        ?>
                                        <div class="col-md-3" style="text-align: center;">
                                            <div style="min-height: 148px;">
											<?php
											if(isset($item->id))
											{
												
												$handle = opendir(Yii::getPathOfAlias('filemanager').'/source/albums/id_'.$item->id);
												while($file = readdir($handle)){
													if($file !== '.' && $file !== '..'){
														echo '<img style="max-width: 100%;" src="'.Yii::app()->params['LINK_SOURCE_ANH'].'/source/albums/id_'.$item->id.'/'.$file.'" border="0" style="height:148px;" />';
														break;
													}
												}
											}
											?>
											</div>
											
                                            <div><?php echo ($item->language->name) ? $item->language->name : '...'?></div>
                                            <div style="font-size:18px">
                                                <span><a href="<?php echo CController::CreateUrl('gallery/formupdate',array('id'=>$item->id))?>"><i class="fa fa-pencil"></i></a></span>
                                                <span style="margin-left: 10px;"><a style="color: red;" url="<?php echo CController::CreateUrl('gallery/del')?>" val="<?php echo $item->id;?>" class="del_demuc"><i class="fa fa-trash-o"></i></a></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div style="clear: both;"></div>
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
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

