<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);


if (is_array($data))
 {
	 if( array_key_exists("userid", $data) && array_key_exists("PhoneNumber", $data) && array_key_exists("RoomNumber", $data) && array_key_exists("BedNumber", $data) && array_key_exists("DeviceToken", $data))
	{
	      
	      $classObject = new ishtraClass();
	      $classObject->insertUsersList($data["userid"],$data["PhoneNumber"],$data['RoomNumber'],$data['BedNumber'],$data['UserName'],$data['UserLoginDate'],$data['DeviceToken']);
	
		 //echo json_encode($classObject->content));
	      
	      exit();
	}
	else if( array_key_exists("userid", $data)) 
	{
		  $classObject = new ishtraClass();
		
	      echo json_encode($classObject->getAllUsersList($data["userid"]));
	      
	       exit();
	}
 
 
 }






?>




