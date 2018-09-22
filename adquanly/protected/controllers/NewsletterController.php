<?php

class NewsletterController extends Controller
{
	public function actionIndex()
	{
		$this->menu='newsletter';
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
		));
        $total_recorde=Newsletter::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Newsletter::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
		
	   $this->render('index',array('list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages));
	}
	public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Newsletter::model()->deleteByPk($_REQUEST['id']))
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