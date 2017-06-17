<?php
/*~ wappushRESTlibraryXML.php
.---------------------------------------------------------------------------.
|  Software: wappushRESTlibraryXML - PHP WAP PUSH REST client class         |
|   Version: 0.1                                                            |
|   Contact:                                                                |
|      Info:                                                                |
|   Support:                                                                |
| ------------------------------------------------------------------------- |
|    Author: Jesús Macias Portela                                           |
|    Contact: me@jesusmacias.es                                             |
'---------------------------------------------------------------------------'

/**
 * wappushRESTlibraryXML - PHP WAP PUSH REST client class
 * @author Jesús Macias Portela
 * @version 0.1
 */


class pushRESTclient {

    /**
    * EndPoint to reach REST MMS Server
    */
    public $apiendpoint;

    /**
    * User Activation Code provided by Operator
    */
    public $spId;

    /**
    * Service Identifier provided by Operator
    */

    public $serviceId;

    /** 
    * User Password provided by Operator
    */
    public $spPassword;

    /**
    * Token provided by Operator
    */
    public $token;

    /**
    * Requestor ID provided by Operator
    */
    public $requestor_id;

    /**
    * Location Header
    */
    private $Location;
    /**
    * Check SSL
    */
    private $checkSSL=1;
    private $checkPeer=1;
    private $checkHost=2;



    /**
    * Constructor of the SMS client. It initializes a REST SMS UNICA API client, capable of sending
    * REST operations
    *
    * @param $spId User Activation Code provided by Operator
    * @param $serviceId Service Identifier provided by Operator
    * @param $spPassword User Password provided by Operator
    * @param $token token provided by Operator
    * @param $requestor_id requestor_id provided by Operator
    * @param $apiendpoint The EndPoint of the server to which is possible to reach REST SMS server
    */
    function __construct($spId,$serviceId,$spPassword,$token,$requestor_id,$apiendpoint){
        try {
            if (!is_numeric($spId)) throw new Exception("spId must be numeric");
            if (!is_numeric($serviceId)) throw new Exception("serviceId must be numeric");
            if (!is_string($spPassword)) throw new Exception("spPassword must be string");
            if (!is_string($token)) throw new Exception("token must be string");
            if (!is_numeric($spId)) throw new Exception("spId must be numeric");
            if (!$this->is_url($apiendpoint)) throw new Exception("apiendpoint must be URL");
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $this->apiendpoint=$apiendpoint;
        $this->spId=$spId;
        $this->serviceId=$serviceId;
        $this->token=$token;
        $this->requestor_id=$requestor_id;
        $this->spPassword=$spPassword;
    }
    
    /**
    * Returns the Header "Authorization" to be used on all REST Request
    * @return HTTP headers array
    */
    private function basicAuthenticate(){
    date_default_timezone_set('UTC');
    //$now = date("Y-m-d H:i:s");
    $now = date("YmdHis");
    //Authorization: SDPBasicAuth;realm="SDPAPIs", consumer_key="serviceId@spId", signature_method="MD5", signature=MD5(spId+spPassword+timeStamp) ,timestamp="200901021632", version="0.1"
    $Authorization='Authorization: SDPBasicAuth realm="SDPAPIs", consumer_key="'.$this->serviceId.'@'.$this->spId.'", signature_method="MD5", signature="';
    $Authorization.=strtoupper(md5($this->spId.$this->spPassword.$now));
    $Authorization.='", timestamp="'.$now.'", version="0.1", token="'.$this->token.'", requestor_id="'.$this->requestor_id.'", requestor_type="1"';
    $headers = array ($Authorization, 'Proxy-Connection: Keep-Alive');
    return $headers;
    }

    /**
     * The application invokes a REST operation to send a new WAP PUSH Message
     *  
     * @param array $address associative array with the list of address which the MMS will be sent
     * @param string $created Timestamp 
     * @param string $text text content 
     * @param string $targetURL TargetURL
     * @param string $paction Paction
     * @param string $property Property
     * @param array $receiptRequest associative array receiptRequest
     * @param array $senderId associative array senderId
     * @param array $charging associative array charging 
     *
     * @return string
     */
    public function sendPushMessage($address,$created,$text,$targetURL=null,$paction=null,$property=null,$receiptRequest=null,$senderId=null,$charging=null){
    /* EJEMPLO DE PETICION REST
    http://telefonica:8080/gSDP/UNICA-PUSH-REST/PushMessage
    */
            $operation="PushMessage";
            $url=$this->apiendpoint."/".$operation;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url);
            $protocol=explode (":",$url);
            if (strtolower($protocol[0])=="https" ) {
                ## Below two option will enable the HTTPS option.
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  $this->checkPeer);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,   $this->checkHost);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120);
            //register a callback function which will process the headers
            //this assumes your code is into a class method, and uses $this->readHeader as the callback //function
            curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this,'readLocation'));
            $content=$this->sendPushMessageXMLBody($address,$created,$text,$targetURL,$paction,$property,$receiptRequest,$senderId,$charging);
            $headers  =  array( "Content-Type: application/xml", "Content-Length: ".strlen($content), "Expect:");
            $full_headers = array_merge ( $this->BasicAuthenticate(), $headers);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $full_headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$content);
            //Executing REQUEST
            $result = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (curl_errno($ch)) return "CURL ERROR: ".curl_errno($ch);
            curl_close ($ch);
            if ($http_code!='201') return "RESPONSE CODE: ".$http_code;
            else return $this->Location;
    }



    /**
     * The operation invokes a REST operation to obtain current Delivery Status of a sent WAP PUSH
     * 
     * @param  $url This is url returned by sendSMS method
     * @param  $responseType Response type: xml or json
     *
     * @return XML content delivery status of a sent Message
     */
     function getPushMessageDeliveryStatus($url,$responseType="xml"){
            /* EJEMPLO DE PETICION REST
            http://telefonica.com/gSDP/UNICA-PUSH-REST/PMDeliveryStatus?messageId=12ASDFGASDF&alt=JSON
            */
            if ($responseType =="json" || $responseType =="JSON") $url.="&alt=json";
            $ch = curl_init($url);
            $protocol=explode (":",$url);
            if (strtolower($protocol[0])=="https" ) {
                ## Below two option will enable the HTTPS option.
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  $this->checkPeer);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,   $this->checkHost);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            $headers  =  $this->BasicAuthenticate();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (curl_errno($ch)) return "CURL ERROR: ".curl_errno($ch);
            curl_close ($ch);
            if ($http_code!='200') return "RESPONSE CODE: ".$http_code;
            else return $result;
            }


