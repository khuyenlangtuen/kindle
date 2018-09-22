<h1 class="main-title clearfix"> Đặt may theo mẫu hiện tại <a style="margin-top: 8px;" href="#" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#myModal-hdmay"><i class="fa fa-scissors"></i> Hướng dẫn đặt may </a></h1>
			<p><strong>* Hình ảnh của mẫu sản phẩm đã chọn </strong></p>
			<p class="outer-img text-center ex-zoo">
				<?php
					$pair=(object)array('thumb_image'=>$thumb,'image_x'=>"",'image_y'=>"",'id'=>"id_mauhientai");
					$this->renderPartial('//blocks/image_new', array('pair' => $pair,'have_src'=>true, 'object_type' => "product", 'no_link' => true, 'width' => 389, 'height' => 502,'class'=>"img-thumbnail"));
				?>
			</p>
			<p><strong>* Điền vào thông số chi tiết </strong> <i>( Đơn vị cm)</i><p>
			<form>
				<div class="row">
					<div class="left-count col-sm-4">
						<div class="form-group">
							<label>Chiều dài áo *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Tay áo *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Vòng nách *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Vòng bắp tay *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
					</div>
					<div class="left-count col-sm-4">
						<div class="form-group">
							<label>Khuỷu tay *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Vòng ngực *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Hạ ngực *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Ngang ngực *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
					</div>
					<div class="left-count col-sm-4">
						<div class="form-group">
							<label>Vòng eo *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Hạ eo sau *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Hạ eo trước *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
						<div class="form-group">
							<label>Vòng cổ *</label>
							<input type="text" class="form-control" name="" id="" placeholder="">
						</div>
					</div>	
				</div>
				<p class="text-danger">* Phải nhập thông tin</p>				
				<button type="refresh" class="btn btn-default"><i class="fa fa-refresh"></i> Xóa</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-check"></i> Đặt may</button>
			</form>
<!-- Modal -->
	<div class="modal fade" id="myModal-hdmay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Hướng dẫn đặt may</h4>
		  </div>
		  <div class="modal-body">
			<h1>title h1</h1>
			<h2>title h2</h2>
			<h3>title h3</h3>
			<h4>title h4</h4>
			<p>Lorem ipsum dolor sit amet, justo sit, id arcu leo in nunc aptent. Blandit ligula urna aliquam id, massa congue, mattis mauris vehicula tortor, aenean lacus, accumsan egestas integer tortor at pede felis. Elit leo labore. Id suspendisse. Turpis a id ante aenean ipsum ut, senectus donec nibh congue adipiscing leo. Eget mauris tristique egestas, lorem adipiscing aliquam lacinia ante a.
Vivamus luctus eros. Parturient feugiat pede dolor, ac ornare ante, mauris et metus viverra metus. Vivamus commodo sit sapien tincidunt, nec et habitant ut facilisi, lacus mi pede neque maecenas egestas, tellus tempor urna nam leo et adipiscing, facilisis pellentesque ridiculus quis. Libero dapibus nibh phasellus convallis porta. Est consequat amet aperiam justo justo quam, curabitur justo eu at. Fusce ligula odio fringilla curabitur porttitor non, duis mauris quam mollis metus mi. Quis metus morbi. Felis justo turpis nec at ducimus, pretium nec placerat inceptos convallis, porttitor augue, tincidunt est a leo dolor ultrices arcu. Pellentesque eu, nulla ut tellus vitae, aliquet quisque, et non ac imperdiet non, pellentesque donec scelerisque nulla aliquam.</p>
		  </div>
		</div>
	  </div>
	</div>