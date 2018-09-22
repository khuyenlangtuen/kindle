<?php

/**
 * This is the model class for table "{{admingroup}}".
 *
 * The followings are the available columns in table '{{admingroup}}':
 * @property integer $id
 * @property string $group_name
 * @property integer $status
 */
class Admingroup extends CActiveRecord
{
    public $group_privileges;
    public $usergroup_ids;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admingroup}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('group_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_name, status', 'safe', 'on'=>'search'),
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
			'group_name' => 'Group Name',
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
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admingroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getUsergroup($id) {
		$model = $this->findByPk($id);
		$group_privileges = self::getGroupPrivileges($id);

		$model->group_privileges = $group_privileges;

		return $model;
	}

	public static function getGroupPrivileges($group_id) {
		$privileges = app()->db->createCommand()
					->select('privilege')
					->from('{{admingroup_privileges}}')
					->where('group_id=:group_id', array(':group_id' => $group_id))
					->queryColumn();

		return $privileges;
	}
    
}
