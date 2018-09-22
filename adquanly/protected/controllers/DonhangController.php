<?php

class DonhangController extends Controller
{
	
	public function actionIndex()
	{
		$this->menu='donhang';
		$filter=array("status2"=>"","fromdate"=>"","todate"=>"");
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
		));
		$criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
		if(isset($_POST['filter']))
			$filter=$_POST['filter'];
		if($filter['status2'])
		{
			$criteria->addCondition("t.status2 =:status2");
			$criteria->params[':status2'] = $filter['status2'];
		}
		else{
			$criteria->addCondition("t.status2 =:status2");
			$criteria->params[':status2'] = 2;
		}
		if($filter['fromdate']!="")
		{
			$criteria->addCondition("t.created_at > :fromdate");
			$criteria->params[':fromdate'] = $filter['fromdate']." 00:00:00";
		}
		if($filter['todate']!="")
		{
			$criteria->addCondition("t.created_at < :todate");
			$criteria->params[':todate'] = $filter['todate']." 23:59:59";
		}
			
        $total_recorde=Orders::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Orders::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
		
	   $this->render('index',array('list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,'status'=>1,"filter"=>$filter,"type"=>"index"));
	}
	public function actionBaogia()
	{
		$this->menu='baogia';
		$filter=array("status2"=>"","fromdate"=>"","todate"=>"");
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
		));
		$criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 2;
		if(isset($_POST['filter']))
			$filter=$_POST['filter'];
		if($filter['status2'])
		{
			$criteria->addCondition("t.status2 =:status2");
			$criteria->params[':status2'] = $filter['status2'];
		}
		else{
			$criteria->addCondition("t.status2 =:status2");
			$criteria->params[':status2'] = 2;
		}
		if($filter['fromdate']!="")
		{
			$criteria->addCondition("t.created_at > :fromdate");
			$criteria->params[':fromdate'] = $filter['fromdate']." 00:00:00";
		}
		if($filter['todate']!="")
		{
			$criteria->addCondition("t.created_at < :todate");
			$criteria->params[':todate'] = $filter['todate']." 23:59:59";
		}
        $total_recorde=Orders::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Orders::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
	   $this->render('index',array('list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,'status'=>2,"filter"=>$filter,"type"=>"baogia"));
	}
	
	public function actionViewDetail()
	{
		if(isset($_REQUEST['id_dh']))
		{
			$order_info = Orders::model()->findByPk($_REQUEST['id_dh']);
			$this->renderPartial('view',array('order_info'=>$order_info));
		}
	}
	public function actionViewDetail2()
	{
		if(isset($_REQUEST['id_dh']))
		{
			$order_info = Orders::model()->findByPk($_REQUEST['id_dh']);
			$this->renderPartial('view2',array('order_info'=>$order_info));
		}
	}
	public function actionUpdateStatus()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Orders::model()->findByPk($_REQUEST['id']);
            $model->status2=$_REQUEST['status'];
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