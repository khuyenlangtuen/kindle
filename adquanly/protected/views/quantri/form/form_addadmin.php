<form id="<?php echo $id_form;?>" action="<?php echo $url;?>" method="post">
	<div class="form-group">
    <?php
    if(!empty($info))
    {
        ?>
        <input name="item[id]" type="hidden" value="<?php echo $info['id'];?>" />
        <?php
    }
    ?>
		 <label><?php echo t('Admin_name');?></label>
		<input value="<?php echo isset($info['fullname']) ? $info['fullname'] : ''?>" name="item[fullname]" class="form-control" placeholder="...">
	   <label  class="error fullname"></label>
    </div>
    <div class="form-group">
		 <label><?php echo t('Email / User name');?></label>
         <input id="id_email_exist" type="hidden" value="0" />
		<input value="<?php echo isset($info['username']) ? $info['username'] : ''?>" name="item[username]" class="form-control" placeholder="...">
        <label class="error username"></label>
	</div>
    <div class="form-group">
		 <label><?php echo t('Password');?></label>
		<input value="<?php echo isset($info['password']) ? $info['password'] : ''?>" type="password"  name="item[password]" class="form-control" placeholder="...">
        <label class="error password"></label>
	</div>
    <div class="form-group">
		 <label><?php echo t('Phone');?></label>
		<input value="<?php echo isset($info['phone']) ? $info['phone'] : ''?>" name="item[phone]" class="form-control" placeholder="...">
	   <label class="error phone"></label>
    </div>
    <div class="form-group">
		 <label><?php echo t('Status');?></label>
		 <select name="item[status]" class="form-control">
            <option <?php echo (isset($info['status']) && $info['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
            <option <?php echo (isset($info['status']) && $info['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
         </select>
	</div>
	<button onclick="<?php echo $onclick;?>" style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
</form> 