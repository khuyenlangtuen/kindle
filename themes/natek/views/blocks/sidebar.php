 <div class="col-lg-3 col-md-3 sidebar" style="padding-right:0px;width:28%;padding-left: 53px;"> 
          <!-- /.Search ./-->
          <div class="search">
            <form action="<?php echo $this->createUrl('/product/index')?>" method="get">
              <input name="q" type="text" placeholder="<?php echo t('Search')?>:"/>
              <button><i class="fa fa-search"></i></button>
            </form>
          </div>
          <!-- /.Search End ./--> 
          
          <?php $this->renderPartial("//blocks/menu_cat") ?> 
          
          <!-- /.Flick start ./-->
          <?php $this->renderPartial("//blocks/gallery") ?> 
          <!-- /.Flick End ./-->
          <?php $this->renderPartial("//blocks/banner_right") ?> 
          <div class="gap-30"></div>
          
          <!-- /.Facebook start ./-->
          <!--div class="facebook-box"> <strong class="stitle">Facebook</strong>
            <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FFacebookDevelopers&amp;width&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=true&amp;appId=133982306765662" style="border:none; overflow:hidden; height:258px;"></iframe>
          </div-->
          <!-- /.Facebook end ./--> 
          
        </div>