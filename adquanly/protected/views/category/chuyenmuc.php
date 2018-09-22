<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div style="margin-bottom: 20px;">
                            <?php
							   $this->renderPartial('//blocks/lang',array('url'=>$url,'lang'=>$lang));
							?>
                            </div>
                        	<div>&nbsp;<i class="fa fa-minus"></i>&nbsp;<span style="font-size: 20px;"><?php echo t('Chuyên mục') ?></span></div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            	 <div class="table-responsive" style="overflow: hidden;" id="cat_<?php echo getQuery('cid') ?>">
                                
                                        <?php
                                        if($model)
                                        {
                                            $c='odd';
                                            $show_head = isAjaxRequest() ? false : true;
                                            foreach( $model as $key=>$value)
                                            {
                                            	
                                            	if($key%2==0)
                        							$c='even';
                                            	$this->renderPartial('_row_cm', array(
                            						'value' => $value,
                            						'c' => $c,
                            						'show_head' => $show_head,
                            					));
                            
                            					$show_head = false;
                        						
                                            }
                        				} else {
                            				$this->renderPartial('_row_cm', array(
                            					'show_head' => true,
                            				));
                            			}
                        				?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

