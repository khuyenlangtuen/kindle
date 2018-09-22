<option value="0"><?php echo t('choose district');?></option>
<?php
if(!empty($list))
{
	foreach($list as $item)
	{
		$name=$item['name'];
		if($item['provinceid']=='79')
		{
			$name=t('Quận').' '.$item['name'];
		}
		?>
		<option value="<?php echo $item['districtid']?>"><?php echo $name?></option>
		<?php
	}
	
}
?>