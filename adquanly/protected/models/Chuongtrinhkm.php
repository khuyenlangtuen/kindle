<?php

class Chuongtrinhkm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{chuongtrinh_khuyenmai}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, status, gia_vnd, phan_tram,only_apply', 'numerical', 'integerOnly'=>true),
			array('name, promotion_type, start_date,end_date,start_value,end_value,created_date,updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
		);
	}
	public function beforeSave() {
		if ( parent::beforeSave() ) {
			
			if ( $this->isNewRecord ) {
				$this->owner_id = Yii::app()->user->getState('id_user');
				$this->created_date = date("y-m-d h:i:s");
			}
			else{
				$this->updated_date = date("y-m-d h:i:s");
			}

			
		}

		return true;
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'promotion_detail' => array(self::HAS_MANY, 'Khuyenmaidetail', 'id_ctkm', 'order' => 'promotion_detail.created_date DESC')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'content_id' => 'Content',
			'id_cate' => 'Id Cate',
			'status' => 'Status',
			'view_num' => 'View Num',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'publish_at' => 'Publish At',
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
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Content the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
