<?php

/**
 * This is the model class for table "{{products}}".
 *
 * The followings are the available columns in table '{{products}}':
 * @property integer $id
 * @property integer $owner_id
 * @property string $product_code
 * @property integer $status
 * @property integer $gia_goc
 * @property integer $gia_ban
 * @property integer $khuyen_mai
 * @property string $file
 * @property string $created_at
 * @property string $updated_at
 * @property integer $cate_id
 * @property integer $gia_tron_goi
 * @property integer $sl_ton
 * @property integer $sl_ban
 * @property integer $id_mau_sac
 * @property integer $id_size
 * @property integer $id_khu_vuc
 * @property string $product_type
 * @property string $product_code
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, status, gia_goc, gia_ban, khuyen_mai,cate_id,gia_tron_goi,sl_ton,sl_ban,id_mau_sac,id_khu_vuc,id_size', 'numerical', 'integerOnly'=>true),
			array('product_type', 'length', 'max'=>100),
			array('file', 'length', 'max'=>500),
			array('created_at, updated_at,product_code', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner_id, product_code, status, gia_goc, gia_ban, khuyen_mai, file, created_at, updated_at', 'safe', 'on'=>'search'),
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
            'images' => array(self::HAS_ONE, 'Images', 'object_id', 'on' => "images.object_type='P'"),
            'language' => array(self::HAS_ONE, 'LanguageValue', 'object_id', 'on' => "language.object_type='P'"),
            'main_image_pair' => array(self::HAS_ONE, 'Images', 'object_id', 'on' => "main_image_pair.object_type='P' AND main_image_pair.type='M'"),
			
			'addition_image_pair' => array(self::HAS_MANY, 'Images', 'object_id', 'on' => "addition_image_pair.object_type='P' AND addition_image_pair.type='A'"),
            'imageCount' => array(self::STAT, 'Images', 'object_id','condition' => "object_type='P'"),
			'category' => array(self::HAS_ONE, 'Category', false,'on'=>"category.id=t.cate_id"),
		);
	}
    public function beforeSave() {
		if ( parent::beforeSave() ) {
			if ( $this->isNewRecord ) {
				$this->owner_id = Yii::app()->user->getState('id_user');
				$this->created_at = date("y-m-d H:i:s");
				$this->sl_ton=100;
			}
			else{
				$this->updated_at = date("y-m-d H:i:s");
			}
			
		}

		return true;
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner_id' => 'Owner',
			'product_code' => 'Product Code',
			'status' => 'Status',
			'gia_goc' => 'Gia Goc',
			'gia_ban' => 'Gia Ban',
			'khuyen_mai' => 'Khuyen Mai',
			'file' => 'File',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('product_code',$this->product_code,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('gia_goc',$this->gia_goc);
		$criteria->compare('gia_ban',$this->gia_ban);
		$criteria->compare('khuyen_mai',$this->khuyen_mai);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
