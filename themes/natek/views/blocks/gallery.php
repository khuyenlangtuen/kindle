<div>
            <div class="gap-30"></div>
            <strong class="stitle"><?php echo DModels::get_general('du_an',$_SESSION['language'],true);?></strong>
            <ul class="lb-album">
                <?php
                $gallery=DModels::show_gallery();
                if(!empty($gallery))
                {
                    foreach($gallery as $key=>$item)
                    {
                        ?>
                        <li> <a href="<?php echo $this->createUrl('/content/detailud',array('id'=>$item->id,'title'=>$item->language->seo_name)) ?>"> 
                        <?php
                            $handle = opendir(Yii::getPathOfAlias('filemanager').'/source/albums/id_'.$item->id);
							while($file = readdir($handle)){
								if($file !== '.' && $file !== '..'){
									echo '<img src="'.Yii::app()->params['LINK_SOURCE_ANH'].'/source/albums/id_'.$item->id.'/'.$file.'" border="0" style="height:75px;width:75px" />';
									break;
								}
							}
						?>
                         <span><i class="fa fa-search-plus"></i></span> </a>
                          </li>
                        <?php
                    }
                }
                ?>
              
            </ul>
</div>