
<?php 
//var_dump($filter);
$url=CController::CreateUrl('content/index');?>
<div>
	<form action="<?php echo $url;?>" method="get">
		<input value="content/index" name="r" type="hidden"/>
		<div style="margin:10px 0">
			<span>Tên sản phẩm: </span>
			<span><input value="<?php echo (isset($filter['name'])) ? $filter['name'] : '';?>" name="name"/></span>
		</div>
		<div class="form-group">
	         <span><?php echo t('Đề mục ');?></span>
	         <select name="cate_id">
	         	<option value=""><?php echo "--All--"?></option>
	            <?php
	                //var_dump($categories);
	                $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'content');
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