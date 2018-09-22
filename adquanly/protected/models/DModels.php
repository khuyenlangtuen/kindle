<?php
class DModels
{
	protected $_model;
	protected $_perms;
    
    function checkPerm($perm,$user_id) {
		if ( $this->_perms === null ) {
			if ( $this->_model === null ) {
				$this->_model=Adminuser::model()->findByPk($user_id);
			}

			$perms = array();
			$usergroups = $this->_model->usergroups;
            //var_dump($usergroups);exit();
			if ( !empty($usergroups) ) {
				foreach ($usergroups as $usergroup) {
					$privileges = Admingroup::getGroupPrivileges($usergroup->id);
					$perms = array_merge($perms, $privileges);
				}
			}

			$perms = array_unique($perms);
			$this->_perms = array_flip($perms);
		}

		if ( isset($this->_perms[$perm]) ) {
			return true;
		}

		return false;
	}
    public static function update_language($code)
    {
        app()->db->createCommand()->update(
          '{{language}}',
          array('status'=>0)
        );
        app()->db->createCommand()->update(
          '{{language}}',
          array('status'=>1),
          'lang_code = :param',
          array(':param'=>$code)
        );
    }
    public static function get_block_product($block_type,$lang,$option_id=0)
    {

        $sql="select l.name,p.*,bp.id as b_id from {{block_product}} bp, {{products}} p, {{language_value}} l ";
        $sql.="where bp.product_id=p.id and p.id = l.object_id and l.object_type='P' and bp.block_type='{$block_type}' and l.lang_code='{$lang}'";
        if($option_id)
        {
            $sql.=" and bp.option_id=".$option_id;
        }
        $command=app()->db->createCommand($sql);
  		$data = $command->queryAll();
        return $data;
    }
    public static function get_list_id_block_product($block_type,$option_id=0)
    {
        $w="";
        if($option_id) $w=" and option_id=".$option_id;
        $sql="select product_id from {{block_product}} where block_type='{$block_type}'".$w;
       // var_dump($sql);
        $command=app()->db->createCommand($sql);
  		$data = $command->queryColumn();
        return $data;
    }
    public static function get_list_options_by_productID($product_id)
    {
        $sql="select * from {{options}} where product_id={$product_id} order by priority asc";
        $command=app()->db->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    public static function get_list_block_by_optionID($option_id)
    {
        $sql="select * from {{options}} where id={$option_id}";
        $command=app()->db->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
    public static function add_product_picker($block_type,$chuoi_id)
    {
        
        if($chuoi_id)
        {
            $list_id=explode('|',$chuoi_id);
            if($list_id)
            {
                foreach($list_id as $id)
                {
                    if($id)
                    {
                        $flag=self::check_id_exist($id,$block_type);
                        if($flag==0)
                        {
                            $command = app()->db->createCommand('REPLACE INTO {{block_product}} (product_id, block_type, created_at) VALUES (:product_id, :block_type, :created_at)');
                    		$command->execute(array(
                    			':product_id' => $id,
                    			':block_type' => $block_type,
                    			':created_at' => date('Y-m-d h:i:s'),
                    		));
                        }
                    }
                }
            }
        }
    }
    public static function add_product_picker_option($block_type,$chuoi_id,$option_name,$priority,$product_id,$option_id=0)
    {
        if($option_id > 0)
        {
            $command = app()->db->createCommand('UPDATE {{options}} SET lang_code_name=:option_name,priority=:priority where id=:option_id');
            $command->execute(array(
                ':option_name' => $option_name,
                ':priority' => $priority,
                ':option_id'=>$option_id,
            ));
        }
        else{
            $command = app()->db->createCommand('REPLACE INTO {{options}} (lang_code_name, priority, created_at,product_id) VALUES (:lang_code_name, :priority, :created_at,:product_id)');
            $k=$command->execute(array(
                ':lang_code_name' => $option_name,
                ':priority' => $priority,
                ':created_at' => date('Y-m-d h:i:s'),
                ':product_id'=>$product_id,
            ));
            if($k) $option_id=app()->db->getLastInsertID();
        }
        if($option_id > 0){
             //self::xoa_all_by_block_option_id($option_id);
            if($chuoi_id)
            {
                $list_id=explode('|',$chuoi_id);
                if($list_id)
                {
                    foreach($list_id as $id)
                    {
                        if($id)
                        {
                            $flag=self::check_id_exist($id,$block_type,$option_id);
                            if($flag==0)
                            {
                                $command = app()->db->createCommand('REPLACE INTO {{block_product}} (product_id, block_type, created_at,option_id) VALUES (:product_id, :block_type, :created_at,:option_id)');
                                $command->execute(array(
                                    ':product_id' => $id,
                                    ':block_type' => $block_type,
                                    ':created_at' => date('Y-m-d h:i:s'),
                                    ':option_id'=>$option_id,
                                ));
                            }
                        }
                    }
                }
            }
        }
       
    }

    public static function xoa_all_by_block_option_id($option_id)
    {
         $sql="DELETE from {{block_product}} where option_id={$option_id} ";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function xoa_option_id($option_id)
    {
         $sql="DELETE from {{options}} where id={$option_id} ";
         $command=app()->db->createCommand($sql)->execute();
         return $command;
    }
    public static function check_id_exist($id,$block_type,$option_id=0)
    {

         $sql="select count(*) as dem from {{block_product}} where block_type='{$block_type}' and product_id={$id} ";
         if($option_id) $sql.=" and option_id={$option_id}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryRow();
         return $data['dem'];
    }
    public static function del_picker($id)
    {
        $sql="DELETE FROM {{block_product}} where id={$id}";
        $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
	public static function get_product_by_id($id,$lang='vn')
    {
        
		$sql="select l.*,p.cate_id,p.id as p_id,p.product_code,p.gia_goc,p.gia_ban,i.thumb_image,i.image_x,i.image_y,i.id as i_id from {{products}} p, {{language_value}} l,{{images}} i ";
		$sql.="where i.object_id=p.id and i.object_type='P' and i.type='M' and p.id = l.object_id and l.object_type='P' and l.lang_code='{$lang}' and p.id={$id}";
		$command=app()->db->createCommand($sql);
		$data = $command->queryRow();
		return $data;
    }	
    public static function get_cate_name_by_cate_id($id,$lang='vn')	
    {		
	    $sql="select l.name from {{category}} p, {{language_value}} l ";		
	    $sql.="where  p.id = l.object_id and l.object_type='C' and l.lang_code='{$lang}' and concat('/',p.id_path,'/') like concat('%/',{$id},'/%')";		
	    $command=app()->db->createCommand($sql);		
	    $data = $command->queryRow();		
	    return $data['name'];	
    }
    public static function get_cate_name_cate_parent_by_cate_id($id,$lang='vn')	
    {		
	    $sql="select l.name,p.parent_id from {{category}} p, {{language_value}} l ";		
	    $sql.="where  p.id = l.object_id and l.object_type='C' and l.lang_code='{$lang}' and concat('/',p.id_path,'/') like concat('%/',{$id},'/%')";		
	    $command=app()->db->createCommand($sql);		
	    $data = $command->queryRow();
	    $kq=$data['name'];
	    if($data['parent_id'] > 0)	
	    {
		    $sql="select l.name from {{category}} p, {{language_value}} l ";		
		    $sql.="where  p.id = l.object_id and l.object_type='C' and l.lang_code='{$lang}' and p.id=".$data['parent_id'];		
		    $command=app()->db->createCommand($sql);		
		    $data2 = $command->queryRow();
		    $kq=$data2['name']." - ".$data['name'];
	    }
	    		
	    return $kq;	
    }
    public static function check_show_menu($group_name,$admin_id)
    {
        $sql="SELECT count(*) as dem FROM {{admingroup_privileges}} ap, {{admingroup_links}} al where ap.group_id=al.group_id and ap.privilege like '%$group_name%' and al.adminuser_id=$admin_id;";
        $command=app()->db->createCommand($sql);
        $data = $command->queryRow();
        if($data['dem'] > 0) return true;
        return false;
    }
    public static function get_list_mausac()
    {

         $sql="select * from {{mausac}}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryAll();
         return $data;
    }
    public static function add_mausac($mau)
    {

         $sql="INSERT INTO  {{mausac}}(name,created_at) VALUES('{$mau}',now())";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_mausac_by_id($id)
    {

         $sql="select * from {{mausac}} where id={$id}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryRow();
         return $data;
    }
    public static function update_mausac($mau,$id)
    {

         $sql="UPDATE {{mausac}} SET name='{$mau}' where id={$id}";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_list_kichthuoc()
    {

         $sql="select * from {{kichthuoc}}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryAll();
         return $data;
    }
    public static function add_kichthuoc($size)
    {

         $sql="INSERT INTO  {{kichthuoc}}(`size`,created_at) VALUES('{$size}',now())";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_kichthuoc_by_id($id)
    {

         $sql="select * from {{kichthuoc}} where id={$id}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryRow();
         return $data;
    }
    public static function update_kichthuoc($size,$id)
    {

         $sql="UPDATE {{kichthuoc}} SET size='{$size}' where id={$id}";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    
    public static function del_kichthuoc($id)
    {
        $sql="DELETE FROM {{kichthuoc}} where id={$id}";
        $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function del_mausac($id)
    {
        $sql="DELETE FROM {{mausac}} where id={$id}";
        $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_list_khuvuc()
    {

         $sql="select * from {{khuvuc}}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryAll();
         return $data;
    }
    public static function add_khuvuc($name)
    {

         $sql="INSERT INTO  {{khuvuc}}(`name`,created_at) VALUES('{$name}',now())";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_khuvuc_by_id($id)
    {

         $sql="select * from {{khuvuc}} where id={$id}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryRow();
         return $data;
    }
    public static function update_khuvuc($name,$id)
    {

         $sql="UPDATE {{khuvuc}} SET name='{$name}' where id={$id}";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    
    public static function del_khuvuc($id)
    {
        $sql="DELETE FROM {{khuvuc}} where id={$id}";
        $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_list_ctkm()
    {

         $sql="select * from {{chuongtrinh_khuyenmai}}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryAll();
         return $data;
    }
    public static function get_ctkm_by_id($id)
    {

         $sql="select * from {{chuongtrinh_khuyenmai}} where id={$id}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryRow();
         return $data;
    }
    public static function update_ctkm($arr,$id)
    {

         $sql="UPDATE {{chuongtrinh_khuyenmai}} SET name='{$name}' where id={$id}";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    
    public static function del_ctkm($id)
    {
        $sql="DELETE FROM {{chuongtrinh_khuyenmai}} where id={$id}";
        $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
     public static function update_revision($id)
    {
	    $sql="select parent_id from {{category}} where id={$id}";
         $command=app()->db->createCommand($sql);
         $data=$command->queryRow();
         $sql="UPDATE {{category}} SET revision=revision+1 where id={$data['parent_id']}";
         $command=app()->db->createCommand($sql)->execute();
        return $command;
    }
    public static function get_author_by_id($id)
    {
	    
	        $sql="select * from {{adminuser}} where id={$id}";
	        $command=app()->db->createCommand($sql);
	        $data = $command->queryRow();
	        return $data['fullname'];
    }
}

?>