<nav class="navbar navbar-default main-nav">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#"><img alt="" src="<?php echo tu() ?>/images/logo.png" /></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form class="navbar-form navbar-right frm-search" role="search">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Tìm kiếm">
				</div>
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			  </form>
		  <ul class="nav navbar-nav list-menu clear">
			<li class="active"><a href="#" title="GIỚI THIỆU">GIỚI THIỆU</a></li>
			<li><a href="#" title=" Khuyến mãi"> Khuyến mãi</a></li>
			<li><a href="#" title=" Tương tác đơn hàng"> Tương tác đơn hàng</a></li>
			<li><a href="#" title=" Tuyển dụng "> Tuyển dụng </a></li>
			<li><a href="#" title=" Nội bộ "> Nội bộ </a></li>
		  </ul>
		 
		  <ul class="nav navbar-nav nav-bottom">
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo DModels::get_general('KHUYẾN MÃI',$_SESSION['language'],true)?></a>
			  <ul class="dropdown-menu">
				<li>
					<a href="#" title="Home shopping wedding servicer 'Hot' nhất trong tháng"><?php echo DModels::get_general('Home shopping wedding servicer "Hot" nhất trong tháng',$_SESSION['language'],true)?></a>
					<a href="#" title="Dịch vụ trọn gói ngày chụp">Dịch vụ trọn gói ngày chụp</a>
					<a href="#" title="Dịch vụ trọn gói ngày cưới">Dịch vụ trọn gói ngày cưới</a>
					<a href="#" title="Dịch vụ trọn gói toàn phần ngày chụp & ngày cưới">Dịch vụ trọn gói toàn phần ngày chụp & ngày cưới</a>
					<a href="#" title="Trang phục cưới">Trang phục cưới</a>
					<a href="#" title="Chụp hình">Chụp hình</a>
				</li>
				<li>
					<a href="#" title="Trang điểm">Trang điểm</a>
					<a href="#" title="Hoa tươi">Hoa tươi</a>
					<a href="#" title="Xe cưới">Xe cưới</a>
					<a href="#" title="Thiệp cưới">Thiệp cưới</a>
					<a href="#" title="Cổng cưới">Cổng cưới</a>
				</li>
			  </ul>
			</li>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>2));//trang phuc cuoi?>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>8));//chup hinh?>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>13));//trang diem?>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>16));//hoa cuoi?>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>20));//xe cuoi?>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>24));//thiep cuoi?>
			<?php $this->renderPartial("//blocks/menu_con",array("cate_id"=>27));//cong cuoi?>
			<li><a href="#" title="ỨNG DỤNG NGÀY CƯỚI">ỨNG DỤNG NGÀY CƯỚI</a></li>
			<li><a href="#" title="TIN TỨC">TIN TỨC</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>