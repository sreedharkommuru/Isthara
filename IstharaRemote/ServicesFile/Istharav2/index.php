<?php


//https://www.binpress.com/tutorial/using-php-with-mysql-the-right-way/17
//https://www.killerphp.com/tutorials/php-objects-page-4/







//print_r($data);

//echo "Welcome ". $data['message'];

include("class_lib.php");


$data = json_decode(file_get_contents('php://input'), true);


if( $data["message"] && $data['userid']) 
{
      //echo "Welcome ". $_POST['message']. "<br />";
      //echo "You are ". $_POST['userid']. " years old.";
      
      //echo "FeedBack name: ";
      
      $habeeb = new ishtraClass();
	  $habeeb->insertFeedBack($data["message"],$data["userid"]);

	   echo "Thank you!. We support you as early as possible";//"FeedBack name: " . $habeeb->getFeedBack();
      
      exit();
}
else if( $_GET["response"] && $_GET["userid"] ) 
{
      //echo "Welcome ". $_GET['name']. "<br />";
      //echo "You are ". $_GET['age']. " years old.";
      
      $habeeb = new ishtraClass();
	  $habeeb->responseFeedBack($_GET["response"],'admin',$_GET["userid"]);

	   echo "FeedBack name: " . $habeeb->outputData();
      
      exit();
}



?>




