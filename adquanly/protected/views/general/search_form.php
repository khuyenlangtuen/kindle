<div>
	<form action="<?php echo CController::CreateUrl('general/index');?>" method="post">
		<span>Tên: </span>
		<span><input value="<?php echo (isset($filter['name'])) ? $filter['name'] : '';?>" name="filter[name]"/></span>
		<span>Position: </span>
		<span><input value="<?php echo (isset($filter['position'])) ? $filter['position'] : '';?>" name="filter[position]"/></span>
		<span><input type="submit" value="Tìm kiếm" /></span>
	</form>
</div>