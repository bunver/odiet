<?php
	include('db.inc.php');
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	
	function updateDietStats(){
		global $db;
		
		$sql = "SELECT * FROM user_goal WHERE u_id=:u_id AND ug_status='1' ORDER BY ug_create_date DESC LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id , PDO::PARAM_INT);
		$stmt->execute();   
		$obj_goal = $stmt->fetchObject();
		
		$sql = "SELECT * FROM user_physical WHERE u_id=:u_id ORDER BY up_date DESC LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->execute();   
		$obj_physical = $stmt->fetchObject();
		
		date_default_timezone_set("America/New_York");
		$date = date("Y-m-d H:i:s");
		
		if($obj_goal->ug_first_weight > $obj_goal->ug_weight){
			$goal = 'loss';
		} else {
			$goal = 'gain';
		}
		
		if($obj_goal->ug_first_weight > $obj_physical->up_weight){
			$current = 'loss';
		} else {
			$current = 'gain';
		}
		
		if($goal == $current){
			$progress = 'P';
		} else {
			$progress = 'N';
		}
		
		$second = strtotime($date) - strtotime($obj_goal->ug_create_date);
		$week = ceil($second / (60 * 60 * 24 * 7));
		$current_difference = abs($obj_physical->up_weight - $obj_goal->ug_first_weight);
		$goal_difference = $obj_goal->ug_first_weight - $obj_goal->ug_weight;
		
		$percent = ceil(($current_difference * 100) / $goal_difference);
		
		
		$sql = "UPDATE diet_stats SET ds_duration=:ds_duration, ds_percent=:ds_percent, ds_difference=:ds_difference, ds_progress=:ds_progress, ds_weight=:ds_weight, ds_date=:ds_date WHERE u_id=:u_id"; 			
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':ds_duration', $week, PDO::PARAM_STR);
		$stmt->bindParam(':ds_percent', $percent, PDO::PARAM_STR);		
		$stmt->bindParam(':ds_difference', $current_difference, PDO::PARAM_STR);
		$stmt->bindParam(':ds_progress', $progress, PDO::PARAM_STR);
		$stmt->bindParam(':ds_weight', $obj_physical->up_weight, PDO::PARAM_INT);
		$stmt->bindParam(':ds_date', $date, PDO::PARAM_STR);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		return $total;

	}
	
	function getAge($birthdate){
		
		$currentDate = date("Y");
		
		$date = DateTime::createFromFormat("Y-m-d", $birthdate);
		$birthdate = $date->format("Y");
		
		$age = $currentDate - $birthdate;
		
		return $age;
		
	}
	
	function getRefWeightUpdate($ref_id, $u_id){
		global $db;
		
		$sql = "SELECT * FROM user_physical WHERE up_id=:ref_id AND u_id=:u_id LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':ref_id',$ref_id, PDO::PARAM_INT);
		$stmt->bindParam(':u_id',$u_id, PDO::PARAM_INT);
		$stmt->execute();   
		$obj = $stmt->fetchObject();
		
		$displayDate = displayDate($obj->up_date, 2);
		$obj->displayDate = $displayDate;
		
		return $obj;
	}
	
	function getRefRegisterDate($ref_id, $u_id){
		global $db;
		
		$sql = "SELECT u_register_date FROM user WHERE u_id=:ref_id LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':ref_id',$ref_id, PDO::PARAM_INT);
		$stmt->execute();   
		$obj = $stmt->fetchObject();
		
		$displayDate = displayDate($obj->u_register_date, 2);
		$obj->displayDate = $displayDate;
		
		return $obj;
	}
	
	function getRefStartDiet($ref_id, $u_id){
		global $db;
		
		$sql = "SELECT * FROM user_goal WHERE ug_id=:ref_id AND u_id=:u_id LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':ref_id',$ref_id, PDO::PARAM_INT);
		$stmt->bindParam(':u_id',$u_id, PDO::PARAM_INT);
		$stmt->execute();   
		$obj = $stmt->fetchObject();
		
		$displayDate = displayDate($obj->ug_create_date, 2);
		
		$obj->displayDate = $displayDate;
		
		return $obj;
	}
	
	function getRefStatusShare($ref_id, $u_id){
		global $db;
		
		$sql = "SELECT * FROM user_status WHERE us_id=:ref_id AND u_id=:u_id LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':ref_id',$ref_id, PDO::PARAM_INT);
		$stmt->bindParam(':u_id',$u_id, PDO::PARAM_INT);
		$stmt->execute();   
		$obj = $stmt->fetchObject();
		
		$displayDate = displayDate($obj->us_date, 2);		
		$obj->displayDate = $displayDate;
		
		return $obj;
	}
	
	function getImgSrc($p_id, $type){
		
		switch($type){
			case 'profile';
				$imgSrc = 'photos/profile/'.$p_id.'.jpg';
			break;
			case 'status';
				$imgSrc = 'photos/status/'.$p_id.'.jpg';
			break;
			case 'cover';
				$imgSrc = 'photos/cover/'.$p_id.'.jpg';
			break;
			case 'physical';
				$imgSrc = 'photos/physical/'.$p_id.'.jpg';
			break;
		}
		
		return $imgSrc;
		
	}
	
	function addUserAction($u_id, $ref_id, $type){
		global $db;
		
		date_default_timezone_set("America/New_York");
		$date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO user_action (u_id, ref_id, ua_type, ua_date) VALUES(:u_id, :ref_id, :ua_type, :ua_date)"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $u_id, PDO::PARAM_INT);
		$stmt->bindParam(':ref_id', $ref_id, PDO::PARAM_INT);
		$stmt->bindParam(':ua_type', $type, PDO::PARAM_STR);
		$stmt->bindParam(':ua_date', $date, PDO::PARAM_STR);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		return $total;
	}
	
	function getUserTimeline($u_id){
		global $db;
		
		$sql = "SELECT * FROM user_action WHERE u_id=:u_id AND ua_status='1' ORDER BY ua_date DESC"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$u_id , PDO::PARAM_INT);
		$stmt->execute();   
		//$obj = $stmt->fetchObject();
		
		return $stmt;
	}
	
	function isSingle($number){
		if ($number > 1){
			return 's';
		}
	}
	
	function displayDate($datetime, $type){	
		date_default_timezone_set("America/New_York");
		if($type == 0){
			$date = date_create($datetime);
			$new_date = date_format($date,"d F Y");
		} else if($type == 1){
			$now = time();
			$reference = strtotime($datetime);
			$second = $now - $reference;
			$minute = floor($second / 60);
			$hour = floor($minute / 60);
			$day = floor($hour / 24);
			$month = floor($day / 30);
			$year = floor($month / 12);
			
			if ($second<60){
				$new_date = 'just added';
			} else if ($minute<60){
				$new_date = $minute.' minutes ago';				
			} else if ($hour<24){
				$new_date = $hour.' hours ago';		
			} else if ($day<30){
				$new_date = $day.' days ago';		
			} else if ($month<12){
				$new_date = $month.' months ago';		
			} else {
				$new_date = $year.' years ago';		
			}				
		} else if($type == 2){
			$datetime1 = new DateTime(date('Y-m-d H:i:s', time()));
			$datetime2 = date_create($datetime);
			$oDiff = $datetime1->diff($datetime2);
	
			if ($oDiff->y>0){
				$new_date = $oDiff->y.' year'.isSingle($oDiff->y).' ago';	
			} else if ($oDiff->m>0){
				$new_date = $oDiff->m.' month'.isSingle($oDiff->m).' ago';	
			} else if ($oDiff->d>0){
				$new_date = $oDiff->d.' day'.isSingle($oDiff->d).' ago';	
			} else if ($oDiff->h>0){
				$new_date = $oDiff->h.' hour'.isSingle($oDiff->h).' ago';	
			} else if ($oDiff->i>0){
				$new_date = $oDiff->i.' minute'.isSingle($oDiff->i).' ago';	
			} else {
				$new_date = ' just added';	
			}
			
		} else if($type == 3){
			setlocale(LC_TIME, 'tr_TR');
			$new_date = strftime('%e %B %Y', strtotime($datetime));			
		}
		
		return $new_date;
	}
	
	function getAddress($zip){
		
		global $db;
		
		$sql = "SELECT * FROM uszip WHERE zip=:zip LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':zip',$zip, PDO::PARAM_INT);
		$stmt->execute();   
		$obj = $stmt->fetchObject();
		
		return $obj;
		
	}
	
	function getDietStats(){
		global $db;
		
		$sql = "SELECT * FROM diet_stats WHERE u_id=:u_id LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->execute();   
		$obj = $stmt->fetchObject();
		
		return $obj;
	}
	
	function isUpUpdateRequired(){
		global $db;
		
		date_default_timezone_set("America/New_York");
		$date = date("Y-m-d H:i:s");
		$date2 = date("H");
		
		$sql = "SELECT DATEDIFF(:date,up_date) AS DiffDate FROM user_physical WHERE u_id=:u_id ORDER BY up_date DESC LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':date',$date, PDO::PARAM_STR);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		
		if($obj->DiffDate AND $date2 >= 0){
			return 1;
		} else {
			return 0;
		}
	}
	function dietStatus(){
		global $db;
		
		$sql = "SELECT * FROM user_goal WHERE u_id=:u_id AND ug_status='1' LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id , PDO::PARAM_INT);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$total = $stmt->rowCount();
		
		return $total;
	}
	function checkRequiredInfo(){
		global $db;
		if(strlen($_SESSION['user']->u_gender) == 0 OR $_SESSION['user']->u_birthday == "0000-00-00" OR strlen($_SESSION['user']->u_country) == 0){
			return 'step1';
		}
		
		$sql = "SELECT * FROM user_physical WHERE u_id=:u_id LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id , PDO::PARAM_INT);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$totalPhysical = $stmt->rowCount();
		
		if($totalPhysical == 0){
			$sql = "INSERT INTO user_physical (u_id) VALUES(:u_id)"; 	
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
			$stmt->execute();
			return 'step2';
		} else if($totalPhysical == 1){
			if($obj->up_height == 0 || $obj->up_weight == 0){
				return 'step2';
			}
		}
		
		$sql = "SELECT * FROM photo WHERE u_id=:u_id LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id , PDO::PARAM_INT);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$totalPhoto = $stmt->rowCount();
		
		if($totalPhoto == 0){
			return 'step3';
		}
		
		return 'home';	
	}
?>