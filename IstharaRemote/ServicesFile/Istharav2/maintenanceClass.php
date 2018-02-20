<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);

//print_r($data);

if (is_array($data))
 {
 
 	if(array_key_exists("message", $data) && array_key_exists("userid", $data) && array_key_exists("insdate", $data)){
      
		$classObject = new ishtraClass();
		$classObject->insertMaintenance($data["message"],$data["userid"],$data["insdate"]);
		
		if($classObject->content == 1)
		 {
		    trigger_error("USER -".$classObject->content."-".$data["userid"]."-".$data["message"]."-".$data["insdate"]);
		    $classObject->postNotificationMessage($data["notificationTitle"],$data["message"],"user");
	         }
		//$classObject->postNotificationMessage($data["notificationTitle"],$data["message"],"user");
		echo "Thank you!. We support you as early as possible";
	      
	      	exit();
	}
	else if(array_key_exists("response", $data) && array_key_exists("userid", $data) && array_key_exists("userid", $data)) 
	{
	    
		$classObject = new ishtraClass();
		$classObject->responseMaintenance($data["response"],$data["adminid"],$data["userid"],$data["insdate"]);
		//$classObject->postNotificationMessage('Maintenance Response',$data["response"],$data["id"]);
		if($classObject->content == 1)
		 {
		    trigger_error("ADMIN -".$classObject->content."-".$data["userid"]."-".$data["response"]."-".$data["insdate"]."-".$data["adminid"]);	
		    $classObject->postNotificationMessage('Maintenance Response',$data["response"],$data["userid"]);
	         }
	
		echo "Maintenance Responded"; 
	      
	        exit();
	}
	else if(array_key_exists("admin", $data)) 
	{
		$classObject = new ishtraClass();	
		echo json_encode($classObject->getAllMaintenance());   
		exit();
	}
	else if( array_key_exists("userid", $data)) 
	{
		$classObject = new ishtraClass();
		echo json_encode($classObject->getUsersMaintenance($data["userid"]));
		exit();
	}
 
 }



?>