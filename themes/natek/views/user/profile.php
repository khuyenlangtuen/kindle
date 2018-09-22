<style type="text/css">
.tabs-menu2 {
    height: 30px;
    //float: left;
    clear: both;
}

.tabs-menu2 li {
    height: 30px;
    line-height: 30px;
    float: left;
    margin-right: 10px;
    background-color: #ccc;
    border-top: 1px solid #d4d4d1;
    border-right: 1px solid #d4d4d1;
    border-left: 1px solid #d4d4d1;
}

.tabs-menu2 li.current {
    position: relative;
    background-color: #fff;
    border-bottom: 1px solid #fff;
    z-index: 5;
}

.tabs-menu2 li a {
    padding: 10px;
    text-transform: uppercase;
    color: #fff;
    text-decoration: none; 
}

.tabs-menu2 .current a {
    color: #2e7da3;
}

.tab {
    border: 1px solid #d4d4d1;
    background-color: #fff;
    //float: left;
    margin-bottom: 20px;
    width: auto;
}

.tab-content2 {
    width: 660px;
    padding: 20px;
    display: none;
}

#tab-1 {
 display: block;   
}
</style>
<section class="products">
	<div id="products-page" class="container" style="margin-bottom:15px">
		<div class="row"> 
			<div id="tabs-container">
			    <ul class="tabs-menu2">
			        <li class="current"><a href="#tab-1"><?php echo DModels::get_general('change_password',$_SESSION['language'],true);?></a></li>
			        <li><a href="#tab-2"><?php echo DModels::get_general('list_order',$_SESSION['language'],true);?></a></li>
			        <li><a href="#tab-3"><?php echo DModels::get_general('update_profile',$_SESSION['language'],true);?></a></li>
			        
			    </ul>
			    <div class="tab">
			        <div id="tab-1" class="tab-content2">
			        	<form action="<?php echo $this->createUrl('/user/changepass')?>" method="post" id="changepassform" name="changepassform">
							<div id="errors_changepass"></div>
							<div class="row-form">
								<span style="padding:0 21px"><?php echo DModels::get_general('old_password',$_SESSION['language'],true);?> <font color="#ff0000">*</font></span>
								<span><input type="password" name="item[old_pass]" id="old_pass" size="40" maxlength="255" value="" class="string_active"></span>
									
							</div>
							<div class="row-form">
								<span style="padding:0 18px"><?php echo DModels::get_general('new_password',$_SESSION['language'],true);?> <font color="#ff0000">*</font></span>
								<span><input type="password" name="item[new_pass]" id="new_pass" size="40" maxlength="255" value="" class="string_active"></span>
									
							</div>
							<div class="row-form">
								<span style="padding:0 10px"><?php echo DModels::get_general('repeat_password',$_SESSION['language'],true);?> <font color="#ff0000">*</font></span>
								<span><input type="password" name="item[confirm_pass]" id="cofirm_pass" size="40" maxlength="255" value="" class="string_active"></span>
									
							</div>
							<div class="row-form" style="margin-left:200px" ><span`><input type="submit" onclick="return change_pass();" name="submit" value="<?php echo DModels::get_general('submit',$_SESSION['language'],true);?>"></span></div>					
											
						</from>

			        </div>
			        <div id="tab-2" class="tab-content2">
			            <form></form>
			        	<table id="dataTables-example" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="padding:5px;text-align:center"><?php echo DModels::get_general('order_code',$_SESSION['language'],true);?></th>
											<th style="padding:5px;text-align:center"><?php echo DModels::get_general('buy_date',$_SESSION['language'],true);?></th>
                                            <th style="padding:5px;text-align:center"><?php echo DModels::get_general('method_order',$_SESSION['language'],true);?></th>
                                            <th style="padding:5px;text-align:center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        if($list_order)
                                        {
                                            foreach( $list_order as $key=>$value)
                                            {
                                            	$list_sp=json_decode($value['order_info']);
                                            	$c='background-color:#fff';
                                            	if($key%2==0)
                        							$c='background-color:rgba(204, 204, 204, 0.1)';
                                            	?>
                                            	<tr style="<?php echo $c;?>">
                                                    <td style="padding:5px"><?php echo $value['id'];?></td>
                                                    <td style="padding:5px"><?php echo date("d-m-Y h:i:s",strtotime($value['created_at']));?></td>
													<td style="padding:5px">
                                                        <?php 
                                                        if($value['status']==1) echo DModels::get_general('order_buy',$_SESSION['language'],true);
                                                        else echo DModels::get_general('notice_price',$_SESSION['language'],true);
                                                        

                                                        ?></td>
                                                    <td class="center" style="padding:5px">
                                                    	<a style="text-decoration: none;" href="javascript:" onclick='$("#id_order_detail_<?php echo $value['id'];?>").slideToggle();'><strong>+</strong></a>
                                                    </td>
                                                </tr>
                                                <tr style="display:none" id="id_order_detail_<?php echo $value['id'];?>">
                                                	<td colspan="5">
                                                		<table style="width:80%;margin:5px 10px 5px 10px">
															<tbody>
																<?php
																if($list_sp)
																{
																	if(isset($list_sp->giohang))
																	{
																		foreach( $list_sp->giohang as $key=>$value)
																		{
																			
																				$info_pro=DModels::get_product_by_id($value->product_id,$_SESSION['language']);
																				
																				?>
																				<tr>
																					<td>
																						<?php
															$pair=(object)array('thumb_image'=>$info_pro['thumb_image'],'image_x'=>$info_pro['image_x'],'image_y'=>$info_pro['image_y'],'id'=>$info_pro['i_id']);
													 $this->renderPartial('//blocks/image', array(
																			'pair' => $pair,
																			'width'=>'100',
																			'height'=>'100',
																			'alt'=>$info_pro['name'],
																		)); 
																						?>
																					</td>
																					<td><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$value->product_id,'title'=>$info_pro['seo_name'])) ?>"><?php echo $info_pro['name'];?></a></td>
																					<td><?php echo $value->amount;?></td>
																					<td><?php echo number_format($value->price)."<sup>đ</sup>";?></td>
																					
																				</tr>
																				<?php
																			
																			
																		}
																	}
																	if(isset($list_sp->baogia))
																	{
																		foreach( $list_sp->baogia as $key=>$value)
																		{
																			
																				$info_pro=DModels::get_product_by_id($value->product_id,$_SESSION['language']);
																				
																				?>
																				<tr>
																					<td>
																						<?php
															$pair=(object)array('thumb_image'=>$info_pro['thumb_image'],'image_x'=>$info_pro['image_x'],'image_y'=>$info_pro['image_y'],'id'=>$info_pro['i_id']);
													 $this->renderPartial('//blocks/image', array(
																			'pair' => $pair,
																			'width'=>'100',
																			'height'=>'100',
																			'alt'=>$info_pro['name'],
																		)); 
																						?>
																					</td>
																					<td><a href="<?php echo $this->createUrl('/product/detail',array('id'=>$value->product_id,'title'=>$info_pro['seo_name'])) ?>"><?php echo $info_pro['name'];?></a></td>
																					<td><?php echo 1;?></td>
																					<td><?php echo "0<sup>đ</sup>";?></td>
																					
																				</tr>
																				<?php
																			
																			
																		}
																	}
																	if(isset($list_sp->total))
																	{
																		?>
																		<tr>
																			<td colspan="3"><?php echo DModels::get_general('Total',$_SESSION['language'],true);?></td>
																			<td><?php echo number_format($list_sp->total)."<sup>đ</sup>"?></td>
																		</tr>
																		<?php
																	}
																}
																?>
															</tbody>
														</table>
                                                	</td> 
                                                </tr>
                                            	<?php
                                            }
                        				}
                        				?>
                                    </tbody>
                                </table>
			        </div>
			        <div id="tab-3" class="tab-content2">
			            <form action="<?php echo $this->createUrl('/user/updateprofile')?>" method="post" id="updateprofile" name="updateprofile">
							<div id="errors_updateprofile"></div>
						<table>
							<tbody>
								<tr>
									<th style="width:150px;"><?php echo DModels::get_general('username',$_SESSION['language'],true);?></th>
									<td><?php echo $data->username;?></td>
								</tr>
								<tr>
									<th><?php echo DModels::get_general('email',$_SESSION['language'],true);?></th>
									<td><?php echo $data->email;?></td>
								</tr>
								
								<tr>
									<th><?php echo DModels::get_general('fullname',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
									<td><input type="text" name="item[fullname]" id="fullname" size="35" style="width:300px" maxlength="255" value="<?php echo $data->fullname;?>" class="string_active"></td>
								</tr>
								<tr>
									<th><?php echo DModels::get_general('province/city',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
									<td>
										<select class="select" id="city" name="item[city]" onchange="javascript:refreshDistrict(this.value);" style="width:310px;">
										<option value="0"><?php echo DModels::get_general('choose_province/city',$_SESSION['language'],true);?></option>
										<?php
										$province=DModels::get_list_province();
										if(!empty($province))
										{
											foreach($province as $item)
											{
												if($data->city==$item['provinceid'])
												{
													?>
													<option selected value="<?php echo $item['provinceid']?>"><?php echo $item['name']?></option>
													<?php
												}
												else{
													?>
													<option value="<?php echo $item['provinceid']?>"><?php echo $item['name']?></option>
													<?php
												}
												
											}
											
										}
										?>
											
										</select>
									</td>
								</tr>
								<tr>
									<th><?php echo DModels::get_general('district',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
									<td>
										<select class="select" id="district" name="item[district]" onchange="javascript:refreshWard(this.value);" style="width:310px;">
											<?php
											if(!empty($data->city))
											{
												$district=DModels::get_list_district_by_id($data->city);
												{
													foreach($district as $item)
													{
														if($data->district==$item['districtid'])
														{
															?>
															<option selected value="<?php echo $item['districtid']?>"><?php echo $item['name']?></option>
															<?php
														}
														else{
															?>
															<option value="<?php echo $item['districtid']?>"><?php echo $item['name']?></option>
															<?php
														}
													}
												}
											}
											else{
												?>
												<option value="0"><?php echo t('choose district');?></option>
												<?php
											}
											?>
											
										</select>
									</td>
								</tr>
								<tr>
									<th><?php echo DModels::get_general('ward',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
									<td>
										<select class="select" id="ward" name="item[ward]" style="width:310px;">
											<?php
											if(!empty($data->district))
											{
												$ward=DModels::get_list_ward_by_districtid($data->district);
												{
													foreach($ward as $item)
													{
														if($data->ward==$item['wardid'])
														{
															?>
															<option selected value="<?php echo $item['wardid']?>"><?php echo $item['name']?></option>
															<?php
														}
														else{
															?>
															<option value="<?php echo $item['wardid']?>"><?php echo $item['name']?></option>
															<?php
														}
													}
												}
											}
											else{
												?>
												<option value="0"><?php echo DModels::get_general('choose_ward',$_SESSION['language'],true);?></option>
												<?php
											}
											?>
											
										</select>
									</td>
								</tr>
								<tr>
									<th><?php echo DModels::get_general('address',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
									<td><input type="text" name="item[address]" id="address" size="35" style="width:300px" maxlength="255" value="<?php echo $data->address;?>" class="string_active"></td>
								</tr>
								<tr>
									<th><?php echo DModels::get_general('phone',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
									<td><input type="phone" name="item[phone]" id="phone" size="35" style="width:300px" maxlength="255" value="<?php echo $data->phone;?>" class="string_active"></td>
								</tr>
								
								<tr>
									<th></th>
									<td><input type="submit" onclick="return check_form_profile();" name="submit" value="<?php echo DModels::get_general('update_profile',$_SESSION['language'],true);?>"></td>
								</tr>
								<tr>
									<th></th>
									<td></td>
								</tr>
							</tbody>
						</table>
					</form>
			        </div>
			    </div>
			    <div style="clear:both"></div>
			</div>
		</div>
    </div>
</div>
</section>
<script type="text/javascript">
function refreshDistrict(id)
{
	$.ajax({
		url: "<?php echo CController::CreateUrl('user/getDistrict')?>",
		type: 'post',
		data: {id:id},
		success: function (data) {
				$("#district").html(data);
			},
		error: function () {}
	});
}
function refreshWard(id)
{
	$.ajax({
		url: "<?php echo CController::CreateUrl('user/getWard')?>",
		type: 'post',
		data: {id:id},
		success: function (data) {
				$("#ward").html(data);
			},
		error: function () {}
	});
}
</script>