/*###################################################################################################################################################################################*/


/**
 * Compount XML Body of sendPushMessage
 *  
 * @param  $address associative array with the list of address which the MMS will be sent
 * @param  $created Timestamp 
 * @param  $text text content 
 * @param  $targetURL TargetURL
 * @param  $paction Paction
 * @param  $property Property
 * @param  $receiptRequest associative array receiptRequest
 * @param  $senderId associative array senderId
 * @param  $charging associative array charging 
 *
 * @return XML Body Content
 */

    private function sendPushMessageXMLBody ($address,$created,$text,$targetURL=NULL,$paction=NULL,$property=NULL,$receiptRequest=NULL,$senderId=NULL,$charging=NULL){
    $iterator=0;
    $XMLbody='<?xml version="1.0" encoding="UTF-8" standalone="no"?><uwb:pMessage xmlns:parlayx_common_xsd="http://www.csapi.org/schema/parlayx/common/v3_1" xmlns:tns="http://www.telefonica.com/UNICA/wappush_types/v0_1_LITMUS_LATAM_03102009" xmlns:tns1="http://www.telefonica.com/UNICA_CommonTypes/v0_1" xmlns:uwb="https://www.telefonica.com/UNICA/wappush_bodies/v0_1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="https://www.telefonica.com/UNICA/wappush_bodies/v0_1 UNICA_API_wap_push_bodies_REST_v0_1.xsd ">';

    if (isset($address[0])){
        while (isset($address[$iterator])){
            $XMLbody.='<tns:address>';
            if (isset($address[$iterator]["phoneNumber"])) $XMLbody.='<tns1:phoneNumber>'.$address[$iterator]["phoneNumber"].'</tns1:phoneNumber>';
            if (isset($address[$iterator]["anyUri"])) $XMLbody.='<tns1:anyUri>'.$address[$iterator]["anyUri"].'</tns1:anyUri>';
            if (isset($address[$iterator]["ipAddress"]))$XMLbody.='<tns1:ipAddress>'.$address[$iterator]["ipAddress"].'</tns1:ipAddress>';
            if (isset($address[$iterator]["login"])) $XMLbody.='<tns1:login>'.$address[$iterator]["login"].'</tns1:login>';
            $XMLbody.='</tns:address>';
            $iterator++;
        }
    }

    else {
            $XMLbody.='<tns:address>';
            if (isset($address["phoneNumber"])) $XMLbody.='<tns1:phoneNumber>'.$address["phoneNumber"].'</tns1:phoneNumber>';
            if (isset($address["anyUri"])) $XMLbody.='<tns1:anyUri>'.$address["anyUri"].'</tns1:anyUri>';
            if (isset($address["ipAddress"]))$XMLbody.='<tns1:ipAddress>'.$address["ipAddress"].'</tns1:ipAddress>';
            if (isset($address["login"])) $XMLbody.='<tns1:login>'.$address["login"].'</tns1:login>';
            $XMLbody.='</tns:address>';
            }

        if ($created!=NULL)  $XMLbody.='<tns:created>'.$created.'</tns:created>';
        
        if ($text!=NULL)  $XMLbody.='<tns:text>'.$text.'</tns:text>';

        if ($targetURL!=NULL)  $XMLbody.='<tns:targetURL>'.$targetURL.'</tns:targetURL>';

        if ($paction!=NULL)  $XMLbody.='<tns:paction>'.$paction.'</tns:paction>';
        
        if ($receiptRequest!=NULL){
            $XMLbody.='<tns:receiptRequest>';
                $XMLbody.='<endpoint>'.$receiptRequest["endpoint"].'</endpoint>';
                $XMLbody.='<interfaceName>'.$receiptRequest["interfaceName"].'</interfaceName>';
                $XMLbody.='<correlator>'.$receiptRequest["correlator"].'</correlator>';    
            $XMLbody.='</tns:receiptRequest>';
            }

        if ($senderId!=NULL){
            $XMLbody.='<tns:senderId>';
                $XMLbody.='<tns1:phoneNumber>'.$senderId["phoneNumber"].'</tns1:phoneNumber>';
                $XMLbody.='<tns1:anyUri>'.$senderId["anyUri"].'</tns1:anyUri>';
                $XMLbody.='<tns1:ipAddress>'.$senderId["ipAddress"].'</tns1:ipAddress>';
                $XMLbody.='<tns1:login>'.$senderId["login"].'</tns1:login>';
            $XMLbody.='</tns:senderId>';
            }

        if ($charging!=NULL){
            $XMLbody.='<tns:charging>';
                $XMLbody.='<description>'.$charging["description"].'</description>';
                $XMLbody.='<currency>'.$charging["currency"].'</currency>';
                $XMLbody.='<amount>'.$charging["amount"].'</amount>';
                $XMLbody.='<code>'.$charging["code"].'</code>';
            $XMLbody.='</tns:charging>';
            }

        $XMLbody.='</uwb:pMessage>';
        return $XMLbody;
    }


