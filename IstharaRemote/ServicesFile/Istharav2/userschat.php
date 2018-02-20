<?php

	include("class_lib.php");
	
	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if (is_array($data))
 	{
 	
 		//print_r($data);
 	
 		if(array_key_exists("message", $data) && array_key_exists("userid", $data) && array_key_exists("insdate", $data)) 
		{
		      
		      $classObject = new ishtraClass();
		      $classObject->insertUserChat($data["message"],$data["userid"],$data["insdate"]);
		      
		      //trigger_error($classObject->content);
		      
		      if($classObject->content == 1)
		      {
		      	$classObject->postNotificationMessage($data["notificationTitle"],$data["message"],"user");
		      }
		      
		      
		      exit();
		}
		else if(array_key_exists("userid", $data) && array_key_exists("adminid", $data) && array_key_exists("adminmessage", $data)) 
		{
			$classObject = new ishtraClass();
			
			$classObject->adminResponsetoUserChat($data["adminid"],$data["userid"],$data["adminmessage"],$data["insdate"], $data["adminname"]);
			
			//trigger_error($classObject->content);
			
		      if($classObject->content == 1)
		      {
		      	$classObject->postNotificationMessage('User Chat Response',$data["adminmessage"],$data["userid"]);
		      }
		      
		        exit();
		}
		else if(array_key_exists("userid", $data)) 
		{
			$classObject = new ishtraClass();
			
			echo json_encode($classObject->getAllUsersChat($data["userid"]));
		      
		        exit();
		}
 	
 	
 	
 	}	
	
	
	
?>