<?php

class ApiController extends Controller
{
    
	public function actionGetListStory()
	{
		
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('images','language'),
		));
		$criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] ="vn";
		$criteria->addCondition('t.loai=:loai');
		$criteria->params[':loai'] ="truyen";
		$list = Category::model()->findAll($criteria);
		$total=Category::model()->count($criteria);
		
		$story=array();
		
		if(!empty($list))
		{
			foreach($list as $item)
			{
				$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $item->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
				$story[]=array(
					"id"=>$item->id,
					"tinh_trang"=>$item->tinh_trang,
					"revision"=>$item->revision,
					"tac_gia"=>$item->tac_gia,
					"ten_truyen"=>$item->language->name,
					"tom_tat"=>$item->language->description,
					"hinh_anh"=>$this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'origin', 'no_link' => true, 'return_url' => true, 'width' => 270, 'height' => 383), true)
				);
			}
			
		}
		echo json_encode(array("count"=>$total,"stories"=>$story));
	}
	public function actionGetStory(){
		$id=getParam('id');
		if(empty($id)) die(json_encode(array("story"=>"")));
		$criteria = new CDbCriteria(array(
			//'order' => 't.created_at DESC',
			'with' => array('language'),
		));
		$criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] ="vn";
		$criteria->addCondition('t.parent_id=:parent_id');
		$criteria->params[':parent_id'] =$id;
		$list = Category::model()->findAll($criteria);
		if(!empty($list))
		{
			foreach($list as $item)
			{
				//$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $item->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
				$tap[]=array(
					"id"=>$item->id,
					"ten_tap"=>$item->language->name,
					
				);
			}
			
		}
		echo json_encode(array("story"=>$tap));
	}
	public function actionGetListChapter()
	{
		$id=getParam('id_truyen');
		if(empty($id)) die(json_encode(array("chapters"=>"")));
		$criteria = new CDbCriteria(array(
			'order' => 't.content_id asc',
			'with' => array('language'),
		));
		$criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] ="vn";
		$criteria->addCondition('t.id_cate=:id_cate');
		$criteria->params[':id_cate'] =$id;
		$list = Content::model()->findAll($criteria);
		if(!empty($list))
		{
			foreach($list as $item)
			{
				//$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $item->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
				$chuong[]=array(
					"content_id"=>$item->content_id,
					"cate_id"=>$item->id_cate,
					"ten_chuong"=>$item->language->name,
					"detail_content"=>$item->language->description
				);
			}
			
		}
		echo json_encode(array("chapters"=>$chuong));
	}
	public function actionGetContent()
	{
		$id=getParam('id_chapter');
		if(empty($id)) die(json_encode(array("chapter"=>"")));
		$criteria = new CDbCriteria(array(
			'order' => 't.content_id asc',
			'with' => array('language'),
		));
		$criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] ="vn";
		$criteria->addCondition('t.content_id=:content_id');
		$criteria->params[':content_id'] =$id;
		$item = Content::model()->find($criteria);
		if(!empty($item))
		{
			
				//$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $item->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
				$chuong=array(
					"content_id"=>$item->content_id,
					"cate_id"=>$item->id_cate,
					"ten_chuong"=>$item->language->name,
					"detail_content"=>$item->language->description
				);
			
			
		}
		echo json_encode(array("chapter"=>$chuong));
	}
	public function actionTaiSach()
	{
		$id=getParam('id');
		//if(empty($id)) die(json_encode(array("book"=>"")));
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('images','language'),
		));
		$criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] ="vn";
		$criteria->addCondition('t.id=:id');
		$criteria->params[':id'] =$id;
		$one = Category::model()->find($criteria);
		//var_dump($one);
		$book=array();
		if(!empty($one))
		{
			

				
				$criteria = new CDbCriteria(array(
					//'order' => 't.created_at DESC',
					'with' => array('language'),
				));
				$criteria->addCondition('language.lang_code=:lang');
				$criteria->params[':lang'] ="vn";
				$criteria->addCondition('t.parent_id=:parent_id');
				$criteria->params[':parent_id'] =$one->id;
				$list_tap = Category::model()->findAll($criteria);
				$tap=array();
				foreach($list_tap as $item)
				{
					//$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $item->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
					$criteria = new CDbCriteria(array(
						'order' => 't.content_id asc',
						'with' => array('language'),
					));
					$criteria->addCondition('language.lang_code=:lang');
					$criteria->params[':lang'] ="vn";
					$criteria->addCondition('t.id_cate=:id_cate');
					$criteria->params[':id_cate'] =$item->id;
					$list_chapter = Content::model()->findAll($criteria);
					
					$chapter=array();
					foreach($list_chapter as $item2)
					{
						//$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $item->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
						$chapter[]=array(
							"id_chapter"=>$item2->content_id,
							"ten_chuong"=>$item2->language->name,
							"detail_content"=>$item2->language->description
						);
					}
					$tap[]=array(
						"id_tap"=>$item->id,
						"ten_tap"=>$item->language->name,
						"chapters"=>$chapter
					);
	
				}
				$pair=(object)array('thumb_image'=>str_replace("/uploads/origin/", "", $one->images->thumb_image),'image_x'=>0,'image_y'=>0,'id'=>0);
				$book=array(
						"id_book"=>$one->id,
						"revision"=>$one->revision,
						"tinh_trang"=>$one->tinh_trang,
						"tac_gia"=>$one->tac_gia,
						"ten_truyen"=>$one->language->name,
						"tom_tat"=>$one->language->description,
						"hinh_anh"=>$this->renderPartial('//blocks/image_new', array('pair' => $pair, 'object_type' => 'origin', 'no_link' => true, 'return_url' => true, 'width' => 270, 'height' => 383), true),
						"tap_truyen"=>$tap,
					);
			
		}
		echo json_encode(array("books"=>$book));
	}
	public function actionGetPlaylists()
	{
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language','category'),
		));
		$criteria->addCondition("t.product_type =:product_type");
        $criteria->params[':product_type'] = "single";
        $list = Products::model()->findAll($criteria);
        $playlists=array();
        if(!empty($list))
        {
	        
	        
	        foreach($list as $item)
	        {
		        $list_anh=array();
				$list_nhac=array();
		        $handle_nhac = opendir(Yii::getPathOfAlias('filemanager').'/source/album_nhac/'.$item->language->seo_name);
		        $handle_anh = opendir(Yii::getPathOfAlias('filemanager').'/source/album_anh/'.$item->language->seo_name);
		        $thumb="";
		        while($file = readdir($handle_nhac)){
                    if($file !== '.' && $file !== '..'){
	                    $link=Yii::app()->params['LINK_SOURCE_ANH'].'/source/album_nhac/'.$item->language->seo_name.'/'.$file;
                        $file_info=explode(".", $file);
                        $media_info=explode("-", $file);
                        $name=str_replace("[M4A 500kbps]", "", $media_info[1]);
                        $name=str_replace(".m4a", "", $name);
                        $list_nhac[]=array(
	                        "link"=>$link,
	                        "ten_bai_hat"=>$media_info[0],
	                        "ca_si"=>$name,
	                        "ten_file"=>$file_info[0],
	                        "file_type"=>$file_info[1]
                        );
                    }
                }
                while($file = readdir($handle_anh)){
                    if($file !== '.' && $file !== '..'){
	                    $link=Yii::app()->params['LINK_SOURCE_ANH'].'/source/album_anh/'.$item->language->seo_name.'/'.$file;
                        $list_anh[]=$link;
                        $thumb=$link;
                    }
                }
                $playlists[]=array(
	                "ID"=>$item->id,
	                "thumb"=>$thumb,
	                "ten_playlist"=>$item->language->name,
	                "so_luong_baihat"=>count($list_nhac),
	                "list_nhac"=>$list_nhac,
	                "so_luong_hinhanh"=>count($list_anh),
	                "list_anh"=>$list_anh,
                );
	        }
        }
        echo json_encode(array("playlists"=>$playlists));
	}
}