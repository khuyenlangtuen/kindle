<?php

class SettingController extends Controller
{
	public function actionIndex()
	{
		$this->menu='setting';
		$id=1;
		if(isset($_REQUEST['id']))
		{
			$id=$_REQUEST['id'];
		}
		$info = Setting::model()->findByPk($id);
		if(!empty($info))
		{
			$info=json_decode($info->setting_value);
		}
		$this->render('index',array('info'=>$info,"id"=>$id));
	}
	public function actionConfigemail()
	{
	   $this->menu='setting';
       if ( app()->request->isPostRequest ) {     
			if( isset($_POST['item']) ) {
				if($_POST['item']['id'])
				{
					$model = Setting::model()->findByPk($_POST['item']['id']);
					$model->setting_name="email";
					$model->setting_value=json_encode($_POST['item']);
	                
	                $model->updated_at=date("y-m-d h:i:s");
					if ( $model->save() ) {
						$this->redirect(array('index', 'id' => $model->id));
					}
				}
				else{
					$model = new Setting;
					$model->setting_name="email";
					$model->setting_value=json_encode($_POST['item']);
	                $model->created_at=date("y-m-d h:i:s");
					if ( $model->save() ) {
						$this->redirect(array('index', 'id' => $model->id));
					}
				}
				
			}
		}
	   $this->redirect(array('index'));
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