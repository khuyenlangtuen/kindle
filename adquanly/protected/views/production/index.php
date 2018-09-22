<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							   $a=0; // $this->renderPartial('//blocks/lang',array('url'=>CController::CreateUrl('production/index'),'lang'=>$lang));
							?>
                            </div>
                        	<div><a href="<?php echo CController::CreateUrl('production/formadd')?>"  class="btn btn-default"><?php echo t('add_new_product') ?></a></div>
                            <?php
                                 $this->renderPartial('search_form',array("filter"=>$filter));
                            ?>
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
                                            <th><?php echo t('product_code') ?></th>
                                            <th><?php echo t('Product') ?></th>
                                            <th><?php echo t('price') ?></th>
                                            <th style="width: 200px"><?php echo t('Status') ?></th>
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
                                                    <td><?php echo $value['product_code'];?></td>
                                                    <td><a href="<?php echo CController::CreateUrl('production/formupdate',array('id'=>$value['id']))?>"><?php echo $value->language->name;?></a></td>
                                                    <td><?php echo number_format($value['gia_ban']);?></td>
                                                    <td align="center">
                                                    	<select url="<?php echo CController::CreateUrl('production/updateStatus')?>" class="form-control sl_change" val="<?php echo $value['id'];?>">
                                                            <option <?php echo ($value['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
                                                            <option <?php echo ($value['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
                                                         </select>
                                                    </td>
                                                    <td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('production/del')?>" val="<?php echo $value['id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    	<a title="c?p nh?t" href="<?php echo CController::CreateUrl('production/formupdate',array('id'=>$value['id']))?>" data-toggle="modal" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></a>
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
           

