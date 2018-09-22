<form action="<?php echo $url;?>" method="post">
	<div class="form-group">
    <?php
    if(!empty($info))
    {
        ?>
        <input name="item[id]" type="hidden" value="<?php echo $info['id'];?>" />
        <?php
    }
    ?>
		 <label><?php echo t('Group_name');?></label>
		<input value="<?php echo isset($info['group_name']) ? $info['group_name'] : ''?>" name="item[group_name]" class="form-control" placeholder="...">
	</div>
    <div class="form-group">
		 <label><?php echo t('Status');?></label>
		 <select name="item[status]" class="form-control">
            <option <?php echo (isset($info['status']) && $info['status']==1) ? 'selected' : ''?> value="1"><?php echo t('On');?></option>
            <option <?php echo (isset($info['status']) && $info['status']==0) ? 'selected' : ''?> value="0"><?php echo t('Off');?></option>
         </select>
	</div>
	<button style="float: right" type="submit" class="btn btn-primary"><?php echo t('Save');?></button>
</form> 