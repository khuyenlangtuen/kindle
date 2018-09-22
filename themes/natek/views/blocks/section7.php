<section id="section7" class="center_section">
        	<div class="layer main_bg"></div>
        	<div class="container clear">
                <div class="left fl white" data-scrollreveal="enter right after 0.15s over 1s">
                  <div class="content_wrap" >
	              <form action="<?php echo $this->createUrl('/cart/adddathang')?>" id="id_dathang" method="post">	
                	<h3 class="big_title">ĐẶT HÀNG</h3>
                    <h4 class="title">NHẬN NGAY TINH HOA GÓC NHÌN ALAN</h4>
                    <p>Quyển sách cuối cùng, đồ sộ và đầy đủ nhất về cuộc đời và góc nhìn của tiến sĩ Alan Phan sẽ đến tay bạn chỉ sau vài thao tác nữa.
</p>
					<h4 class="title">THÔNG TIN NGƯỜI MUA</h4>
                    <div class="buyer_info">
                        <dl>
                            <dt>Họ tên</dt>
                            <dd><input type="text" name="item[full_name]" id="full_name" /></dd>
                        </dl>
                        <dl>
                            <dt>Email</dt>
                            <dd><input type="email" name="item[email]" id="email" /></dd>
                        </dl>
                        <dl>
                            <dt>Điện thoại</dt>
                            <dd><input type="text" onkeypress="validate_amount(event)" name="item[phone]" id="phone" /></dd>
                        </dl>
                        <dl>
                            <dt>Địa chỉ</dt>
                            <dd><input type="text" name="item[address]" id="address" /></dd>
                        </dl>
                        
                    </div>
                    <p class="s_text">+ Hiện HappyLive hỗ trợ đặt hàng trước cho bạn đọc tại TP.HCM và Hà Nội. Các bạn đọc đặt hàng tại khu vực khác, HappyLive sẽ chuyển thông tin sang Tiki, đối tác phân phối trực tuyến để chuyển đến tận tay các bạn. 
</p>
					<h4 class="title">THÔNG TIN ĐƠN HÀNG</h4>
                    <div class="ordering_info">
                    
                    	<dl>
                            <dt>Địa chỉ nhận hàng</dt>
                            <dd>
                            	<input type="text" name="item[delivery_address]" id="delivery_address" />
                            </dd>
                        </dl>
                        
                        <dl>
                            <dt>Số lượng sách đặt hàng</dt>
                            <dd>
                            	<input type="text" onkeypress="validate_amount(event)" name="item[delivery_quantity]" id="delivery_quantity" />
                            </dd>
                        </dl>
                        
                    </div>
                    <p class="s_text">Với mỗi quyển sách đặt hàng trực tiếp, gia đình tiến sĩ Alan Phan sẽ gửi tặng một quyển sách<a href="#section6"> Bí mật của Phan Thiên Ân</a></p>				<h4 class="title">PHƯƠNG THỨC THANH TOÁN</h4>
                    <div class="payment_method">	
                        <p>
                            <label> <input val="1" checked="" class="cash" type="radio" name="cash" />
                            Thanh toán tiền mặt khi nhận hàng</label>
                        </p>
                        <p>
                            <label> <input val="2" class="cash" type="radio" name="cash" />
                            Thẻ ATM đăng ký Internet Banking (Miễn phí thanh toán)</label>
                        </p>
                        <p>
                            <label> <input val="3" class="cash" type="radio" name="cash" />
                            Thanh toán bằng thẻ quốc tế Visa, MasterCard, JCB</label>
                        </p>
                        <input type="hidden" value="1" id="id_cash" name="item[pay_method]" />
                        <dl>
                            <dt>Ghi chú khi giao hàng</dt>
                            <dd>
                            	<textarea name="item[delivery_note]"></textarea>
                            </dd>
                        </dl>
                        <p>Để đặt hàng số lượng lớn, xuất hóa đơn đỏ hay cần các hỗ trợ khác, xin vui lòng liên hệ hotline [+84 93 2623023] (gặp Chí Dũng) hay email dung.ngo@happy.live.
</p>
						<p>Chân thành cám ơn sự quan tâm của các bạn.</p>
                        <p class="order"><input onclick="return check_form('#id_dathang');" type="submit" class="order_btn" value="Đặt mua" /></p>
                    </div>
	              </form>
                  </div><!--content_wrap-->  
                </div><!--left-->
                <div class="right fr" data-scrollreveal="enter left after 0.15s over 1s">
                	<div class="google_maps clear">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4484184501025!2d106.68263727775238!3d10.776926842712234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f24e8c26a87%3A0x7c8b04f238472758!2zNzYgQ8OhY2ggTeG6oW5nIFRow6FuZyBUw6FtLCBwaMaw4budbmcgNiwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1460284469502" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                </div>
           	</div><!--container-->
            
        </section>