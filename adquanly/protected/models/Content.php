<?php

/**
 * This is the model class for table "{{content}}".
 *
 * The followings are the available columns in table '{{content}}':
 * @property integer $content_id
 * @property integer $id_cate
 * @property integer $status
 * @property integer $view_num
 * @property string $created_at
 * @property string $updated_at
 * @property string $publish_at
 * @property integer $owner_id
 */
class Content extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{content}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_id, id_cate, status, view_num, owner_id', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at, publish_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('content_id, id_cate, status, view_num, created_at, updated_at, publish_at', 'safe', 'on'=>'search'),
		);
	}
	public function beforeSave() {
		if ( parent::beforeSave() ) {
			if ( $this->isNewRecord ) {
				$this->owner_id = Yii::app()->user->getState('id_user');
			}

			$this->created_at = date("y-m-d h:i:s");
			$this->publish_at=date('Y-m-d h:i:s');
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
            'images' => array(self::HAS_ONE, 'Images', 'object_id', 'on' => "images.object_type='T'"),
            'language' => array(self::HAS_ONE, 'LanguageValue', 'object_id', 'on' => "language.object_type='T'"),
            'main_image_pair' => array(self::HAS_ONE, 'Images', 'object_id', 'on' => "main_image_pair.object_type='T' AND main_image_pair.type='M'"),
            'category' => array(self::HAS_ONE, 'Category', false,'on'=>"category.id=t.id_cate"),
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('id_cate',$this->id_cate);
		$criteria->compare('status',$this->status);
		$criteria->compare('view_num',$this->view_num);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('publish_at',$this->publish_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

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
