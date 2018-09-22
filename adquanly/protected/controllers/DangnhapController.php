<?php

class DangnhapController extends Controller
{
    public $layout = '//layouts/login';
	public function actionIndex()
	{
		$this->render('index');
	}
    public function actionLogin()
    {
        $model=new Adminuser;
        // collect user input data
		if(isset($_POST['login']))
		{
		      //var_dump($_POST['login']);die();
            $record = $model->findByAttributes(array('username'=>$_POST['login']['username']));
			if($record){
				$record1 = $model->findByAttributes(array('password'=>md5($_POST['login']['password']),'username'=>$_POST['login']['username']));
				if($record1)
				{
				    Yii::app()->user->setState('id_user', $record1->id);
        			Yii::app()->user->setState('role', $record1->role);
        			Yii::app()->user->setState('username_admin', $record1->username);
				    $this->redirect(CController::createUrl('/content/gioithieu'));
                }
            }
		}
		// display the login form
		$this->render('index');
    }
    public function actionLogout()
    {
        Yii::app()->user->logout();
		$this->redirect(array('index'));
    }
	
}