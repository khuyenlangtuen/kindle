<div  class="modal fade" id="<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                               
	<div class="modal-dialog">
		
		<div class="modal-content" style="width: 800px;">
			<div class="modal-header">
				<input type="hidden" value="" id="id_sp" name="id_sp" />
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $title;?></h4>
			</div>
			<div class="modal-body">
					<?php echo $content_dialog;?>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
		
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>