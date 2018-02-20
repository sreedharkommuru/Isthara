<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);

if (is_array($data))
 {
 	if( array_key_exists("userid", $data) && array_key_exists("message", $data) && array_key_exists("eventdate", $data) && array_key_exists("insdate", $data)) 
	{
	      
	      $classObject = new ishtraClass();
		  $classObject->insertEvent($data["userid"],$data["message"],$data['eventdate'],$data['insdate']);
	
		   echo "Event posted successfully";
	      
	      exit();
	}
	else if( array_key_exists("date", $data)) 
	{
		  $classObject = new ishtraClass();
		
	      echo json_encode($classObject->getAllEvents($data["date"]));
	      
	       exit();
	}
 
 }






?>




