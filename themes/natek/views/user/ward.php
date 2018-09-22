<option value="0"><?php echo t('choose ward');?></option>
<?php
if(!empty($list))
{
	foreach($list as $item)
	{
		?>
		<option value="<?php echo $item['wardid']?>"><?php echo $item['name']?></option>
		<?php
	}
	
}
?>