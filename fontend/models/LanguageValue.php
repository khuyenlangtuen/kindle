<?php

/**
 * This is the model class for table "{{language_value}}".
 *
 * The followings are the available columns in table '{{language_value}}':
 * @property integer $id
 * @property string $lang_code
 * @property integer $object_id
 * @property string $object_type
 * @property string $name
 * @property string $seo_name
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $search_keys
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $short_description
  */
class LanguageValue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{language_value}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id', 'numerical', 'integerOnly'=>true),
			array('lang_code', 'length', 'max'=>10),
			array('object_type', 'length', 'max'=>5),
			array('name, seo_name, seo_title, seo_keywords, search_keys', 'length', 'max'=>500),
			array('seo_description, description, created_at, updated_at,short_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lang_code, object_id, object_type, name, seo_name, seo_title, seo_description, seo_keywords, search_keys, description, created_at, updated_at', 'safe', 'on'=>'search'),
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
			 'main_image_pair' => array(self::HAS_ONE, 'Images', false, 'on' => "t.object_id=main_image_pair.object_id and main_image_pair.type='M' and t.object_type=main_image_pair.object_type"),
			 'content' => array(self::HAS_ONE, 'Content', false, 'on' => "t.object_id=content.content_id and t.object_type='T'"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lang_code' => 'Lang Code',
			'object_id' => 'Object',
			'object_type' => 'Object Type',
			'name' => 'Name',
			'seo_name' => 'Seo Name',
			'seo_title' => 'Seo Title',
			'seo_description' => 'Seo Description',
			'seo_keywords' => 'Seo Keywords',
			'search_keys' => 'Search Keys',
			'description' => 'Description',
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
		$criteria->compare('lang_code',$this->lang_code,true);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('seo_name',$this->seo_name,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('search_keys',$this->search_keys,true);
		$criteria->compare('description',$this->description,true);
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
	 * @return LanguageValue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
