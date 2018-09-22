<section class="highlight highlight-1">
        <div class="container">
             <div class="block-first text-center">
                 <h2 class="section-heading"><?php echo $detail['name']?></h2>
                 <p><?php echo $detail['short_description'];?></p>
                 <hr class="line-1">
            </div>
            <article class="art-feature art-feature-left">
	            <img  src="<?php echo tu() ?>/images/photo/img-6.jpg"  alt="">
                <div>
                  <?php echo $detail['description'];?>
                </div>
            </article>
            <div class="outer-art-5 row">
                <article class="art-5 col-sm-4">
                    <h3><span>01</span> Tầm nhìn</h3>
                    <p><?php echo $detail['ung_dung'];?></p>
                </article>
                  <article class="art-5 col-sm-4">
                    <h3><span>02</span> Sứ mệnh</h3>
                    <p><?php echo $detail['download'];?></p>
                </article>
                 <article class="art-5 col-sm-4">
                    <h3><span>03</span> Giá trị cốt lõi</h3>
                    <p><?php echo $detail['nha_san_xuat'];?></p>
                </article>
            </div>
        </div>
    </section>