<?php

class GeneralController extends Controller
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
	   $this->menu='general';
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
			if($_POST['filter']['name']!="")
			{
				$criteria->addCondition("language.name like :l_name");
				$criteria->params[':l_name'] = "%".$_POST['filter']['name']."%";
			}
			if($_POST['filter']['position']!="")
			{
				$criteria->addCondition("t.position like :position");
				$criteria->params[':position'] = "%".$_POST['filter']['position']."%";
			}
			
		}
        
        $total_recorde=General::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = General::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=10;
	   $this->render('index',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,'filter'=>$filter));
	}
    public function actionFormadd()
	{
	   $this->menu='general';
       $model = new General;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
               
				if ( $model->save() ) {
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
                    		$language->object_type = 'S'; // setting chung
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('formupdate', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('general/formadd');
       $title=t('Add new general');
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
       
       
	}
    public function actionFormupdate()
	{
	   $this->menu='general';
       $id = getQuery('id');
		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = General::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
					$model->save();
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'S','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdate', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('general/formupdate',array('id'=>$id));
           $title=t('update general');
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = General::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$title,'info'=>$info,'lang'=>$lang));
           
        }
	}
     public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(General::model()->deleteByPk($_REQUEST['id']))
			{
				LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'S'));
				echo "1";
             }
        }
    }
    public function actionUpdateStatus()
    {
        if(isset($_REQUEST['id']))
        {
            $model=General::model()->findByPk($_REQUEST['id']);
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