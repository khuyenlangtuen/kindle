<?php

class ContentController extends Controller
{
	public function actionIndex()
	{
		$detail=DModels::get_one_content_by_id_cate(29,$_SESSION['language']);
		$this->redirect(array('detail','id'=>$detail['content_id'],'title'=>$detail['seo_name']));
	}
	public function actionGioithieu()
	{
		$detail=DModels::get_content_by_id(param('id_gioi_thieu'),$_SESSION['language']);
		$this->pageTitle($detail['name']);
		$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/gioithieu');
        
		$pair=(object)array('thumb_image'=>$detail['thumb_image'],'image_x'=>$detail['image_x'],'image_y'=>$detail['image_y'],'id'=>$detail['i_id']);
        
        $this->seo_data = array(
			'description' => $detail['short_description'],
			'keywords' => $detail['seo_keywords'],
			'og:title' => $detail['name'],
			'og:url' => $link_url,
			'og:description' => $detail['short_description'],
			'og:image' => $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true), true),
		);
		//$detail['description']=str_replace("../rfilemanager",Yii::app()->params['LINK_SOURCE_ANH'],$detail['description']);
		$this->render('gioithieu',array('detail'=>$detail,'link_url'=>$link_url));
		
	}
	public function actionDetail()
	{
		if(isset($_REQUEST['id']))
		{
			 //die($_REQUEST['id']);
			$cate_info=DModels::get_cate_name_by_content_id($_REQUEST['id'],$_SESSION['language']);
			//die($cate_info);
			$detail=DModels::get_content_by_id($_REQUEST['id'],$_SESSION['language']);
			$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$cate_info['name'], 'url' => array('content/index','id'=>$cate_info['id_cate'])),
				array('name' =>$detail['name'])
			);
			$this->pageTitle($detail['name']);
			$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/detail',array('catename'=>$cate_info['seo_name'],'id'=>$_REQUEST['id'],'title'=>$detail['seo_name']));
            
			$pair=(object)array('thumb_image'=>$detail['thumb_image'],'image_x'=>$detail['image_x'],'image_y'=>$detail['image_y'],'id'=>$detail['i_id']);
            $this->seo_data = array(
				'description' => $detail['seo_description'],
				'keywords' => $detail['seo_keywords'],
				'og:title' => $detail['name'],
				'og:url' => '',
				'og:description' => $detail['short_description'],
				'og:image' => $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true, 'width' => 300, 'height' => 500), true),
			);
			$detail['description']=str_replace("../rfilemanager",Yii::app()->params['LINK_SOURCE_ANH'],$detail['description']);
			$this->render('detail',array('detail'=>$detail,'cate_name'=>$cate_info['name'],'link_url'=>$link_url));
		}
	}
	public function actionNews()
	{
		$this->menu='news';
		$title=t('News');
		$menu_info=DModels::get_cate_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language']);
		$pageTitle=($menu_info['seo_title']) ? $menu_info['seo_title'] : $menu_info['name'];
		$pair=(object)array('thumb_image'=>$menu_info['thumb_image'],'image_x'=>$menu_info['image_x'],'image_y'=>$menu_info['image_y'],'id'=>$menu_info['i_id']);
            
		$this->seo_data = array(
				'description' => $menu_info['seo_description'],
				'keywords' => $menu_info['seo_keywords'],
				'og:title' => $menu_info['name'],
				'og:url' => '',
				'og:description' => $menu_info['short_description'],
				'og:image' => $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'origin', 'no_link' => true, 'return_url' => true, 'width' => 300, 'height' => 500), true),
			);
		$list=array();
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
		if($page >= 1) $page=($page-1)*param('limit_on_page');
		$obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
		
		$this->pageTitle($pageTitle);
		$cate_info=$title;
		$this->breadcrumbs=array(
			array('name' => t('Home'), 'url' => array('site/index')),
			array('name' =>$title)
		);
		$list=DModels::get_list_news_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language'],$obj);
		$total_recorde=DModels::count_news_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language']);
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
		
		
		$this->render('news',array('title'=>$title,'list'=>$list,'menu_info'=>$menu_info,'item_count'=>$total_recorde,'pages'=>$pages));
	}
	public function actionDetailnews()
	{
		$this->menu='news';
		if(isset($_REQUEST['id']))
		{
			 //die($_REQUEST['id']);
			//die($cate_info);
			$detail=DModels::get_content_by_id($_REQUEST['id'],$_SESSION['language']);
			
			$this->pageTitle($detail['name']);
			$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/detailnews',array('id'=>$_REQUEST['id'],'title'=>$detail['seo_name']));
            
			$pair=(object)array('thumb_image'=>$detail['thumb_image'],'image_x'=>$detail['image_x'],'image_y'=>$detail['image_y'],'id'=>$detail['i_id']);
            $this->seo_data = array(
				'description' => $detail['seo_description'],
				'keywords' => $detail['seo_keywords'],
				'og:title' => $detail['name'],
				'og:url' => $link_url,
				'og:description' => $detail['short_description'],
				'og:image' => $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true, 'width' => 300, 'height' => 500), true),
			);
			$list_other_news=DModels::get_list_news_other_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language'],$_REQUEST['id'],3);
			$list_other_news_r=DModels::get_list_news_other_by_cate_id(param('id_chuyen_muc_tintuc'),$_SESSION['language'],$_REQUEST['id'],8);
			
			$this->render('detailnews',array('detail'=>$detail,'link_url'=>$link_url,"list_other_news"=>$list_other_news,"list_other_news_r"=>$list_other_news_r));
		}
	}
	public function actionAjaxTonvinh()
	{
		$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
		if($page >= 1) $page=($page-1)*param('limit_on_page');
		$obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
		$tin_tonvinh=DModels::get_list_content_by_id(2,'vn',$obj);
    	$total_recorde=DModels::count_list_content_by_id(2);
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $this->renderPartial("ajaxTonvinh",array("tin_tonvinh"=>$tin_tonvinh,'total_recorde'=>$total_recorde,'pages'=>$pages));

	}
	public function actionAjaxSukien()
	{
		$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
		if($page >= 1) $page=($page-1)*param('limit_sk');
		$obj=array('limit'=>param('limit_sk'),'offset'=>$page);
		$tin_sk=DModels::get_list_content_by_id(3,'vn',$obj);
    	$total_recorde=DModels::count_list_content_by_id(3);
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_sk');
        $this->renderPartial("ajaxSukien",array("tin_sk"=>$tin_sk,'total_recorde'=>$total_recorde,'pages'=>$pages));

	}
	public function actionDetailTonvinh()
	{
		if(isset($_REQUEST['id']))
		{
			 
			
			$detail=DModels::get_content_by_id($_REQUEST['id'],'vn');
		
			
			$detail['description']=str_replace("../rfilemanager",Yii::app()->params['LINK_SOURCE_ANH'],$detail['description']);
			$this->renderPartial('detailTonvinh',array('detail'=>$detail));
		}
	}
	public function actionDetailSukien()
	{
		if(isset($_REQUEST['id']))
		{
			$detail=DModels::get_content_by_id($_REQUEST['id'],'vn');
			$detail['description']=str_replace("../rfilemanager",Yii::app()->params['LINK_SOURCE_ANH'],$detail['description']);
			$this->render('detailSukien',array('detail'=>$detail));
		}
	}
	public function actionDoitac()
	{
		$list=array();
		$pageTitle=t('Partner');
		$this->pageTitle($pageTitle);
			$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$pageTitle)
			);
		$position="partner";
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
	   $this->menu='doitac';
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = $_SESSION['language'];
        $criteria->addCondition('t.position =:position');
			$criteria->params[':position'] = $position;
        $total_recorde=Banners::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Banners::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
		
		$this->render('doitac',array('list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages));
	}
	public function actionDv2()
	{
		$title=t('dich_vu');
		if(isset($_REQUEST['id']))
		{
			$cate_info1=DModels::get_cate_by_cate_id($_REQUEST['id'],$_SESSION['language']);
			$cate_info=$cate_info1['name'];
			$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$title, 'url' => array('content/dv')),
				array('name' =>$cate_info )
			);
			$pagetitle=($cate_info1['seo_title']) ? $cate_info1['seo_title']:$cate_info1['name'];
			$this->pageTitle($pagetitle);
			$list=DModels::get_list_news_by_cate_id($_REQUEST['id'],$_SESSION['language']);
			$this->render('dv',array('title'=>$title,'list'=>$list,'cate_name'=>$cate_info));
		}
		
	}
	public function actionDetaildv()
	{
		//die('aaaaaaaaaa');
		$title=t('dich_vu');
		$id=getParam('id');
		//echo '0-'.$id;
		if($id)
		{
			$detail=DModels::get_content_by_id($id,$_SESSION['language']);
			//var_dump($detail);
			$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$title, 'url' => array('content/dv')),
				array('name' =>$detail['name'] )
			);
			$pagetitle=($detail['seo_title']) ? $detail['seo_title']:$detail['name'];
			$this->pageTitle($pagetitle);
			$pair=(object)array('thumb_image'=>$detail['thumb_image'],'image_x'=>$detail['image_x'],'image_y'=>$detail['image_y'],'id'=>$detail['i_id']);
			$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/detaildv',array('title'=>$detail['seo_name'],'id'=>$id));
            $this->seo_data = array(
				'description' => $detail['seo_description'],
				'keywords' => $detail['seo_keywords'],
				'og:title' => $detail['name'],
				'og:url' => $link_url,
				'og:description' => $detail['short_description'],
				'og:image' => $this->renderPartial('//blocks/image', array('pair' => $pair, 'object_type' => 'content', 'no_link' => true, 'return_url' => true, 'width' => 300, 'height' => 500), true),
			);
			$detail['description']=str_replace("../rfilemanager",Yii::app()->params['LINK_SOURCE_ANH'],$detail['description']);
			$this->render('detaildv',array('detail'=>$detail,'title'=>$title,'link_url'=>$link_url));
		}
	}
	public function actionUngdung()
	{
		$title=DModels::get_general('du_an',$_SESSION['language'],true);
		$menu_info=DModels::get_cate_by_seo_name('du-an',$_SESSION['language']);
		$pageTitle=($menu_info['seo_title']) ? $menu_info['seo_title'] : $menu_info['name'];
		
		$this->seo_data = array(
				'description' => $menu_info['seo_description'],
				'keywords' => $menu_info['seo_keywords'],
				'og:title' => $pageTitle,
				'og:url' => '',
				'og:description' => $menu_info['seo_description'],
				'og:image' => Yii::app()->getRequest()->getHostInfo().$menu_info['thumb_image'],
			);
		$this->pageTitle($pageTitle);
		$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$title)
			);
		$page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
        $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = $_SESSION['language'];
        $total_recorde=Gallery::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Gallery::model()->findAll($criteria);
        $pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
		$this->render('ungdung',array('title'=>$title,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages));
	}
	public function actionDetailfaq()
	{
		$this->menu='faq';
		$title=t('FAQ');
		if(isset($_REQUEST['id']))
		{
			$criteria = new CDbCriteria(array(
    			'with' => array('language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = $_SESSION['language'];
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $_REQUEST['id'];
			$detail = Faqs::model()->find($criteria);
			$link_url=Yii::app()->getRequest()->getHostInfo().$this->createUrl('/content/detailfaq',array('id'=>$_REQUEST['id']));
			$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$title, 'url' => array('content/faq')),
				array('name' =>$detail->language->name)
			);
			$pagetitle=($detail->language->seo_title) ? $detail->language->seo_title:$detail->language->name;
			$this->pageTitle($pagetitle);
			$url_image=$this->renderPartial('//blocks/image', array('pair' => $detail->main_image_pair, 'object_type' => 'faq', 'no_link' => true, 'return_url' => true, 'width' => 300, 'height' => 500), true);
			
            $this->seo_data = array(
				'description' => $detail->language->seo_description,
				'keywords' => $detail->language->seo_keywords,
				'og:title' => $detail->language->name,
				'og:url' => $link_url,
				'og:description' => $detail->language->short_description,
				'og:image' => $url_image,
			);
			$list_cau_hoi_khac=DModels::get_list_cau_hoi_khac($_REQUEST['id'],$_SESSION['language']);
			$this->render('detailfaq',array('detail'=>$detail,'title'=>$title,'link_url'=>$link_url,"list_cau_hoi_khac"=>$list_cau_hoi_khac));
		}
	}
	public function actionLienhe()
	{
		$title=t('Contact');
		/*$menu_info=DModels::get_cate_by_seo_name('lien-he',$_SESSION['language']);
		$pageTitle=($menu_info['seo_title']) ? $menu_info['seo_title'] : $menu_info['name'];
		$this->seo_data = array(
				'description' => $menu_info['seo_description'],
				'keywords' => $menu_info['seo_keywords'],
				'og:title' => $pageTitle,
				'og:url' => '',
				'og:description' => $menu_info['seo_description'],
				'og:image' => Yii::app()->getRequest()->getHostInfo().$menu_info['thumb_image'],
			);*/
		$this->pageTitle($title);
		
		$this->render('lienhe',array("title"=>$title));
	}
	public function actionAddlienhe()
	{
		if ( app()->request->isPostRequest ) 
		{
			if(!empty($_POST['item']))
			{
				$model = new Contact;
				$model->attributes=$_POST['item'];
				$model->created_at=date('Y-m-d h:i:s');
				if ( $model->save() ) {
					$this->redirect(array('lienhe'));
				}
			}
		}
	}
	public function actionFaq()
	{
		$this->menu='faq';
		$pageTitle="FAQs";
		//$menu_info=DModels::get_cate_by_seo_name('hoi-dap',$_SESSION['language']);
		//$pageTitle=($menu_info['seo_title']) ? $menu_info['seo_title'] : $menu_info['name'];
		/*$this->seo_data = array(
				'description' => $menu_info['seo_description'],
				'keywords' => $menu_info['seo_keywords'],
				'og:title' => $pageTitle,
				'og:url' => '',
				'og:description' => $menu_info['seo_description'],
				'og:image' => Yii::app()->getRequest()->getHostInfo().$menu_info['thumb_image'],
			);*/
		//$q=getParam("q");
		$this->pageTitle($pageTitle);
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = $_SESSION['language'];
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
		/*if(!empty($q))
		{
			$criteria->addCondition('language.short_description like :short_description');
			$criteria->params[':short_description'] = "%{$q}%";
		}*/
		$criteria->offset = 0;
        $criteria->limit=6;
		$list_cauhoi = Faqs::model()->findAll($criteria);
		$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$pageTitle)
			);
		$this->render('faq',array("list_cauhoi"=>$list_cauhoi,"type"=>"faq"));
	}
	public function actionFaqother()
	{
		$this->menu='faq';
		$pageTitle="FAQs";
		
		$q=getParam("q");
		$this->pageTitle($pageTitle);
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at ASC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = $_SESSION['language'];
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
		if(!empty($q))
		{
			$criteria->addCondition('language.short_description like :short_description');
			$criteria->params[':short_description'] = "%{$q}%";
		}
		$list_cauhoi = Faqs::model()->findAll($criteria);
		$this->breadcrumbs=array(
				array('name' => t('Home'), 'url' => array('site/index')),
				array('name' =>$pageTitle)
			);
		$this->render('faq',array("list_cauhoi"=>$list_cauhoi,"q"=>$q,"type"=>"faqother"));
	}
	public function actionSetquestion()
	{
		$res['type']="00";
		$res['message']="";
		
		if ( app()->request->isPostRequest ) 
		{
			
				$model = new Faqs;
				//$model->attributes=$_POST['item'];
				$model->created_at=date('Y-m-d H:i:s');
				$model->status=0;
				if ( $model->save() ) {
					Images::attachImagePair('images', 'faq', $model->id);
					if ( getPost('lang') ) {
                        $l=Language::model()->findAll();
                        foreach($l as $row)
                        {
                            $language=new LanguageValue;
                            $language->attributes = getPost('lang');
                            $language->lang_code=$row->lang_code;
                    		$language->object_id = $model->id;
                    		$language->object_type = 'F'; // F là FAQs
                            $language->created_at = date("y-m-d H:i:s");
                            $language->save();
                    		
                        }
                        $res['type']="01";
						$res['message']=t('You successfully questioned');
                        Yii::app()->user->setState('dat_cau_hoi', $res);
                        $this->redirect(array('faq'));
                    }
				}
				else{
					$res['type']="02";
					$res['message']=t('System error');
					Yii::app()->user->setState('dat_cau_hoi', $res);
					$this->redirect(array('faq'));
				}
		}
		else{
			$res['type']="03";
			$res['message']=t('You do not fill');
			Yii::app()->user->setState('dat_cau_hoi', $res);
			$this->redirect(array('faq'));
		}
	}
	protected function afterRender($view, &$output) {
		//$this->redirect(array('landingpage/index'));
		/*$js="FB.Event.subscribe('edge.create', function(href, widget) {
	        fblogin();
	    });";
	    Yii::app()->facebook->addJsCallback($js);*/
    	
			Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
		
 	
      return parent::afterRender($view, $output);
	}
	
}