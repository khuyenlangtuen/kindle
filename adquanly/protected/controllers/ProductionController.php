<?php

class ProductionController extends Controller
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
	   $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
	   $this->menu='sanpham';
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language','category'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
        $filter=array();
        if(isset($_REQUEST))
        {
            
            if(isset($_REQUEST['name']) && ['name']!="")
            {
                $filter['name']=$_REQUEST['name'];
                $criteria->addCondition("language.name like :l_name");
                $criteria->params[':l_name'] = "%".$_REQUEST['name']."%";
            }
            if(isset($_REQUEST['product_type']) && $_REQUEST['product_type']!="")
            {
                $filter['product_type']=$_REQUEST['product_type'];
                $criteria->addCondition("t.product_type =:product_type");
                $criteria->params[':product_type'] = $_REQUEST['product_type'];
            }
            if(isset($_REQUEST['cate_id']) && $_REQUEST['cate_id']!="" && $_REQUEST['cate_id']!=1)
            {
                $filter['cate_id']=$_REQUEST['cate_id'];
               $criteria->addCondition('t.cate_id=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
                $criteria->params[':cate_id'] =$_REQUEST['cate_id'];
                $criteria->params[':match1'] =$_REQUEST['cate_id']."/%";
                $criteria->params[':match2'] ="%/".$_REQUEST['cate_id']."/%";
            }
            
        }
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list = Products::model()->findAll($criteria);
        
		$pages=new MyPagination($total_recorde);
        $pages->pageSize=param('limit_on_page');
	    $this->render('index',array('lang'=>$lang,'list'=>$list,'item_count'=>$total_recorde,'pages'=>$pages,"filter"=>$filter));
	}
    public function actionFormadd()
	{
	   $this->menu='themsanpham';
       $model = new Products;
       $model->images=new Images;
       
       if ( app()->request->isPostRequest ) {
             
			if( isset($_POST['item']) ) {
				$model->attributes = $_POST['item'];
                /*$model->gia_ban=preg_replace('/[.,]/', '', $_POST['item']['gia_ban']);
                $model->gia_goc=preg_replace('/[.,]/', '', $_POST['item']['gia_goc']);//gia thue
                $model->gia_tron_goi=preg_replace('/[.,]/', '', $_POST['item']['gia_tron_goi']);*/
                $title_slug=D_Untils::generateUrlSlug($_POST['lang']['name']);
				if ( $model->save() ) {
				    if ( getPost('images') ) {
						Images::attachImagePair('images', 'product', $model->id);
					}
					

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
                    		$language->object_type = 'P'; // P là Product
                            $language->created_at = date("y-m-d H:i:s");
                            $language->save();
                    		
                        }
                        
                    }
                    
					$this->redirect(array('formupdate', 'id' => $model->id));
				}
			}
		}
       $link=CController::CreateUrl('production/formadd');
       $title=t('add_new_product');
       $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'',7);
       $lang=Language::model()->findAll();
       $info=array();
	   $this->render('form',array('url'=>$link,'title'=>$title,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
       
       
	}
    public function actionFormupdate()
	{
	   $this->menu='themsanpham';
       $id = getQuery('id');

		if ( $id ) {
             
           if ( app()->request->isPostRequest ) {
                $model = Products::model()->findByPk($id);
    			
    			//var_dump(getPost('item'));exit;
				$model->attributes = getPost('item');
				$model->save();
                if ( getPost('images') ) {
                    Images::updateImagePair('images', 'product', $model->id);
                }
                if ( getPost('lang') ) {
                    
                        $language=LanguageValue::model()->findByAttributes(array('object_id'=>$id,'object_type'=>'P','lang_code'=>Yii::app()->user->getState('lang')));
                        $language->attributes = getPost('lang');
                        if(Yii::app()->user->getState('lang')=='en')
                            $language->seo_name = D_Untils::generateUrlSlug($_POST['lang']['name']);
                        $language->updated_at = date("y-m-d H:i:s");
                        $language->save();
                    
                }
				$this->redirect(array('formupdate', 'id' => $model->id));
    				
    			
    		}
            $link=CController::CreateUrl('production/formupdate',array('id'=>$id));
           $title=t('update_product');
           $categories = Category::getCategoriesList(false,Yii::app()->user->getState('lang'),'',7);
           $lang=Language::model()->findAll();
           $criteria = new CDbCriteria(array(
    			'with' => array('main_image_pair','addition_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = Yii::app()->user->getState('lang');
     	    $criteria->addCondition('t.id=:id');
			$criteria->params[':id'] = $id;
			$info = Products::model()->find($criteria);
    	   $this->render('form',array('url'=>$link,'title'=>$title,'categories'=>$categories,'info'=>$info,'lang'=>$lang));
           
        }
       
       
	}
	
    public function actionAddimage()
    {
        if ( app()->request->isPostRequest ) {
            $index=$_POST['id'];
            $object_type=$_POST['object_type'];
             $this->renderPartial('//blocks/add_image',array('index'=>$index,'object_type'=>$object_type));
        }
    }
     public function actionDelimage()
    {
        if(isset($_REQUEST['id_image']))
        {
            if(Images::model()->deleteByPk($_REQUEST['id_image']))
			{
				echo "1";
             }
        }
    }
     public function actionDel()
    {
        if(isset($_REQUEST['id']))
        {
            if(Products::model()->deleteByPk($_REQUEST['id']))
			{
			     LanguageValue::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'P'));
                 Images::model()->deleteAllByAttributes(array('object_id'=>$_REQUEST['id'],'object_type'=>'P'));
				echo "1";
             }
        }
    }
    public function actionUpdateStatus()
    {
        
        if(isset($_REQUEST['id']))
        {
            $model=Products::model()->findByPk($_REQUEST['id']);
            $model->status=$_REQUEST['status'];
            if($model->save())
			{
				echo "1";
             }
        }
    }
    public function actionNew()
	{
	   $this->menu='sanpham_moi';
       $block_type='new';
       /**/
       $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = 'vn';
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
        
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list_product = Products::model()->findAll($criteria);
        
		$pages=new MyPaginationAjax($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $data=array('list_product'=>$list_product,'total_product'=>$total_recorde,'pages'=>$pages,'block_type'=>$block_type);
       /**/
       
       $lang=Language::model()->findAll();
	   $list = DModels::get_block_product($block_type,Yii::app()->user->getState('lang'));
	   $this->render('new',array('lang'=>$lang,'list'=>$list,'data'=>$data));
	}
    public function actionAjaxpicker()
    {
        $block_type=$_REQUEST['block_type'];
        $onclick="add_product_picker()";
        $option_id=0;
        if($block_type=="options"){
            $onclick="add_product_picker_and_option()";
        } 
        $page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language','category'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = 'vn';
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
        if(isset($_REQUEST['id_ten_sanpham']) && $_REQUEST['id_ten_sanpham'])
        {
            $criteria->addCondition('language.name LIKE :ten_sanpham');
            $criteria->params[':ten_sanpham'] = "%".$_REQUEST['id_ten_sanpham']."%";
        }
        if(isset($_REQUEST['id_theloai']) && $_REQUEST['id_theloai']!=1)
        {
           $criteria->addCondition('t.cate_id=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
            $criteria->params[':cate_id'] =$_REQUEST['id_theloai'];
            $criteria->params[':match1'] =$_REQUEST['id_theloai']."/%";
            $criteria->params[':match2'] ="%/".$_REQUEST['id_theloai']."/%";
        }
        if(isset($_REQUEST['id_gia_tu']) && $_REQUEST['id_gia_tu'])
        {
            $criteria->addCondition('t.gia_ban > :id_gia_tu');
            $criteria->params[':id_gia_tu'] = $_REQUEST['id_gia_tu'];
        }
        if(isset($_REQUEST['id_gia_den']) && $_REQUEST['id_gia_den'])
        {
            $criteria->addCondition('t.gia_ban < :id_gia_den');
            $criteria->params[':id_gia_den'] = $_REQUEST['id_gia_den'];
        }
        if(isset($_REQUEST['option_id']) && $_REQUEST['option_id'])
        {
           $option_id=$_REQUEST['option_id'];
        }
        
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list_product = Products::model()->findAll($criteria);
        
		$pages=new MyPaginationAjax($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $data=array('list_product'=>$list_product,'total_product'=>$total_recorde,'pages'=>$pages,'block_type'=>$block_type,'onclick'=>$onclick,"option_id"=>$option_id);
        $this->renderPartial('//production/ajax/ajaxpicker',array('data'=>$data));
    }
    public function actionAddproductpicker()
    {
        $this->menu='sanpham_moi';
        if($_REQUEST['chuoi_id'] && $_REQUEST['block_type'])
        {
           DModels::add_product_picker($_REQUEST['block_type'],$_REQUEST['chuoi_id']);
           $list = DModels::get_block_product($_REQUEST['block_type'],Yii::app()->user->getState('lang'));
	       $this->renderPartial('//production/ajax/ajaxproduct',array('list'=>$list));
        }
    }
    public function actionAddproductpickeroption()
    {
        $this->menu='sanpham_moi';
        if($_REQUEST['chuoi_id'] && $_REQUEST['block_type'])
        {
           DModels::add_product_picker_option($_REQUEST['block_type'],$_REQUEST['chuoi_id'],$_REQUEST['option_name'],$_REQUEST['option_priority'],$_REQUEST['product_id'],$_REQUEST['option_id']);
           $list = DModels::get_block_product($_REQUEST['block_type'],Yii::app()->user->getState('lang'));
           $this->renderPartial('//production/ajax/ajaxproduct',array('list'=>$list));
        }
    }
    public function actionShowthemtuychon()
    {
        $product_id=$_REQUEST['product_id'];
        
        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
            'order' => 't.created_at DESC',
            'with' => array('language'),
        ));
        $criteria->addCondition('language.lang_code=:lang');
        $criteria->params[':lang'] = 'vn';
        $criteria->addCondition('t.status=:status');
        $criteria->params[':status'] = 1;
        
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
        $list_product = Products::model()->findAll($criteria);
        $block_type="options";
        $pages=new MyPaginationAjax($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $data=array('list_product'=>$list_product,'total_product'=>$total_recorde,'pages'=>$pages,'block_type'=>$block_type,"product_id"=>$product_id);
        if(isset($_REQUEST['option_id']) && $_REQUEST['option_id'])
        {
            $op=DModels::get_list_block_by_optionID($_REQUEST['option_id']);
            if($op)
            {
                $data['option_id']=$op['id'];
                $data['option_name']=$op['lang_code_name'];
                $data['option_priority']=$op['priority'];
                
            }
            
        }
        else{
            $data['option_id']=-1;
        }
       $this->renderPartial('//production/ajax/product_picker_tuychon',array('data'=>$data));
    }
    public function actionDelpicker()
    {
        if(isset($_REQUEST['id']))
        {
            if(DModels::del_picker($_REQUEST['id']))
			{
				echo "1";
             }
        }
    }
    public function actionPromotion()
	{
	   $this->menu='sanpham_km';
       $block_type='promotion';
       /**/
       $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = 'vn';
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
        
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list_product = Products::model()->findAll($criteria);
        
		$pages=new MyPaginationAjax($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $data=array('list_product'=>$list_product,'total_product'=>$total_recorde,'pages'=>$pages,'block_type'=>$block_type);
       /**/
       
       $lang=Language::model()->findAll();
	   $list = DModels::get_block_product($block_type,Yii::app()->user->getState('lang'));
	   $this->render('new',array('lang'=>$lang,'list'=>$list,'data'=>$data));
	}
    public function actionHighlight()
	{
	   $this->menu='sanpham_noibat';
       $block_type='highlight';
       /**/
       $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        if($page >= 1) $page=($page-1)*param('limit_on_page');
        $obj=array('limit'=>param('limit_on_page'),'offset'=>$page);
       $lang=Language::model()->findAll();
       $criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = 'vn';
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
        
        $total_recorde=Products::model()->count($criteria);
        
        $criteria->offset = $obj['offset'];
        $criteria->limit=$obj['limit'];
        
		$list_product = Products::model()->findAll($criteria);
        
		$pages=new MyPaginationAjax($total_recorde);
        $pages->pageSize=param('limit_on_page');
        $data=array('list_product'=>$list_product,'total_product'=>$total_recorde,'pages'=>$pages,'block_type'=>$block_type);
       /**/
       
       $lang=Language::model()->findAll();
	   $list = DModels::get_block_product($block_type,Yii::app()->user->getState('lang'));
	   $this->render('new',array('lang'=>$lang,'list'=>$list,'data'=>$data));
	}
    public function actionMausac()
    {
        $this->menu='mau_sac';
        $list = DModels::get_list_mausac();
        $this->render('mausac',array('list' =>$list));
    }
    public function actionUpdatemausac()
    {
        $this->menu='mau_sac';
        $id = getQuery('id');
        $title=t("Thêm màu sắc");
        $info=array();
        if($id)
        {
            $title=t("Cập nhật màu sắc");
            if ( app()->request->isPostRequest ) {
                $mau=$_POST['item']['name'];
                $kq=DModels::update_mausac($mau,$id);

            }
            $info=DModels::get_mausac_by_id($id);
        }
        else{
            if ( app()->request->isPostRequest ) {
                $mau=$_POST['item']['name'];
                $kq=DModels::add_mausac($mau);
                if($kq)
                {
                    $insert_id = app()->db->getLastInsertID();
                    $title=t("Cập nhật màu sắc");
                    $info=DModels::get_mausac_by_id($insert_id);
                }
            }
            
        }
        $this->render('form2',array("title"=>$title,"info"=>$info));
    }
    public function actionKichthuoc()
    {
        $this->menu='kich_thuoc';
        $list = DModels::get_list_kichthuoc();
        $this->render('kichthuoc',array('list' =>$list));
    }
    public function actionUpdatekichthuoc()
    {
        $this->menu='kich_thuoc';
        $id = getQuery('id');
        $title=t("Thêm size");
        $info=array();
        if($id)
        {
            $title=t("Cập nhật size");
            if ( app()->request->isPostRequest ) {
                $mau=$_POST['item']['size'];
                $kq=DModels::update_kichthuoc($mau,$id);

            }
            $info=DModels::get_kichthuoc_by_id($id);
        }
        else{
            if ( app()->request->isPostRequest ) {
                $mau=$_POST['item']['size'];
                $kq=DModels::add_kichthuoc($mau);
                if($kq)
                {
                    $insert_id = app()->db->getLastInsertID();
                    $title=t("Cập nhật size");
                    $info=DModels::get_kichthuoc_by_id($insert_id);
                }
            }
            
        }
        $this->render('form3',array("title"=>$title,"info"=>$info));
    }
    public function actionDelmausac()
    {
        if(isset($_REQUEST['id']))
        {
            if(DModels::del_mausac($_REQUEST['id']))
            {
                echo "1";
             }
        }
    }
    public function actionDelkichthuoc()
    {
        if(isset($_REQUEST['id']))
        {
            if(DModels::del_kichthuoc($_REQUEST['id']))
            {
                echo "1";
             }
        }
    }
    public function actionKhuvuc()
    {
        $this->menu='khu_vuc';
        $list = DModels::get_list_khuvuc();
        $this->render('khuvuc',array('list' =>$list));
    }
    public function actionUpdatekhuvuc()
    {
        $this->menu='khu_vuc';
        $id = getQuery('id');
        $title=t("Thêm khu vực");
        $info=array();
        if($id)
        {
            $title=t("Cập nhật khu vực");
            if ( app()->request->isPostRequest ) {
                $mau=$_POST['item']['name'];
                $kq=DModels::update_khuvuc($mau,$id);

            }
            $info=DModels::get_khuvuc_by_id($id);
        }
        else{
            if ( app()->request->isPostRequest ) {
                $mau=$_POST['item']['name'];
                $kq=DModels::add_khuvuc($mau);
                if($kq)
                {
                    $insert_id = app()->db->getLastInsertID();
                    $title=t("Cập nhật khu vực");
                    $info=DModels::get_khuvuc_by_id($insert_id);
                }
            }
            
        }
        $this->render('form4',array("title"=>$title,"info"=>$info));
    }
    public function actionDelkhuvuc()
    {
        if(isset($_REQUEST['id']))
        {
            if(DModels::del_khuvuc($_REQUEST['id']))
            {
                echo "1";
             }
        }
    }
    public function actionChuongtrinhkm()
    {
        $this->menu='chuong_trinh_km';
        $model = Chuongtrinhkm::model()->findAll();
         $this->render('ctkm',array("list"=>$model));
    }
    public function actionUpdatectkm()
    {
        $this->menu='chuong_trinh_km';
        $id = getQuery('id');
        $title=t("Thêm Chương trình khuyến mãi");
        $info=array();
        if($id)
        {
            $title=t("Cập nhật Chương trình khuyến mãi");
            $model = Chuongtrinhkm::model()->findByPk($id);
            if ( app()->request->isPostRequest ) {
                $model->attributes=$_POST['item'];
                $model->start_date=$_POST['item']['start_date']." ".$_POST['item']['start_hour'].":".$_POST['item']['start_min'].":00";
                $model->end_date=$_POST['item']['end_date']." ".$_POST['item']['end_hour'].":".$_POST['item']['end_min'].":00";
                $model->save();
            }
            $info=Chuongtrinhkm::model()->findByPk($id);
        }
        else{
            if ( app()->request->isPostRequest ) {
	            $model = new Chuongtrinhkm;
                $model->attributes=$_POST['item'];
                $model->start_date=$_POST['item']['start_date']." ".$_POST['item']['start_hour'].":".$_POST['item']['start_min'].":00";
                $model->end_date=$_POST['item']['end_date']." ".$_POST['item']['end_hour'].":".$_POST['item']['end_min'].":00";
                if($model->save())
                {
                    $title=t("Cập nhật khu vực");
                    $info=Chuongtrinhkm::model()->findByPk($model->id);
                }
            }
            
        }
        $this->render('formctkm',array("title"=>$title,"info"=>$info));
    }
    public function actionDelctkm()
    {
        if(isset($_REQUEST['id']))
        {
            if(Chuongtrinhkm::model()->deleteByPk($_REQUEST['id']))
			{
				echo "1";
             }
        }
    }
    public function actionDelcouponcode()
    {
        if(isset($_REQUEST['id']))
        {
            if(Khuyenmaidetail::model()->deleteByPk($_REQUEST['id']))
			{
				echo "1";
             }
        }
    }
    public function actionDelallCouponcode()
    {
        if(isset($_REQUEST['id']))
        {
            if(Khuyenmaidetail::model()->deleteAllByAttributes(array('id_ctkm'=>$_REQUEST['id'])))
			{
				echo "1";
             }
        }
    }
     public function actionAddcouponcode()
    {
        $this->menu='chuong_trinh_km';
        $id = getQuery('id');
        $info=array();
        if($id)
        {
	        $title=t("Cập nhật Chương trình khuyến mãi");
	        if ( app()->request->isPostRequest ) {
		        if($_POST['item']['list_code'])
		        {
			        $list_code=explode(",", $_POST['item']['list_code']);
			        foreach($list_code as $value)
			        {
				        if(trim($value)!="")
				        {
					        $model = new Khuyenmaidetail;
			                $model->coupon_code=trim($value);
			                $model->id_ctkm=$_POST['item']['id_ctkm'];
			                $model->save();
				        }
			        }
		        }
	            
                
            }
            $info=Chuongtrinhkm::model()->findByPk($id);
           $this->render('formctkm',array("title"=>$title,"info"=>$info));
        }
        
    }

  protected function afterRender($view, &$output) {
    $user_id=Yii::app()->user->getState('id_user');
        if(empty($user_id))
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