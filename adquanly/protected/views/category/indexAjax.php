                      
<?php
if($model)
{
	$c='odd';
	$show_head = isAjaxRequest() ? false : true;
	foreach( $model as $key=>$value)
	{
		
		if($key%2==0)
			$c='even';
		$this->renderPartial('_row', array(
			'value' => $value,
			'c' => $c,
			'show_head' => $show_head,
		));

		$show_head = false;
		
	}
} else {
	$this->renderPartial('_row', array(
		'show_head' => true,
	));
}
?>
           

