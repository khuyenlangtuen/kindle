<?php
	$info=DModels::get_general("lien_he",$_SESSION['language']);
?>
<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo $title;?></h2>
                 <p><?php echo $info['short_description']?></p>
                 <hr class="line-1">
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4669439466466!2d106.68413931480075!3d10.775503992322147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f24e8c26a87%3A0x7c8b04f238472758!2zNzYgQ8OhY2ggTeG6oW5nIFRow6FuZyBUw6FtLCBwaMaw4budbmcgNiwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1468087084030" width="100%" height="422" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="row">
                <div class="block-contact col-sm-5">
                    <p><?php echo $info['description']?></p>
                    <div class="box-contact">
                        <h3>NATEK</h3>
                        <ul>
                            <li><address><?php echo $info['ung_dung']?></address></li>
                            <li><a href="mailto:<?php echo $info['name']?>" title="">E: <?php echo $info['name']?></a></li>
                            <li><a href="tel:<?php echo $info['seo_name']?>" title="">T: <?php echo $info['seo_name']?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-7">
                    <h3 class="title-contact"><?php echo t("Contact us");?></h3>
                    <form class="frm-general frm-contact" action="<?php echo $this->createUrl('/content/addlienhe') ?>" method="post" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="item[fullname]" placeholder="<?php echo t("Fullname");?>" required >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="item[email]" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="tel" name="item[phone]" placeholder="<?php echo t("Phone");?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="item[address]" placeholder="<?php echo t("Address");?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea required name="item[message]" class="form-control txtarea" placeholder="<?php echo t("Content");?>"></textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-send"><?php echo t("Send");?></button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>