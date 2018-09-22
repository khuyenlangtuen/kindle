<?php

class QuantriController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
    public function actionGroup()
	{
	    $this->menu='group';
        $list=Admingroup::model()->findAll();
		$this->render('group',array('list'=>$list));
	}
	
    public function actionAddgroup()
	{
	    $this->menu='group';
         if(isset($_POST['item']))
        {
            $model= new Admingroup;
            $model->attributes=$_POST['item'];
			if($model->save())
			{
				$this->redirect(array('group'));
			}
            
        }
	}
    public function actionUpdate()
	{
	    $this->menu='group';
         if(isset($_POST['item']))
        {
            $model=Admingroup::model()->findByPk($_POST['item']['id']);
            $model->attributes=$_POST['item'];
			if($model->save())
			{
				$this->redirect(array('updategroup','id'=>$model->id));
			}
        }
	}
    public function actionUpdategroup()
	{
	    $this->menu='group';
        if(isset($_REQUEST['id']))
        {
            $info=Admingroup::model()->findByPk($_REQUEST['id']);
            $model = Admingroup::model()->getUsergroup($_REQUEST['id']);
            $privileges = Privileges::model()->findAllPrivileges();
            
            $this->render('updategroup',array('info'=>$info,'privileges'=>$privileges,'model'=>$model));
        }
        else{
            $this->redirect(array('group'));
        }
		
	}
    public function actionUpdateStatusGroup()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Admingroup::model()->findByPk($_REQUEST['id']);
            $model->status=$_REQUEST['status'];
            if($model->save())
			{
				echo "1";
             }
        }
    }
    public function actionDelGroup()
    {
        if(isset($_REQUEST['id']))
        {
            if(Admingroup::model()->deleteByPk($_REQUEST['id']))
			{
				echo "1";
             }
        }
    }
    public function actionUpdatePermission()
    {
        $id=getPost('group_id');
        $privileges = getPost('set_privileges');
        
        Privileges::model()->savePrivileges($privileges,$id);
	    $this->redirect(array('updategroup', 'id' => $id));

		
    }
    public function actionAdmin()
	{
	    $this->menu='admin';
        $list=Adminuser::model()->findAll();
		$this->render('admin',array('list'=>$list));
	}
	public function actionUser()
	{
	    $this->menu='user';
        $list=User::model()->findAll();
		$this->render('user',array('list'=>$list));
	}
    public function actionAddadmin()
	{
        if(isset($_POST['item']))
        {
            $model= new Adminuser;
            
            $model->attributes=$_POST['item'];
            $model->created_at=date("Y-m-d h:i:s");
            $model->password=md5($_POST['item']['password']);
			if($model->save())
			{
				$this->redirect(array('admin'));
			}
            
        }
	}
    public function actionUpdateadmin()
	{
        if(isset($_POST['item']))
        {
            $model=Adminuser::model()->findByPk($_POST['item']['id']);
            $pass='';
            if($model->password==$_POST['item']['password'])
            {
                $pass=$model->password;
            }
            else{
                $pass=md5($_POST['item']['password']);
            }
            $model->attributes=$_POST['item'];
            $model->updated_at=date("Y-m-d h:i:s");
            $model->password=$pass;
			if($model->save())
			{
				$this->redirect(array('admin'));
			}
            
        }
	}
    public function actionAdminDetail()
	{
	    $this->menu='admin';
        $arr_group_id=array();
        if(isset($_REQUEST['id']))
        {
            $info=Adminuser::model()->findByPk($_REQUEST['id']);
            $model=Admingroup::model()->findAllByAttributes(array('status'=>1));
            $arr_group_id=Adminuser::model()->get_adminGroup_link_by_idADMIN($_REQUEST['id']);
            $this->render('updateadmin',array('info'=>$info,'model' => $model,'arr_group_id'=>$arr_group_id));
        }
        else{
            $this->redirect(array('admin'));
        }
		
	}
    public function actionCheckEmailExist()
    {
        if(isset($_REQUEST['email']))
        {
            $record = Adminuser::model()->findByAttributes(array('username'=>$_REQUEST['email']));
            if($record)
			{
				echo "1";
             }
        }
    }
     public function actionUpdateStatusAdmin()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Adminuser::model()->findByPk($_REQUEST['id']);
            $model->status=$_REQUEST['status'];
            if($model->save())
			{
				echo "1";
             }
        }
    }
    public function actionDelAdmin()
    {
        if(isset($_REQUEST['id']))
        {
            if(Adminuser::model()->deleteByPk($_REQUEST['id']))
			{
				echo "1";
             }
        }
    }
    public function actionSetGroupForAdmin()
    {
        if(isset($_REQUEST['id_group']) && isset($_REQUEST['id_admin']) && isset($_REQUEST['type']))
        {
            if($_REQUEST['type']=='add')
            {
                $model=Adminuser::model()->setGroupForAdmin($_REQUEST['id_group'],$_REQUEST['id_admin']);
                if($model)
    			{
    				echo "1";
                 }
            }
            else{
                 $model=Adminuser::model()->setGroupForAdmin($_REQUEST['id_group'],$_REQUEST['id_admin'],'del');
                 if($model)
    			 {
    				echo "1";
                 }
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
    
}