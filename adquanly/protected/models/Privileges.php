<?php

/**
 * This is the model class for table "{{privileges}}".
 *
 * The followings are the available columns in table '{{privileges}}':
 * @property integer $id
 * @property string $privilege
 * @property string $description
 * @property string $section
 */
class Privileges extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{privileges}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('privilege, section', 'length', 'max'=>100),
			array('description', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, privilege, description, section', 'safe', 'on'=>'search'),
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
			'privilege' => 'Privilege',
			'description' => 'Description',
			'section' => 'Section',
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
		$criteria->compare('privilege',$this->privilege,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('section',$this->section,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Privileges the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function findAllPrivileges() {
		$_privileges = $this->findAll();
		$privileges = array();
		foreach ($_privileges as $pri) {
			$privileges[$pri->section][] = $pri;
		}

		return $privileges;
	}
    function savePrivileges($privileges,$group_id) {
        if($privileges)
        {
            $sql = "REPLACE INTO {{admingroup_privileges}} (group_id,privilege) VALUES ";
    		$values = array();
    		foreach ($privileges as $privilege => $ignore) {
    			$values[] = sprintf("(%d, '%s')", $group_id, $privilege);
    		}
    		$sql .= implode(',', $values);
    
    		// first delete
    		app()->db->createCommand()->delete("{{admingroup_privileges}}", "group_id=:group_id", array(':group_id' => $group_id));
    		// then insert
    		app()->db->createCommand($sql)->execute();
        }
        else{
            app()->db->createCommand()->delete("{{admingroup_privileges}}", "group_id=:group_id", array(':group_id' => $group_id));
        }
		
	}
}
