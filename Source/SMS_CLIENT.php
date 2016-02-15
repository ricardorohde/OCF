<?php
/*
* Example: Send SMS ang Getting Delivery Status of it.
*/

error_reporting(E_ALL);  

// Select only one of this
include_once "../src/smsRESTlibraryXML.php";
//include_once "../src/smsRESTlibraryJSON.php";
//include_once "../src/smsRESTlibraryURLEnc.php";

//$smsClient = new smsRESTclient($spId,$serviceId,$spPassword,$token,$requestor_id,$apiendpoint);
$smsClient = new smsRESTclient("000154","0102129606","123456","o3H85j7c3","551171107149","https://sdp.vivo.com.br/osg/UNICA-SMS-REST");

//Set up mandatory parameters
$address["phoneNumber"]="551171107147";
$message = "This is the Message";

//Send wap push message
$result =  $smsClient->sendSMS($address,$message);

//Checking response
$protocol=explode (":",strtolower($result));

if ($protocol[0] == 'http' || $protocol[0] == 'https'){
            //Getting Delivery Status
            $deliveryStatus =  $smsClient->getSMSDeliveryStatus($result); 
            echo $deliveryStatus;
    }
else {
        //An error ocurred
        echo $result;    
        }

?>

