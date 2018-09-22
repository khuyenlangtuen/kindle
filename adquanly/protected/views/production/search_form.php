
<?php 
//var_dump($filter);
$url=CController::CreateUrl('production/index');?>
<div>
	<form action="<?php echo $url;?>" method="get">
		<input value="production/index" name="r" type="hidden"/>
		<div style="margin:10px 0">
			<span>Tên sản phẩm: </span>
			<span><input value="<?php echo (isset($filter['name'])) ? $filter['name'] : '';?>" name="name"/></span>
			<span>Loại sản phẩm: </span>
			<span>
				<select name="product_type"  style="width:20%;clear:both">
					<option value=""><?php echo t('--Chọn--');?></option>
		            <option <?php echo (isset($filter['product_type']) && $filter['product_type']=="single") ? 'selected' : ''?> value="single"><?php echo t('Sản phẩm đơn');?></option>
		            <option <?php echo (isset($filter['product_type']) && $filter['product_type']=="album") ? 'selected' : ''?> value="album"><?php echo t('Album');?></option>
		         	<option <?php echo (isset($filter['product_type']) && $filter['product_type']=="group") ? 'selected' : ''?> value="group"><?php echo t('Trọn gói');?></option>
		         </select>
			</span>
		</div>
		<div class="form-group">
	         <span><?php echo t('Đề mục sản phẩm');?></span>
	         <select name="cate_id">
	            <?php
	                //var_dump($categories);
	                $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'',7);
	                foreach($categories as $key=>$row)
	                {
	                    if(isset($filter['cate_id']) && $key==$filter['cate_id'])
	                    {
	                        ?>
	                        <option selected="" value="<?php echo $key?>"><?php echo $row?></option>
	                        <?php
	                    }
	                    else{
	                        ?>
	                            <option value="<?php echo $key?>"><?php echo $row?></option>
	                        <?php
	                    }
	                    
	                }
	            ?>
	         </select>
	    </div>
	    <div>
			<span><input type="submit" value="Tìm kiếm" /></span>
		</div>
	</form>
</div>