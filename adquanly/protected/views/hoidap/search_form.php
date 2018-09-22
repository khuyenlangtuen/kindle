<div>
	<form action="<?php echo CController::CreateUrl('hoidap/index');?>" method="post">
		<span>Câu hỏi: </span>
		<span><input value="<?php echo (isset($filter['short_description'])) ? $filter['short_description'] : '';?>" name="filter[short_description]"/></span>
		<span>Câu trả lời: </span>
		<span><input value="<?php echo (isset($filter['description'])) ? $filter['description'] : '';?>" name="filter[description]"/></span>
		<span><input type="submit" value="Tìm kiếm" /></span>
	</form>
</div>