<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							    $a=0;// $this->renderPartial('//blocks/lang',array('url'=>CController::CreateUrl('production/'.$data['block_type']),'lang'=>$lang));
							?>
                            </div>
                        	<div><a href="#modal_add_product" data-toggle="modal"  class="btn btn-default"><?php echo t('add_product') ?></a></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body" id="list_product">
                            	 <div class="table-responsive" style="overflow: hidden;">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo t('id') ?></th>
                                            <th><?php echo t('product_code') ?></th>
                                            <th><?php echo t('Product') ?></th>
                                            <th><?php echo t('price') ?></th>
                                            <th><?php echo t('list price') ?></th>
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
                                                    <td><a href="<?php echo CController::CreateUrl('production/formupdate',array('id'=>$value['id']))?>"><?php echo $value['name'];?></a></td>
                                                    <td><?php echo number_format($value['gia_ban']);?></td>
                                                    <td><?php echo number_format($value['gia_goc']);?></td>
                                                    <td class="center">
                                                    	<a title="xóa" url="<?php echo CController::CreateUrl('production/delpicker')?>" val="<?php echo $value['b_id'];?>" class="btn btn-warning btn-circle del_demuc"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            	<?php
                        						
                                            }
                        				}
                        				?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
<?php 
// them moi
$content_dialog=$this->renderPartial('//production/ajax/product_picker',array('data'=>$data),true);
$this->renderPartial('//blocks/dialog',array("title"=>t('add_product'),"content_dialog"=>$content_dialog,'id'=>'modal_add_product'));

?>
