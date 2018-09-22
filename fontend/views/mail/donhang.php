<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--link href="http://komo.vn/themes/v2014_ken/css/common.css" rel="stylesheet" type="text/css" /-->
<title>Untitled Document</title>
<style>
* {
	margin:0; padding:0; border:0; list-style:none;
	outline: 0; 	
}
a {
	text-decoration:none;
}

html{ 
	width:100%; 
	height:auto;
}

figure{
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

body {
	background:#FFF;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
}

.clear {
	clear:both; margin:0; padding:0;
}

legend,textarea{ margin:0; padding:0;}
fieldset,img { 
	border:0;
}
a:focus{outline:none;}
h1{}
h2{}
h3{}
h1,h2,h3{}
h1,h2,h3,h4,h5,h6,h7,strong{}
abbr,acronym{}
em{font-style:italic;}
blockquote,ul,ol,dl{}
ol,ul,dl{}
ul li{list-style:none;}
dl dd{}
th,td{}
th{}
caption{}
p,fieldset,table{}
dl{}
dd{}
a:link, a:visited{
	
}
a:hover{text-decoration:none;}
legend{}
option{}
input[type='text'],
input[type="password"]{
	
}

input[type='hidden']{display:none;}
button, input[type='button'], input[type='submit']{}
input[type='button'], input[type='submit'], input[type='checkbox'], input[type='image'], input[type='radio'], input[type='reset'], select, button{cursor:pointer;}
input[type='button'], input[type='submit'], input[type='text'], textarea{}
hr{}
q{}
blockquote{}
blockquote > *:first-child:first-letter{}
pre{}
.nobg{
	background:none !important;
}

input[type="submit"]::-moz-focus-inner, input[type="button"]::-moz-focus-inner
{   
	border : 0px;
}
</style>
</head>

<body>
	<!--begin header-->
        <div style="width:100%;	height:38px;background-color:#FFF;">
            <div style="width:600px;
						margin:0 auto;
						font-size:14px;
						color:#58B1C3;
						text-align:center;
						text-transform:uppercase;
						padding:12px;
						font-weight:bold;">
            	Xác nhẬn đơn hàng ebook 
            </div>
        </div>
    <!--end header-->
    <!--begin mainpage-->
        <div style="width:100%;
					background-color:#ececec;">
        	<div style="width:600px;
						margin:0 auto;
						padding-bottom:30px;"> 
            	<div style="width:588px;
							padding:6px;
							text-align:center;">
   	    	    	<img src="http://www.cokhiquocky.vn/themes/v1/images/logo-blue.png"/> 
                </div>  
                <div style="width:580px;
							margin:0 auto;
							border-radius:15px;
							-moz-border-radius:15px;
							background:#FFF;
							padding:10px;">
                	<div style="width:565px;
								font-size:13px; 
								text-align:left; 
								line-height:25px; 
								padding:15px 0 15px 15px; ">
                    	Thân gởi Quý khách hàng,<br />
						Cơ khí quốc kỳ xác nhận lại thông tin đơn hàng bạn đã thực hiện trên <a href="http://cokhiquocky.vn">cokhiquocky.vn</a> như sau:
                    </div>
                    <div style="width:580px;
								border:#ddd solid 1px;">
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td bgcolor="#58B1C3" style="padding:10px;
															padding-left:15px !important;
															text-transform:uppercase;
															font-weight:bold;
															color:#FFF;	">thông tin đơn hàng</td>
                          </tr>
                          <tr>
                            <td style="padding:15px 5px 10px 5px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:#ccc solid 1px; border-left:#ccc solid 1px;">
                                          <tr>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">STT</td>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">Hình ảnh</td>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">Tên</td>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">Số lượng</td>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">Giá bán (VNĐ)</td>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">Giảm giá</td>
                                            <td style=" border-bottom: #ccc solid 1px;
														  border-right: #ccc solid 1px;
														  font-weight: bold;
														  color: #000;
														  text-align: center;
														  padding: 5px;">Thành tiền</td>
                                           
                                          </tr>
										  <?php
											if($cart)
											{	
												$stt=0;
												foreach ($cart['giohang'] as $key=>$item)
												{
													$info_pro=DModels::get_product_by_id($item['product_id'],$_SESSION['language']);
													$stt++;
													?>
														<tr>
															<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;text-align:center;
																		color:#000;	"><?php echo $stt;?></td>
															<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;">
																		<?php 
												$pair=(object)array('thumb_image'=>$info_pro['thumb_image'],'image_x'=>$info_pro['image_x'],'image_y'=>$info_pro['image_y'],'id'=>$info_pro['i_id']);
												 $this->renderPartial('//blocks/image', array(
																		'pair' => $pair,
																		'width'=>'120',
																		'height'=>'150',
																		'alt'=>$info_pro['name'],
																	)); 
										   ?>
															</td>
															<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#444444;
																		padding-left:10px;
																		text-transform:capitalize;	"><?php echo shortenText($info_pro['name'], 50); ?></td>
														<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#444444;
																		padding-left:10px;
																		text-transform:capitalize;	"><?php echo $item['amount']; ?></td>
														
															<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#d31a64;
																		text-align:center;	"><?php echo number_format($info_pro['gia_goc']*$item['amount']); ?>đ</td>
															<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#d31a64;
																		text-align:center;	"><?php echo ceil((($info_pro['gia_goc']-$info_pro['gia_ban'])*100)/$info_pro['gia_goc']) . '%'; ?></td>
															<td style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#d31a64;
																		text-align:center;	"><?php echo number_format($item['sub_total']); ?>đ</td>
															
														  </tr>
													<?php
												}
												?>
											  <tr>
													<td colspan="5" style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#444444;
																		padding-left:300px !important;
																		padding:15px;	">Tổng tiền</td>
													<td colspan="2" style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#000;
																		text-align:right;
																		padding-right:20px !important;
																		padding:15px;
																		font-weight:bold;	"><?php echo number_format($cart['total']); ?>đ</td>
											  </tr>
											  <tr>
												<td colspan="5" style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#d31a64;
																		padding-left:300px !important;
																		padding:15px;
																		text-transform:uppercase;
																		font-weight:bold;">đã thanh toán</td>
												<td colspan="2" style="border-bottom:#ccc solid 1px;
																		border-right: #ccc solid 1px;
																		padding:5px;
																		vertical-align:middle;color:#d31a64;
																		text-align:right;
																		padding-right:20px !important;
																		padding:15px;
																		font-weight:bold;"><?php echo number_format($cart['total']); ?>đ</td>
											  </tr>
												
												<?php
											}
										  ?>
                                          
                                         
                                 </table>

                            </td>
                          </tr>
                        </table>
                    </div>
					
                    <div style="width:550px;
									font-size:13px; 
									text-align:left; 
									padding-top:15px;
									padding-left:15px;
									padding-right:15px;">
                    	
                        
                        <p style="width: 550px;
							  padding-bottom: 10px;
							  line-height: 24px;">Trong trường hợp bạn có những thắc mắc liên quan đến sản phẩm có thể tham khảo trong <a style="font-weight:bold;	
																																																color:#f8931e;
																																																text-decoration:underline;" href="http://www.cokhiquocky.vn/hoi-dap.html">Những câu hỏi thường gặp </a>hoặc gửi email về <a style="font-weight:bold;	
																																																																											color:#f8931e;
																																																																											text-decoration:underline;" href="mailto:hotro@cokhiquocky.vn">hotro@cokhiquocky.vn</a>, Cơ Khí Quốc Kỳ sẽ trả lời email của bạn trong vòng 24h của ngày làm việc tiếp theo.</p>
                        <p style="width: 550px;
							  padding-bottom: 10px;
							  line-height: 24px;">Xin chân thành cám ơn,</p>
                    </div>
                    <div style="width:550px;
										font-size:12px; 
										text-align:left; 
										padding:15px;
										border-top: #aaaaaa dotted 1px;">
                   	  <p style="padding-bottom:8px;	
							font-style:italic;
							line-height:20px;">Bạn nhận được email này vì đã mua sản phẩm tại cokhiquocky.vn</p>
                        <p style="padding-bottom:8px;	
							font-style:italic;
							line-height:20px;">Để chắc chắn luôn nhận được email thông báo, xác nhận đơn hàng từ Cơ Khí Quốc Kỳ, bạn vui lòng thêm địa chỉ <a style="font-weight:bold;	
																																								color:#f8931e;
																																								text-decoration:underline;" href="mailto:hotro@cokhiquocky.vn">hotro@cokhiquocky.vn</a> vào sổ địa chỉ (Address Book, Contacts) của hộp >
                        <h1 style="padding-top:10px;font-size:12px;
												font-weight:normal;
												line-height:15px;
												color:#444444;
												padding-bottom:8px;"><strong>Email này được gửi đi từ:</strong></h1>
                        <h1 style="font-size:12px;
												font-weight:normal;
												line-height:15px;
												color:#444444;
												padding-bottom:8px;"><strong>Công ty TNHH Thương mại Cơ Khí Quốc Kỳ</strong></h1>
                        <h1 style="font-size:12px;
												font-weight:normal;
												line-height:15px;
												color:#444444;
												padding-bottom:8px;"><strong>Địa chỉ:</strong> D9/12 Quốc Lộ 1A , Ấp 4, Xã Bình Chánh, Huyện Bình Chánh (Ngã tư quán chuối), TP. Hồ Chí Minh</h1>
                    </div>
                </div>             
          </div>
        </div>
    <!--end mainpage-->
</body>
</html>
