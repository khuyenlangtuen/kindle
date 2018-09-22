<?php
class DModels
{
    public static function get_list_cate_by_parent_id($parent_id,$cate_type='',$langcode='vn',$limit=0)
    {
        $cache=Yii::app()->cache;
		$key='get_list_cate_by_parent_id'.$parent_id.'_'.$cate_type.'_'.$langcode.$limit;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="SELECT c.id as c_id,l.*,i.thumb_image,i.image_x,i.image_y,i.id as i_id FROM {{category}} c, {{language_value}} l,{{images}} i WHERE i.object_id=c.id and i.object_type='C' and i.type='M' and c.status=1 and c.parent_id={$parent_id} and c.id=l.object_id and l.object_type='C' and l.lang_code='{$langcode}'";
    		if($cate_type!='')
    		{
	    		$sql.=" and c.cate_type='{$cate_type}'";
    		}
    		if($limit > 0)
    		{
	    		$sql.=" LIMIT 0,".$limit;
    		}
    		$db=Yii::app()->db;
    		$command=$db->createCommand($sql);
    		$data = $command->queryAll();
            $cache->set($key,$data,86400);
    		return $data;
        }
    }
	public static function get_cate_by_seo_name($seo_name,$langcode='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_list_cate_by_seo_name'.$seo_name.'_'.$langcode;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="SELECT c.id as c_id,l.*,i.thumb_image,i.image_x,i.image_y,i.id as i_id FROM {{category}} c, {{language_value}} l ,{{images}} i WHERE i.object_id=c.id and i.object_type='C' and i.type='M' and c.status=1 and c.seo_name='{$seo_name}' and c.id=l.object_id and l.object_type='C' and l.lang_code='{$langcode}'";
    		$db=Yii::app()->db;
    		$command=$db->createCommand($sql);
    		$data = $command->queryRow();
            $cache->set($key,$data,86400);
    		return $data;
        }
    }
    public static function get_cate_by_cate_id($cate_id,$langcode='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_cate_by_cate_id'.$cate_id.'_'.$langcode;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="SELECT c.id as c_id,c.id_path,l.*,i.thumb_image,i.image_x,i.image_y,i.id as i_id FROM {{category}} c, {{language_value}} l,{{images}} i WHERE c.status=1  and c.id={$cate_id} and c.id=l.object_id and l.object_type='C' and i.object_id=c.id and i.object_type='C' and i.type='M' and l.lang_code='{$langcode}'";
    		$db=Yii::app()->db;
    		$command=$db->createCommand($sql);
    		$data = $command->queryRow();
            $cache->set($key,$data,86400);
    		return $data;
        }
    }
    public static function get_list_banners_by_position($position,$langcode='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_list_banners_by_position'.$position.'_'.$langcode;
		if($data=$cache->get($key))
            return $data;
        else{
            $criteria = new CDbCriteria(array(
			'order' => 't.priority DESC',
			'with' => array('main_image_pair','language'),
    		));
            $criteria->addCondition('language.lang_code=:lang');
    		$criteria->params[':lang'] = $langcode;
            $criteria->addCondition('t.position=:position');
			$criteria->params[':position'] = $position;
            $criteria->addCondition('t.status=:status');
			$criteria->params[':status'] = 1;
    		$data = Banners::model()->findAll($criteria);
            //$sql="SELECT b.id as b_id,l.* FROM {{banners}} b, {{language_value}} l WHERE b.status=1 and b.position={$position} and b.id=l.object_id and l.object_type='B' and l.lang_code='{$langcode}'";
    		//$db=Yii::app()->db;
    		//$command=$db->createCommand($sql);
    		//$data = $command->queryAll();
            $cache->set($key,$data,86400);
    		return $data;
        }
    }
    public static function get_block_product_fontend($block_type,$lang,$limit=10)
    {
        $cache=Yii::app()->cache;
		$key='get_block_product_fontend'.$block_type.'_'.$lang.'_'.$limit;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.*,p.id as p_id,p.product_code,p.gia_goc,p.gia_ban,bp.id as b_id,i.thumb_image,i.image_x,i.image_y,i.id as i_id from {{block_product}} bp, {{products}} p, {{language_value}} l,{{images}} i ";
            $sql.="where i.object_id=p.id and i.object_type='P' and i.type='M' and bp.product_id=p.id and p.id = l.object_id and l.object_type='P' and bp.block_type='{$block_type}' and l.lang_code='{$lang}' limit 0,".$limit;
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
    }
    public static function show_gallery($limit=9)
    {
        $cache=Yii::app()->cache;
		$key='show_gallery_'.$limit.'_'.$_SESSION['language'];
		if($data=$cache->get($key))
            return $data;
        else{
           $criteria = new CDbCriteria(array(
				'order' => 't.created_at DESC',
				'with' => array('language'),
			));
			$criteria->addCondition('language.lang_code=:lang');
			$criteria->params[':lang'] = $_SESSION['language'];
			$criteria->limit=$limit;
			
			$data = Gallery::model()->findAll($criteria);
            $cache->set($key,$data,86400);
            return $data;
        }
    }
    public static function get_product_by_id($id,$lang='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_product_by_id_'.$id.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.*,p.cate_id,p.id as p_id,p.product_code,p.product_type,p.gia_goc,p.gia_ban,p.gia_tron_goi,p.sl_ton,p.owner_id,i.thumb_image,i.image_x,i.image_y,i.id as i_id from {{products}} p, {{language_value}} l,{{images}} i ";
            $sql.="where i.object_id=p.id and i.object_type='P' and i.type='M' and p.id = l.object_id and l.object_type='P' and l.lang_code='{$lang}' and p.id={$id}";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            $cache->set($key,$data,86400);
            return $data;
        }
        
    }
    public static function get_list_image_by_product_id($id)
    {
        $cache=Yii::app()->cache;
		$key='get_list_image_by_product_id_'.$id;
		if($data=$cache->get($key))
            return $data;
        else{
            $criteria = new CDbCriteria(array(
    			'order' => 't.type DESC',
    		));
              // $model=Images::model()->findAllByAttributes(array('type'=>'A','object_type'=>'G'));
           $criteria->addCondition('t.object_id=:object_id');
    		$criteria->params[':object_id'] = $id;
             $criteria->addCondition('t.object_type=:object_type');
    		$criteria->params[':object_type'] = 'P';
            $data = Images::model()->findAll($criteria);
            $cache->set($key,$data,86400);
            return $data;
        }
    }
    public static function get_product_relative_by_id($id,$cate_id,$lang='vn',$limit=4)
    {
        $cache=Yii::app()->cache;
		$key='get_product_relative_by_id_'.$id.'_'.$cate_id.'_'.$lang.'_'.$limit;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.*,p.id as p_id,p.product_code,p.gia_goc,p.gia_ban,i.thumb_image,i.image_x,i.image_y,i.id as i_id from {{products}} p, {{language_value}} l,{{images}} i ";
            $sql.="where i.object_id=p.id and i.object_type='P' and i.type='M' and p.id = l.object_id and l.object_type='P' and l.lang_code='{$lang}' and p.id!={$id} and p.cate_id={$cate_id} limit 0,".$limit;
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
        
    }
     public static function get_product_noi_bat_by_cateid($cate_id,$lang='vn',$limit=5)
    {
        $cache=Yii::app()->cache;
        $key='get_product_noi_bat_by_cateid'.$cate_id.'_'.$lang.'_'.$limit;
        if($data=$cache->get($key))
            return $data;
        else{
            $criteria = new CDbCriteria(array(
                'order' => 't.created_at DESC',
                'with' => array('language','category'),
            ));
            $criteria->addCondition('language.lang_code=:lang');
            $criteria->params[':lang'] = $lang;
            $criteria->addCondition('t.status=:status');
            $criteria->params[':status'] = 1;

            $criteria->addCondition('t.cate_id=:cate_id OR category.id_path LIKE :match1 OR category.id_path LIKE :match2');
            $criteria->params[':cate_id'] =$cate_id;
            $criteria->params[':match1'] =$cate_id."/%";
            $criteria->params[':match2'] ="%/".$cate_id."/%";
            $criteria->limit=$limit;
            $data = Products::model()->findAll($criteria);
            $cache->set($key,$data,86400);
            return $data;
        }
        
    }
    
	public static function get_content_by_id($id,$lang='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_content_by_id'.$id.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.*,p.id_cate,p.content_id,p.owner_id,p.publish_at,i.thumb_image,i.image_x,i.image_y,i.id as i_id from {{content}} p, {{language_value}} l ,{{images}} i";
            $sql.=" where i.object_id=p.content_id and i.object_type='T' and i.type='M' and p.content_id = l.object_id and l.object_type='T' and l.lang_code='{$lang}' and p.content_id={$id}";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            $cache->set($key,$data,86400);
            return $data;
        }
        
    }
	public static function get_list_content_by_id($id,$lang='vn',$phantrang=array())
    {
        $cache=Yii::app()->cache;
		$key='get_list_content_by_id'.$id.'_'.$lang;
		if($phantrang)
		{
			$key.=$phantrang['offset']."_".$phantrang['limit'];
		}
		if($data=$cache->get($key))
            return $data;
        else{
	        $sql="select l.*,p.id_cate,p.content_id,p.publish_at,i.thumb_image,i.image_x,i.image_y,i.id as i_id 
					from {{content}} p LEFT JOIN {{language_value}} l ON p.content_id = l.object_id LEFT JOIN {{images}} i ON i.object_id=p.content_id where 
					i.object_type='T' and i.type='M' and l.object_type='T' and l.lang_code='".$lang."' and p.id_cate = {$id}";
            if($phantrang)
			{
				$sql.=" LIMIT ".$phantrang['offset'].",".$phantrang['limit'];
			}
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
    }
    public static function count_list_content_by_id($id,$lang='vn')
	{
		$cache=Yii::app()->cache;
		$key='count_list_content_by_id'.$id.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql=" select count(*) as dem
					from {{content}} p LEFT JOIN {{language_value}} l ON p.content_id = l.object_id LEFT JOIN {{images}} i ON i.object_id=p.content_id where 
					i.object_type='T' and i.type='M' and l.object_type='T' and l.lang_code='".$lang."' and p.id_cate = {$id}";
			
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            $cache->set($key,$data['dem'],86400);
            return $data['dem'];
        }
	}
	public static function get_one_content_by_id_cate($id,$lang='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_one_content_by_id_cate'.$id.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.*,p.id_cate,p.content_id,p.publish_at from {{content}} p, {{language_value}} l ";
            $sql.="where p.content_id = l.object_id and l.object_type='T' and l.lang_code='{$lang}' and p.id_cate={$id}";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            $cache->set($key,$data,86400);
            return $data;
        }
    }
	public static function get_cate_name_by_content_id($id,$lang='vn')
	{
		$cache=Yii::app()->cache;
		$key='get_cate_name_by_content_id'.$id.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.*,p.id_cate,p.content_id,p.publish_at from {{content}} p, {{language_value}} l ";
            $sql.="where p.id_cate = l.object_id and l.object_type='C' and l.lang_code='{$lang}' and p.content_id={$id}";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            $cache->set($key,$data,86400);
            return $data;
        }
	}
	public static function get_list_id_cate_by_parent_id($id)
	{
		$sql="select id from {{category}} where parent_id = {$id}";
		$command=app()->db->createCommand($sql);
      	$data = $command->queryColumn();
		if($data)
		{
			return implode(',',$data);
		}
		return $id;
	}
	public static function get_list_news_by_cate_id($id,$lang='vn',$phantrang=array())
	{
		$cache=Yii::app()->cache;
		$key='get_list_news_by_cate_id'.$id.'_'.$lang;
		if($phantrang)
		{
			$key.=$phantrang['offset']."_".$phantrang['limit'];
		}
		if($data=$cache->get($key))
            return $data;
        else{
			$list_id=self::get_list_id_cate_by_parent_id($id);
            $sql=" select l.*,p.id_cate,p.content_id,p.publish_at,i.thumb_image,i.image_x,i.image_y,i.id as i_id 
					from {{content}} p LEFT JOIN {{language_value}} l ON p.content_id = l.object_id LEFT JOIN {{images}} i ON i.object_id=p.content_id where 
					i.object_type='T' and i.type='M' and l.object_type='T' and l.lang_code='".$lang."' and p.id_cate in ({$list_id})";
			if($phantrang)
			{
				$sql.=" LIMIT ".$phantrang['offset'].",".$phantrang['limit'];
			}
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
	}
	public static function count_news_by_cate_id($id,$lang='vn')
	{
		$cache=Yii::app()->cache;
		$key='count_news_by_cate_id'.$id.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
			$list_id=self::get_list_id_cate_by_parent_id($id);
            $sql=" select count(*) as dem
					from {{content}} p LEFT JOIN {{language_value}} l ON p.content_id = l.object_id LEFT JOIN {{images}} i ON i.object_id=p.content_id where 
					i.object_type='T' and i.type='M' and l.object_type='T' and l.lang_code='".$lang."' and p.id_cate in ({$list_id})";
			
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            $cache->set($key,$data['dem'],86400);
            return $data['dem'];
        }
	}
	public static function get_list_news_other_by_cate_id($cate_id,$lang='vn',$id,$limit=4)
	{
		$cache=Yii::app()->cache;
		$key='get_list_news_other_by_cate_id'.$cate_id.'_'.$lang.$id.$limit;
		
		if($data=$cache->get($key))
            return $data;
        else{
			$list_id=self::get_list_id_cate_by_parent_id($cate_id);
            $sql=" select l.*,p.id_cate,p.content_id,p.publish_at,i.thumb_image,i.image_x,i.image_y,i.id as i_id 
					from {{content}} p LEFT JOIN {{language_value}} l ON p.content_id = l.object_id LEFT JOIN {{images}} i ON i.object_id=p.content_id where 
					i.object_type='T' and i.type='M' and l.object_type='T' and l.lang_code='".$lang."' and p.id_cate in ({$list_id}) and p.content_id != ".$id;
				$sql.=" order by rand()";
				$sql.=" LIMIT 0,".$limit;
			
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
	}
	public static function get_list_cau_hoi_khac($id,$lang='vn',$limit=6)
	{
		$criteria = new CDbCriteria(array(
			'order' => 't.created_at DESC',
			'with' => array('language'),
		));
        $criteria->addCondition('language.lang_code=:lang');
		$criteria->params[':lang'] = $lang;
        $criteria->addCondition('t.status=:status');
		$criteria->params[':status'] = 1;
		$criteria->addCondition('t.id !=:id');
		$criteria->params[':id'] = $id;
        $criteria->limit=$limit;
		$list_cauhoi = Faqs::model()->findAll($criteria);
		return $list_cauhoi;
	}
	public static function get_list_menu($lang='vn',$cid=0)
	{
		$cache=Yii::app()->cache;
		$key='get_list_menu_'.$cid.'_'.$lang;
		if($data=$cache->get($key))
            return $data;
        else{
			$criteria = new CDbCriteria(array(
				'order' => 't.priority ASC',
				'with' => array('subcats','language'),
			));
			$criteria->addCondition('language.lang_code=:lang');
			$criteria->params[':lang'] = $lang;
			$criteria->addCondition('t.show_in_menu=:show_in_menu');
			$criteria->params[':show_in_menu'] = 1;
			if ( $cid != 0 ) {
				$criteria->addCondition('t.parent_id=:parent_id');
				$criteria->params[':parent_id'] = $cid;
			} else {
				$criteria->scopes = array('level_1');
			}
			$data = Category::model()->findAll($criteria);
			$cache->set($key,$data,86400);
			return $data;
		}
		
	}
	public static function get_general($pos,$lang='vn',$name=false)
    {
        $cache=Yii::app()->cache;
		$key='get_general'.$pos.'_'.$lang.'_'.$name;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select l.* from {{general}} p, {{language_value}} l ";
            $sql.="where p.id = l.object_id and l.object_type='S' and l.lang_code='{$lang}' and p.position='{$pos}' order by id desc";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            if(empty($data)) return $pos;
            
            if($name){
                $cache->set($key,$data['name'],86400);
                return $data['name'];
            } 
            else{
	            $cache->set($key,$data,86400);
				return $data;
            }
            
        }
    }
	public static function Taocode()
	{
			
			// Create a blank image and add some text
			$im = imagecreatetruecolor(150, 50);
			$grey = imagecolorallocate($im, 193, 112, 104);
			//$font_color =  0x000000;
			$text_color = imagecolorallocate($im, 0, 0, 0);
			imagecolortransparent($im, $text_color);
			$val= rand(9,true).rand(9,true).rand(9,true).rand(9,true).rand(9,true).rand(9,true);
			//imagestring($im, 5, 5, 5,  $val , $text_color);
			// The text to draw
			//$text = 'Testing...';
			// Replace path by your own font path
			//$font_size = 12;
			$font = Yii::app()->basePath."/../font/arial.ttf";
			//die($font);
			// Add some shadow to the text
			imagettftext($im, 25, 0, 0, 45, $grey, $font, $val);

			// Add the text
			//imagettftext($im, 13, 0, 50, 20, $text_color, $font, $val);
			// Save the image as 'simpletext.jpg'
			imagepng($im, Yii::app()->basePath."/../cap/captcha.png");
			Yii::app()->user->setState('val_cap', $val);
			// Free up memory
			imagedestroy($im);
	}
    public static function generatePassword($length = 6, $special_chars = false, $extra_special_chars = false) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ( $special_chars )
            $chars .= '!@#$%^&*()';
        if ( $extra_special_chars )
            $chars .= '-_ []{}<>~`+=,.;:/?|';

        $password = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $password .= substr($chars, rand(0, strlen($chars) - 1), 1);
        }

        // random_password filter was previously in random_password function which was deprecated
        return $password;
    }
	public static function sendmail($sub,$email,$layout_name,$content=array())
	{
        $rs = Setting::model()->findByAttributes(array('setting_name'=>'email'));
        $config=json_decode($rs->setting_value);
       // var_dump($config);
		$mail = new YiiMailer();
		$mail->setView($layout_name);
		$mail->setData($content);
		//render HTML mail, layout is set from config file or with $mail->setLayout('layoutName')
		$mail->render();
        
		//set properties as usually with PHPMailer
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "SSL";                 // sets the prefix to the servier
		$mail->Host       = $config->host;      // sets GMAIL as the SMTP server
		$mail->Port       = $config->port;                   // set the SMTP port for the GMAIL server
		$mail->Username   = $config->username;  // GMAIL username
		$mail->Password   = $config->password;            // GMAIL password
		$mail->From = $config->from;
		$mail->FromName = $config->fromname;
		$mail->Subject = $sub;

		$mail->AddAddress($email);
		//send
		if ( $mail->Send() ) {
			$mail->ClearAddresses();
            return 1;
		}
        else{
            return $mail->ErrorInfo;
        }
	}
	public static function get_list_province()
    {
        $cache=Yii::app()->cache;
		$key='get_list_province';
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select * from {{province}}";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
    }
	public static function get_list_district_by_id($id)
    {
        $cache=Yii::app()->cache;
		$key='get_list_district_by_id'.$id;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select * from {{district}} where provinceid='{$id}' order by name asc";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
    }
	public static function get_list_ward_by_districtid($id)
    {
        $cache=Yii::app()->cache;
		$key='get_list_ward_by_districtid'.$id;
		if($data=$cache->get($key))
            return $data;
        else{
            $sql="select * from {{ward}} where districtid='{$id}'";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
    }
	public static function get_list_ungdung($limit=9)
	{
		$cache=Yii::app()->cache;
		$key='get_list_ungdung'.$limit;
		if($data=$cache->get($key))
            return $data;
        else{
			$criteria = new CDbCriteria(array(
				'order' => 't.created_at DESC',
				'with' => array('language'),
			));
			$criteria->addCondition('language.lang_code=:lang');
			$criteria->params[':lang'] = $_SESSION['language'];
			$total_recorde=Gallery::model()->count($criteria);
			$criteria->limit=$limit;
			
			$data = Gallery::model()->findAll($criteria);
			 $cache->set($key,$data,86400);
			 return $data;
		}
	}
	public static function get_cate_path_by_cate_id($cate_id,$langcode='vn')
    {
        $cache=Yii::app()->cache;
		$key='get_cate_path_by_cate_id'.$cate_id.'_'.$langcode;
		if($data=$cache->get($key))
            return $data;
        else{
			$db=Yii::app()->db;
            $sql="SELECT c.id_path FROM {{category}} c WHERE c.id={$cate_id}";
			
			/* $sql="SELECT c.id as c_id,l.* FROM {{category}} c, {{language_value}} l WHERE c.status=1  and c.id={$cate_id} and c.id=l.object_id and l.object_type='C' and l.lang_code='{$langcode}'";/**/
    		
    		$command=$db->createCommand($sql);
    		$data = $command->queryRow();
			$arr_path=str_replace("/",",",$data['id_path']);
			$sql="SELECT l.seo_name,c.id FROM {{category}} c, {{language_value}} l WHERE c.status=1  and c.id in ({$arr_path}) and c.id=l.object_id and l.object_type='C' and l.lang_code='{$langcode}'";
			$command=$db->createCommand($sql);
    		$data = $command->queryAll();
			$cache->set($key,$data,86400);
    		return $data;
        }
    }
	public static function show_luot_truy_cap()
    {
            $sql="select * from {{traffic}} where id=1";
            $command=app()->db->createCommand($sql);
      		$data = $command->queryRow();
            return $data['user_truy_cap'];
    }
	public static function add_truy_cap()
	{
		$sql="update {{traffic}} set user_truy_cap=user_truy_cap+1 where id=1";
		$command=app()->db->createCommand($sql);
		$data = $command->execute();
	}
	public static function add_user_by_sessionid($session_id,$time,$time_check)
	{
		 $sql="select count(*) as dem from {{user_online}} where session='{$session_id}'";
		$command=app()->db->createCommand($sql);
		$data = $command->queryRow();
		if($data['dem']==0)
		{
			$sql="insert into {{user_online}}(session,`time`) values('{$session_id}',{$time})";
		    $command=app()->db->createCommand($sql)->execute();
		}
		else{
			$sql="update {{user_online}} set time={$time} where session='{$session_id}'";	
			$command=app()->db->createCommand($sql)->execute();
		}
		$sql="delete from {{user_online}} where `time` < {$time_check}";	
		$command=app()->db->createCommand($sql)->execute();
	}
	public static function count_user_online()
	{
		$sql="select count(*) as dem from {{user_online}}";
		$command=app()->db->createCommand($sql);
		$data = $command->queryRow();
		return $data['dem'];
	}
    public static function check_parent_id_cate($cate_id,$parent_id)
    {
        $sql="select count(*) as dem from {{category}} where id_path like '%{$cate_id}%' and parent_id={$parent_id}";
        $command=app()->db->createCommand($sql);
        $data = $command->queryRow();
        if($data['dem']==0) return false;
        return true;
    }
    public static function check_old_pass($old_pass,$user_id)
    {
        $sql="select count(*) as dem from {{user}} where password='{$old_pass}' and id={$user_id}";
        $command=app()->db->createCommand($sql);
        $data = $command->queryRow();
        if($data['dem']==0) return false;
        return true;
    }
    public static function get_list_kichthuoc_kem_sl($cate_id)
    {
        $cache=Yii::app()->cache;
        $key='get_list_kichthuoc'.$cate_id;
        if($data=$cache->get($key))
            return $data;
        else{
            $sql="select kt.*,count(p.id) as sl_sp from {{kichthuoc}} as kt, {{products}} as p, {{category}} as c";
            $sql.=" Where kt.id=p.id_size and p.cate_id=c.id and (p.cate_id={$cate_id} or concat('/',c.id_path,'/') like '%/{$cate_id}/%')";
            $sql.=" group by kt.id";
             $command=app()->db->createCommand($sql);
             $data=$command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
         
    }
    public static function get_list_mausac_kem_sl($cate_id)
    {
        $cache=Yii::app()->cache;
        $key='get_list_mausac_kem_sl'.$cate_id;
        if($data=$cache->get($key))
            return $data;
        else{
            $sql="select kt.*,count(p.id) as sl_sp from {{mausac}} as kt, {{products}} as p, {{category}} as c";
            $sql.=" Where kt.id=p.id_mau_sac and p.cate_id=c.id and (p.cate_id={$cate_id} or concat('/',c.id_path,'/') like '%/{$cate_id}/%')";
            $sql.=" group by kt.id";
             $command=app()->db->createCommand($sql);
             $data=$command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
         
    }
    public static function get_list_khuvuc_kem_sl($cate_id)
    {
        $cache=Yii::app()->cache;
        $key='get_list_khuvuc_kem_sl'.$cate_id;
        if($data=$cache->get($key))
            return $data;
        else{
            $sql="select kt.*,count(p.id) as sl_sp from {{khuvuc}} as kt, {{products}} as p, {{category}} as c";
            $sql.=" Where kt.id=p.id_khu_vuc and p.cate_id=c.id and (p.cate_id={$cate_id} or concat('/',c.id_path,'/') like '%/{$cate_id}/%')";
            $sql.=" group by kt.id";
             $command=app()->db->createCommand($sql);
             $data=$command->queryAll();
            $cache->set($key,$data,86400);
            return $data;
        }
         
    }
    public static function get_value_promotion($promotion_type,$val,$only_apply)
    {
      
      	$date=date("Y-m-d H:i:s");
        $sql="select * from {{chuongtrinh_khuyenmai}}";
        $sql.=" Where promotion_type=:promotion_type AND only_apply=:only_apply";
        $sql.=" AND start_value <=:val AND end_value >=:val";
        $sql.=" AND start_date <=:ngay AND end_date >=:ngay ";
        $sql.=" order by created_date desc";
         $command=app()->db->createCommand($sql);
         $command->bindParam(':promotion_type', $promotion_type);
         $command->bindParam(':val', $val);
         $command->bindParam(':ngay', $date);
         $command->bindParam(':only_apply', $only_apply);
         
         $data=$command->queryRow();
        return $data;
         
    }
    public static function get_value_promotion_by_coupon_code($promotion_type,$val,$only_apply)
    {
      
      	$date=date("Y-m-d H:i:s");
        $sql="select ck.* from {{chuongtrinh_khuyenmai}} ck, {{khuyenmai_detail}} kd";
        $sql.=" Where ck.promotion_type=:promotion_type AND ck.only_apply=:only_apply";
        $sql.=" AND ck.id=kd.id_ctkm AND kd.coupon_code=:code";
        $sql.=" AND ck.start_date <=:ngay AND ck.end_date >=:ngay ";
        $sql.=" AND kd.status=0";
        $sql.=" order by created_date desc";
         $command=app()->db->createCommand($sql);
         $command->bindParam(':promotion_type', $promotion_type);
         $command->bindParam(':val', $val);
         $command->bindParam(':ngay', $date);
          $command->bindParam(':code', $val);
         $command->bindParam(':only_apply', $only_apply);
         
         $data=$command->queryRow();
        return $data;
         
    }
    public static function get_value_promotion_by_id($id_ctkm)
    {
      
        $sql="select * from {{chuongtrinh_khuyenmai}}";
        $sql.=" Where id=:id ";
         $command=app()->db->createCommand($sql);
         $command->bindParam(':id', $id_ctkm);
         
         $data=$command->queryRow();
        return $data;
         
    }
    public static function update_code_coupon($code,$id_ctkm)
    {
	    $sql="update {{khuyenmai_detail}} set status=1 where coupon_code='{$code}' and id_ctkm={$id_ctkm}";
		$command=app()->db->createCommand($sql);
		$data = $command->execute();
    }
    public static function get_author_by_id($id)
    {
	    $cache=Yii::app()->cache;
        $key='get_author_by_id'.$id;
        if($data=$cache->get($key))
            return $data;
        else{
	        $sql="select * from {{adminuser}} where id={$id}";
	        $command=app()->db->createCommand($sql);
	        $data = $command->queryRow();
	        $cache->set($key,$data['fullname'],86400);
	        return $data['fullname'];
	    }
    }
}

?>