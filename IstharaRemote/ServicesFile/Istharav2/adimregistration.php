<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);

if (is_array($data))
 {
 
 	if(array_key_exists("phonenumber", $data) && array_key_exists("userid", $data) && array_key_exists("devicetoken", $data))
	{
	
	    $classObject = new ishtraClass();
	    $classObject->insertAdminDeviceTokenList($data["userid"],$data["phonenumber"],$data["devicetoken"]);
	    
	    
	    
	    /*if(sizeof($classObject->content) != 0)
	    {
	      echo json_encode($classObject->content);
	    }
	    else
	    {
	      echo "Authentication failed!";
	    }*/
	
	    echo json_encode($classObject->content);
	
	    exit();
	}
 
 }





?>



