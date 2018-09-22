
<?php 
//var_dump($filter);
$url=CController::CreateUrl('content/news');?>
<div>
	<form action="<?php echo $url;?>" method="get">
		<input value="content/news" name="r" type="hidden"/>
		<div style="margin:10px 0">
			<span>Tên bài viết: </span>
			<span><input value="<?php echo (isset($filter['name'])) ? $filter['name'] : '';?>" name="name"/></span>
		</div>
		<div class="form-group">
	         <span><?php echo t('Chuyên mục ');?></span>
	         <select name="cate_id">
	            <?php
	                //var_dump($categories);
	                $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'content',12);
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