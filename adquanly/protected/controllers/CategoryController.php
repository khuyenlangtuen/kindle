<?php

class CategoryController extends Controller
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
	   Yii::app()->user->setState('cate_kind', 'product');
	   $this->menu='demuc';
        $cid = getPost('cid');

		$criteria = new CDbCriteria(array(
			'order' => 't.priority ASC',
			'with' => array('subcats','language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
		if ( $cid != 0 ) {
			$criteria->addCondition('t.parent_id=:parent_id');
			$criteria->params[':parent_id'] = $cid;
		} else {
			$criteria->scopes = array('level_1');
		}
        $criteria->addCondition('t.cate_type=:cate_type');
		$criteria->params[':cate_type'] = 'product';
		$model = Category::model()->findAll($criteria);
        $lang=Language::model()->findAll();
        $link=CController::CreateUrl('category/index');
        if ( app()->request->isAjaxRequest ) {
            $this->renderPartial('indexAjax', array(
            'model'=>$model
            ));
        } else {
            $this->render('index',array('model'=>$model,'lang'=>$lang,'url'=>$link));
        }
		
	}
    public function actionContent()
	{
	   Yii::app()->user->setState('cate_kind', 'content');
	   $this->menu='demuc_content';
        $cid = getPost('cid');

		$criteria = new CDbCriteria(array(
			'order' => 't.priority ASC',
			'with' => array('subcats','language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
		if ( $cid != 0 ) {
			$criteria->addCondition('t.parent_id=:parent_id');
			$criteria->params[':parent_id'] = $cid;
		} else {
			$criteria->scopes = array('level_1');
		}
        $criteria->addCondition('t.cate_type=:cate_type');
		$criteria->params[':cate_type'] = 'content';
		$model = Category::model()->findAll($criteria);
        $lang=Language::model()->findAll();
        $link=CController::CreateUrl('category/content');
        if ( app()->request->isAjaxRequest ) {
            $this->renderPartial('indexAjax', array(
            'model'=>$model
            ));
        } else {
            $this->render('index',array('model'=>$model,'lang'=>$lang,'url'=>$link));
        }
		
	}
	 public function actionMenu()
	{
		Yii::app()->user->setState('cate_kind', 'content');
	   $this->menu='menu';
        $cid = getPost('cid');

		$criteria = new CDbCriteria(array(
			'order' => 't.priority ASC',
			'with' => array('subcats','language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
		if ( $cid != 0 ) {
			$criteria->addCondition('t.parent_id=:parent_id');
			$criteria->params[':parent_id'] = $cid;
		} else {
			$criteria->scopes = array('level_1');
		}
		$model = Category::model()->findAll($criteria);
        $lang=Language::model()->findAll();
        $link=CController::CreateUrl('category/menu');
        if ( app()->request->isAjaxRequest ) {
            $this->renderPartial('indexAjax', array(
            'model'=>$model
            ));
        } else {
            $this->render('index',array('model'=>$model,'lang'=>$lang,'url'=>$link));
        }
		
	}
        
    public function actionFormadd()
	{
	   $ac=Yii::app()->user->getState('cate_kind');
       if($ac=="content")
       {
             $this->menu='menu';
            $cate_type="content";
            $back_link=CController::CreateUrl('category/menu');
            $add_new_cate_name=t('add_new_category_content');
            $cate_title=t('Category content');
       }
       else{
            $this->menu='demuc';
            $cate_type="product";
            $back_link=CController::CreateUrl('category/index');
             $add_new_cate_name=t('add_new_category_product');
            $cate_title=t('Category product');
       }
	   
       $model = new Category;
       $model->images=new Images;
       
       if ( app()->request->isPostRequest ) {
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
                $model->seo_name=D_Untils::generateUrlSlug($_POST['lang']['name']);
                $model->cate_type=$cate_type;
                
				if ( $model->save() ) {
				    
				    if ( getPost('images') ) {
						Images::attachImagePair('images', 'origin', $model->id);
					}
					else{
						$images=new Images;
						$image->object_id = $model->id;
						$image->object_type = 'C';
						$image->type = 'M';
						$image->created_at = date("y-m-d H:i:s");
					}
					if ( $model->parent_id == 0 ) {
						$model->id_path = $model->id;
					} else {
						$id_path = $model->getIdPath($model->parent_id);
						$model->id_path = $id_path . '/' . $model->id;
					}
					$model->save();
                     // add ngon ngu
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = $model->seo_name;
                    		$language->object_id = $model->id;
                    		$language->object_type = 'C'; // C là category
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('formupdate', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('category/formadd');
       $categories = Category::getCategoriesList(t('Root'),Yii::app()->user->getState('lang'),$cate_type);
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$add_new_cate_name,'categories'=>$categories,'info'=>$info,'lang'=>$lang,'back_link'=>$back_link,'cate_title'=>$cate_title));
        
       
	}
    public function actionFormupdate()
	{
	  $ac=Yii::app()->user->getState('cate_kind');
       if($ac=="content")
       {
             $this->menu='demuc_content';
            $cate_type="content";
            $back_link=CController::CreateUrl('category/menu');
            $add_new_cate_name=t('update_category_content');
            $cate_title=t('Category content');
       }
	   else if($ac=="product"){
            $this->menu='demuc';
            $cate_type="product";
            $back_link=CController::CreateUrl('category/index');
             $add_new_cate_name=t('update_category_product');
            $cate_title=t('Category product');
       }
	   else{
			$this->menu='menu';
            $cate_type="menu";
            $back_link=CController::CreateUrl('category/menu');
             $add_new_cate_name=t('Cập nhật menu');
            $cate_title=t('Đề mục menu');
	   }
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Category::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
                    $model->seo_name=D_Untils::generateUrlSlug($_POST['lang']['name']);
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'origin', $model->id);
                    }
					if ( $model->parent_id == 0 ) {
						$model->id_path = $model->id;
					} else {
						$id_path = $model->getIdPath($model->parent_id);
						$model->id_path = $id_path . '/' . $model->id;
					}
					
						
					$model->save();
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'C','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            //$language->seo_name = $model->seo_name;
							if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->id;
                    		$language->object_type = 'C'; // C là category
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('formupdate', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('category/formupdate',array('id'=>$id));
           $categories = Category::getCategoriesList(t('Root'),Yii::app()->user->getState('lang'),$cate_type);
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => 'language',
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Category::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$add_new_cate_name,'categories'=>$categories,'info'=>$info,'lang'=>$lang,'back_link'=>$back_link,'cate_title'=>$cate_title));
           
        }
       
       
	}
	public function actionTintuc()
	{
       
	   $cate_type="content";
	   $add_new_cate_name="";
	   $back_link="";
	   $cate_title="";
	   $this->menu='motanews';
       $id = 12;

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Category::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
                    $model->seo_name=D_Untils::generateUrlSlug($_POST['lang']['name']);
                    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'origin', $model->id);
                    }
					if ( $model->parent_id == 0 ) {
						$model->id_path = $model->id;
					} else {
						$id_path = $model->getIdPath($model->parent_id);
						$model->id_path = $id_path . '/' . $model->id;
					}
					
						
					$model->save();
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'C','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            //$language->seo_name = $model->seo_name;
							if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->id;
                    		$language->object_type = 'C'; // C là category
                            $language->created_at = date("y-m-d H:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('tintuc', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('category/tintuc');
           $categories = Category::getCategoriesList(t('Root'),Yii::app()->user->getState('lang'),$cate_type);
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => 'language',
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Category::model()->find($criteria);
    	   $this->render('form_news',array('url'=>$link,'title'=>$add_new_cate_name,'categories'=>$categories,'info'=>$info,'lang'=>$lang,'back_link'=>$back_link,'cate_title'=>$cate_title));
           
        }
       
       
	}
	public function actionChuyenmuc()
	{
		$this->menu='chuyenmuc';
        //$cid = getPost('cid');
		$cid=7;//chuyen muc sản phẩm;
		$criteria = new CDbCriteria(array(
			'order' => 't.priority ASC',
			'with' => array('subcats','language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
		if ( $cid != 0 ) {
			$criteria->addCondition('t.parent_id=:parent_id');
			$criteria->params[':parent_id'] = $cid;
		} else {
			$criteria->scopes = array('level_1');
		}
		$model = Category::model()->findAll($criteria);
        $lang=Language::model()->findAll();
        $link=CController::CreateUrl('category/chuyenmuc');
        if ( app()->request->isAjaxRequest ) {
            $this->renderPartial('indexAjax', array(
            'model'=>$model
            ));
        } else {
            $this->render('chuyenmuc',array('model'=>$model,'lang'=>$lang,'url'=>$link));
        }
	}
	public function actionCapnhatchuyenmuc()
	{
		$add_new_cate_name="Cập nhật chuyên mục sản phẩm";
	  $this->menu='themchuyenmuc';
       $id = getQuery('id');
	   $cate_type="san_pham";
	   $cate_id=7;
		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Category::model()->findByPk($id);
    			if( isset($_POST['item']) ) {
    				$model->attributes = $_POST['item'];
                    $model->seo_name=D_Untils::generateUrlSlug($_POST['lang']['name']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
				    if ( getPost('images') ) {
                        Images::updateImagePair('images', 'origin', $model->id);
                    }
					if ( $model->parent_id == 0 ) {
						$model->id_path = $model->id;
					} else {
						$id_path = $model->getIdPath($model->parent_id);
						$model->id_path = $id_path . '/' . $model->id;
					}
					
						
					$model->save();
                    if ( getPost('lang') ) {
                        
                            $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'C','lang_code'=>Yii::app()->user->getState('lang')));
                            $language->attributes = getPost('lang');
                            //$language->seo_name = $model->seo_name;
							if(Yii::app()->user->getState('lang')=='en')
                                $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                    		$language->object_id = $model->id;
                    		$language->object_type = 'C'; // C là category
                            $language->created_at = date("y-m-d h:i:s");
                            $language->save();
                        
                    }
					$this->redirect(array('capnhatchuyenmuc', 'id' => $model->id));
    				
    			}
    		}
            $link=CController::CreateUrl('category/capnhatchuyenmuc',array('id'=>$id));
           $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'',$cate_id);
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => 'language',
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Category::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$add_new_cate_name,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
           
        }
       
	}
	public function actionThemchuyenmuc()
	{
		$add_new_cate_name=t('Thêm chuyên mục sản phẩm');
	   $cate_type="san_pham";	
	   $this->menu='themchuyenmuc';  
       $model = new Category;
       $model->images=new Images;
       $cate_id=7;
       if ( app()->request->isPostRequest ) {
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
                $model->seo_name=D_Untils::generateUrlSlug($_POST['lang']['name']);
                $model->cate_type=$cate_type;
               
                
				if ( $model->save() ) {
				    
				    if ( getPost('images') ) {
						Images::attachImagePair('images', 'origin', $model->id);
					}
					else{
						$images=new Images;
						$image->object_id = $model->id;
						$image->object_type = 'C';
						$image->type = 'M';
						$image->created_at = date("y-m-d H:i:s");
					}
					if ( $model->parent_id == 0 ) {
						$model->id_path = $model->id;
					} else {
						$id_path = $model->getIdPath($model->parent_id);
						$model->id_path = $id_path . '/' . $model->id;
					}
					$model->save();
                     // add ngon ngu
                    if ( getPost('lang') ) {
                        
                        
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                            $language->seo_name = $model->seo_name;
                    		$language->object_id = $model->id;
                    		$language->object_type = 'C'; // C là category
                            $language->created_at = date("y-m-d H:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('capnhatchuyenmuc', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('category/themchuyenmuc');
       $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'',$cate_id);
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$add_new_cate_name,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
        
       
	}
    public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Category::model()->deleteByPk($_REQUEST['id']))
			{
			     LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'C'));
                 Images::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'C'));
				echo "1";
             }
        }
    }
    public function actionUpdateStatus()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Category::model()->findByPk($_REQUEST['id']);
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
	
}