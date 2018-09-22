<h1 class="main-title clearfix">Đặt hàng </h1>
			<p style="overflow: hidden;">
				<button type="button" class="btn btn-primary pull-left" onclick="javascript:location.href='Dangnhap.html'">Đăng nhập</button> 
				<button type="button" class="btn btn-primary pull-right" onclick="javascript:location.href='<?php echo $this->createUrl('/cart/giohang')?>'"><i class="fa fa-shopping-cart"></i> <?php echo (isset($cart['total']) && $cart['total']) ? number_format($cart['total']):0?> ₫</button>
			</p>
			<div class="row">
				<form action="<?php echo $this->createUrl('/cart/Addgiohang')?>" method="post">
				<div class="left-count col-sm-5">
					<h3>Tên và địa chỉ</h3>
					
						<div class="form-group">
							<div class="row">
								<span class="col-sm-6">
									<input type="text" class="form-control" name="user[firtname]" id="fistname" placeholder="Nhập tên*">
								</span>	
								<span class="col-sm-6">
									<input type="text" class="form-control" name="user[lastname]" id="lastname" placeholder="Nhập họ*">
								</span>	
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<span class="col-sm-6">
									<input type="text" class="form-control" name="user[company]" id="company" placeholder="Đơn vị công tác">
								</span>	
								<span class="col-sm-6">
									<input type="text" class="form-control" name="user[email]" id="email" placeholder="Địa chỉ email *">
								</span>	
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="3" name="user[address]" id="address"  placeholder="Địa chỉ *"></textarea>
						</div>
						<div class="form-group">
							<div class="row">
								<span class="col-sm-6">
									
									<select class="form-control" id="city" name="user[city]" onchange="javascript:refreshDistrict(this.value);">
									<option value="0">-- Tỉnh/Thành phố * --</option>
									<?php
									$province=DModels::get_list_province();
									if(!empty($province))
									{
										foreach($province as $item)
										{
											?>
											<option value="<?php echo $item['provinceid']?>"><?php echo $item['name']?></option>
											<?php
										}
										
									}
									?>
										
									</select>
								</span>	
								<span class="col-sm-6">
									<select class="form-control" id="district" name="user[district]">
										<option value="0">--Quận/Huyện*--</option>
									</select>
								</span>	
								
							</div>
						</div>
						<!--div class="form-group">
							<div class="row">
								<span class="col-sm-6">
									<input type="text" class="form-control" name="" id="" placeholder="Mã quốc gia *">
								</span>	
								<span class="col-sm-6">
									<input type="text" class="form-control" name="" id="" placeholder="Quốc gia *">
								</span>	
							</div>
						</div-->
						<div class="form-group">
							<div class="row">
								<span class="col-sm-6">
									<input type="text" class="form-control" name="user[phone]" id="phone" placeholder="Điện thoại *">
								</span>	
								<span class="col-sm-6">
									<input type="text" class="form-control" name="user[fax]" id="fax" placeholder="Fax">
								</span>	
							</div>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox" checked> Giao hàng ở địa chỉ này
							</label>
						  </div>
						  <div class="checkbox">
							<label>
							  <input type="checkbox" > Tạo tài khoản để sử dụng sau
							</label>
						  </div>
					
				</div>
				<div class="mid-count col-sm-3">
					<h3>Phương thức vận chuyển</h3>
					<p>Phí vận chuyển cố định: <strong>Fixed <?php echo number_format(param("FEE_SHIPPING"))?> ₫</strong></p>
					
						<div class="form-group">
							<input class="form-control" type="text" <?php echo (isset($cart['code_shipping']) && $cart['code_shipping']) ? "disabled":"";?> id="id_coupon_value_s" value="<?php echo isset($cart['code_shipping']) ? $cart['code_shipping']:"";?>" placeholder="Nhập mã coupon của bạn">
							<input type="hidden" value="code" id="promotion_type_s">
							<input type="hidden" value="3" id="only_apply_s">
						</div>
						<div class="form-group">
							<?php
								if(isset($cart['code_shipping']))
								{
									if($cart['code_shipping']=="")
									{
										?>
										<button type="button" id="id_apply_shipping"  class="btn btn-default">Áp dụng mã giảm</button>
										<?php
									}
									
								}
								
							?>
							
						</div>
						<div class="form-group">
							<span style="color:red" id="id_errors_code"></span>
						</div>
				</div>
				<div class="right-count-1 col-sm-4">
					<h3>Phương thức thanh toán</h3>
					
					<p><button type="button" class="btn btn-success btn-2" id="id_cod">Giao hàng nhận tiền </button></p>
					<p><button type="button" class="btn btn-warning btn-2" id="id_atm">Thẻ tín dụng</button></p>
					<p class="total-count"><label>TỔNG CỘNG: </label><span id="id_total_have_fee"> <?php echo (isset($cart['total_have_fee']) && $cart['total_have_fee']) ? number_format($cart['total_have_fee']):0?> ₫ <?php echo (isset($cart['giam_gia_shipping']) && $cart['giam_gia_shipping']) ? "(-".number_format($cart['giam_gia_shipping'])." ₫)":"";?></span></p>
					<p>
						
							<input type="hidden" name="item[pay_method]" id="pay_method"/>
							<button id="id_thanhtoan_ngay" onclick="return check_form();" class="btn btn-danger btn-2">Đặt hàng ngay </button>
						
					</p>
				</div>
				</form>
			</div>	