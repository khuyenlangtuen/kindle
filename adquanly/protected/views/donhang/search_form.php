<div>
	<form action="<?php echo CController::CreateUrl('donhang/'.$type);?>" method="post">
		<span>Trạng thái: </span>
		<span><select name="filter[status2]" >
															<option <?php echo (isset($filter['status2']) && $filter['status2']==2) ? 'selected' : ''?> value="2"><?php echo t('Chưa xữ lý');?></option>
                                                            <option <?php echo (isset($filter['status2']) && $filter['status2']==1) ? 'selected' : ''?> value="1"><?php echo t('Đã xữ lý');?></option>
                                                            
                                                         	<option <?php echo (isset($filter['status2']) && $filter['status2']==3) ? 'selected' : ''?> value="3"><?php echo t('Cho vào giỏ rác');?></option>
        </select></span>
		<span>Từ ngày: </span>
		<span>
			
			<?php
			$fromDateValue=(isset($filter['fromdate'])) ? $filter['fromdate'] : '';
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'filter[fromdate]',
    'value' => $fromDateValue,
    'options' => array('dateFormat' => 'yy-mm-dd'),
    'htmlOptions' => array(
        'size' => '20',         // textField size
        'maxlength' => '10',    // textField maxlength
        'readonly'=>"enable",
    ),
));
			?>
		</span>
		<span>Đến ngày: </span>
		<span>
<?php
			$toDateValue=(isset($filter['todate'])) ? $filter['todate'] : '';
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'filter[todate]',
    'value' => $toDateValue,
    'options' => array('dateFormat' => 'yy-mm-dd'),
    'htmlOptions' => array(
        'size' => '20',         // textField size
        'maxlength' => '10',    // textField maxlength
        'readonly'=>"enable",
    ),
));
			?>
		</span>
		
		<span><input type="submit" value="Tìm kiếm" /></span>
	</form>
</div>