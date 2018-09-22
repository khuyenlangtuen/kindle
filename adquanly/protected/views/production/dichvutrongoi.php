<div style="margin-top:20px">
	<?php 
		if(isset($info->id) && $info->id)
		{
			$list_option=DModels::get_list_options_by_productID($info->id);
			?>
			<div style="float:right"><a href="javascript:show_them_tuychon(<?php echo $info->id;?>);" class="btn btn-warning"><?php echo t("+ Thêm tùy chọn");?></a></div>
			<div style="clear:both"></div>
			<div style="margin-top:5px" >
				<?php
				if($list_option)
				{
					foreach ($list_option as $key => $value) {
						$list_pro=DModels::get_block_product('options','vn',$value['id']);
						?>
						<div class="panel panel-green">
		                    <div class="panel-heading">
		                        <div><?php echo $value['lang_code_name']?><span style="margin-left:20px;font-size: 20px;"><a style="color:#fff;" href="javascript:show_them_tuychon(<?php echo $info->id;?>,<?php echo $value['id']?>);"><i class="fa fa-pencil-square-o"></i></a></span></div>
		                    </div>
		                    <div class="panel-body">
		                    	<table class="table table-striped table-bordered table-hover" id="dataTables-example2">
			                        <tbody>
			                        <?php
			                        	foreach ($list_pro as $key => $item) {
			                        		$c='odd';
                                            	if($key%2==0)
                        							$c='even';
                                            	?>
                                            	<tr class="<?php echo $c;?> gradeA">
                                            		<td><?php echo $item['product_code']?></td>
                                            		<td><?php echo $item['name']?></td>
                                            		<td><?php echo $item['gia_ban']?></td>
                                            	</tr>
                                            	<?php
			                        	}
			                        ?>
			                    	</tbody>
			                    </table>
		                    </div>
		                </div>
						<?php
					}
				}
				?>

			</div>
			<?php
		}
    ?>
    
    
</div>