////////////////////////////////////////////////////////////////////////////////

    /**
     * Find whether the type of a variable is URL
     *
     * @return  Returns TRUE if var is an URL, FALSE otherwise. 
     */
    private function is_url($url){
        $url = substr($url,-1) == "/" ? substr($url,0,-1) : $url;
        if ( !$url || $url=="" ) return false;
        if ( !preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) return false;
        else return true;
    }

    /**
    * CURL callback function for reading and processing headers
    *
    * @param  $ch
    * @param  $header
    *
    * @return integer
    */
    private function readLocation($ch, $header) {
    	$location = $this->extractCustomHeader('Location:', '\n', $header);
    	if ($location) {
    		$this->Location = trim($location);
    	}
    	return strlen($header);
    }

    /**
    * CURL callback function for extract and processing custom headers
    *
    * @param  $start
    * @param  $end
    * @param  $header
    *
    * @return integer
    */
    private function extractCustomHeader($start,$end,$header) {
    	$pattern = '/'. $start .'(.*?)'. $end .'/';
    	if (preg_match($pattern, $header, $result)) {
    		return $result[1];
    	} else {
    		return false;
    	}
    }

    /**
    * Function to activate/desactivate SSL Validation
    *
    * @param  $bool
    *
    * @return integer
    */
    public function CertificateValidation($bool) {
    if ($bool==0) {
                $this->checkSSL=0;
                $this->checkPeer=0;
                $this->checkHost=0;
                }
    else {
                $this->checkSSL=1;
                $this->checkPeer=1;
                $this->checkHost=2;
                }
    return;
    }    

    /**
    * Function to check SSL Validation
    *
    *
    * @return checkSSK
    */
    public function checkCertificateValidation() {
    return $this->checkSSL;
    }
    
//End of Class
}



?>
