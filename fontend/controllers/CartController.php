<?php

class CartController extends Controller
{
	public function actionHoigia()
	{
		$title=t('bao_gia');
		$this->breadcrumbs=array(

			array('name' => t('Home'), 'url' => array('site/index')),
			array('name' =>$title )
		);
		DModels::Taocode();
	   $id=getParam('id');
       if(!empty($id))
	   		Cart::addProductToCart($id,"baogia");
	   
	   $this->render('index');
	}
	public function actionGiohang()
	{
		$title=t('Giò hàng của bạn');
		$this->breadcrumbs=array(

			array('name' => t('Home'), 'url' => array('site/index')),
			array('name' =>$title )
		);
		//DModels::Taocode();
	   $item=getPost('item');
	   //var_dump($item);die();
       if(!empty($item))
	   		Cart::addProductToCart($item,"giohang");
	   
	   $cart = Cart::getCart(); 
	   
	  // var_dump($cart);die();
	   $this->render('giohang',array("shop_cart"=>$cart));
	}
	public function actionUpdatesl()
	{
		if(isset($_REQUEST['sl']) && isset($_REQUEST['id']))
		{
			Cart::addProductToCart($_REQUEST['id'],"baogia",$_REQUEST['sl']);
		}
	}
	public function actionDelsp()
	{
		if(isset($_REQUEST['id']))
		{
			Cart::removeProductFromCart($_REQUEST['id'],"baogia");
		}
	}
	public function actionUpdatesl2()
	{
		if(isset($_REQUEST['sl']) && isset($_REQUEST['id']))
		{
			Cart::addProductToCart($_REQUEST['id'],"giohang",$_REQUEST['sl']);
			$cart = Cart::getCart(); 
			die(json_encode($cart));
		}
	}
	public function actionDelsp2()
	{
		if(isset($_REQUEST['id']) && isset($_REQUEST['price_type']))
		{
			$key=$_REQUEST['id'].$_REQUEST['price_type'];
			Cart::removeProductFromCart($key,"giohang");
			$cart = Cart::getCart(); 
			die(json_encode($cart));
		}
	}
	public function actionDelall()
	{
		Cart::emptyCart();
	}
	public function actionThankyou()
	{
		//$_SESSION['bao_gia']=array();
		//$_SESSION['gio_hang']=array();
		Cart::emptyCart();
		$this->render('thankyou');
	}
	public function actionMauhientai()
	{	
		$this->breadcrumbs=array(

			array('name' => t('Home'), 'url' => array('site/index')),
			array('name' =>t('Đặt may theo mẫu hiện tại')),
			
		);
		if ( app()->request->isPostRequest ) 
		{
			$thumb=$_POST['id_thumb_image'];
			$this->render('mauhientai',array("thumb"=>$thumb));

		}
	}
	public function actionAdddathang()
	{
		if ( app()->request->isPostRequest ) 
		{
			
			if(!empty($_POST['item']))
			{
				$model = new Orders;
				$model->user_info=json_encode($_POST['item']);
				$model->created_at=date('Y-m-d h:i:s');
				$model->status=1;//hoi gia
				$model->status2=2;
				$model->pay_method=$_POST['item']['pay_method'];
				if ( $model->save() ) {
					$model->ma_don_hang=Cart::generateCartId($model->id);
					$model->save();
					die("0");
				}
			}
		}
		else{
			die("-1");
		}
	}
	
}