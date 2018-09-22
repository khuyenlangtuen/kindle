<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property integer $id
 * @property integer $object_id
 * @property string $object_type
 * @property string $thumb_image
 * @property integer $image_x
 * @property integer $image_y
 * @property string $alt
 * @property string $created_at
 * @property string $type
 */
class Images extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, object_id, image_x, image_y', 'numerical', 'integerOnly'=>true),
			array('object_type, type', 'length', 'max'=>10),
			array('thumb_image, alt', 'length', 'max'=>200),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, object_id, object_type, thumb_image, image_x, image_y, alt, created_at, type', 'safe', 'on'=>'search'),
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
			'object_id' => 'Object',
			'object_type' => 'Object Type',
			'thumb_image' => 'Thumb Image',
			'image_x' => 'Image X',
			'image_y' => 'Image Y',
			'alt' => 'Alt',
			'created_at' => 'Created At',
			'type' => 'Type',
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
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('thumb_image',$this->thumb_image,true);
		$criteria->compare('image_x',$this->image_x);
		$criteria->compare('image_y',$this->image_y);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Images the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public static function getUploadBasePath($object_type = 'product')
	{
		return Yii::getPathOfAlias('upload') . "/$object_type/";
	}

	public static function getUploadPath($object_type = 'product')
	{
		$path =  self::getUploadBasePath($object_type) . date('Y/m/d');

		if ( !file_exists($path) ) mkdir ($path, 0777, true);

		return $path;
	}

	public static function attachImagePair($name, $object_type, $object_id) {
		$pairs_data = getPost($name);
		$upload_base_path = self::getUploadBasePath($object_type);
		$upload_path = self::getUploadPath($object_type);

		if ( !empty($pairs_data) ) {
			foreach ($pairs_data as $k => $p_data) {
				$field_name = "thumb_img[$k]";
				$image_hndl = CUploadedFile::getInstanceByName($field_name);
				
				$image = new Images;
				if ( $image_hndl != null ) {
				    
					// save new image
					$image_file = $upload_path . '/' . $image_hndl->name;
					$image_path = str_replace($upload_base_path, '', $image_file);
					$image_hndl->saveAs($image_file);
					list($w, $h, $t, $a) = @getimagesize($image_file);
					$image->thumb_image = $image_path;
					$image->image_x = $w;
					$image->image_y = $h;
					$image->alt = $p_data['alt'];
                    $image->object_id = $object_id;
                    $image->object_type = $p_data['object_type'];
                    $image->type = $p_data['type'];
                    $image->created_at = date("y-m-d H:i:s");
					if ( !$image->save() ) {
						return false;
					}
				}
				else{
					if($object_type=='content')
					{
						$object_type="T";
					}
					elseif($object_type=='product')
					{
						$object_type="P";
					}
					elseif($object_type=='origin')
					{
						$object_type="C";
					}
					elseif($object_type=='faq')
					{
						$object_type="F";
					}
					$image->object_id = $object_id;
					$image->object_type = $object_type;
					$image->type = 'M';
					$image->created_at = date("y-m-d H:i:s");
					if ( !$image->save() ) {
						return false;
					}
				}
			}
		}
	}
    public static function updateImagePair($name, $object_type, $object_id) {
        
		$pairs_data = getPost($name);
		$upload_base_path = self::getUploadBasePath($object_type);
		$upload_path = self::getUploadPath($object_type);

		if ( !empty($pairs_data) ) {
			foreach ($pairs_data as $k => $p_data) {
			     if(!empty($p_data['id']))
                 {
                    $field_name = "thumb_img[$k]";
    				$image_hndl = CUploadedFile::getInstanceByName($field_name);
    				
    				$image = Images::model()->findByPk($p_data['id']);
    				if ( $image_hndl != null ) {
    				    
    					// save new image
    					$image_file = $upload_path . '/' . $image_hndl->name;
    					$image_path = str_replace($upload_base_path, '', $image_file);
    					$image_hndl->saveAs($image_file);
    					list($w, $h, $t, $a) = @getimagesize($image_file);
    					$image->thumb_image = $image_path;
    					$image->image_x = $w;
    					$image->image_y = $h;
    				}
                    $image->alt = $p_data['alt'];
                    $image->object_id = $object_id;
                    $image->object_type = $p_data['object_type'];
                    $image->type = $p_data['type'];
					if ( !$image->save() ) {
						return false;
					}
                 }
                 else{
                    $field_name = "thumb_img[$k]";
    				$image_hndl = CUploadedFile::getInstanceByName($field_name);
    				
    				$image = new Images;
    				if ( $image_hndl != null ) {
    				    
    					// save new image
    					$image_file = $upload_path . '/' . $image_hndl->name;
    					$image_path = str_replace($upload_base_path, '', $image_file);
    					$image_hndl->saveAs($image_file);
    					list($w, $h, $t, $a) = @getimagesize($image_file);
    					$image->thumb_image = $image_path;
    					$image->image_x = $w;
    					$image->image_y = $h;
    					$image->alt = $p_data['alt'];
                        $image->object_id = $object_id;
                        $image->object_type = $p_data['object_type'];
                        $image->type = $p_data['type'];
                        $image->created_at = date("y-m-d H:i:s");
    					if ( !$image->save() ) {
    						return false;
    					}
    				}
                 }
				
			}
		}
	}
}
