<section id="section1" class="main_section cover_bg">
        	
            <div class="layer">
            	<a href="#" class="top_menu_btn hide white"><i class="fa fa-navicon "></i></a>
            	<ul id="primary_menu" class="head_menu">
                	<li data-scrollreveal="enter bottom after 0.15s over 0.5s"><a class="active" href="#section1">Trang chủ</a></li>
                    <li data-scrollreveal="enter bottom after 0.15s over 0.75s"><a href="#section2">Cuộc đời</a></li>
                    
                    <li data-scrollreveal="enter bottom after 0.15s over 1s"><a href="#section4">Thành tựu</a></li>
                    <li data-scrollreveal="enter bottom after 0.15s over 1.25s"><a href="#section8">Tóm tắt sách</a></li>
                    <li data-scrollreveal="enter bottom after 0.15s over 1.5s"><a href="#section6">Quà tặng</a></li>
                    <li data-scrollreveal="enter bottom after 0.15s over 2s"><a href="#section7">Đặt hàng</a></li>
                    <li data-scrollreveal="enter bottom after 0.15s over 2.5s"><a href="#section3">Tôn vinh</a></li>
                    <li data-scrollreveal="enter bottom after 0.15s over 3s"><a href="#section5">Sự kiện</a></li>
                    
                    
                   
                </ul>
                <ul class="top social_buttons clear" data-scrollreveal="enter bottom after 0.15s over 4s">
                    <li class="fl"><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                    <li class="fl"><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                    <li class="fl"><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                </ul>
                
            </div>
            <div class="content container clear">
            	<div class="right fr" data-scrollreveal="enter right after 0.15s over 1s">
               		<img src="<?php echo tu() ?>/images/book_img.png" />
               </div>
               
				<div class="left fl" data-scrollreveal="enter left after 0.15s over 1s">            	
                    <h1 class="top_main_title white shadow">
                    	<span class="title ">GÓC NHÌN</span> 
                     	<span class="big_title main_color ">ALAN PHAN</span>
                    </h1>

                    <p class="white b shadow">DÀNH TẶNG DOANH NHÂN VIỆT<br/>TRONG THẾ TRẬN TOÀN CẦU</p>
                    <p>		
                        <span class="white dark_bg inline">Quyển sách cuối cùng của một tầm nhìn</span><span class="break"></span>
                        <span class="white dark_bg inline">và nhân cách lớn của cộng đồng người Việt</span><span class="break"></span>
                    	<div class="video_wrap"><a href="https://www.youtube.com/watch?v=j1gETxEp0Cw" class="html5lightbox white"><span class="video main_bg white inline"> <div class="icon"></div>  video Alan Phan</span></a></div>    
                    </p>
               </div>
               
            </div>
            
        </section>
<div class="modal fade" tabindex="-1" id="id_video" role="dialog" aria-labelledby="myModal_item">
	  <div class="modal-dialog modal-lg2" role="document">
		<div class="modal-content">
		  
		  <div class="modal-body" style="padding: 0">		
				<?php
					$tin_video=DModels::get_one_content_by_id_cate(5);
					if(!empty($tin_video))
					{
						echo $tin_video['description'];
					}
				?>	
		  </div>
		</div>
	  </div>
	</div>