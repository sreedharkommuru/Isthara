<?php

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);


if(array_key_exists("referralname", $data) && array_key_exists("userid", $data) && array_key_exists("referralnumber", $data)) 
{
      
      $classObject = new ishtraClass();
	  $classObject->insertReferrals($data["userid"],$data["referralname"],$data['referralnumber'],$data['insDate'],$data['location']);

		     if($classObject->content == 1)
		      {
		      	$classObject->postNotificationMessage("Sales Referral",$data["referralname"],"user");
		      }
		      
	   echo "Thank you for your referral";
      
      exit();
}
else if(array_key_exists("admin", $data)) 
{
	  $classObject = new ishtraClass();
	
	   echo json_encode($classObject->getAllReferrals());
      
      exit();
}
else if(array_key_exists("locations", $data)) 
{
	  $classObject = new ishtraClass();
	
	   echo json_encode($classObject-> getAllLocations());
      
      exit();
}

?>