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
 * @property string $seo_name
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
			array('parent_id, owner_id, status, product_count, priority, show_in_menu', 'numerical', 'integerOnly'=>true),
			array('id_path', 'length', 'max'=>100),
			array('cate_type, seo_name', 'length', 'max'=>500),
			array('created_at, updated_at,tinh_trang,tac_gia,loai', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, id_path, owner_id, status, cate_type, product_count, created_at, updated_at, priority, show_in_menu, seo_name', 'safe', 'on'=>'search'),
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
			'cate_type' => 'Cate Type',
			'product_count' => 'Product Count',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'priority' => 'Priority',
			'show_in_menu' => 'Show In Menu',
			'seo_name' => 'Seo Name',
			'loai' => 'loai',
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
		$criteria->compare('cate_type',$this->cate_type,true);
		$criteria->compare('product_count',$this->product_count);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('show_in_menu',$this->show_in_menu);
		$criteria->compare('seo_name',$this->seo_name,true);

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
    public static function getCategoriesTree($add_root = false,$lang_code,$cate_type='',$cate_id=0,$limit=0) {
	   
        $s='t.id is not null ';
        if($cate_type) $s.=' and cate_type="'.$cate_type.'"';
        if($cate_id) $s.=" and concat('/',t.id_path,'/') like '%/$cate_id/%' ";
		$command = app()->db->createCommand()
					->select('t.id, lv.name as cate_name, t.parent_id, t.id_path, t.product_count, t.status')
					->from('{{category}} t') 
                    ->join('{{language_value}} lv', 't.id = lv.object_id')
					->where($s ." AND status = 1 AND lv.lang_code='{$lang_code}' AND lv.object_type='C'");
		if($limit > 0)
		{
			$command->limit($limit);
		}			
		$command->order(array('priority ASC'));
		$_categories=$command->queryAll();
		
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
    public static function getCategoriesList($add_root = false,$lang_code,$cate_type,$cate_id) {
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
    public static function getMenuCategories($limit = 8, $parent_id = 0,$lang='vn') {
        //$s='t.id is not null and t.cate_type="'.$cate_type.'"';
		$s='t.id is not null';
		$command = app()->db->createCommand()
			->select('t.id as category_id, t.parent_id, t.id_path, lv.name as category')
			->from('{{category}} t')
			->leftJoin('{{language_value}} lv', 'lv.object_id=t.id AND lv.object_type="C"')
			->where($s.' AND t.status=:status and lv.lang_code=:lang', array(':status' => 1,':lang'=>$lang))
			->order(array('t.priority ASC'));

		if ( $parent_id ) {
			$command->where("t.status=:status AND concat('/',t.id_path,'/') like '%/{$parent_id}/%' and lv.lang_code=:lang and t.id!={$parent_id}", array(':status' => 1,':lang'=>$lang));
		}
		
		$_categories = $command->queryAll();

		if ( !empty($_categories) )
		{
			$categories = array();
			foreach ($_categories as $cat) {
				$categories[$cat['category_id']] = $cat;
			}
			unset($_categories);

			$tmp = array();

			foreach ($categories as $k => $v) {
				$path = explode('/', $v['id_path']);
				$category_path = array();
				foreach ($path as $__k => $__v) {
					if(empty($categories[$__v]))continue;
					$category_path[$__v] = $categories[$__v]['category'];
				}
				$v['category_path'] = implode('/', $category_path);
				$v['level'] = substr_count($v['id_path'], "/");
				$tmp[$v['level']][$v['category_id']] = $v;
			}
			
			ksort($tmp, SORT_NUMERIC);
			$tmp = array_reverse($tmp);

			foreach ($tmp as $level => $v) {
				foreach ($v as $k => $data) {
					if (isset($tmp[$level + 1][$data['parent_id']])) {
						$tmp[$level + 1][$data['parent_id']]['subcategories'][] = $tmp[$level][$k];
						unset($tmp[$level][$k]);
					}
				}
			}

			$tmp = array_pop($tmp);
			//var_dump($tmp);
		} else {
			$tmp = array();
		}

		return $tmp;
	}
	public static function getMenuCategories_by_seo_name($limit = 8, $seo_name = "",$lang='vn') {
        //$s='t.id is not null and t.cate_type="'.$cate_type.'"';
		$s='t.id is not null';
		$command = app()->db->createCommand()
			->select('t.id as category_id, t.parent_id, t.id_path, lv.name as category')
			->from('{{category}} t')
			->leftJoin('{{language_value}} lv', 'lv.object_id=t.id AND lv.object_type="C"')
			->where($s.' AND t.status=:status and lv.lang_code=:lang', array(':status' => 1,':lang'=>$lang))
			->order(array('t.priority ASC'));

		if ( $seo_name ) {
			$command->where("t.status=:status AND t.seo_name=:seo_name and lv.lang_code=:lang", array(':status' => 1,':seo_name'=>$seo_name,':lang'=>$lang));
		}
		
		$_categories = $command->queryAll();

		if ( !empty($_categories) )
		{
			$categories = array();
			foreach ($_categories as $cat) {
				$categories[$cat['category_id']] = $cat;
			}
			unset($_categories);

			$tmp = array();

			foreach ($categories as $k => $v) {
				$path = explode('/', $v['id_path']);
				$category_path = array();
				foreach ($path as $__k => $__v) {
					if(empty($categories[$__v]))continue;
					$category_path[$__v] = $categories[$__v]['category'];
				}
				$v['category_path'] = implode('/', $category_path);
				$v['level'] = substr_count($v['id_path'], "/");
				$tmp[$v['level']][$v['category_id']] = $v;
			}
			
			ksort($tmp, SORT_NUMERIC);
			$tmp = array_reverse($tmp);

			foreach ($tmp as $level => $v) {
				foreach ($v as $k => $data) {
					if (isset($tmp[$level + 1][$data['parent_id']])) {
						$tmp[$level + 1][$data['parent_id']]['subcategories'][] = $tmp[$level][$k];
						unset($tmp[$level][$k]);
					}
				}
			}

			$tmp = array_pop($tmp);
			//var_dump($tmp);
		} else {
			$tmp = array();
		}

		return $tmp;
	}
}
