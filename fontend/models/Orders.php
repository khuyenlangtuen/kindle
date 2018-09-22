<?php

/**
 * This is the model class for table "{{orders}}".
 *
 * The followings are the available columns in table '{{orders}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $order_info
 * @property string $user_info
 * @property string $created_at
 * @property double $total
 * @property double $discount
 * @property integer $status
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{orders}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('total, discount,', 'numerical'),
			array('order_info, user_info, created_at,discount_order,discount_shipping,id_ctkm_order,id_ctkm_shipping,fee_shipping,discount_code_order,discount_code_shipping,ma_don_hang,pay_method', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, order_info, user_info, created_at, total, discount, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'order_info' => 'Order Info',
			'user_info' => 'User Info',
			'created_at' => 'Created At',
			'total' => 'Total',
			'discount' => 'Discount',
			'discount_order' => 'discount order',
			'discount_shipping' => 'discount shipping',
			'id_ctkm_order' => 'id_ctkm_order',
			'id_ctkm_shipping' => 'id_ctkm_shipping',
			'fee_shipping' => 'fee_shipping',
			'discount_code_order' => 'discount_code_order',
			'discount_code_shipping' => 'discount_code_shipping',
			'ma_don_hang' => 'ma_don_hang',
			'pay_method' => 'pay_method',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_info',$this->order_info,true);
		$criteria->compare('user_info',$this->user_info,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function add_order($cart,$user_info,$pay_method)
	{
		 $user_id=app()->user->getState('user_id');
		$model = new Orders;
		$model->user_info=json_encode($user_info);
		$model->order_info=json_encode($cart);
		$model->user_id=$user_id;
		$model->created_at=date('Y-m-d h:i:s');
		$model->total=$cart['total_have_fee'];
		$model->pay_method=$pay_method;
		if(isset($cart['id_ctkm_donhang']) && $cart['id_ctkm_donhang'])
		{
			$model->id_ctkm_order=$cart['id_ctkm_donhang'];
		}
		if(isset($cart['giam_gia_don_hang']) && $cart['giam_gia_don_hang'])
		{
			$model->discount_order=$cart['giam_gia_don_hang'];
		}
		if(isset($cart['id_ctkm_shipping']) && $cart['id_ctkm_shipping'])
		{
			$model->id_ctkm_shipping=$cart['id_ctkm_shipping'];
		}
		if(isset($cart['giam_gia_shipping']) && $cart['giam_gia_shipping'])
		{
			$model->discount_shipping=$cart['giam_gia_shipping'];
		}
		if(isset($cart['phi_van_chuyen']) && $cart['phi_van_chuyen'])
		{
			$model->fee_shipping=$cart['phi_van_chuyen'];
		}
		if(isset($cart['code_order']) && $cart['code_order'])
		{
			$model->discount_code_order=$cart['code_order'];
		}
		if(isset($cart['code_shipping']) && $cart['code_shipping'])
		{
			$model->discount_code_shipping=$cart['code_shipping'];
		}
		$model->status=1;//mua hang
		$model->status2=2;//mua hang
		if ( $model->save() ) {
			$flag=false;
			foreach($cart['giohang'] as $item_id => $product)
			{
				$order_details = new OrderDetail;
				$order_details->order_id = $model->id;
				$order_details->item_id = $item_id;
				$order_details->product_id = $product['product_id'];
				$order_details->amount = $product['amount'];
				$order_details->gia_chua_giam = $product['price']*$product['amount'];
				$order_details->giam_gia = $product['giam_gia_sanpham'];
				$order_details->gia_da_giam = $product['sub_total'];
				$order_details->product_type = $product['product_type'];
				$order_details->price_type = $product['price_type'];
				if(isset($product['id_ctkm']) && $product['id_ctkm'])
				{
					$order_details->id_ctkm_product = $product['id_ctkm'];
					DModels::update_code_coupon($product['km_value'],$product['id_ctkm']);
				}
				if(isset($product['km_value']) && $product['km_value'])
				{
					$order_details->discount_value = $product['km_value'];
				}
				if ($order_details->save()) 
				{
					$flag=true;
				}
			}
			/*if($flag)
			{
				if(isset($_POST['user']['email']) && $_POST['user']['email'])
				{
					$sub="Alenvina xác nhận đơn hàng của bạn";
					$layout_name="donhang";
					$content=array("cart"=>$cart);
					$kq=DModels::sendmail($sub,$_POST['user']['email'],$layout_name,$content);
				}
			}*/
			if($model->discount_code_shipping && $model->id_ctkm_shipping)
				DModels::update_code_coupon($model->discount_code_shipping,$model->id_ctkm_shipping);
			if($model->id_ctkm_order && $model->discount_code_order)
				DModels::update_code_coupon($model->discount_code_order,$model->id_ctkm_order);
		    $model->ma_don_hang=Cart::generateCartId($model->id);
		    $model->save();
			return $model->id;
		}
			
	}
}
