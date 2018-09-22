<?php

class GalleryController extends Controller
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
	   $this->menu='gallery';
       $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
		$lang=Language::model()->findAll();
        $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $total_recorde=Gallery::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$model = Gallery::model()->findAll($criteria);
        $pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
	   $this->render('index',array('lang'=>$lang,'model'=>$model,'item_count'=>$total_recorde,'pages'=>$pages));
	}
    public function actionFormadd()
	{
	   $this->menu='gallery';
       $model = new Gallery;
       $model->images=new Images;
       if ( app()->request->isPostRequest ) {
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
			}
                $model->save();
				/*if ( getPost('images') ) {
					Images::attachImagePair('images', 'Gallery', $model->id);
				}*/
				$path=Yii::getPathOfAlias('filemanager').'/source/';
				$album_folder='albums/id_'.$model->id;
				$album_path=$path.$album_folder;
				if ( !file_exists($album_path) ) mkdir($album_path, 0777, true);
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
						$language->object_type = 'AL'; // AL là album
						$language->created_at = date("y-m-d h:i:s");
						$language->save();
						
					}
					
				}
				$this->redirect(array('formupdate', 'id' => $model->id));
			
				
		}
       $link=CController::CreateUrl('gallery/formadd');
       $title=t('add_new_gallery');
	   $lang=Language::model()->findAll();
	   $this->render('form',array('lang'=>$lang,'url'=>$link,'title'=>$title));
       
       
	}
    public function actionFormupdate()
	{
	   $this->menu='gallery';
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
             
				$model = Gallery::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
				}
					$model->save();
                  /*  if ( getPost('images') ) {
                        Images::updateImagePair('images', 'Gallery', $model->id);
                    }*/
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'AL','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                            $language->updated_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdate', 'id' => $model->id));
    				
    			
    		}
            $link=CController::CreateUrl('gallery/formupdate',array('id'=>$id));
            $title=t('update_gallery');
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$lang=Language::model()->findAll();
			$info = Gallery::model()->find($criteria);
    	   $this->render('form',array('lang'=>$lang,'url'=>$link,'title'=>$title,'info'=>$info));
           
        }
       
       
	}
    public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
				if(Gallery::model()->deleteByPk($_REQUEST['id']))
				{
					 LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'AL'));
					// Images::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'AL'));
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