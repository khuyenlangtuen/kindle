<?php


class OrderDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, product_id', 'numerical', 'integerOnly'=>true),
			array('order_id', 'numerical'),
			array('gia_chua_giam, giam_gia,gia_da_giam,id_ctkm_product,item_id,discount_value,amount,price_type,product_type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('id, user_id, order_info, user_info, created_at, total, discount, status', 'safe', 'on'=>'search'),
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
			'product_id' => 'product_id',
			'order_id' => 'order_id',
			'gia_chua_giam' => 'gia_chua_giam',
			'giam_gia' => 'giam_gia',
			'gia_da_giam' => 'gia_da_giam',
			'id_ctkm_product' => 'id_ctkm_product',
			'item_id' => 'item_id',
			'discount_value' => 'discount_value',
			'amount' => 'amount',
			'price_type' => 'price_type',
			'product_type' => 'product_type',
		);
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
}
