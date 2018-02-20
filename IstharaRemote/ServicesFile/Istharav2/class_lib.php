<?php

	include("Dbclass.php");
	
	$connectionObject = new Db();

    class ishtraClass
    {
        var $content;
        
        
        function insertMaintenance($new_Maintenance1,$userid1,$ins_Date1)
        {	
        	
        	global $connectionObject;
        	$new_Maintenance = $connectionObject->esscapeStringData($new_Maintenance1);
        	$userid = $connectionObject->esscapeStringData($userid1);
        	$ins_Date = $connectionObject->esscapeStringData($ins_Date1);
            
            $insresult = $connectionObject->query("INSERT INTO maintenance (message,userid,status,date) VALUES ('$new_Maintenance','$userid','pending','$ins_Date')");
            
            
            
            $this->content = $connectionObject->select("Select * from maintenance WHERE userid='$userid' AND message='$new_Maintenance'");
            
           
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = 1;
            }
            else
            {
            	$this->content = 'No';
            }
            
            
            
            
            
        }
        
        function responseMaintenance($new_Maintenance1,$responded_by1,$userid1,$ins_Date1)
        {	
        	
        	global $connectionObject;
        	$new_Maintenance = $connectionObject->esscapeStringData($new_Maintenance1);
        	$responded_by = $connectionObject->esscapeStringData($responded_by1);
        	$userid = $connectionObject->esscapeStringData($userid1);
        	$ins_Date = $connectionObject->esscapeStringData($ins_Date1);
        	
        	$insresult = $connectionObject->query("INSERT INTO maintenance (response,userid,status,date,responseuserid) VALUES ('$new_Maintenance','$userid','Responded','$ins_Date','$responded_by')");
        	
        	$this->content = $connectionObject->select("Select * from maintenance WHERE userid='$userid' AND response='$new_Maintenance' AND date='$ins_Date'");
            
           
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = 1;
            }
            else
            {
            	$this->content = 'No';
            }
            
            //$connectionObject->query("UPDATE maintenance SET response='$new_Maintenance',responseuserid='$responded_by',status='Responded' WHERE mid='$id'");
            
        }
        
        function getAllMaintenance()
        {
        	global $connectionObject;
            
            //return $this->content = $connectionObject->select("SELECT * FROM maintenance");
            return $this->content = $connectionObject->select("Select * from maintenance AS mnc INNER JOIN userslist AS usr ON mnc.userid = usr.userid WHERE mnc.status =  'pending' ORDER BY mid desc");

            
        }
        
        function getUsersMaintenance($userid)
        {
        	global $connectionObject;
            
            //return $this->content = $connectionObject->select("SELECT * FROM maintenance WHERE userid='$userid'");
            //SELECT * FROM maintenance WHERE userid='$userid' ORDER BY mid desc
            
            
            return $this->content = $connectionObject->select("SELECT * FROM maintenance AS mnc INNER JOIN adminslist AS adm WHERE mnc.userid ='$userid' AND mnc.responseuserid = adm.userid GROUP BY mid ASC");
            
            
            
        }
        
        
        /*
        * EVENT METHODS STARTS FROM HERE ----- 
        */
        
        
        function insertEvent($userid1,$new_Event1,$event_Date1,$ins_Date1)
        {	
        	
            global $connectionObject;
            
            $userid = $connectionObject->esscapeStringData($userid1);
            $new_Event = $connectionObject->esscapeStringData($new_Event1);
            $event_Date = $connectionObject->esscapeStringData($event_Date1);
            $ins_Date = $connectionObject->esscapeStringData($ins_Date1);
           
            $connectionObject->query("INSERT INTO events (userid,evmessage,evdate,insdate) VALUES ('$userid','$new_Event','$event_Date','$ins_Date')");
            
        }
        
        function getAllEvents($current_Date)
        {
        	global $connectionObject;
            
            return $this->content = $connectionObject->select("SELECT * FROM events WHERE evdate >=  '$current_Date'");
            
        }
        
        /*
        * REFERRAL METHODS STARTS FROM HERE ----- 
        */
        
        function insertReferrals($userid1,$referral_Name1,$referral_Number1,$insDate1,$location1)
        {	
        	
            global $connectionObject;
            
            $userid = $connectionObject->esscapeStringData($userid1);
            $referral_Name = $connectionObject->esscapeStringData($referral_Name1);
            $referral_Number = $connectionObject->esscapeStringData($referral_Number1);
            $insDate = $connectionObject->esscapeStringData($insDate1);
            $location = $connectionObject->esscapeStringData($location1);
           
            $insresult = $connectionObject->query("INSERT INTO referrals (userid,refname,refnumber,insDate,location) VALUES ('$userid','$referral_Name','$referral_Number','$insDate','$location')");
            
            $this->content = $connectionObject->select("Select * from referrals WHERE userid='$userid' AND refname ='$referral_Name' AND refnumber ='$referral_Number'");
            
           
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = 1;
            }
            else
            {
            	$this->content = 'No';
            }
            
        }
        
        function getAllReferrals()
        {
        	global $connectionObject;        
            //return $this->content = $connectionObject->select("SELECT * FROM referrals ORDER BY refid desc");
            
            return $this->content = $connectionObject->select("Select DISTINCT  usr.username,usr.bednumber,refr.refnumber,refr.refname,refr.location 
            from referrals AS refr INNER JOIN userslist AS usr WHERE refr.userid = usr.userid ORDER BY refid desc");
            
        }
        
        
        
        
         /*
        * FEEDBACK METHODS STARTS FROM HERE ----- 
        */
        
        function insertFeedBack($new_FeedBack1,$userid1,$insdate1)
        {	
        	
        	global $connectionObject;
            $this->content = $new_FeedBack1;
            
            $new_FeedBack = $connectionObject->esscapeStringData($new_FeedBack1);
            $userid = $connectionObject->esscapeStringData($userid1);
            $insdate = $connectionObject->esscapeStringData($insdate1);
            
            $connectionObject->query("INSERT INTO feedback (message,userid,date,readstatus) VALUES ('$new_FeedBack','$userid','$insdate',0)");
            
            $this->content = $connectionObject->select("Select * from feedback WHERE userid='$userid' AND message='$new_FeedBack'");
            
           
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = 1;
            }
            else
            {
            	$this->content = 'No';
            }
            
        }
        
        function getAllFeedBack()
        {
        	global $connectionObject;
            
            
            //return $this->content = $connectionObject->select("Select * from feedback AS fdb INNER JOIN userslist AS usr ON fdb.userid = usr.userid ORDER BY fid desc");
            
            return $this->content = $connectionObject->select("Select * from feedback AS fdb INNER JOIN userslist AS usr ON fdb.userid = usr.userid  WHERE usr.username != '' ORDER BY fid desc");
            

        }
        
        function getAllUsersFeedBack($userid)
        {
        	global $connectionObject;
        	
        	$connectionObject->esscapeStringData($userid);
            
           
            
            return $this->content = $connectionObject->select("SELECT fdb.userid, fdb.message, fdb.adminmessage, fdb.date, adm.username FROM feedback AS fdb INNER JOIN adminslist AS adm WHERE fdb.userid =  '$userid' AND fdb.adminid = adm.userid GROUP BY fid ASC");
            
            //return $this->content = $connectionObject->select("SELECT * FROM feedback AS fdb INNER JOIN adminslist AS adm ON fdb.adminid = adm.userid WHERE fdb.userid =  '$userid' GROUP BY fid ASC");
            
        }
        
        function responseFeedBack($adminid,$userid,$adminmessage,$insdate)
        {	
        	
        	global $connectionObject;
        	
        	$value1 = $connectionObject->esscapeStringData($adminid);
        	$value2 = $connectionObject->esscapeStringData($userid);
        	$value3 = $connectionObject->esscapeStringData($adminmessage);
        	$value4 = $connectionObject->esscapeStringData($insdate);
            
            $connectionObject->query("INSERT INTO feedback (adminid,userid,adminmessage,date) VALUES ('$value1','$value2','$value3','$value4')");
            
            $this->content = $connectionObject->select("Select * from feedback WHERE userid='$value2' AND adminmessage ='$value3'");
            
           //trigger_error(sizeof($this->content));
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = 1;
            }
            else
            {
            	$this->content = 'No';
            }
            
            //$connectionObject->query("UPDATE feedback SET readstatus=1 WHERE fid='$fid'");
            
        }

        
        
        /*
        * REFERRAL METHODS STARTS FROM HERE ----- 
        */
        
        function insertFoodMenu($break_fast1,$dinner1,$insdate1)
        {	
        	
            global $connectionObject;
            
            $break_fast = $connectionObject->esscapeStringData($break_fast1);
            $dinner = $connectionObject->esscapeStringData($dinner1);
            $insdate = $connectionObject->esscapeStringData($insdate1);
           
           //trigger_error($insdate);
           
            $connectionObject->query("INSERT INTO foodmenu (breakfastitems,dinneritems,menudate) VALUES 	('$break_fast','$dinner','$insdate')");
            
        }
        
        
        function insertFoodMenuPath($filepath1,$menudate1)
        {	
        	
            global $connectionObject;
            
            $filepath = $connectionObject->esscapeStringData($filepath1);
            $menudate = $connectionObject->esscapeStringData($menudate1);
            
            $this->content = $connectionObject->select("SELECT * FROM foodmenu  WHERE menudate = '$menudate1'");
            
           //trigger_error($menudate);
            
            if(sizeof($this->content) == 0)
            {
            	$connectionObject->query("INSERT INTO foodmenu (menupath,menudate) VALUES ('$filepath','$menudate')");
            }
            else
            {
            	$connectionObject->query("UPDATE foodmenu SET menupath ='$filepath' WHERE menudate='$menudate'");
            }
           
            
            
        }
        
        function getAllFoodMenu($current_Date1)
        {
        	global $connectionObject;
        	
        	$current_Date = $connectionObject->esscapeStringData($current_Date1);
        	
        	//trigger_error($current_Date);
            
            return $this->content = $connectionObject->select("SELECT * FROM foodmenu  WHERE menudate =  '$current_Date'");
            
        }
                
        /*
        * USERSLIST METHODS STARTS FROM HERE ----- 
        */
        
        function insertUsersList($userid1,$phonenumber1,$roomnumber1,$bednumber1,$username1,$insdate1,$devicetoken1)
        {	
        	
            global $connectionObject;
            
            $userid = $connectionObject->esscapeStringData($userid1);
            $phonenumber = $connectionObject->esscapeStringData($phonenumber1);
            $roomnumber = $connectionObject->esscapeStringData($roomnumber1);
            $bednumber = $connectionObject->esscapeStringData($bednumber1);
            $username = $connectionObject->esscapeStringData($username1);
            $insdate = $connectionObject->esscapeStringData($insdate1);
            $devicetoken = $connectionObject->esscapeStringData($devicetoken1);
            
            //trigger_error($userid);
            //trigger_error($phonenumber);
            //trigger_error($roomnumber);

	     //trigger_error($username);

	     //trigger_error($insdate);

	//trigger_error($devicetoken);





            
            $this->content = $connectionObject->select("SELECT * FROM userslist  WHERE userid = '$userid' AND phonenumber ='$phonenumber'");
            
           //trigger_error(sizeof($this->content));
            
            if(sizeof($this->content) == 0)
            {
            	//trigger_error('insertted');
              $connectionObject->query("INSERT INTO userslist (userid,phonenumber,roomnumber,bednumber,username,insdate, devicetoken) VALUES ('$userid','$phonenumber','$roomnumber','$bednumber','$username','$insdate','$devicetoken')");
            }
            else if(sizeof($this->content) > 0 && strlen($devicetoken) != 0)
            {
            //trigger_error('updated');
               $connectionObject->query("UPDATE userslist SET devicetoken ='$devicetoken' WHERE userid='$userid' AND phonenumber ='$phonenumber'");
            }
            
           
            
            
        }
        
        
        function getAllUsersList()
        {
        	global $connectionObject;
            
            return $this->content = $connectionObject->select("SELECT * FROM userslist ORDER BY uid desc");
            
        }

        /*
        * ADMIN USERSLIST METHODS STARTS FROM HERE -----
        */

        function insertAdminDeviceTokenList($userid1,$phonenumber1,$deviceToken1)
        {

            global $connectionObject;

            $userid = $connectionObject->esscapeStringData($userid1);
            $phonenumber = $connectionObject->esscapeStringData($phonenumber1);
            $deviceToken = $connectionObject->esscapeStringData($deviceToken1);


            $this->content = $connectionObject->select("SELECT * FROM adminslist  WHERE userid = '$userid' AND phonenumber='$phonenumber'");




            if(sizeof($this->content) > 0 && strlen($deviceToken) != 0)
            {
                $connectionObject->query("UPDATE adminslist SET devicetoken='$deviceToken' WHERE userid='$userid'");
            }

	

            return $this->content;


        }
        
        /*
        * USERS CHAT METHODS STARTS FROM HERE -----
        */
	function insertUserChat($message1,$userid1,$insdate1)
        {	
        	
            global $connectionObject;
            
            
            $message = $connectionObject->esscapeStringData($message1);
            $userid = $connectionObject->esscapeStringData($userid1);
            $insdate = $connectionObject->esscapeStringData($insdate1);
            
            $insresult = $connectionObject->query("INSERT INTO userschat (usermessage,userid,chatdate,status) VALUES ('$message','$userid','$insdate',0)");
            
            //trigger_error($insresult);
            
            $this->content = $connectionObject->select("Select * from userschat WHERE userid='$userid' AND usermessage ='$message' AND chatdate ='$insdate'");
            
           
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = $insresult;
            }
            else
            {
            	$this->content = 'No';
            }
            
        }
        
        function getAllUsersChat($userid)
        {
        	global $connectionObject;
            
            
            
            return $this->content = $connectionObject->select("SELECT usch.userid, usch.usermessage, usch.adminmessage, usch.chatdate, adm.username FROM userschat AS usch INNER JOIN adminslist AS adm WHERE usch.userid =  '$userid' AND usch.adminid = adm.userid GROUP BY ucid ASC");
            
            //return $this->content = $connectionObject->select("Select * from userschat WHERE userid='$userid' ORDER BY ucid desc");
            
        }
        
        function adminResponsetoUserChat($adminid,$userid,$adminmessage,$insdate,$adminname)
        {	
        	
        	global $connectionObject;
        	
        	$value1 = $connectionObject->esscapeStringData($adminid);
        	$value2 = $connectionObject->esscapeStringData($userid);
        	$value3 = $connectionObject->esscapeStringData($adminmessage);
        	$value4 = $connectionObject->esscapeStringData($insdate);
        	$value5 = $connectionObject->esscapeStringData($adminname);
            
            $insresult = $connectionObject->query("INSERT INTO userschat (adminid,userid,adminmessage,chatdate,adminname) VALUES ('$value1','$value2','$value3','$value4','$value5')");
            
            $this->content = $connectionObject->select("Select * from userschat WHERE userid='$value2' AND adminmessage ='$value3' AND chatdate ='$value4'");
            
           
            
            if(sizeof($this->content) != 0)
            {
            	$this->content = $insresult;
            }
            else
            {
            	$this->content = 'No';
            }
            
        }
        
        
        /*
        * PROPERTY CLASS METHODS
        **/
        function getAllLocations()
        {
        	global $connectionObject;        
            return $this->content = $connectionObject->select("SELECT * FROM properties WHERE active=1");
            
            
        }
        
        function locationInertMethod($location1,$userid1)
        {
            global $connectionObject;  
            
            $location = $connectionObject->esscapeStringData($location1);
            $userid = $connectionObject->esscapeStringData($userid1);
                  
            $connectionObject->query("INSERT INTO properties (locationname,userid,active) VALUES ('$location','$userid',1)");
            
            
        }
        
        function locationUpdateMethod($locid1,$location1,$userid1)
        {
            global $connectionObject;  
            
            $location = $connectionObject->esscapeStringData($location1);
            $locid = $connectionObject->esscapeStringData($locid1);
            $userid = $connectionObject->esscapeStringData($userid1);
            
            
           
                  
            $connectionObject->query("UPDATE properties SET locationname ='$location', userid ='$userid' WHERE locid='$locid'");
            
            
        }
        
        function locationDeleteMethod($locid1,$userid1)
        {
            global $connectionObject;  
            
           
            $locid = $connectionObject->esscapeStringData($locid1);
            $userid = $connectionObject->esscapeStringData($userid1);
                  
            $connectionObject->query("UPDATE properties SET active =0 AND userid ='$userid' WHERE locid='$locid'");
            
            
        }
        
        /*
        * POST PUSH NOTIFICATION MESSAGE METHODS STARTS FROM HERE -----
        */

        function postNotificationMessage($title,$message,$userIs)
        {
            global $connectionObject;

            $config = parse_ini_file('../config.ini');
            $fcmurl = $config['fcmurl'];
            $fcmkey = $config['fcmkey'];
            
            //trigger_error($fcmurl);
            //trigger_error($fcmkey);
            
            //trigger_error($title);
            //trigger_error($message);
            //trigger_error($userIs);
            
            if($userIs == "user")
            {
             	$this->content = $connectionObject->select("SELECT devicetoken FROM adminslist");
            }
            else //if($userIs == "admin")
            {
             	$this->content = $connectionObject->select("Select devicetoken from userslist WHERE userid = (SELECT userid from maintenance WHERE mid='$userIs')");
            }

            
            
            
            //$tokenIs = $this->content;
            
            for($x = 0; $x < sizeof($this->content); $x++) 
            {
              
              	$devTokenID = $this->content[$x]['devicetoken'];
              
              //trigger_error($devTokenID);
              
              $resultMessage = $title . ' - ' . $message;
              
              	$headers = array('Authorization:key=' .$fcmkey,
                            'Content-Type:application/json');

	            $fields = array('to'=>$devTokenID,
	                            'notification'=>array('title'=>$title,'body'=>$resultMessage));
	
	            //trigger_error(json_encode($fields));
	
	
	            $payload = json_encode($fields);
	
	            $curl_session = curl_init();
	
	            //Setting the curl url
	            curl_setopt($curl_session, CURLOPT_URL, $fcmurl);
	            //setting the method as post
	            curl_setopt($curl_session, CURLOPT_POST, true);
	
	            //adding headers
	            curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
	            curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
	
	            //disabling ssl support
	            curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
	
	            //adding the fields in json format
	            curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
	
	
	            $resultpush = curl_exec($curl_session);
	            
	            //trigger_error($resultpush);
	
	            curl_close($curl_session);
            
            
            }


        }
        
        function outputData()
        {
        	return $this->content;
        }
    }

?>