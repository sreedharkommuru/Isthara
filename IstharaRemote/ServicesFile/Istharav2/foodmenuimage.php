<?php

	include("class_lib.php");
	$data = json_decode(file_get_contents('php://input'), true);

    	$base=$data['foodimage'];
     	$binary=base64_decode($base);
     
	    header('Content-Type: bitmap; charset=utf-8');
	    
	    $file = fopen('foodmenus/'.$data['dateis'], 'wb');
	    
	    $filePath = "http://sriayyappaconstructions.com/Istharav2/foodmenus/".$data['dateis'];
	    
	    //trigger_error($filePath);
	    fwrite($file, $binary);
	    fclose($file);
	    
	 if (is_array($data))
	 {
	 	if( array_key_exists("foodimage", $data) && array_key_exists("dateis", $data)) 
		{
		      
		      $classObject = new ishtraClass();
		      $classObject->insertFoodMenuPath($filePath,$data['dateis']);
		
		      echo "Menu posted successfully";
		      
		      exit();
		}
		
	 
	 }
	 
	   
?>