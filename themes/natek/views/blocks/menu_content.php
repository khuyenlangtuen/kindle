<?php $categories = Category::getMenuCategories(20,0,'content',$_SESSION['language']);?>
			<ul>
                <?php 
                if($categories)
                {
                    foreach($categories as $key=>$category)
                    {
                        $class = (!empty($category['subcategories']) ? 'has-children' : '');
					  $class .= (getParam('id') == $category['category_id'] ? ' active' : '');
                        ?>
                        <li class="block">
        					<input type="checkbox" name="item" id="item<?php echo $key?>" />
        					<label for="item<?php echo $key?>"><i class="fa fa-arrow-circle-right"></i><?php echo $category['category'];?></label>
        					<?php 
                            if ( !empty($category['subcategories']) ) {
                                
                                ?>
                                <ul class="options">
                                <?php
                                foreach ($category['subcategories'] as $cat) {
                                        $class = (getParam('id') == $cat['category_id'] ? ' active' : '');
                                    ?>
                                    <li><a href="<?php echo $this->createUrl('/content/detail',array('id'=>$cat['category_id'],'title'=>'')) ?>"><i class="fa fa-chevron-circle-right"></i><?php echo $cat['category'];?></a></li>
       						
                                    <?php
                                }

                                ?>
            					</ul>		
                                <?php
                            }
                            ?>
                            			
        				</li>
                        <?php
                    }
                }
                
                ?>
				
			</ul>		
          </div>
          <!-- /.Categoris list End ./-->