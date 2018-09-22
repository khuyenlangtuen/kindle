 <ul class="navbar-top-links navbar-right">
                    
                                <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php 
                                    foreach($lang as $l)
                                    {
                                        if($l->status==1)
                                        {
                                            ?>
                                            <img style="width: 20px;" src="<?php echo Yii::app()->request->baseUrl.'/images/'.$l->lang_code.'.jpg'?>" /><?php echo $l->lang_name;?><i class="fa fa-caret-down"></i>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                    ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php 
                                    foreach($lang as $l)
                                    {
                                        ?>
                                        <li val="<?php echo $l->lang_code?>" ><a href="<?php echo $url.'&lg='.$l->lang_code;?>"><img style="width: 20px;" src="<?php echo Yii::app()->request->baseUrl.'/images/'.$l->lang_code.'.jpg'?>" /><?php echo $l->lang_name;?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                </li>
                                </ul>