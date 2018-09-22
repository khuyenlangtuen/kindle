<?php

class ContactController extends Controller
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
		$this->menu='lienhe';
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
		));
        $total_recorde=Contact::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Contact::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $id=1;
        
        if ( getPost('lang') ) {
            
                $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'S','lang_code'=>Yii::app()->user->getState('lang')));
                $language->attributes = getPost('lang');
                $language->updated_at = date("y-m-d H:i:s");
                $language->save();
            
        }
		$lang=Language::model()->findAll();
		$link=CController::CreateUrl('contact/index');	
		$criteria = new CDbCriteria(array(
    			'with' => array('language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = General::model()->find($criteria);
		$lang=Language::model()->findAll();
		$link=CController::CreateUrl('contact/index');
	   $this->render('index',array('list'=>$list,"url"=>$link,'item_count'=>$total_recorde,'pages'=>$pages,"info"=>$info,'lang'=>$lang));
	}
	public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Contact::model()->deleteByPk($_REQUEST['id']))
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