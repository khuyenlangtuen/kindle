<?php

class BannersController extends Controller
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
		$position="partner";
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*10;
        $obj=array('limit'=>10,'offset'=>$page);
	   $this->menu='banner';
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $criteria->addCondition('t.position !=:position');
			$criteria->params[':position'] = $position;
        $total_recorde=Banners::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Banners::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=10;
	   $this->render('index',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages));
	}
	public function actionPartner()
	{
		$position="partner";
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*10;
        $obj=array('limit'=>10,'offset'=>$page);
	   $this->menu='banner';
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $criteria->addCondition('t.position=:position');
			$criteria->params[':position'] = $position;
        $total_recorde=Banners::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Banners::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=10;
	   $this->render('partner',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages));
	}
	public function actionFormaddpart()
	{
	   $this->menu='banner';
       $model = new Banners;
       $model->images=new Images;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
               
				if ( $model->save() ) {
				    Images::attachImagePair('images', 'banner', $model->id);
                     // add ngon ngu
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->id;
                    		$language->object_type = 'B'; // P là Product
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('formupdatepart', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('banners/formaddpart');
       $title=t('Đối tác');
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form_partner',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
       
       
	}
    public function actionFormupdatepart()
	{
	   $this->menu='banner';
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Banners::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
					$model->save();
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'banner', $model->id);
                    }
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'B','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdatepart', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('banners/formupdatepart',array('id'=>$id));
           $title=t('Đối tác');
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Banners::model()->find($criteria);
    	   $this->render('form_partner',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
           
        }
       
       
	}
    public function actionFormadd()
	{
	   $this->menu='banner';
       $model = new Banners;
       $model->images=new Images;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
               
				if ( $model->save() ) {
				    Images::attachImagePair('images', 'banner', $model->id);
                     // add ngon ngu
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->id;
                    		$language->object_type = 'B'; // P là Product
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('formupdate', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('banners/formadd');
       $title=t('Add new banner');
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
       
       
	}
    public function actionFormupdate()
	{
	   $this->menu='banner';
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Banners::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
					$model->save();
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'banner', $model->id);
                    }
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'B','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdate', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('banners/formupdate',array('id'=>$id));
           $title=t('update banner');
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Banners::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
           
        }
       
       
	}
     public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Banners::model()->deleteByPk($_REQUEST['id']))
			{
			     LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'B'));
                 Images::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'B'));
				echo "1";
             }
        }
    }
    public function actionUpdateStatus()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Banners::model()->findByPk($_REQUEST['id']);
            $model->status=$_REQUEST['status'];
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