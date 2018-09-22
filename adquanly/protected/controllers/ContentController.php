<?php

class ContentController extends Controller
{
	public function init() {
		
        $lg = getQuery('lg');
        if(!empty($lg))
        {
            DModels::update_language($lg);
            Yii::app()->user->setState('lang', $lg);
        }
        else{
            $l=Language::model()->findByAttributes(array('status'=>1));
            Yii::app()->user->setState('lang', $l->lang_code);
        }
		parent::init();
	}
	public function actionIndex()
	{
		$this->menu="content";
	    $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language','category'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $filter=array();
        if(isset($_REQUEST))
        {
            
            if(isset($_REQUEST['name']) && ['name']!="")
            {
                $filter['name']=$_REQUEST['name'];
                $criteria->addCondition("language.name like :l_name");
                $criteria->params[':l_name'] = "%".$_REQUEST['name']."%";
            }
            if(isset($_REQUEST['cate_id']) && $_REQUEST['cate_id']!="" && $_REQUEST['cate_id']!=1)
            {
                $filter['cate_id']=$_REQUEST['cate_id'];
               $criteria->addCondition('t.id_cate=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
                $criteria->params[':cate_id'] =$_REQUEST['cate_id'];
                $criteria->params[':match1'] =$_REQUEST['cate_id']."/%";
                $criteria->params[':match2'] ="%/".$_REQUEST['cate_id']."/%";
            }
            
        }
        $total_recorde=Content::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Content::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
	   $this->render('index',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,"filter"=>$filter));
	}
	public function actionNews()
	{
		$_REQUEST['cate_id']=12;
		$this->menu="news";
	    $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language','category'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $filter=array();
        if(isset($_REQUEST))
        {
            
            if(isset($_REQUEST['name']) && ['name']!="")
            {
                $filter['name']=$_REQUEST['name'];
                $criteria->addCondition("language.name like :l_name");
                $criteria->params[':l_name'] = "%".$_REQUEST['name']."%";
            }
            if(isset($_REQUEST['cate_id']) && $_REQUEST['cate_id']!="" && $_REQUEST['cate_id']!=1)
            {
                $filter['cate_id']=$_REQUEST['cate_id'];
               $criteria->addCondition('t.id_cate=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
                $criteria->params[':cate_id'] =$_REQUEST['cate_id'];
                $criteria->params[':match1'] =$_REQUEST['cate_id']."/%";
                $criteria->params[':match2'] ="%/".$_REQUEST['cate_id']."/%";
            }
            
        }
        $total_recorde=Content::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Content::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
	   $this->render('news',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,"filter"=>$filter));
	}
	public function actionFormadd()
	{
	   $this->menu='content';
       $model = new Content;
       $model->images=new Images;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
               
				if ( $model->save() ) {
					if ( getPost('images') ) {
						Images::attachImagePair('images', 'content', $model->content_id);
					}
					else{
						$images=new Images;
						$images->object_id = $model->content_id;
						$images->object_type = 'T';
						$images->type = 'M';
						$images->created_at = date("y-m-d h:i:s");
						$images->save();
					}
                     // add ngon ngu
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->content_id;
                    		$language->object_type = 'T'; // T là noi dung
                            $language->created_at = date("y-m-d H:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    DModels::update_revision($model->id_cate);
					$this->redirect(array('formupdate', 'id' => $model->content_id));
				}
			}
		}
       $link=CController::CreateUrl('content/formadd');
       $title=t('Thêm mới bài viết');
       $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'content');
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$title,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
       
       
	}
	public function actionGioithieu()
	{
	   $this->menu='gioithieu';
       $id = 11;

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Content::model()->findByPk($id);
    			
					if(!empty($_POST['item']))
					{
						$model->attributes = $_POST['item'];
						$model->status=1;
						if($model->save())
						{
							DModels::update_revision($model->id_cate);
						}
						
					}
    				
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'content', $model->content_id);
                    }
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'T','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d H:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('gioithieu'));
    				
    			
    		}
            $link=CController::CreateUrl('content/gioithieu');
           $title=t('Giới thiệu');
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.content_id=:id');
			$criteria->params[':id'] = $id;
			$info = Content::model()->find($criteria);
    	   $this->render('form_gioithieu',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
           
        }
       
	}
	
	public function actionFormupdate()
	{
	   $this->menu='content';
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Content::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
					if(!empty($_POST['item']))
					{
						$model->attributes = $_POST['item'];
						if($model->save())
						{
							DModels::update_revision($model->id_cate);
						}
						
					}
    				
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'content', $model->content_id);
                    }
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'T','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                           // if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdate', 'id' => $model->content_id));
    				
    			}
    		}
            $link=CController::CreateUrl('content/formupdate',array('id'=>$id));
           $title=t('Cập nhật bài viết');
           $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'content');
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.content_id=:id');
			$criteria->params[':id'] = $id;
			$info = Content::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$title,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
           
        }
       
       
	}
	public function actionFormaddnews()
	{
	   $this->menu='addnews';
       $model = new Content;
       $model->images=new Images;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
               
				if ( $model->save() ) {
					if ( getPost('images') ) {
						Images::attachImagePair('images', 'content', $model->content_id);
					}
					
                     // add ngon ngu
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->content_id;
                    		$language->object_type = 'T'; // T là noi dung
                            $language->created_at = date("y-m-d H:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    DModels::update_revision($model->id_cate);
					$this->redirect(array('formupdatenews', 'id' => $model->content_id));
				}
			}
		}
       $link=CController::CreateUrl('content/formaddnews');
       $title=t('Thêm mới bài viết');
       $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'content',12);
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form_news',array('url'=>$link,'title'=>$title,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
       
       
	}
	public function actionFormupdatenews()
	{
	   $this->menu='addnews';
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Content::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
					if(!empty($_POST['item']))
					{
						$model->attributes = $_POST['item'];
						if($model->save())
						{
							DModels::update_revision($model->id_cate);
						}
						
					}
    				
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'content', $model->content_id);
                    }
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'T','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                           // if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d H:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdatenews', 'id' => $model->content_id));
    				
    			}
    		}
            $link=CController::CreateUrl('content/formupdatenews',array('id'=>$id));
           $title=t('Cập nhật bài viết');
           $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'content',12);
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.content_id=:id');
			$criteria->params[':id'] = $id;
			$info = Content::model()->find($criteria);
    	   $this->render('form_news',array('url'=>$link,'title'=>$title,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
           
        }
       
       
	}
	public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Content::model()->deleteByPk($_REQUEST['id']))
			{
			     LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'T'));
                 Images::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'T'));
				echo "1";
             }
        }
    }
    public function actionUpdateStatus()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Content::model()->findByPk($_REQUEST['id']);
            $model->status=$_REQUEST['status'];
			if($_REQUEST['status']==1)
				$model->publish_at=date('Y-m-d h:i:s');
            if($model->save())
			{
				echo "1";
             }
        }
    }
    protected function afterRender($view, &$output) {
        $user_id=Yii::app()->user->getState('id_user');
        if(!$user_id)
        {
            $this->redirect(CController::createUrl('/dangnhap/index'));
        }
        else{
            $con=Yii::app()->controller->id;
            $ac=Yii::app()->controller->action->id;
            $hash = sprintf("%s_%s", $con, $ac);
            //die($hash);
            $abc=new DModels;
            if(!$abc->checkPerm($hash,$user_id))
            {
                die(t('Access Denied'));
            } 
            else return true;/**/
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
}