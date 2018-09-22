<?php
    class CronCommand extends CConsoleCommand
	{
	    public function actionAutomoney($date="") {
	    	
			$db=Yii::app()->db;
			if($date=="")
			{
				$sql="select MAX(m.score_point) as max_point, c.user_name, m.id_user,m.id 
						from match_2048 m, cc_user c 
					where c.id=m.id_user and DATE_FORMAT(m.created_at, '%Y-%m-%d') = CURDATE()  
					GROUP BY m.id_user ORDER BY max_point desc limit 0,1";
				$sql_tong="SELECT sum(xu_cuoc) as tong FROM match_2048 WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE()";
			}
			else{
				$sql="select MAX(m.score_point) as max_point, c.user_name, m.id_user,m.id 
						from match_2048 m, cc_user c 
					where c.id=m.id_user and DATE_FORMAT(m.created_at, '%Y-%m-%d') = {$date}  
					GROUP BY m.id_user ORDER BY max_point desc limit 0,1";
				$sql_tong="SELECT sum(xu_cuoc) as tong FROM match_2048 WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = {$date}";
			}
			$data=$db->createCommand($sql)->queryRow();
			if($data['id_user'] !=null)
			{
				$row=$db->createCommand($sql_tong)->queryRow();
				if($row['tong']!=null)
				{
					$sql="UPDATE cc_user SET game_coin=game_coin + ".$row["tong"]." WHERE id=".$data["id_user"];
					$db->createCommand($sql)->execute();  
					$sql="UPDATE match_2048 SET kq=".$data["id_user"]." WHERE id=".$data["id"];
					$db->createCommand($sql)->execute();
					$chuoi_username=$data["user_name"]." thắng được tổng số xu là : ".$row["tong"]." xu với số điểm cao nhất là: ".$data["max_point"];
					$sql="INSERT INTO log_2048(log,id_match,created_at) VALUES('$chuoi_username',".$data["id"].",now())";
					$db->createCommand($sql)->execute();
					echo "1";
				}
				else echo "0";
			}
			else echo "-1";
	    }
	}
?>