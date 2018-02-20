<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);


if (is_array($data))
 {
 	if( array_key_exists("breakfast", $data) && array_key_exists("dinner", $data) && array_key_exists("insdate", $data)) 
	{
	      
	      $classObject = new ishtraClass();
		  $classObject->insertFoodMenu($data["breakfast"],$data["dinner"],$data['insdate']);
	
		   echo "Menu posted successfully";
	      
	      exit();
	}
	else if( array_key_exists("date", $data)) 
	{
		  $classObject = new ishtraClass();
		
	      echo json_encode($classObject->getAllFoodMenu($data["date"]));
	      
	       exit();
	}
	else if( array_key_exists("delete", $data) && array_key_exists("path", $data)) 
	{
		//trigger_error($data["path"]);
	
		  unlink('foodmenus/'.$data["path"]);
		
	      echo "Image Deleted";
	      
	       exit();
	}
 
 }
 	






?>

