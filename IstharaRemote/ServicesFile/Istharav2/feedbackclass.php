<?php

	include("class_lib.php");
	
	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if (is_array($data))
 	{
 	
 		//print_r($data);
 	
 		if(array_key_exists("message", $data) && array_key_exists("userid", $data) && array_key_exists("insdate", $data)) 
		{
		      
		      $classObject = new ishtraClass();
		      $classObject->insertFeedBack($data["message"],$data["userid"],$data["insdate"]);
		      
		      if($classObject->content == 1)
		      {
		    	$classObject->postNotificationMessage('Feedback',$data["message"],"user");
	              }
		
		      echo "Thank you!. For your support";
		      
		      exit();
		}
		else if(array_key_exists("userid", $data) && array_key_exists("adminid", $data) && array_key_exists("adminmessage", $data)) 
		{
			$classObject = new ishtraClass();
			
			//responseFeedBack($adminid,$userid,$adminmessage,$insdate)
			
			$classObject->responseFeedBack($data["adminid"],$data["userid"],$data["adminmessage"],$data["insdate"]);
			
			//$classObject->responseFeedBack($data["userid"],$data["fid"]);
			
			//trigger_error($classObject->content);
			
			if($classObject->content == 1)
		      	{
		      		//trigger_error("Push");
		    	   $classObject->postNotificationMessage('Feedback',$data["adminmessage"],$data["userid"]);
	              	}
			
			echo "Thank you!. Feedback Responded";
		      
		        exit();
		}
		else if(array_key_exists("admin", $data)) 
		{
			$classObject = new ishtraClass();
			
			echo json_encode($classObject->getAllFeedBack());
		      
		        exit();
		}
		else if(array_key_exists("userid", $data)) 
		{
			$classObject = new ishtraClass();
			
			echo json_encode($classObject->getAllUsersFeedBack($data["userid"]));
		      
		        exit();
		}
 	
 	
 	
 	}	
	
	
	
?>