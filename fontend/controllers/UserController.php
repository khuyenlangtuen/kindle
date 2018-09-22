<?php
class UserController extends Controller
{
	
	public function actionLogin()
	{
		$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>DModels::get_general('login',$_SESSION['language'],true))
			);
		if(app()->request->isPostRequest)
		{
			$model=new User;
			$record = $model->findByAttributes(array('username'=>$_POST['item']['username']));
			if($record)
			{
				$record1 = $model->findByAttributes(array('password'=>md5($_POST['item']['password']),'username'=>$_POST['item']['username']));
				if($record1)
				{
					Yii::app()->user->setState('username', $record->username);
	    			Yii::app()->user->setState('user_id', $record1->id);
	    			Yii::app()->user->setState('password', $record1->password);
	    			//die(Yii::app()->user->returnUrl);
					$this->redirect(Yii::app()->user->returnUrl);
					//app()->exit;
				}
				else{
					$this->redirect(array('user/thongbao','tb'=>-1));
				}
			}
			else{
					$this->redirect(array('user/thongbao','tb'=>-2));
				}
		}
		else{
			$this->render('login');
		}
		
	}
	public function actionCheckuser()
	{
		if(isset($_REQUEST['username']))
		{
			$record = User::model()->findByAttributes(array('username'=>$_REQUEST['username']));
			if(!empty($record)){
				die("1");
			}
			else die("-1");
		}
		else{
			die("0");
		}
		die("-2");
	}
	public function actionCheckemail()
	{

		if(isset($_REQUEST['email']))
		{
			$record = User::model()->findByAttributes(array('email'=>$_REQUEST['email']));
			if(!empty($record)){
				die("1");
			}
			else die("-1");
		}
		else{
			die("0");
		}
		die("-2");
	}
	public function actionThongbao()
	{
		if(isset($_REQUEST['tb']))
		{
			$mess="";
			if($_REQUEST['tb']==-1)
			{
				$mess=t("password not correct");
			}
			if($_REQUEST['tb']==-2)
			{
				$mess=t("username not correct");
			}
			$this->render('thongbao',array('mess'=>$mess));
		}
		else{
			$this->redirect(array('site/index'));
		}
	}
	public function actionGetDistrict()
	{
		if($_REQUEST['id'])
		{
			$list=DModels::get_list_district_by_id($_REQUEST['id']);
			$this->renderPartial('district',array('list'=>$list));
		}
	}
	public function actionGetWard()
	{
		if($_REQUEST['id'])
		{
			$list=DModels::get_list_ward_by_districtid($_REQUEST['id']);
			$this->renderPartial('ward',array('list'=>$list));
		}
	}
	public function actionRegister()
	{
		DModels::Taocode();
		$title=t('register');
		$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$title)
			);
		$mess="";
		if ( app()->request->isPostRequest ) 
		{
			if(!empty($_POST['item']))
			{
				$record = User::model()->findByAttributes(array('username'=>$_POST['item']['username']));
				if(empty($record))
				{   
					$record = User::model()->findByAttributes(array('email'=>$_POST['item']['email']));
					if(empty($record))
					{
						$model = new User;
						$model->attributes=$_POST['item'];
						$model->password=md5($_POST['item']['password']);
						$model->ip_address=Yii::app()->request->userHostAddress;
						$model->created_at=date('Y-m-d h:i:s');
						if ( $model->save() ) {
							$mess=DModels::get_general('register_success',$_SESSION['language'],true);
							
						}
					}
					else{
						$mess=DModels::get_general('lang_errors_email_exist',$_SESSION['language'],true);	
					}
					
				}
				else{
					$mess=DModels::get_general('lang_errors_username_exist',$_SESSION['language'],true);	
				}
				
			}
		}
		$this->render('register',array("mess"=>$mess));

	}
	public function actionLogout()
	{
		Yii::app()->user->clearStates();
		
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionForgetpass()
	{
		if ( app()->request->isPostRequest ) {
			$model = User::model()->findByAttributes(array('email'=>$_POST['email']));
			if(!empty($model))
			{

				$new_pass=DModels::generatePassword();
				
				$model->password=md5($new_pass);
				if($model->save())
				{
					$sub="Mật khẩu mới của bạn tại Cơ khí Quốc Ký";
					$layout_name="forgot_password";
					$content=array("user_name"=>$model->username,"new_pass"=>$new_pass,"login_url"=>"","home_link"=>"");
					$kq=DModels::sendmail($sub,$model->email,$layout_name,$content);
				
					if($kq==1)
						$this->redirect(array('/user/login'));
					else{
						$this->render('forgetpass',array("mess"=>json_encode($kq)));
					}
				}
				else{
					$errors=DModels::get_general('errors_system',$_SESSION['language'],true);
					$this->render('forgetpass',array("mess"=>$errors));
				}
				
			}
			else{
				$errors=DModels::get_general('email_not_exist',$_SESSION['language'],true);
				$this->render('forgetpass',array("mess"=>$errors));
			}

		}
		else{
			$this->render('forgetpass');
		}
		
	}
	public function actionProfile()
	{
		$user_id = (app()->user->getState('user_id')) ? app()->user->getState('user_id'):0;
		if($user_id)
		{
			$model = User::model()->findByPk($user_id);
			$title=DModels::get_general('information_account',$_SESSION['language'],true);
			$this->breadcrumbs=array(
					array('name' => t('Home'), 'url' => array('site/index')),
					array('name' =>$title)
				);
			$page = (isset($_GET['page']) ? $_GET['page'] : 1);
	        if($page >= 1) $page=($page-1)*param('limit_on_page');
	        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
	       $criteria = new CDbCriteria(array(
				'order' => 't.created_at DESC',
			));
			$criteria->addCondition('t.user_id=:user_id');
			$criteria->params[':user_id'] = $user_id;
			
	        $total_recorde=Orders::model()->count($criteria);
	        
	        $criteria->offset = $obj['offset'];
	        $criteria->limit=$obj['limit'];
	        
			$list_order = Orders::model()->findAll($criteria);
			$this->render('profile',array("data"=>$model,"list_order"=>$list_order));
		}
		else{
			$this->redirect(array('site/index'));
		}
		
	}
	public function actionUpdateprofile()
	{
		if ( app()->request->isPostRequest ) {
			$user_id = (app()->user->getState('user_id')) ? app()->user->getState('user_id'):0;
			if($user_id)
			{
				$model = User::model()->findByPk($user_id);
				$model->attributes=$_POST['item'];
				if($model->save())
				{
					die("1");
				}
				else{
					die("-1");
				}
			}
			else{
				die("-2");
			}
		}
		
		
	}
	public function actionChangepass()
	{
		if ( app()->request->isPostRequest ) {
			$user_id = (app()->user->getState('user_id')) ? app()->user->getState('user_id'):0;
		//	var_dump(DModels::check_old_pass(md5($_REQUEST['item']['old_pass']),$user_id));
		//	die(DModels::check_old_pass(md5($_REQUEST['item']['old_pass']),$user_id));
			if(empty($_REQUEST['item']['old_pass'])) die("-1");
			else if(!DModels::check_old_pass(md5($_REQUEST['item']['old_pass']),$user_id)) die("-2");
			else if(empty($_REQUEST['item']['new_pass'])) die("-3");
			else if(empty($_REQUEST['item']['confirm_pass'])) die("-4");
			else if($_REQUEST['item']['new_pass']!=$_REQUEST['item']['confirm_pass']) die("-5");
			else{
				$model = User::model()->findByPk($user_id);
				$model->password=md5($_REQUEST['item']['confirm_pass']);
				if($model->save())
				{
					die("1");
				}
				else{
					die("-6");
				}
			}
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