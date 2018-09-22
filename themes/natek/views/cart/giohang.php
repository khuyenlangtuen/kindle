<h1 class="main-title clearfix">Giỏ hàng</h1>
			<div class="outer-list">
				<ul class="list-title row">
					<li class="col-sm-5">TÊN SẢN PHẨM</li>
					<li class="col-sm-2">Giá</li>
					<li class="col-sm-1">Số lượng</li>
					<li class="col-sm-3">Tổng cộng</li>
					<li class="col-sm-1">Xóa</li>
				</ul>
			</div>
			<?php
				
				if(!empty($shop_cart))
				{
					$gio=$shop_cart['giohang'];
					if(!empty($gio))
					{
						foreach($gio as $key=>$item)
						{
							$type_gia=($item['price_type']=="B") ? "Giá mua" : (($item['price_type']=="R") ? "Giá thuê" : "Giá trọn gói");
							$info_pro=DModels::get_product_by_id($item['product_id'],$_SESSION['language']);
							$pair=(object)array('thumb_image'=>$info_pro['thumb_image'],'image_x'=>$info_pro['image_x'],'image_y'=>$info_pro['image_y'],'id'=>$info_pro['i_id']);
							?>
								<div class="outer-list rowcart" id="row-cart<?php echo $item['product_id'];?>">
									<ul class="list-items row">
										<li class="col-sm-5">
											<a class="thumbs" href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['product_id'],'title'=>$info_pro['seo_name'])) ?>">
												<?php 
												
													 $this->renderPartial('//blocks/image_new', array(
																			'pair' => $pair,
																			'width'=>'137',
																			'height'=>'137',
																			'alt'=>$info_pro['name'],
																			'class'=>'lazy',
																		)); 
											   ?>
											</a>
											<h4><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$item['product_id'],'title'=>$info_pro['seo_name'])) ?>"><?php echo $item["product"];?></a></h4>
											<p><strong>Chọn mua</strong>: <?php echo $type_gia;?></p>
										</li>
										<li class="col-sm-2"><?php echo number_format($item['price']);?> ₫</li>
										<li class="col-sm-1"><span><?php echo number_format($item['amount']);?></span></li>
										<li class="price-total col-sm-3"><?php echo number_format($item['sub_total']);?> ₫ <?php echo (isset($item['giam_gia_sanpham']) && $item['giam_gia_sanpham']) ? "(-".number_format($item['giam_gia_sanpham'])." ₫)":""?></li>
										<li class="col-sm-1"><a class="btn-delete" href="javascript:del_sp(<?php echo $item['product_id'];?>,'<?php echo $item['price_type'];?>');"><i class="fa fa-times"></i></a></li>
									</ul>
								</div>
							<?php
						}
						
					}
					?>
					<p class="outer-btn-1">
				<button type="button" class="btn btn-success" onclick="del_all();">Xóa giỏ hàng</button>
						<!--button type="button" class="btn btn-warning">Cập nhật giỏ hàng</button-->
					</p>
				<div class="row">
					<div class="left-count col-sm-4">
							<div class="form-group">
								<span style="color:red" id="id_errors_code"></span>
							</div>
							<div class="form-group">
								<label><?php echo (isset($shop_cart['code_order']) && $shop_cart['code_order']) ? "Bạn đã nhập mã Coupon":"Nhập mã coupon của bạn";?></label>
								<input type="hidden" value="code" id="promotion_type">
								<input type="hidden" value="2" id="only_apply">
								<input class="form-control" <?php echo (isset($shop_cart['code_order']) && $shop_cart['code_order']) ? "disabled":"";?> type="text" name="" value="<?php echo isset($shop_cart['code_order']) ? $shop_cart['code_order']:"";?>" id="id_coupon_value">
							</div>
							<div class="form-group">
								<?php
									
									if(empty($shop_cart['code_order']))
									{
										?>
										<button type="button" id="apply_coupon" class="btn btn-default">Áp dụng mã giảm</button>
										<?php
									}
								?>
								
							</div>
							
						
						<button type="button" class="btn btn-info btn-style" onclick="javascript:location.href='<?php echo bu("/");?>'">Tiếp tục mua hàng</button>
					</div>
					<div class="right-count col-sm-5 col-sm-offset-3">
						<p><label>Tạm tính</label><span id="id_tam_tinh"><?php echo (isset($shop_cart['tam_tinh'])) ? number_format($shop_cart['tam_tinh']) : 0;?> ₫</span></p>
						<p class="total-count"><label>TỔNG CỘNG <label><span id="id_total"><?php echo (isset($shop_cart['total'])) ? number_format($shop_cart['total']) : 0;?> ₫ <?php echo (isset($shop_cart['giam_gia_don_hang']) && $shop_cart['giam_gia_don_hang']) ? "(-".number_format($shop_cart['giam_gia_don_hang'])." ₫)":"";?></span></p>
						<p><a href="#" title="">Thanh toán với nhiều địa chỉ</a><button type="button" class="btn btn-danger btn-style" onclick="javascript:location.href='<?php echo $this->createUrl('/cart/dathang')?>'">Tiến hành thanh toán</button></p>
					</div>
				</div>
					<?php
				}
			?>
			
			
				