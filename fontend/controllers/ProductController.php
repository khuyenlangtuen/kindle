<?php

class ProductController extends Controller
{
	public function actionIndex()
	{
		$cate_info=DModels::get_cate_by_cate_id(8,$_SESSION['language']);
		$this->redirect(array('cate','cate_id'=>$cate_info['c_id'],'title'=>$cate_info['seo_name']));
	}
    public function actionCate()
	{
	   $cate_id=getParam('cate_id');
	   $cate_info=DModels::get_cate_by_cate_id($cate_id,$_SESSION['language']);
	   $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
	   $this->menu='sanpham';
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('main_image_pair','language','category'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] =$_SESSION['language'];
        $criteria->addCondition('t.cate_id=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
		$criteria->params[':cate_id'] =$cate_id;
		$criteria->params[':match1'] ="$cate_id/%";
		$criteria->params[':match2'] ="%/$cate_id/%";
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Products::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $title=DModels::get_cate_by_cate_id($cate_id,$_SESSION['language']);
        $pair=(object)array('thumb_image'=>$title['thumb_image'],'image_x'=>$title['image_x'],'image_y'=>$title['image_y'],'id'=>$title['i_id']);
		$this->seo_data = array(
				'description' => $title['short_description'],
				'keywords' => $title['seo_keywords'],
				'og:title' => $title['name'],
				'og:url' => '',
				'og:description' => $title['short_description'],
				'og:image' => $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true, 'width' => 476, 'height' => 249), true),
			);
        
        $this->breadcrumbs=array(
        	array('name' => t('Home'), 'url' => array('site/index')),
        	array('name' =>t('san_pham'), 'url' => array('product/index')),
            array('name' =>$title['name'] )
        );
		$pagetitle=($title['seo_title']) ? $title['seo_title']:$title['name'];
		$this->pageTitle($pagetitle);
	   $this->render('index',array('list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,'title'=>$title['name'],"cate_info"=>$cate_info));
		
	   
	}
    public function actionAjaxproduct()
    {
        $cate_id=getParam('cate_id');
        $page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
	   $this->menu='sanpham';
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('main_image_pair','language','category'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] =$_SESSION['language'];
        if($cate_id > 0)
        {
             $criteria->addCondition('t.cate_id=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
			$criteria->params[':cate_id'] =$cate_id;
			$criteria->params[':match1'] ="$cate_id/%";
			$criteria->params[':match2'] ="%/$cate_id/%";
        }
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Products::model()->findAll($criteria);
        
		$pages=new MyPaginationAjax($total_recorde);
        $pages->pageSize=param('limit_on_page');
	   $this->renderPartial('//product/ajax/ajaxProduct',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages));
    }
    public function actionDetail()
    {
	    $this->menu='sanpham';
        if($_REQUEST['id'])
        {
            
			$info=DModels::get_product_by_id($_REQUEST['id'],$_SESSION['language']);
			$cate_name1=DModels::get_cate_by_cate_id($info['cate_id'],$_SESSION['language']);
			$cate_name=$cate_name1['name'];
			$cate_slug=D_Untils::generateUrlSlug($cate_name);
			$cate_path_arr=explode("/", $cate_name1['id_path']);
			if(count($cate_path_arr)>2)
			{
				$parent_cate=$cate_path_arr[count($cate_path_arr)-2];
				$parent_info=DModels::get_cate_by_cate_id($parent_cate,$_SESSION['language']);
        	    $title_slug_parent=D_Untils::generateUrlSlug($parent_info['name']);
				$this->breadcrumbs=array(
					array('name' => t('Home'), 'url' => array('site/index')),
					array('name' => $parent_info['name'], 'url' => array('product/cate','cate_id'=>$parent_cate,'title'=>$title_slug_parent)),
				    array('name' =>$cate_name,'url'=> array('product/cate','cate_id'=>$info['cate_id'],"title"=>$cate_slug,"parent_cate"=>$parent_cate,'title_parent'=>$title_slug_parent) ),
				    array('name' =>($info['name']) ? $info['name'] : '.............')
				);
			}
			else{
				$this->breadcrumbs=array(
					array('name' => t('Home'), 'url' => array('site/index')),
				    array('name' =>$cate_name,'url'=> array('product/cate','cate_id'=>$info['cate_id'],'title'=>$cate_slug) ),
				    array('name' =>($info['name']) ? $info['name'] : '.............')
				);
			}
			
			$pagetitle=($info['seo_title']) ? $info['seo_title']:$info['name'];
			$this->pageTitle($pagetitle);
            //var_dump($info);
			$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/product/detail',array('id'=>$_REQUEST['id'],'title'=>$info['seo_name']));
            $pair=(object)array('thumb_image'=>$info['thumb_image'],'image_x'=>$info['image_x'],'image_y'=>$info['image_y'],'id'=>$info['i_id']);
            $this->seo_data = array(
				'description' => $info['seo_description'],
				'keywords' => $info['seo_keywords'],
				'og:title' => $info['name'],
				'og:url' => $link_url,
				'og:description' => $info['seo_description'],
				'og:image' => $this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'product', 'no_link' => true, 'return_url' => true, 'width' => 476, 'height' => 249), true),
	    	);
			$list_image=DModels::get_list_image_by_product_id($_REQUEST['id']);
			$list_orther_product=DModels::get_product_relative_by_id($_REQUEST['id'],$cate_name1['c_id'],$_SESSION['language'],3);
            $this->render('detail',array('info'=>$info,'link_url'=>$link_url,"image_info"=>$pair,"cate_info"=>$cate_name1,"list_image"=>$list_image,"list_orther_product"=>$list_orther_product));
        }
        
    }
    

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	protected function afterRender($view, &$output) {
		//$this->redirect(array('landingpage/index'));
		/*$js="FB.Event.subscribe('edge.create', function(href, widget) {
	        fblogin();
	    });";
	    Yii::app()->facebook->addJsCallback($js);*/
    	
			Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
		
 	
      return parent::afterRender($view, $output);
	}
}