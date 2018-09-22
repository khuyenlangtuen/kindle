<?php $admin_id=Yii::app()->user->getState('id_user');?>
<ul class="nav" id="side-menu">
                        
                        <?php
                            if(DModels::check_show_menu('banners',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='banner') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/banners/index')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('Banner') ?></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <?php
                            if(DModels::check_show_menu('content',$admin_id))
                            {
                        ?>
						 <li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='gioithieu') echo 'active'?>" href="<?php echo CController::createUrl('/content/gioithieu')?>"><i class="fa fa-files-o fa-fw"></i><?php echo t('Giới thiệu') ?></a>
                                </li>
                        <?php } ?>
                        <?php
                            if(DModels::check_show_menu('banners',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='partner') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/banners/partner')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('Đối tác') ?></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <?php
                            if(DModels::check_show_menu('production',$admin_id))
                            {
                        ?>
                        <li class="<?php if(CHtml::encode($this->menu)=='sanpham' || CHtml::encode($this->menu)=='themsanpham' || CHtml::encode($this->menu)=='chuyenmuc' || CHtml::encode($this->menu)=='themchuyenmuc') echo 'active'?>">
                            <a href="#"><i class="fa fa-users"></i> <?php echo t('Sản phẩm') ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='sanpham') echo 'active';?>" href="<?php echo CController::createUrl('/production/index')?>"><?php echo t('Tất cả sản phẩm') ?></a>
                                </li>
                            	<li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='themsanpham') echo 'active';?>" href="<?php echo CController::createUrl('/production/formadd')?>"><?php echo t('Thêm sản phẩm') ?></a>
                                </li>
                                <li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='chuyenmuc') echo 'active';?>" href="<?php echo CController::createUrl('/category/chuyenmuc')?>"><?php echo t('Chuyên mục') ?></a>
                                </li>
                                <li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='themchuyenmuc') echo 'active';?>" href="<?php echo CController::createUrl('/category/themchuyenmuc')?>"><?php echo t('Thêm chuyên mục') ?></a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <?php } ?>
                         <?php
                            if(DModels::check_show_menu('news',$admin_id))
                            {
	                        ?>
							<li class="<?php if(CHtml::encode($this->menu)=='news' || CHtml::encode($this->menu)=='addnews' || CHtml::encode($this->menu)=='motanews') echo 'active'?>">
	                            <a href="#" onclick="window.location.href='<?php echo CController::createUrl('/category/tintuc')?>'" ><i class="fa fa-users"></i> <?php echo t('Tin tức') ?><span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
	                                <li>
	                                    <a class="<?php if(CHtml::encode($this->menu)=='motanews') echo 'active';?>" href="<?php echo CController::createUrl('/category/tintuc')?>"><?php echo t('Mô tả tin tức') ?></a>
	                                </li>
	                                <li>
	                                    <a class="<?php if(CHtml::encode($this->menu)=='news') echo 'active';?>" href="<?php echo CController::createUrl('/content/news')?>"><?php echo t('Tất cả bài viết') ?></a>
	                                </li>
	                            	<li>
	                                    <a class="<?php if(CHtml::encode($this->menu)=='addnews') echo 'active';?>" href="<?php echo CController::createUrl('/content/formaddnews')?>"><?php echo t('Thêm bài viết') ?></a>
	                                </li>
	                                
	                            </ul>
	                        </li>
	                        
	                        <?php } ?>
	                         
                        <?php
                            if(DModels::check_show_menu('quantri',$admin_id))
                            {
                        ?>
                        <li class="<?php if(CHtml::encode($this->menu)=='group' || CHtml::encode($this->menu)=='admin' || CHtml::encode($this->menu)=='user') echo 'active'?>">
                            <a href="#"><i class="fa fa-users"></i> <?php echo t('Administrator') ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='group') echo 'active'?>" href="<?php echo CController::createUrl('/quantri/group')?>"><?php echo t('Group_member') ?></a>
                                </li>
                            	<li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='admin') echo 'active'?>" href="<?php echo CController::createUrl('/quantri/admin')?>"><?php echo t('Group_admin') ?></a>
                                </li>
                                <li>
                                    <a class="<?php if(CHtml::encode($this->menu)=='user') echo 'active'?>" href="<?php echo CController::createUrl('/quantri/user')?>"><?php echo t('Group_user') ?></a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <?php } ?>
                         
                         <?php
                            $a=0;/*if(DModels::check_show_menu('gallery',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='gallery') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/gallery/index')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('Ứng dụng');?></a>
                           
                        </li>
                        <?php }*/ ?>
                         <?php
                            $a=0;/*if(DModels::check_show_menu('menu',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='menu') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/category/menu')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('Menu');?></a>
                           
                        </li>
                        <?php }*/ ?>
                         <?php
                          $a=0; /* if(DModels::check_show_menu('general',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='general') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/general/index')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('general');?></a>
                           
                        </li>
                        <?php }*/ ?>
                        
                         <?php
                            if(DModels::check_show_menu('contact',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='lienhe') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/contact/index')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('Liên hệ');?></a>
                           
                        </li>
                        <?php } ?>
                         <?php
                            if(DModels::check_show_menu('newsletter',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='newsletter') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/newsletter/index')?>"><i class="fa fa-files-o fa-fw"></i> <?php echo t('Newsletter');?></a>
                           
                        </li>
                        <?php } ?>
                         <?php
                            if(DModels::check_show_menu('setting',$admin_id))
                            {
                        ?>
						<li class="<?php if(CHtml::encode($this->menu)=='setting') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/setting/index')?>"><i class="fa fa-cogs"></i> <?php echo t('Setting Email');?></a>
                           
                        </li>
                        <?php } ?>
                        <?php
                            if(DModels::check_show_menu('hoidap',$admin_id))
                            {
                        ?>
                        <li class="<?php if(CHtml::encode($this->menu)=='hoidap') echo 'active'?>">
                            <a href="<?php echo CController::createUrl('/hoidap/index')?>"><i class="fa fa-cogs"></i> <?php echo t('Hỏi đáp');?></a>
                           
                        </li>
                        <?php } ?>
                    </ul>