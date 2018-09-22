<?php

class HoidapController extends Controller
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
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*10;
        $obj=array('limit'=>10,'offset'=>$page);
	   $this->menu='Hoidap';
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $filter=array();
		if(isset($_POST['filter']))
		{
            $filter=$_POST['filter'];
			if($_POST['filter']['short_description']!="")
			{
				$criteria->addCondition("language.short_description like :l_short_description");
				$criteria->params[':l_short_description'] = "%".$_POST['filter']['short_description']."%";
			}
			if($_POST['filter']['description']!="")
			{
				$criteria->addCondition("t.description like :description");
				$criteria->params[':description'] = "%".$_POST['filter']['description']."%";
			}
			
		}
        
        $total_recorde=Faqs::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Faqs::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=10;
	   $this->render('index',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,'filter'=>$filter));
	}
    public function actionFormadd()
	{
	   $this->menu='Hoidap';
       $model = new Faqs;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
               
				if ( $model->save() ) {
                     // add ngon ngu
                      Images::attachImagePair('images', 'faq', $model->id);
                    
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->id;
                    		$language->object_type = 'F'; // setting chung
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('formupdate', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('Hoidap/formadd');
       $title=t('Add new Hoidap');
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
       
       
	}
    public function actionFormupdate()
	{
	   $this->menu='Hoidap';
       $id = getQuery('id');
		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Faqs::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
					$model->save();
					if ( getPost('images') ) {
                        Images::updateImagePair('images', 'faq', $model->id);
                    }
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'F','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            $language->updated_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdate', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('Hoidap/formupdate',array('id'=>$id));
           $title=t('update Hoidap');
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Faqs::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
           
        }
	}
     public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Faqs::model()->deleteByPk($_REQUEST['id']))
			{
				LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'F'));
				echo "1";
             }
        }
    }
    public function actionUpdateStatus()
    {
        if(isset($_REQUEST['id']))
        {
            $model=Faqs::model()->findByPk($_REQUEST['id']);
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