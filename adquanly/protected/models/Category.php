<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $id_path
 * @property integer $owner_id
 * @property integer $status
 * @property string $cate_type
 * @property integer $product_count
 * @property string $created_at
 * @property string $updated_at
 * @property integer $priority
 * @property integer $show_in_menu
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, parent_id, owner_id, status, product_count, priority, show_in_menu', 'numerical', 'integerOnly'=>true),
			array('id_path', 'length', 'max'=>100),
			array('cate_type, seo_name', 'length', 'max'=>500),
			array('created_at, updated_at, tinh_trang,tac_gia,loai,revision', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, id_path, owner_id, status, cate_name, seo_title, seo_description, description, product_count, seo_keywords, search_keys, created_at, updated_at, priority, show_in_menu', 'safe', 'on'=>'search'),
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
            'subcats' => array(self::HAS_MANY, 'Category', 'parent_id'),
            'images' => array(self::HAS_ONE, 'Images', 'object_id', 'on' => "images.object_type='C'"),
            'language' => array(self::HAS_ONE, 'LanguageValue', 'object_id', 'on' => "language.object_type='C'"),
            'main_image_pair' => array(self::HAS_ONE, 'Images', 'object_id', 'on' => "main_image_pair.object_type='C' AND main_image_pair.type='M'"),
		);
	}
    public function scopes()
    {
        return array(
			'level_1' => array(
				'condition' => 't.parent_id=0',
			),
            'lang_country' => array(
				'condition' => 't.parent_id=0',
			),
        );
    }
    public function beforeSave() {
		if ( parent::beforeSave() ) {
			if ( $this->isNewRecord ) {
				$this->owner_id = Yii::app()->user->getState('id_user');
			}

			$this->created_at = date("y-m-d h:i:s");
		}

		return true;
	}
    public function afterSave() {   
        //if ( $this->disable_events ) return true;
        // add images
        if ( getPost('images') ) {
            if ( !isset($this->images) ) {
    				$this->images = new Images;
    			}
            $this->images->attributes = getPost('images');
            
    		$this->images->object_id = $this->id;
    		$this->images->object_type = 'C'; // C là category
            $this->images->created_at = date("y-m-d h:i:s");
            $this->images->type='M';
    		$this->images->save();
        }
       
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'id_path' => 'Id Path',
			'owner_id' => 'Owner',
			'status' => 'Status',
			'cate_name' => 'Cate Name',
			'seo_title' => 'Seo Title',
			'seo_description' => 'Seo Description',
			'description' => 'Description',
			'product_count' => 'Product Count',
			'seo_keywords' => 'Seo Keywords',
			'search_keys' => 'Search Keys',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'priority' => 'Priority',
			'show_in_menu' => 'Show In Menu',
			'revision' => 'revision',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('id_path',$this->id_path,true);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('cate_name',$this->cate_name,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('product_count',$this->product_count);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('search_keys',$this->search_keys,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('show_in_menu',$this->show_in_menu);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public static function getCategoriesTree($add_root = false,$lang_code,$cate_type='',$cate_id=0) {
	   
        $s='t.id is not null';
		if($cate_type) $s.=" and t.cate_type='".$cate_type."'";
		if($cate_id) $s.=" and concat('/',t.id_path,'/') like '%/$cate_id/%' ";
		$_categories = app()->db->createCommand()
					->select('t.id, lv.name as cate_name, t.parent_id, t.id_path, t.product_count, t.status')
					->from('{{category}} t') 
                    ->leftjoin('{{language_value}} lv', 't.id = lv.object_id')
					->where($s ." AND status = 1 AND lv.lang_code='{$lang_code}' AND lv.object_type='C'")->order(array('priority ASC'))->queryAll();
		
		if ( !empty($_categories) ) 
		{
			$categories = array();
			foreach ($_categories as $cat) {
				$categories[$cat['id']] = $cat;
			}
            //var_dump($categories);
			unset($_categories);

			$tmp = array();

			foreach ($categories as $k => $v) {
				$path = explode('/', $v['id_path']);
				$category_path = array();
				foreach ($path as $__k => $__v) {
					if(empty($categories[$__v]))continue;
					$category_path[$__v] = @$categories[$__v]['cate_name'];
				}
				$v['category_path'] = implode('/', $category_path);
				$v['level'] = substr_count($v['id_path'], "/");
				$tmp[$v['level']][$v['id']] = $v;
			}

			ksort($tmp, SORT_NUMERIC);
			$tmp = array_reverse($tmp);
			//var_dump($tmp);
			foreach ($tmp as $level => $v) {
				foreach ($v as $k => $data) {
					if (isset($tmp[$level + 1][$data['parent_id']])) {
						$tmp[$level + 1][$data['parent_id']]['subcategories'][] = $tmp[$level][$k];
						unset($tmp[$level][$k]);
					}
				}
			}

			$tmp = array_pop($tmp);
		} else {
			$tmp = array();
		}

		if ( $add_root ) {
			array_unshift($tmp, array('id' => 0, 'cate_name' => $add_root));
		}

		return $tmp;
	}
    public static function getCategoriesList($add_root = false,$lang_code,$cate_type='',$cate_id=0) {
		$tree = self::getCategoriesTree($add_root,$lang_code,$cate_type,$cate_id);
		//var_dump($tree);
		$categories = self::_buildList($tree);

		return $categories;
	}

	private static function _buildList($categories, $level = 0) {
		$tmp = array();
		foreach ($categories as $category) {
			$tmp["{$category['id']}"] = str_repeat('- ', $level) . $category['cate_name'];

			if ( isset($category['subcategories']) && !empty($category['subcategories']) ) {
				$tmp = $tmp + self::_buildList($category['subcategories'], $level + 1);
			}
		}

		return $tmp;
	}
    public static function getIdPath($id) {
		$category = app()->db->createCommand()
			->select('id_path')
			->from('{{category}}')
			->where('id=:category_id', array(':category_id' => $id))
			->queryRow();

		return $category['id_path'];
	}
}
