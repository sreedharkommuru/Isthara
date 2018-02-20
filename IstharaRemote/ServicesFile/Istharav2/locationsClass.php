<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);


if(array_key_exists("locationname", $data) && array_key_exists("userid", $data) && array_key_exists("insert", $data)) 
{
      
      $classObject = new ishtraClass();
      $classObject-> locationInertMethod($data["locationname"],$data["userid"]);
      echo "Successfully Added Location";
      
      exit();
}
else if(array_key_exists("locationID", $data) && array_key_exists("locationname", $data) && array_key_exists("userid", $data) && array_key_exists("update", $data)) 
{
      
      
      $classObject = new ishtraClass();
      $classObject-> locationUpdateMethod($data["locationID"],$data["locationname"],$data["userid"]);
      echo "Successfully Updated Location";
      
      exit();
}
else if(array_key_exists("locationID", $data) && array_key_exists("userid", $data) && array_key_exists("delete", $data)) 
{
	$classObject = new ishtraClass();
	$classObject-> locationDeleteMethod($data["locationID"],$data["userid"]);
      	echo "Successfully Deleted Location";
      
      exit();
}
else if(array_key_exists("locations", $data)) 
{
	  $classObject = new ishtraClass();
	
	   echo json_encode($classObject-> getAllLocations());
      
      exit();
}

?>