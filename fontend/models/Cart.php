<?php

class Cart {

	public static function addProductToCart($arr,$type, $amount_new=0) 
	{
		$cart = self::getCart();
		$key=$arr["id"].$arr["price_type"];
		$cart_id = self::generateCartId($key);

		if(!isset($cart[$type][$cart_id]))
		{
			$product_data = DModels::get_product_by_id($arr["id"],$_SESSION['language']);
			//Load promotion price
			//Return data
			$amount=1;
			if ( $product_data ) 
			{
				$price=$product_data['gia_goc'];
				if($arr["price_type"]=="R")
					$price=$product_data['gia_ban'];
				else if($arr['price_type']=="C")
					$price=$product_data['gia_tron_goi'];
				$sub_total=$amount*$price;
				$gia_giam=0;
				if(!empty($arr["id_ctkm"]))
				{
					$info_ctkm=DModels::get_value_promotion_by_id($arr["id_ctkm"]);
					if(!empty($info_ctkm))
					{
						$gia_giam=0;
						if($info_ctkm['gia_vnd'] > 0)
					    {
						    $gia_giam=$info_ctkm['gia_vnd']*$amount;
						}
					    else if($info_ctkm['phan_tram']){
						    $gia_giam=$sub_total*$info_ctkm['phan_tram']*0.01;
					    }
					    $sub_total=$sub_total-$gia_giam;
					}
				}
				$product = array(
					'product_id' => $arr["id"],
					'product_type' => $product_data['product_type'],
					'product_code' => $product_data['product_code'],
					'product' => $product_data['name'],
					'price' => $price,
					'sub_total'=>$sub_total,
					'amount'=>$amount,
					'price_type'=>$arr["price_type"],
					'id_ctkm'=>$arr["id_ctkm"],
					'km_value'=>$arr["km_value"],
					'giam_gia_sanpham'=>$gia_giam,
					
				);
				$cart[$type][$cart_id] = $product;
				
				$cart['recalculate'] = true;

				self::setCart($cart);
			}
		}
		else{
			if($amount_new==0)
			{
				$amount_old=(!empty($cart[$type][$cart_id]['amount'])) ? $cart[$type][$cart_id]['amount'] : 1;
				$cart[$type][$cart_id]['amount']=$amount_old+1;
			}
			else{
				$cart[$type][$cart_id]['amount']=$amount_new;
			}
			$sub_total=$cart[$type][$cart_id]['amount']*$cart[$type][$cart_id]['price'];
			$gia_giam=$cart[$type][$cart_id]['giam_gia_sanpham'];
			if(!empty($arr["id_ctkm"]))
			{
				$info_ctkm=DModels::get_value_promotion_by_id($arr["id_ctkm"]);
				if(!empty($info_ctkm))
				{
					
					if($info_ctkm['gia_vnd'] > 0)
				    {
					    $gia_giam=$info_ctkm['gia_vnd']*$cart[$type][$cart_id]['amount'];
					}
				    else if($info_ctkm['phan_tram']){
					    $gia_giam=$sub_total*$info_ctkm['phan_tram']*0.01;
				    }
				    $sub_total=$sub_total-$gia_giam;
				}
			}
			$cart[$type][$cart_id]['giam_gia_sanpham']=$gia_giam;
			$cart[$type][$cart_id]['id_ctkm']=$arr["id_ctkm"];
			$cart[$type][$cart_id]['km_value']=$arr["km_value"];
			$cart[$type][$cart_id]['price_type']=$arr["price_type"];
			$cart[$type][$cart_id]['sub_total']=$sub_total;
			$cart['recalculate'] = true;
			self::setCart($cart);
		}
		

		if ( $cart['recalculate'] ) {
			self::calculateCartContent();
		}
	}
	
	public static function calculateCartContent($type="giohang") {
		$cart = self::getCart();

		$total = 0;
		foreach ($cart[$type] as $item_id => $product ) {
			$total += $product['sub_total'];
		}
		$cart['tam_tinh'] = $total;
		$cart['total'] = $total;
		$cart['giam_gia_don_hang'] = 0;
		$cart['id_ctkm_donhang'] = 0;
		$cart['code_order'] = "";	
		$cart['phi_van_chuyen'] = param("FEE_SHIPPING");	
		$cart['giam_gia_shipping'] = 0;
		$cart['code_shipping'] = "";
		$cart['id_ctkm_shipping'] = 0;
		$cart['total_have_fee'] = $total+param("FEE_SHIPPING");
		$cart['recalculate'] = false;

		self::setCart($cart);
	}

	public static function removeProductFromCart($product_id,$type, $itm = false) {
		$cart_id = self::generateCartId($product_id);
		$cart = self::getCart();

		if ( !empty($cart[$type]) && isset($cart[$type][$cart_id]) ) 
		{
			//Clear from cart_id
			unset($cart[$type][$cart_id]);
			$cart['recalculate'] = true;

			self::setCart($cart);
		}

		if (isset($cart) && isset($cart['recalculate']) && $cart['recalculate']) {
			self::calculateCartContent();
		}

		return true;
	}

	public static function getCart() {
		$_cart = app()->session->get('cart');
		$cart = @json_decode($_cart, true);

		if ( !is_array($cart) ) {
			$cart = self::emptyCart();
		}

		return $cart;
	}

	public static function setCart(&$cart) {
		app()->session['cart'] = @json_encode($cart);
		//user()->setState('cart', @json_encode($cart, true));
	}

	public static function emptyCart() {
		$cart = array(
			'giohang' => array(),
			'baogia' => array(),
			'total' => 0,
		);

		self::setCart($cart);

		return $cart;
	}

	public static function generateCartId($product_id) {
		$_cid = array();

		$_cid[] = $product_id;
		
		$cart_id = fn_crc32(implode('_', $_cid));

		return $cart_id;
	}
	static function fn_normalize_amount($amount = '1')
	{
	    $amount = abs(intval($amount));

	    return empty($amount) ? 0 : $amount;
	}
}