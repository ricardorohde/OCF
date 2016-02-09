<?php
/*~ wappushRESTlibraryJSON.php
.---------------------------------------------------------------------------.
|  Software: wappushRESTlibraryJSON - PHP WAP PUSH REST client class         |
|   Version: 0.1                                                            |
|   Contact:                                                                |
|      Info:                                                                |
|   Support:                                                                |
| ------------------------------------------------------------------------- |
|    Author: Jesús Macias Portela                                           |
|    Contact: me@jesusmacias.es                                             |
'---------------------------------------------------------------------------'

/**
 * wappushRESTlibraryJSON - PHP WAP PUSH REST client class
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
            $content=$this->sendPushMessageJSONBody($address,$created,$text,$targetURL,$paction,$property,$receiptRequest,$senderId,$charging);
            $headers  =  array( "Content-Type: application/json", "Content-Length: ".strlen($content), "Expect:");
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
 * Compount JSON Body of sendPushMessage
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
 * @return string
 */

    private function sendPushMessageJSONBody ($address,$created,$text,$targetURL,$paction,$property,$receiptRequest,$senderId,$charging){
    $iterator=0;
    $JSONbody='{"pMessage":{"address":';
    //Si hay varias address se añade varias veces
        if (isset($address[0])){
            $JSONbody.='[';
            while (isset($address[$iterator])){
                    if (isset($address[$iterator]["phoneNumber"])) $JSONbody.='{"phoneNumber":"'.$address[$iterator]["phoneNumber"].'"},';
                    if (isset($address[$iterator]["anyUri"])) $JSONbody.='{"anyUri":"'.$address[$iterator]["anyUri"].'"},';
                    if (isset($address[$iterator]["ipAddress"])) $JSONbody.='{"ipAddress":"'.$address[$iterator]["ipAddress"].'"},';
                    if (isset($address[$iterator]["alias"])) $JSONbody.='{"alias":"'.$address[$iterator]["alias"].'"},';
                    if (isset($address[$iterator]["otherId"])) $JSONbody.='{"otherId":"'.$address[$iterator]["otherId"].'"},';
                $iterator++;
            }
            //Eliminamos la última ','
            $JSONbody = substr ($JSONbody, 0, -1);
            $JSONbody.='],';
        }
    //Si no hay varias address pos se añade una vez
        else {
             $JSONbody.='[{';
                    if (isset($address["phoneNumber"])) $JSONbody.='"phoneNumber":"'.$address["phoneNumber"].'",';
                    if (isset($address["anyUri"])) $JSONbody.='"anyUri":"'.$address["anyUri"].'",';
                    if (isset($address["ipAddress"])) $JSONbody.='"ipAddress":"'.$address["ipAddress"].'",';
                    if (isset($address["alias"])) $JSONbody.='"alias":"'.$address["alias"].'",';
                    if (isset($address["otherId"])) $JSONbody.='"otherId":"'.$address["otherId"].'",';
            $JSONbody = substr ($JSONbody, 0, -1);
            $JSONbody.='}],';
            }
            
    if (is_string($created)) $JSONbody.='"created":"'.$created.'",';
    if (is_string($text)) $JSONbody.='"text":"'.$text.'",';
    if (is_string($targetURL)) $JSONbody.='"targetURL":"'.$targetURL.'",';
    if (is_string($paction)) $JSONbody.='"paction":"'.$paction.'",';
    
        if ($receiptRequest!=NULL){
            $JSONbody='"receiptRequest":{';
                $JSONbody.='{';
                $JSONbody.='"endpoint":"'.$receiptRequest["endpoint"].'",';
                $JSONbody.='"interfaceName":"'.$receiptRequest["interfaceName"].'",';
                $JSONbody.='"correlator":"'.$receiptRequest["correlator"].'",';
                $JSONbody = substr ($JSONbody, 0, -1);
                $JSONbody.='}';
            $JSONbody.='},';
            }

        if ($senderId!=NULL){
             $JSONbody.='"senderId":{';
                    if (isset($senderId["phoneNumber"])) $JSONbody.='{"phoneNumber":"'.$senderId["phoneNumber"].'"},';
                    if (isset($senderId["anyUri"])) $JSONbody.='{"anyUri":"'.$senderId["anyUri"].'"},';
                    if (isset($senderId["ipAddress"])) $JSONbody.='{"ipAddress":"'.$senderId["ipAddress"].'"},';
                    if (isset($senderId["alias"])) $JSONbody.='{"alias":"'.$senderId["alias"].'"},';
                    if (isset($senderId["otherId"])) $JSONbody.='{"otherId":"'.$senderId["otherId"].'"},';
            $JSONbody = substr ($JSONbody, 0, -1);
            $JSONbody.='},';
            }

    if ($charging!=NULL){
             $JSONbody.='"charging":{';
                    if (isset($charging["description"])) $JSONbody.='{"description":"'.$charging["description"].'"},';
                    if (isset($charging["currency"])) $JSONbody.='{"currency":"'.$charging["currency"].'"},';
                    if (isset($charging["amount"])) $JSONbody.='{"amount":"'.$charging["amount"].'"},';
                    if (isset($charging["code"])) $JSONbody.='{"code":"'.$charging["code"].'"},';
            $JSONbody = substr ($JSONbody, 0, -1);
            $JSONbody.='},';
        }

    $JSONbody = substr ($JSONbody, 0, -1);
    $JSONbody.='}}';
    return $JSONbody;
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
