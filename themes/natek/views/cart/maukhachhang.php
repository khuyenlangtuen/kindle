<h1 class="main-title clearfix"> Đặt may theo mẫu khách hàng <a style="margin-top: 8px;" href="#" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#myModal-hdmay"><i class="fa fa-scissors"></i> Hướng dẫn đặt may </a></h1>
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
				<div class="form-group">
					<div id="actions" class="row">
					  <div class="col-lg-7">
						<!-- The fileinput-button span is used to style the file input field as button -->
						<span class="btn btn-info fileinput-button">
							<i class="glyphicon glyphicon-plus"></i>
							<span>Chọn hình...</span>
						</span>
						
					  </div>

					  <div class="col-lg-5">
						<!-- The global file processing state -->
						<span class="fileupload-process">
						  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
							<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
						  </div>
						</span>
					  </div>

					</div>
					<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
					<div class="table table-striped" class="files" id="previews">
					  <div id="template" class="file-row">
						<!-- This is used as the file preview template -->
						<div>
							<span class="preview"><img data-dz-thumbnail style="width: auto" /></span>
						</div>
						
						<div>
							<p class="size" data-dz-size></p>
							<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
							  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
							</div>
						</div>
						<div class="box-caption">
							<textarea class="form-control" rows="4" placeholder=""></textarea>
					    </div>
						<div style="text-align: center;">
						  <button class="btn btn-primary start">
							  <i class="glyphicon glyphicon-upload"></i>
							  <span>Upload</span>
						  </button>
						  <button data-dz-remove class="btn btn-warning cancel">
							  <i class="glyphicon glyphicon-trash"></i>
							  <span>Xóa</span>
						  </button>
						  <button data-dz-remove class="btn btn-danger delete">
							<i class="glyphicon glyphicon-trash"></i>
							<span>Delete</span>
						  </button>
						</div>						
					  </div>					
					</div>				
				</div>
				<p class="text-danger">* Phải nhập thông tin</p>
				<div class="form-group">
					<button type="refresh" class="btn btn-default"><i class="fa fa-refresh"></i> Xóa</button>
					<button type="button" class="btn btn-danger"><i class="fa fa-check"></i> Đặt may</button>
					
				</div>
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
			<script>
		// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
		var previewNode = document.querySelector("#template");
		previewNode.id = "";
		var previewTemplate = previewNode.parentNode.innerHTML;
		previewNode.parentNode.removeChild(previewNode);

		var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
		  url: "/target-url", // Set the url
		  thumbnailWidth: 233,
		  thumbnailHeight: 233,
		  parallelUploads: 1,
		  previewTemplate: previewTemplate,
		  autoQueue: false, // Make sure the files aren't queued until manually added
		  previewsContainer: "#previews", // Define the container to display the previews
		  clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
		});

		myDropzone.on("addedfile", function(file) {
		  // Hookup the start button
		  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
		});

		// Update the total progress bar
		myDropzone.on("totaluploadprogress", function(progress) {
		  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
		});

		myDropzone.on("sending", function(file) {
		  // Show the total progress bar when upload starts
		  document.querySelector("#total-progress").style.opacity = "1";
		  // And disable the start button
		  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
		});

		// Hide the total progress bar when nothing's uploading anymore
		myDropzone.on("queuecomplete", function(progress) {
		  document.querySelector("#total-progress").style.opacity = "0";
		});

		// Setup the buttons for all transfers
		// The "add files" button doesn't need to be setup because the config
		// `clickable` has already been specified.
		document.querySelector("#actions .start").onclick = function() {
		  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
		}; 
		document.querySelector("#actions .cancel").onclick = function() {
		  myDropzone.removeAllFiles(true); 
		 
		};
	</script>