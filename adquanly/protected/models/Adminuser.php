<?php

/**
 * This is the model class for table "adminuser".
 *
 * The followings are the available columns in table 'adminuser':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role
 * @property string $created_at
 * @property string $updated_at
 * @property string $fullname
 * @property integer $status
 * @property string $phone
 */
class Adminuser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{adminuser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role,status', 'numerical', 'integerOnly'=>true),
			array('username, password, fullname,phone', 'length', 'max'=>200),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, role, created_at, updated_at, fullname', 'safe', 'on'=>'search'),
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
            'usergroups' => array(self::MANY_MANY, 'Admingroup', '{{admingroup_links}}(adminuser_id, group_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'role' => 'Role',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'fullname' => 'Fullname',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('fullname',$this->fullname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adminuser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    function setGroupForAdmin($group_id,$id,$type="add") {
        
        if($type=='add')
        {
            $sql1= "SELECT count(*) as dem FROM {{admingroup_links}} where group_id={$group_id} AND adminuser_id={$id}";
            $data=app()->db->createCommand($sql1)->queryRow();
            if($data['dem']==0)
            {
                $sql = "REPLACE INTO {{admingroup_links}} VALUES ";
                $sql.= "({$group_id},{$id})";
        		return app()->db->createCommand($sql)->execute();
            }
            
        }
        else{
            return app()->db->createCommand()->delete("{{admingroup_links}}", "group_id=:group_id and adminuser_id=:adminuser_id", array(':group_id' => $group_id,':adminuser_id'=>$id));
        }
		
	}
    function get_adminGroup_link_by_idADMIN($id)
    {
        $sql1= "SELECT group_id FROM {{admingroup_links}} where adminuser_id={$id}";
        $data=app()->db->createCommand($sql1)->queryColumn();
        return $data;
    }
}
