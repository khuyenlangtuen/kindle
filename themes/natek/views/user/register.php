
<section class="products">
	<div id="products-page" class="container" style="margin-bottom:15px">
		<div class="row"> 
			<div id="form-register">
				<span class="title-lienhe"><?php echo t('register');?></span>
				<div style="color:red" id="errors"></div>
				<div style="color:blue"><?php echo (isset($mes)) ? $mes:'';?></div>
				<input id="val_cap" type="hidden" value="<?php echo Yii::app()->user->getState('val_cap');?>">
				<input id="validate_username" type="hidden" value="0">
				
				<form action="<?php echo $this->createUrl('/user/register')?>" method="post" id="cartform" name="cartform">
					<input type="hidden" name="sid" id="sid" value="">
					<table>
						<tbody>
							<tr>
								<th style="width:150px;"><?php echo DModels::get_general('username',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="text" name="item[username]" id="username" size="40" maxlength="255" value="" class="string_active"></td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('password',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="password" name="item[password]" id="password" size="35" maxlength="255" value="" class="string_active"></td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('repeat_password',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="password" name="password2" id="password2" size="35" maxlength="255" value="" class="string_active"></td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('fullname',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="text" name="item[fullname]" id="fullname" size="35" style="width:300px" maxlength="255" value="" class="string_active"></td>
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
											?>
											<option value="<?php echo $item['provinceid']?>"><?php echo $item['name']?></option>
											<?php
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
										<option value="0"><?php echo t('choose district');?></option>
									</select>
								</td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('ward',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td>
									<select class="select" id="ward" name="item[ward]" style="width:310px;">
										<option value="0"><?php echo DModels::get_general('choose_ward',$_SESSION['language'],true);?></option>
									</select>
								</td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('address',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="text" name="item[address]" id="address" size="35" style="width:300px" maxlength="255" value="" class="string_active"></td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('phone',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="phone" name="item[phone]" id="phone" size="35" style="width:300px" maxlength="255" value="" class="string_active"></td>
							</tr>
							<tr>
								<th><?php echo DModels::get_general('email',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td><input type="text" name="item[email]" id="email" size="35" style="width:300px" maxlength="255" value="" class="string_active"></td>
							</tr>
							<tr>
								<th width="87"><?php echo DModels::get_general('captcha',$_SESSION['language'],true);?> <font color="#ff0000">*</font></th>
								<td colspan="3">
									<div>
										<span id="cap_tc" onclick="reload_cap('#cap_tc')"><img src="<?php echo Yii::app()->request->baseUrl; ?>/cap/captcha.png?v<?php echo rand(5000,9000)?>" /></span>
									</div>
									<div>
										<p style="margin-top:5px"><input type="text" name="captcha" id="captcha" class="string_active"></p>
									</div>
								</td>
							</tr>
							<tr>
								<th></th>
								<td><input type="submit" onclick="return check_form();" name="submit" value="<?php echo DModels::get_general('register',$_SESSION['language'],true);?>"></td>
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
    </div>
</div>
       
</section>
<script>
function reload_cap(id)
{
	$.ajax({
		url: '<?php echo CController::CreateUrl('cart/recatpcha')?>',
		type: 'post',
		data: {},
		success: function (data) {
				$(id).html("<img src='"+data+"' />");
			},
		error: function () {}
	});
}
function reset()
{
	$('#fullname').val('');
	$('#company').val('');
	$('#email').val('');
	$('#phone').val('');
	$('#captcha').val('');
	$('#address').val('');
	$('#message').val('');
	return false;
	
}

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