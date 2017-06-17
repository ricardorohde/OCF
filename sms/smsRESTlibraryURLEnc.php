<?php
/*~ smsRESTlibraryURLEnc.php
.---------------------------------------------------------------------------.
|  Software: smsRESTlibraryURLEnc - PHP SMS REST client class               |
|   Version: 1.0                                                            |
|   Contact:                                                                |
|      Info:                                                                |
|   Support:                                                                |
| ------------------------------------------------------------------------- |
|    Author: Jesús Macias Portela                                           |
|    Contact: me@jesusmacias.es                                             |
'---------------------------------------------------------------------------'
*/

/** smsRESTclient class. smsRESTclient PHP SMS REST client class with URLEnc
 * @package UNICA
 * @author Jesús Macias Portela
 * @version 1.0
 */
class smsRESTclient {
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
    * This application invokes a REST operation to send a new SMS
    *  
    * @param  $address associative array with the list of address which the SMS will be sent
    * @param  $message string message
    * @param  $receiptRequest associative array receiptRequest
    * @param  $senderId associative array senderId
    * @param  $charging associative array charging 
    * @param  $encode string encode
    * @param  $sourceport string sourceport
    * @param  $destinationport string destinationport
    * @param  $esm_class string esm_class
    * @param  $data_coding string data_coding
    *
    * @return URL to check Delivery Status of SMS
    */

    public function sendSMS($address,$message,$receiptRequest=null,$senderId=null,$charging=null,$encode=null,$sourceport=null,$destinationport=null,$esm_class=null,$data_coding=null){
    /* EJEMPLO DE PETICION REST
    http://telefonica:8080/gSDP/UNICA-SMS-REST/SMS
    */
            $this->Location=NULL;
            $operation="SMS";
            $url=$this->apiendpoint."/".$operation;
            $headers  =  array( "Content-Type: application/xml" , $this->BasicAuthenticate());
            $ch = curl_init($url);
            //Checking Protocol
            $protocol=explode (":",$url);
            if (strtolower($protocol[0])=="https" ) {
                ## Below two option will enable the HTTPS option.
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  $this->checkPeer);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  $this->checkHost);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        		curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120);
            //register a callback function which will process the headers
            //this assumes your code is into a class method, and uses $this->readHeader as the callback function
            curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this,'readLocation'));
            //Set Content Body
            $content=$this->sendSMSURLEncBody($address,$message,$receiptRequest,$senderId,$charging,$encode,$sourceport,$destinationport,$esm_class,$data_coding);
            //Set up HTTP Headers
            $headers  =  array( "Content-Type: application/x-www-form-urlencoded;charset=utf8", "Content-Length: ".strlen($content), "Expect:");
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
     * The operation invokes a REST operation to obtain current Delivery Status of a sent SMS
     * 
     * @param  $url This is url returned by sendSMS method
     * @param  $responseType Response type: xml or json
     *
     * @return XML content delivery status of a sent Message
     */
    function getSMSDeliveryStatus($url,$responseType="xml"){
            /* EJEMPLO DE PETICION REST
            http://telefonica.com/gSDP/UNICA-SMS-REST/SMSDeliveryStatus?SMSIdentifier=12ASDFGASDF&alt=JSON
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

////////////////////////////////////////////////////////////////////////////////

    /**
    * Compound body URLEnc of operation sendSMS
    *  
    * @param $address associative array with the list of address which the SMS will be sent
    * @param $message string message
    * @param $receiptRequest associative array receiptRequest
    * @param $senderId associative array senderId
    * @param $charging associative array charging 
    * @param $encode string encode
    * @param $sourceport string sourceport
    * @param $destinationport string destinationport
    * @param $esm_class string esm_class
    * @param $data_coding string data_coding
    *
    * @return XML Body Content
    */

    private function sendSMSURLEncBody ($address,$message,$receiptRequest,$senderId,$charging,$encode,$sourceport,$destinationport,$esm_class,$data_coding){

    $iterator=0;
    $body="";

    if (isset($address[0])){
        while (isset($address[$iterator])){
            if (isset($address[$iterator]["phoneNumber"])) $body=$body."address[".$iterator."].phoneNumber=".urlencode($address[$iterator]["phoneNumber"])."&";
            if (isset($address[$iterator]["anyUri"]))$body=$body."address[".$iterator."].anyUri=".urlencode($address[$iterator]["anyUri"])."&";
            if (isset($address[$iterator]["ipAddress"]))$body=$body."address[".$iterator."].ipAddress=".urlencode($address[$iterator]["ipAddress"])."&";
            if (isset($address[$iterator]["alias"]))$body=$body."address[".$iterator."].alias=".urlencode($address[$iterator]["alias"])."&";
            if (isset($address[$iterator]["otherId"]))$body=$body."address[".$iterator."].otherId=".urlencode($address[$iterator]["otherId"])."&";
            $iterator++;
        }
    }

    else {
            if (isset($address["phoneNumber"])) $body=$body."address.phoneNumber=".urlencode($address["phoneNumber"])."&";
            if (isset($address["anyUri"]))$body=$body."address.anyUri=".urlencode($address["anyUri"])."&";
            if (isset($address["ipAddress"]))$body=$body."address.ipAddress=".urlencode($address["ipAddress"])."&";
            if (isset($address["alias"]))$body=$body."address.alias=".urlencode($address["alias"])."&";
            if (isset($address["otherId"]))$body=$body."address.otherId=".urlencode($address["otherId"])."&";
            }
            
    if (isset($message)) $body=$body."message=".urlencode($message)."&";

    if ($receiptRequest!=NULL){
        $body=$body."receiptRequest.endpoint=".urlencode($receiptRequest["endpoint"])."&";
        $body=$body."receiptRequest.interfaceName=".urlencode($receiptRequest["interfaceName"])."&";
        $body=$body."receiptRequest.correlator=".urlencode($receiptRequest["correlator"])."&";
        }

    if ($senderId!=NULL){
        if (isset($senderId["phoneNumber"])) $body=$body."senderId.phoneNumber=".urlencode($senderId["phoneNumber"])."&";
        if (isset($senderId["anyUri"])) $body=$body."senderId.anyUri=".urlencode($senderId["anyUri"])."&";
        if (isset($senderId["ipAddress"])) $body=$body."senderId.ipAddress=".urlencode($senderId["ipAddress"])."&";
        if (isset($senderId["alias"])) $body=$body."senderId.alias=".urlencode($senderId["alias"])."&";
        if (isset($senderId["otherId"])) $body=$body."senderId.otherId=".urlencode($senderId["otherId"])."&";
        }

    if ($charging!=NULL){
        $body=$body."charging.description=".urlencode($charging["description"])."&";
        $body=$body."charging.currency=".urlencode($charging["currency"])."&";
        $body=$body."charging.amount=".urlencode($charging["amount"])."&";
        $body=$body."charging.code=".urlencode($charging["code"])."&";
        }

    if ($encode!=NULL) $body=$body."encode=".urlencode($encode)."&";

    if ($sourceport!=NULL) $body=$body."sourceport=".urlencode($sourceport)."&";

    if ($destinationport!=NULL) $body=$body."destinationport=".urlencode($destinationport)."&";

    if ($esm_class!=NULL) $body=$body."esm_class=".urlencode($esm_class)."&";

    if ($data_coding!=NULL) $body=$body."data_coding=".urlencode($data_coding)."&";

    //Eliminamos el ultimo &
    $body = substr ($body, 0, -1);

    return $body;
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
