<?php

class SiteController extends Controller
{
    
	public function actionIndex()
	{
		
		$this->isBannerMain=true;
		$menu_info=DModels::get_cate_by_seo_name('trang-chu',$_SESSION['language']);
		$pageTitle=($menu_info['seo_title']) ? $menu_info['seo_title'] : $menu_info['name'];
		$this->pageTitle($pageTitle);
		$tin_cuoc_doi=DModels::get_one_content_by_id_cate(1);
		$this->seo_data = array(
				'description' => $menu_info['seo_description'],
				'keywords' => $menu_info['seo_keywords'],
				'og:title' => $pageTitle,
				'og:url' => '',
				'og:description' => $menu_info['seo_description'],
				'og:image' => Yii::app()->getRequest()->getHostInfo().$menu_info['thumb_image'],
			);
       $this->render('index',array("tin_cuoc_doi"=>$tin_cuoc_doi));
	}
	public function actionLang()
	{
		if(isset($_REQUEST["lg"])  && $_REQUEST["lg"]!='')
		{
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
	public function actionFind()
	{
		$this->breadcrumbs=array(

        	array('name' => t('Home'), 'url' => array('site/index')),
        	array('name' =>t('search result') )
        );
		$search=getParam('q');
		 $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('main_image_pair','content'),
		));
        $criteria->addCondition('t.lang_code=:lang');
		$criteria->params[':lang'] =$_SESSION['language'];
        if(!empty($search))
        {
            $criteria->addSearchCondition('t.name',$search);
           /* $criteria->addSearchCondition('t.short_description',$search,true,"OR");
             $criteria->addSearchCondition('t.description',$search,true,"OR");*/
            
        }
		$criteria->addInCondition('t.object_type',array('P','T','F'));
        $total_recorde=LanguageValue::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = LanguageValue::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
		$this->render('find',array('list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,"search"=>$search));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	public function actionNewsletter()
	{
		if ( app()->request->isPostRequest ) 
		{
			if(!empty($_POST['item']))
			{
				app()->db->createCommand()->delete("{{newsletter}}", "email=:email", array(':email' => $_POST['item']['email']));
				$model = new Newsletter;
				$model->attributes=$_POST['item'];
				$model->created_at=date('Y-m-d h:i:s');
				if ( $model->save() ) {
					$this->redirect(array('/site/thankyou'));
				}
			}
		}
	}
	public function actionThankyou()
	{
		$this->render('thankyou');
	}
	public function actionClearcache()
	{
		Yii::app()->cache->flush();
		$this->redirect(array('/site/index'));
	}
}