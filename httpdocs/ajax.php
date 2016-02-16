<?php
	include('db.inc.php');
	include('functions.php');

	$function = $_REQUEST['function'];
	
	switch ($function){
		case 'register';
			$u_email = $_REQUEST['u_email'];
			$u_firstname = $_REQUEST['u_firstname'];
			$u_lastname = $_REQUEST['u_lastname'];
			$u_password = $_REQUEST['u_password'];
			$u_passwordrepeat = $_REQUEST['u_passwordrepeat'];
			$agreementCheckbox = $_REQUEST['agreementCheckbox'];
			register($u_email, $u_firstname, $u_lastname, $u_password, $u_passwordrepeat, $agreementCheckbox);
		break;
		case 'login';
			$u_email = $_REQUEST['u_email'];
			$u_password = $_REQUEST['u_password'];
			$rememberCheckbox = $_REQUEST['rememberCheckbox'];
			login($u_email, $u_password, $rememberCheckbox);
		break;
		case 'checkZIP';
			$zip = $_REQUEST['zip'];
			checkZIP($zip);			
		break;
		case 'step1';
			$gender = $_REQUEST['gender'];
			$birthday = $_REQUEST['birthday'];
			$country = $_REQUEST['country'];
			$zip = $_REQUEST['zip'];
			step1($gender, $birthday, $country, $zip);			
		break;
		case 'step2';
			$feet = $_REQUEST['feet'];
			$inches = $_REQUEST['inches'];
			$pounds = $_REQUEST['pounds'];
			step2($feet, $inches, $pounds);			
		break;
		case 'imgUpload';
			$imgType = $_REQUEST['imgType'];
			$imgData = $_REQUEST['imgData'];			
			imgUpload($imgType,$imgData);			
		break;
		case 'startDiet';
			$currentWeight = $_REQUEST['currentWeight'];
			$targetWeight = $_REQUEST['targetWeight'];
			$targetDate = $_REQUEST['targetDate'];			
			startDiet($currentWeight, $targetWeight, $targetDate);			
		break;
		case 'updateWeight';
			$weight = $_REQUEST['weight'];			
			updateWeight($weight);			
		break;
		case 'statusShare';
			$statusText = $_REQUEST['statusText'];
			$imgType = $_REQUEST['imgType'];
			$imgData = $_REQUEST['imgData'];			
			statusShare($statusText, $imgType, $imgData);			
		break;
		case 'forgotPassword';
			$email = $_REQUEST['u_email'];			
			forgotPassword($email);			
		break;
		case 'changePassword';
			$oldPassword = $_REQUEST['oldPassword'];
			$newPassword = $_REQUEST['newPassword'];
			$newPasswordRepeat = $_REQUEST['newPasswordRepeat'];			
			changePassword($oldPassword, $newPassword, $newPasswordRepeat);			
		break;
		case 'editInfo';
			$firstName = $_REQUEST['firstName'];
			$lastName = $_REQUEST['lastName'];
			$gender = $_REQUEST['gender'];
			$birthday = $_REQUEST['birthday'];
			$country = $_REQUEST['country'];
			$zip = $_REQUEST['zip'];			
			editInfo($firstName, $lastName, $gender, $birthday, $country, $zip);			
		break;		
	}
	
	function editInfo($firstName, $lastName, $gender, $birthday, $country, $zip){
		global $db;
		session_start();
		$errorList = '';
		$firstError = true;
		
		if (strlen($firstName)==0 || strlen($lastName)==0 || strlen($gender)==0 || strlen($birthday)==0 || strlen($country)==0 || strlen($zip)==0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		if (strlen($firstName)<3 || strlen($firstName)>100){			
			if($firstError){
				$errorList .= 'Firstname must between 3-100 characters!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Firstname must between 3-100 characters!';
			}
		}
		if (strlen($lastName)<3 || strlen($lastName)>50){			
			if($firstError){
				$errorList .= 'Lastname must between 3-50 characters!!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Lastname must between 3-50 characters!!';
			}
		}
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		
		$sql = "UPDATE user SET u_firstname=:u_firstname, u_lastname=:u_lastname, u_gender=:u_gender, u_birthday=:u_birthday, u_country=:u_country, u_zip=:u_zip WHERE u_id=:u_id"; 			
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_firstname', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':u_lastname', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':u_gender', $gender, PDO::PARAM_STR);
		$stmt->bindParam(':u_birthday', $birthday, PDO::PARAM_STR);
		$stmt->bindParam(':u_country', $country, PDO::PARAM_STR);
		$stmt->bindParam(':u_zip', $zip, PDO::PARAM_INT);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		
		if($total == 1){
			$_SESSION['user']->u_firstname = $firstName;
			$_SESSION['user']->u_lastname = $lastName;
			$_SESSION['user']->u_gender = $gender;
			$_SESSION['user']->u_birthday = $birthday;
			$_SESSION['user']->u_country = $country;
			$_SESSION['user']->u_zip = $zip;
			$result['status'] = 'success';
			$result['msg'] = 'Your info successfully changed.';	
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			echo json_encode($result);
			exit;
		}
	}
	
	function changePassword($oldPassword, $newPassword, $newPasswordRepeat){
		global $db;
		session_start();
		$errorList = '';
		$firstError = true;
		
		if (strlen($oldPassword)==0 || strlen($newPassword)==0 || strlen($newPasswordRepeat)==0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		if($firstError == false){
			returnError($errorList);
		}
		
		$sql = "SELECT * FROM user WHERE u_id=:u_id LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_STR);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$total = $stmt->rowCount();
		
		if ($oldPassword !== $obj->u_password){
			if($firstError){
				$errorList .= 'Password is wrong!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Password is wrong!';
			}
		}
		
		if($firstError == false){
			returnError($errorList);
		}
		
		if (strlen($newPassword)<6 || strlen($newPassword)>24 || strlen($newPasswordRepeat)<6 || strlen($newPasswordRepeat)>24){			
			if($firstError){
				$errorList .= 'Password must between 6-24 characters!!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Password must between 6-24 characters!!';
			}
		}
		
		if ($newPassword !== $newPasswordRepeat){			
			if($firstError){
				$errorList .= 'Passwords does not match!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Passwords does not match!';
			}
		}
		
		if ($newPassword == $oldPassword){			
			if($firstError){
				$errorList .= 'You are already using this password!';
				$firstError = false;	
			} else {
				$errorList .= '<br />You are already using this password!';
			}
		}
		
		if($firstError == false){
			returnError($errorList);
		}
		
		$sql = "UPDATE user SET u_password=:u_password WHERE u_id=:u_id"; 			
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_password', $newPassword, PDO::PARAM_STR);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		if($total == 1){
			$result['status'] = 'success';
			$result['msg'] = 'Your password successfully changed.';			
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			echo json_encode($result);
			exit;
		}
		
	}
	
	function forgotPassword($email){
		global $db;
		$errorList = '';
		$firstError = true;
		
		if (strlen($email) == 0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			if($firstError){
				$errorList .= 'Please check your email address!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please check your email address!';
			}	
		}	
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		
		$sql = "SELECT * FROM user WHERE u_email=:u_email LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_email',$email , PDO::PARAM_INT);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$total = $stmt->rowCount();
		
		if($total == 1){
			sendMail($obj->u_email, 'password_reminder', $obj->u_password);
			$result['status'] = 'success';
			$result['msg'] = 'Your password sent to your email address.';
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			$result['msg'] = 'User not found with entered email!';
			echo json_encode($result); 			
			exit;
		}
	}
	
	function updateWeight($weight){
		global $db;
		$errorList = '';
		$firstError = true;
		session_start();
		
		if (strlen($weight) == 0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		if (!is_numeric($weight)){			
			if($firstError){
				$errorList .= 'Format error!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Format error!';
			}					
		}
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		$sql = "SELECT * FROM user_physical WHERE u_id=:u_id LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id',$_SESSION['user']->u_id , PDO::PARAM_INT);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$total = $stmt->rowCount();
		
		date_default_timezone_set("America/New_York");
		$date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO user_physical (u_id, up_weight, up_height, up_date) VALUES(:u_id, :up_weight, :up_height, :up_date)"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':up_weight', $weight, PDO::PARAM_STR);
		$stmt->bindParam(':up_height', $obj->up_height, PDO::PARAM_STR);
		$stmt->bindParam(':up_date', $date, PDO::PARAM_STR);
		$stmt->execute();
		$lastId = $db->lastInsertId();
		$total = $stmt->rowCount();
			
		if($total == 1){
			updateDietStats();
			$type = 'u_updated_weight';
			$action = addUserAction($_SESSION['user']->u_id, $lastId, $type);
			$result['status'] = 'success';
			$result['msg'] = 'Your weight updated';
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			$result['msg'] = 'Your weight could not update!';
			echo json_encode($result);
			exit;
		}
	}
	function startDiet($currentWeight, $targetWeight, $targetDate){
		global $db;
		$errorList = '';
		$firstError = true;
		session_start();
		
		if(dietStatus()){
			if($firstError){
				$errorList .= 'You already have an active diet!';
				$firstError = false;	
			} else {
				$errorList .= '<br />You already have an active diet!';
			}
		}
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		if (strlen($currentWeight) == 0 || strlen($targetWeight) == 0 || strlen($targetDate) == 0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		if (!is_numeric($currentWeight) || !is_numeric($targetWeight)){			
			if($firstError){
				$errorList .= 'Format error!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Format error!';
			}					
		}
		
		if ($currentWeight == $targetWeight){
			if($firstError){
				$errorList .= 'Your current weight end target weight can not be some!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Your current weight end target weight can not be some!';
			}
		}
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		date_default_timezone_set("America/New_York");
		$date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO user_goal (u_id, ug_weight, ug_first_weight, ug_date, ug_create_date) VALUES(:u_id, :ug_weight, :ug_first_weight, :ug_date, :ug_create_date)"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':ug_weight', $targetWeight, PDO::PARAM_STR);
		$stmt->bindParam(':ug_first_weight', $currentWeight, PDO::PARAM_STR);
		$stmt->bindParam(':ug_date', $targetDate, PDO::PARAM_STR);
		$stmt->bindParam(':ug_create_date', $date, PDO::PARAM_STR);
		$stmt->execute();
		$lastId = $db->lastInsertId();
		$total_goal = $stmt->rowCount();
		
		$sql = "INSERT INTO user_physical (u_id, up_weight, up_date) VALUES(:u_id, :up_weight, :up_date)"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':up_weight', $currentWeight, PDO::PARAM_STR);
		$stmt->bindParam(':up_date', $date, PDO::PARAM_STR);
		$stmt->execute();		
		$total_physical = $stmt->rowCount();
		
		$sql = "INSERT INTO diet_stats (u_id, ds_weight, ds_date) VALUES(:u_id, :ds_weight, :ds_date)"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':ds_weight', $currentWeight, PDO::PARAM_INT);
		$stmt->bindParam(':ds_date', $date, PDO::PARAM_STR);
		$stmt->execute();
			
		if($total_goal && $total_physical){			
			$type = 'u_started_diet';
			$action = addUserAction($_SESSION['user']->u_id, $lastId, $type);
			
			$result['status'] = 'success';
			$result['msg'] = 'Your diet created';
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			$result['msg'] = 'Your diet could not create';
			echo json_encode($result);
			exit;
		}
		
	}
	function step2($feet, $inches, $pounds){
		global $db;
		$errorList = '';
		$firstError = true;
		session_start();
		
		if (strlen($feet) == 0 || strlen($inches) == 0 || strlen($pounds) == 0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		if (!is_numeric($feet) || !is_numeric($inches) || !is_numeric($pounds)){			
			if($firstError){
				$errorList .= 'Format error!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Format error!';
			}					
		}
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		$heights = $feet * 12 + $inches;
		
		date_default_timezone_set("America/New_York");
		$date = date("Y-m-d H:i:s");
		
		$sql = "UPDATE user_physical SET up_height=:up_height, up_weight=:up_weight, up_date=:up_date WHERE u_id=:u_id"; 			
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':up_height', $heights, PDO::PARAM_STR);
		$stmt->bindParam(':up_weight', $pounds, PDO::PARAM_STR);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':up_date', $date, PDO::PARAM_STR);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		if($total == 1){
			$result['status'] = 'success';			
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			echo json_encode($result);
			exit;
		}
		
	}
	function step1($gender, $birthday, $country, $zip){
		global $db;
		$errorList = '';
		$firstError = true;
		session_start();
		
		if (strlen($gender) == 0 || strlen($birthday) == 0 || strlen($country) == 0 || strlen($zip) == 0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		
		
		if ($firstError == false){
			returnError($errorList);
		}
		
		
		$sql = "UPDATE user SET u_gender=:u_gender, u_birthday=:u_birthday, u_country=:u_country, u_zip=:u_zip WHERE u_id=:u_id"; 			
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_gender', $gender, PDO::PARAM_STR);
		$stmt->bindParam(':u_birthday', $birthday, PDO::PARAM_STR);
		$stmt->bindParam(':u_country', $country, PDO::PARAM_STR);
		$stmt->bindParam(':u_zip', $zip, PDO::PARAM_INT);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		
		if($total == 1){
			$_SESSION['user']->u_gender = $gender;
			$_SESSION['user']->u_birthday = $birthday;
			$_SESSION['user']->u_country = $country;
			$_SESSION['user']->u_zip = $zip;
			$result['status'] = 'success';
			echo json_encode($result);
			exit;
		} else {
			$result['status'] = 'error';
			echo json_encode($result);
			exit;
		}
		
		
	}
	function checkZIP($zip){
		global $db;
		$errorList = '';
		$firstError = true;
		
		if (strlen($zip)<3 || strlen($zip)>5){			
			if($firstError){
				$errorList .= 'ZIP code format error!';
				$firstError = false;	
			} else {
				$errorList .= '<br />ZIP code format error!';
			}					
		}
		if (!is_numeric($zip)){			
			if($firstError){
				$errorList .= 'ZIP code format error!';
				$firstError = false;	
			} else {
				$errorList .= '<br />ZIP code format error!';
			}					
		}
		if($firstError == false){
			returnError($errorList);
		}
		$sql = "SELECT * FROM uszip WHERE zip=:zip LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':zip', $zip, PDO::PARAM_INT);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$total = $stmt->rowCount();
		if ($total == 0){			
			if($firstError){
				$errorList .= 'ZIP code cannot found!';
				$firstError = false;	
			} else {
				$errorList .= '<br />ZIP code cannot found!';
			}
		}
		if ($firstError == false){
			returnError($errorList);
		} else {
			$result['data'] = $obj;
			$result['status'] = 'success';
			echo json_encode($result);
			exit;
		}
	}
	function createCode($length){
		$arr = array("q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","1","2","3","4","5","6","7","8","9","0");
		$code = '';
		for ($x = 0; $x <= $length - 1; $x++) {
			$y = rand(0,35);
			$code .= $arr[$y];
		}

		return $code;
	}
	function returnError($errorList){		
		$result['status'] = 'error';
		$result['msg'] = $errorList;
		echo json_encode($result);
		exit;
	}
	function sendMail($u_email,$mail_type,$var1){

		switch ($mail_type){
			case 'mail_activation';
				$subject = 'Activate Your OpenDiet Account';
				$msg = 'Click this link to activate your account <a href="http://www.odiet.net/activate.php?code='.$var1.'">Activation code is: '.$var1.'</a>';
			break;
			case 'password_reminder';
				$subject = 'OpenDiet Account Informaton';
				$msg = 'Your password is <a href="http://www.odiet.net/login.php">'.$var1.'</a>';
			break;
		}

		$mailStatus = mail($u_email,$subject,$msg);
		return $mailStatus;
	}
	function login($u_email, $u_password, $rememberCheckbox){
		global $db;
		$errorList = '';
		$firstError = true;
		
		if (strlen($u_email)==0 || strlen($u_password)==0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		if (filter_var($u_email, FILTER_VALIDATE_EMAIL) === false){
			if($firstError){
				$errorList .= 'Please check your email address!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please check your email address!';
			}	
		}	
		if (strlen($u_password)<6 || strlen($u_password)>24){			
			if($firstError){
				$errorList .= 'Password must between 6-24 characters!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Password must between 6-24 characters!';
			}
		}
		if($firstError == false){
			returnError($errorList);
		}
		$sql = "SELECT * FROM user WHERE u_email=:u_email LIMIT 1"; 
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_email', $u_email, PDO::PARAM_STR);
		$stmt->execute();   
		$obj  = $stmt->fetchObject();
		$total = $stmt->rowCount();
		
		if($total == 0){
			if($firstError){
				$errorList .= 'User not found with entered email!';
				$firstError = false;	
			} else {
				$errorList .= '<br />User not found with entered email!';
			}
		} 
		if($firstError == false){
			returnError($errorList);
		}
		if($obj->u_status == 0){
			if($firstError){
				$errorList .= 'User not activated!';
				$firstError = false;	
			} else {
				$errorList .= '<br />User not activated!';
			}
		}
		
		if($firstError == false){
			returnError($errorList);
		}
		
		if ($u_password !== $obj->u_password){
			if($firstError){
				$errorList .= 'Password is wrong!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Password is wrong!';
			}
		}
		if($firstError == false){
			returnError($errorList);
		}
		if($obj->u_status != 1){
			if($firstError){
				$errorList .= 'User account suspended!';
				$firstError = false;	
			} else {
				$errorList .= '<br />User account suspended!';
			}
		}
		if ($firstError == false){
			returnError($errorList);
		} else {
			session_start();
			$_SESSION['user']=$obj;
			
			$result['msg'] = 'Login successfull';
			$result['status'] = 'success';
			echo json_encode($result);
			exit;
		}
			
		
	}
	
	function register($u_email, $u_firstname, $u_lastname, $u_password, $u_passwordrepeat, $agreementCheckbox){
		global $db;

		$errorList = '';
		$firstError = true;
		
		if (strlen($u_email)==0 || strlen($u_firstname)==0 || strlen($u_lastname)==0 || strlen($u_password)==0 || strlen($u_passwordrepeat)==0){			
			if($firstError){
				$errorList .= 'Please fill all the required fields!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please fill all the required fields!';
			}					
		}
		if (filter_var($u_email, FILTER_VALIDATE_EMAIL) === false){
			if($firstError){
				$errorList .= 'Please check your email address!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please check your email address!';
			}	
		}	
		if (strlen($u_firstname)<3 || strlen($u_firstname)>100){			
			if($firstError){
				$errorList .= 'Firstname must between 3-100 characters!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Firstname must between 3-100 characters!';
			}
		}
		if (strlen($u_lastname)<3 || strlen($u_lastname)>50){			
			if($firstError){
				$errorList .= 'Lastname must between 3-50 characters!!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Lastname must between 3-50 characters!!';
			}
		}
		if (strlen($u_password)<6 || strlen($u_password)>24 || strlen($u_passwordrepeat)<6 || strlen($u_passwordrepeat)>24){			
			if($firstError){
				$errorList .= 'Password must between 6-24 characters!!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Password must between 6-24 characters!!';
			}
		}
		if ($u_password !== $u_passwordrepeat){			
			if($firstError){
				$errorList .= 'Passwords does not match!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Passwords does not match!';
			}
		}
		if ($agreementCheckbox == 0){
			if($firstError){
				$errorList .= 'Please accept our privacy policy and customer agreement!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Please accept our privacy policy and customer agreement!';
			}
		}
		
		/**
		 *  TODO : Check wheter user accepted aggreement.
		 */	
		 
		if ($firstError == false){
			$result['status'] = 'error';
			$result['msg'] = $errorList;
			echo json_encode($result);
			exit;
		}
		date_default_timezone_set("America/New_York");
		$u_register_date = date("Y-m-d H:i:s");
		
		$u_register_ip = $_SERVER['REMOTE_ADDR'];
		if ($u_register_ip == '::1'){
			$u_register_ip = '127.0.0.1';
		}
		$u_activation_code = createCode(40);
		
		$sql = "INSERT INTO user (u_email, u_firstname, u_lastname, u_password, u_activation_code, u_register_date, u_register_ip) VALUES(:u_email, :u_firstname, :u_lastname, :u_password, :u_activation_code, :u_register_date, :u_register_ip)"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_email', $u_email, PDO::PARAM_STR);
		$stmt->bindParam(':u_firstname', $u_firstname, PDO::PARAM_STR);
		$stmt->bindParam(':u_lastname', $u_lastname, PDO::PARAM_STR);
		$stmt->bindParam(':u_password', $u_password, PDO::PARAM_STR);
		$stmt->bindParam(':u_activation_code', $u_activation_code, PDO::PARAM_STR);
		$stmt->bindParam(':u_register_date', $u_register_date, PDO::PARAM_STR);
		$stmt->bindParam(':u_register_ip', $u_register_ip, PDO::PARAM_STR);
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		} catch (Exception $e) {
			if ($e->getCode() == 23000) {
				if($firstError){
					$errorList .= 'This user already registered!';
					$firstError = false;	
				} else {
					$errorList .= '<br />This user already registered!';
				}
			}
	    }	
		if ($firstError == false){
			$result['status'] = 'error';
			$result['msg'] = $errorList;
			echo json_encode($result);
			exit;
		} 
		
		$type = 'u_registered';
		
		$action = addUserAction($id, $id, $type);
		
		
		/**
		 *  TODO : Sent confirmation email including authorization code.
		 */	
		$mailStatus = sendMail($u_email,'mail_activation',$u_activation_code);
		if($mailStatus){
			$result['msg'] = 'Your account successfully created.<br />We sent an email to you, please check your inbox and activate your account.';
		} else {
			$result['msg'] = 'Your account successfully created.<br />A problem occured while trying to send an email to you;';
		}
			
			
		$result['status'] = 'success';
		echo json_encode($result);
		exit;
	}
	
	function imgUpload($imgType,$imgData){
		global $db;	
		session_start();
		$errorList = '';
		$firstError = true;
		
		$data =  explode(',',$imgData);
		$img = str_replace(' ','+',$data[1]);
		$img2 = base64_decode($img);

		$tmp_code = createCode(10);
		
		$im = imagecreatefromstring($img2);		
		imagejpeg($im, 'photos/tmp/'.$tmp_code.'.jpg');
		imagedestroy($im);
		
		if(file_exists('photos/tmp/'.$tmp_code.'.jpg')){
			$code = createCode(40);
		}
		
		date_default_timezone_set("America/New_York");
		$p_date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO photo (u_id, p_code, p_type, p_date, p_status) VALUES(:u_id, :p_code, '1', :p_date, '1')"; 	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
		$stmt->bindParam(':p_code', $code, PDO::PARAM_STR);
		$stmt->bindParam(':p_date', $p_date, PDO::PARAM_STR);
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		} catch (Exception $e) {
			if($firstError){
				$errorList .= 'Photo could not insert to table!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Photo could not insert to table!';
			}
	    }	
		
		if ($firstError == false){
			$result['status'] = 'error';
			$result['msg'] = $errorList;
			echo json_encode($result);
			exit;
		}
		
		copy('photos/tmp/'.$tmp_code.'.jpg', 'photos/profile/'.$id.'.jpg');
		unlink('photos/tmp/'.$tmp_code.'.jpg');
		
		$sql = "UPDATE user SET u_profile_photo=:u_profile_photo WHERE u_id=:u_id"; 			
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':u_profile_photo', $id, PDO::PARAM_STR);
		$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);		
		try {
			$stmt->execute();
		} catch (Exception $e) {
			if($firstError){
				$errorList .= 'Users table could not updated!';
				$firstError = false;	
			} else {
				$errorList .= '<br />Users table could not updated!';
			}
	    }
		
		if ($firstError == false){
			$result['status'] = 'error';
			$result['msg'] = $errorList;
			echo json_encode($result);
			exit;
		}
		
		$_SESSION['user']->u_profile_photo = $id;
		
			 

		$result['status'] = 'success';
		$result['msg'] = 'Profile picture uploaded';
		echo json_encode($result);		
	}
	
	function statusShare($statusText, $imgType, $imgData){
		global $db;	
		session_start();
		$errorList = '';
		$firstError = true;
		
		date_default_timezone_set("America/New_York");
		$p_date = date("Y-m-d H:i:s");
		
		if(strlen($imgData) > 0){
			$data =  explode(',',$imgData);
			$img = str_replace(' ','+',$data[1]);
			$img2 = base64_decode($img);

			$tmp_code = createCode(10);
			
			$im = imagecreatefromstring($img2);		
			imagejpeg($im, 'photos/tmp/'.$tmp_code.'.jpg');
			imagedestroy($im);
			
			if(file_exists('photos/tmp/'.$tmp_code.'.jpg')){
				$code = createCode(40);
			}			
			
			$sql = "INSERT INTO photo (u_id, p_code, p_type, p_date, p_status) VALUES(:u_id, :p_code, '1', :p_date, '1')"; 	
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);
			$stmt->bindParam(':p_code', $code, PDO::PARAM_STR);
			$stmt->bindParam(':p_date', $p_date, PDO::PARAM_STR);
			try {
				$stmt->execute();
				$id = $db->lastInsertId();
			} catch (Exception $e) {
				if($firstError){
					$errorList .= 'Photo could not insert to table!';
					$firstError = false;	
				} else {
					$errorList .= '<br />Photo could not insert to table!';
				}
			}	
			
			if ($firstError == false){
				$result['status'] = 'error';
				$result['msg'] = $errorList;
				echo json_encode($result);
				exit;
			}
			
			copy('photos/tmp/'.$tmp_code.'.jpg', 'photos/status/'.$id.'.jpg');
			unlink('photos/tmp/'.$tmp_code.'.jpg');
			
			$sql = "INSERT INTO user_status (u_id, p_id, us_text, us_date) VALUES (:u_id, :p_id, :us_text, :us_date)"; 			
			$stmt = $db->prepare($sql);		
			$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);	
			$stmt->bindParam(':p_id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':us_text', $statusText, PDO::PARAM_STR);
			$stmt->bindParam(':us_date', $p_date, PDO::PARAM_STR);
			try {
				$stmt->execute();
				$id = $db->lastInsertId();
				
			} catch (Exception $e) {
				if($firstError){
					$errorList .= 'Status text could not updated with photo!';
					$firstError = false;	
				} else {
					$errorList .= '<br />Status text could not updated with photo!';
				}
			}
			
			if ($firstError == false){
				$result['status'] = 'error';
				$result['msg'] = $errorList;
				echo json_encode($result);
				exit;
			}			
			
			if(strlen($statusText) > 0) {
				$type = 'u_shared_photo_and_text';	
				$action = addUserAction($_SESSION['user']->u_id, $id, $type);
			} else {
				$type = 'u_shared_photo';	
				$action = addUserAction($_SESSION['user']->u_id, $id, $type);
			}
		} else if(strlen($statusText) > 0) {						
			
			$sql = "INSERT INTO user_status (u_id, us_text, us_date) VALUES (:u_id, :us_text, :us_date)"; 			
			$stmt = $db->prepare($sql);		
			$stmt->bindParam(':u_id', $_SESSION['user']->u_id, PDO::PARAM_INT);	
			$stmt->bindParam(':us_text', $statusText, PDO::PARAM_STR);
			$stmt->bindParam(':us_date', $p_date, PDO::PARAM_STR);
			try {
				$stmt->execute();
				$id = $db->lastInsertId();
			} catch (Exception $e) {
				if($firstError){
					$errorList .= 'Status text could not updated!';
					$firstError = false;	
				} else {
					$errorList .= '<br />Status text could not updated!';
				}
			}
			
			if ($firstError == false){
				$result['status'] = 'error';
				$result['msg'] = $errorList;
				echo json_encode($result);
				exit;
			}
				
			$type = 'u_shared_text';	
			$action = addUserAction($_SESSION['user']->u_id, $id, $type);
		}
		if ($firstError == false){
			$result['status'] = 'error';
			$result['msg'] = $errorList;
			echo json_encode($result);
			exit;
		}
		
		$result['status'] = 'success';
		$result['msg'] = 'Status updated';
		echo json_encode($result);		
	}

	
?>