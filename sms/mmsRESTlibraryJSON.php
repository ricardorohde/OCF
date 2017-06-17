<?php
/*~ mmsRESTlibraryJSON.php
.---------------------------------------------------------------------------.
|  Software: mmsRESTlibraryJSON - PHP MMS REST client class                  |
|   Version: 1.0                                                            |
|   Contact:                                                                |
|      Info:                                                                |
|   Support:                                                                |
| ------------------------------------------------------------------------- |
|    Author: Jesús Macias Portela                                           |
|    Contact: me@jesusmacias.es                                             |
| ------------------------------------------------------------------------- |
|   License: Distributed under the Lesser General Public License (LGPL)     |
|            http://www.gnu.org/copyleft/lesser.html                        |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
'---------------------------------------------------------------------------'

/**
 * mmsRESTlibraryJSON - PHP MMS REST client class
 * @package UNICA LIB
 * @author Jesús Macias Portela
 * @version 1.0
 */


class mmsRESTclient {

    /**
     * EndPoint to reach REST MMS Server provided by Operator
     */
    public  $apiendpoint;
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
     * Array with MMS content
     */
    var $attachment = array();
    /**
     * Array with Boundary content
     */
    private $boundary;
    
    /**
     * Character line end
     */    
    var $LE = "\r\n";
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
     * Constructor of the MMS client. It initializes a REST MMS UNICA API client, capable of sending
     * REST operations
     *  
     * @param  $spId User Activation Code
     * @param  $serviceId Service Identifier
     * @param  $spPassword User Password
     * @param $token token provided by Operator
     * @param $requestor_id requestor_id provided by Operator
     * @param  $apiendpoint The EndPoint of the server to which is possible to reach REST SMS server
     */
    function __construct($spId,$serviceId,$spPassword,$token,$requestor_id,$apiendpoint){
        try {
            if (!is_numeric($spId)) throw new Exception("spId must be numeric");
            if (!is_numeric($serviceId)) throw new Exception("serviceId must be numeric");
            if (!is_string($spPassword)) throw new Exception("spPassword must be string");
            if (!is_string($token)) throw new Exception("token must be string");
            if (!is_numeric($requestor_id)) throw new Exception("requestor_id must be numeric");
            if (!$this->is_url($apiendpoint)) throw new Exception("apiendpoint must be URL");
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
       $this->apiendpoint=$apiendpoint;
       $this->spId=$spId;
       $this->serviceId=$serviceId;
       $this->spPassword=$spPassword;
       $this->token=$token;
       $this->requestor_id=$requestor_id; 
       $this->boundary[0]=$this->boundary_maker(31);
       $this->boundary[1]="----------------".$this->boundary_maker(21);
    }


/**
* Returns the Header "Authorization" to be used on all Request REST server.
* @return HTTP headers array
*/
    private function basicAuthenticate(){
    date_default_timezone_set('UTC');
    //$now = date("Y-m-d H:i");
    $now = date("YmdHis");
    //Authorization: SDPBasicAuth;realm="SDPAPIs", consumer_key="serviceId@spId", signature_method="MD5", signature=MD5(spId+spPassword+timeStamp) ,timestamp="200901021632", version="0.1"
    $Authorization='Authorization: SDPBasicAuth realm="SDPAPIs", consumer_key="'.$this->serviceId.'@'.$this->spId.'", signature_method="MD5", signature="';
    $Authorization.=strtoupper(md5($this->spId.$this->spPassword.$now));
    $Authorization.='", timestamp="'.$now.'", version="0.1", token="'.$this->token.'", requestor_id="'.$this->requestor_id.'", requestor_type="1"';
    $headers = array ($Authorization, 'Proxy-Connection: Keep-Alive');
    return $headers;
    }


/**
 * The application invokes a REST operation to send a new MMS
 *  
 * @param  $address associative array with the list of address which the MMS will be sent
 * @param  $receiptRequest associative array receiptRequest
 * @param  $senderId associative array senderId
 * @param  $subject string subject
 * @param  $priority associative array priority
 * @param  $charging associative array charging 
 *
 * @return URL to check Delivery Status of SMS
 */
    public function sendMMS($address,$receiptRequest=null,$senderId=null,$subject=null,$priority=null,$charging=null){
    /* EJEMPLO DE PETICION REST
    http://telefonica:8080/gSDP/UNICA-MMS-REST/MMS
    */
            $operation="MMS";
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
            curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this,'readLocation'));
            $contentXML=$this->sendmmsJSONBody($address,$receiptRequest,$senderId,$subject,$priority,$charging);
            $contentBody = $this->AttachAll($contentXML);
            $headers  =  array( "Content-Type: multipart/form-data; boundary=".$this->boundary[0] , "Accept:","Content-Length: ".strlen($contentBody), "Expect:");
            $full_headers = array_merge ( $this->BasicAuthenticate(), $headers);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $full_headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$contentBody);
            //Executing REQUEST
            $result = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (curl_errno($ch)) return "CURL ERROR: ".curl_errno($ch);
            curl_close ($ch);
            if ($http_code!='201') return "RESPONSE CODE: ".$http_code;
            else return $this->Location;
    }



    /**
     * The operation invokes a REST operation to obtain current Delivery Status of a sent MMS
     * 
     * @param  $url This is url returned by sendSMS method
     * @param  $responseType Response type: xml or json
     *
     * @return  XML content delivery status of a sent Message
     */
     public function getMessageDeliveryStatus($url,$responseType="xml"){
            /* EJEMPLO DE PETICION REST
            http://telefonica.com/gSDP/UNICA-MMS-REST/MessageDeliveryStatus?messageIdentifier=12ASDFGASDF&alt=JSON
            */
            if ($responseType =="json" || $responseType =="JSON") $url.="&alt=json";
            $ch = curl_init($url);
            $protocol=explode (":",$url);
            if (strtolower($protocol[0])=="https" ) {
                ## Below two option will enable the HTTPS option.
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  $this->checkPeer);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->checkHost);
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
     * Override this for your needs
     * 
     * @param object $ch
     * @param string $header
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
   * Adds an attachment from a path on the filesystem.
   * Returns false if the file could not be found
   * or accessed. From http://phpmailer.worxware.com
   * @param  $path Path to the attachment.
   * @param  $name Overrides the attachment name.
   * @param  $encoding File encoding ej: base64
   * @param  $type File extension (MIME) type.
   * @return bool
   */

    public function addAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream') {
        if(!@is_file($path)) {
          $this->SetError($this->Lang('file_access') . $path);
          return false;
        }

        $filename = basename($path);
        if($name == '') {
          $name = $filename;
        }
        $cur = count($this->attachment);
        $this->attachment[$cur][0] = $path;
        $this->attachment[$cur][1] = $filename;
        $this->attachment[$cur][2] = $name;
        $this->attachment[$cur][3] = $encoding;
        $this->attachment[$cur][4] = $type;
        $this->attachment[$cur][5] = false; // isStringAttachment
        $this->attachment[$cur][6] = 'attachment';
        $this->attachment[$cur][7] = 0;

        return true;
      }

    private function SetError($path){
        try {
            throw new Exception("File not found:".$path);
        }catch (Exception $e) {
            echo "\nCaught exception: ",  $e->getMessage(), "\n";
        }    
    }
  /**
   * Delete all attachment
   * Returns false if not possible.
   * @return bool
   */

    public function delAttachments() {
        $this->attachment = array ();
        if (count($this->attachment)>0)return false;
        else return true;
      }

/*###################################################################################################################################################################################*/


/**
 * Compound body JSON of operation sendMMS
 *  
 * @param array $address associative array with the list of address which the MMS will be sent
 * @param array $receiptRequest associative array receiptRequest
 * @param array $senderId associative array senderId
 * @param string $subject string subject
 * @param array $priority associative array priority
 * @param array $charging associative array charging 
 *
 * @return string
 */


    private function sendmmsJSONBody ($address,$receiptRequest,$senderId,$subject,$priority,$charging){

    $iterator=0;
    $JSONbody='{"message": {"address":';
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
             $JSONbody.='{';
                    if (isset($address["phoneNumber"])) $JSONbody.='"phoneNumber":"'.$address["phoneNumber"].'",';
                    if (isset($address["anyUri"])) $JSONbody.='"anyUri":"'.$address["anyUri"].'",';
                    if (isset($address["ipAddress"])) $JSONbody.='"ipAddress":"'.$address["ipAddress"].'",';
                    if (isset($address["alias"])) $JSONbody.='"alias":"'.$address["alias"].'",';
                    if (isset($address["otherId"])) $JSONbody.='"otherId":"'.$address["otherId"].'",';
            $JSONbody = substr ($JSONbody, 0, -1);
            $JSONbody.='},';
            }

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

    if (is_string($subject)) $JSONbody.='"subject":"'.$subject.'",';
    if (is_string($priority)) $JSONbody.='"priority":"'.$priority.'",';
    $JSONbody = substr ($JSONbody, 0, -1);
    $JSONbody.='}}';
    return $JSONbody;
    }





    /**
    * Generate Alfanumeric of given lenght 
    * @param $longitud lenght of Alphanumeric Boundary
    * @return Alphanumeric Boundary
    */
    private function boundary_maker($longitud){  
        $exp_reg="[^A-Z0-9]";  
        return substr(eregi_replace($exp_reg, "", md5(rand())) .        eregi_replace($exp_reg, "", md5(rand())) .   eregi_replace($exp_reg, "", md5(rand())),  0, $longitud); 
    } 

    /**
    * Attaches all fs, string, and binary attachments to the message.
    * Returns an empty string on failure. Modified. Original Source from http://phpmailer.worxware.com
    * @return Content Body
    */
      private function AttachAll($XML=null) {
        $boundary_main        = $this->boundary[0];
        $boundary_attach      = $this->boundary[1];
        /* Return text of body */
        $mime = array();
        /* Add all attachments */
        $mime[] = sprintf("--%s%s", $boundary_main, $this->LE);
        $mime[] = sprintf("Content-Disposition: form-data; name=\"root-fields\"%s",$this->LE);
        //$mime[] = sprintf("Content-Type: application/xml; charset=UTF-8%s",$this->LE);
        $mime[] = sprintf("Content-Type: application/json%s",$this->LE);
        $mime[] = sprintf("Content-Transfer-Encoding: 8bit%s", $this->LE);
        $mime[] = sprintf("%s%s%s",$this->LE,$XML,$this->LE);


        $mime[] = sprintf("--%s%s", $boundary_main, $this->LE);        

        if (count($this->attachment)>1){
                $mime[] = sprintf("Content-Disposition: form-data; name=\"attachments\"%s",$this->LE);
                $mime[] = sprintf("Content-Type: multipart/mixed; boundary=%s%s%s", $boundary_attach, $this->LE, $this->LE);
                for($i = 0; $i < count($this->attachment); $i++) {
                  /* Check for string attachment */
                  $bString = $this->attachment[$i][5];
                  if ($bString) {
                    $string = $this->attachment[$i][0];
                  } else {
                    $path = $this->attachment[$i][0];
                  }

                  $filename    = $this->attachment[$i][1];
                  $name        = $this->attachment[$i][2];
                  $encoding    = $this->attachment[$i][3];
                  $type        = $this->attachment[$i][4];

                  $mime[] = sprintf("--%s%s", $boundary_attach, $this->LE);
                  $mime[] = sprintf("Content-Disposition: attachment; filename=\"%s\"%s", $name, $this->LE);
                  $mime[] = sprintf("Content-Type: %s %s", $type, $this->LE);

                  //La siguiente linea es la que no tiene que estar siempre
                  $mime[] = sprintf("Content-Transfer-Encoding: %s%s%s", $encoding, $this->LE, $this->LE);

                  /* Encode as string attachment */
                  if($bString) {
                    $mime[] = $this->EncodeString($string, $encoding);
                    if($this->IsError()) {
                      return '';
                    }
                  } else {
                    $mime[] = $this->EncodeFile($path, $encoding);
                  }
                }
        }

        else{
                  $filename    = $this->attachment[0][1];
                  $name        = $this->attachment[0][2];
                  $encoding    = $this->attachment[0][3];
                  $type        = $this->attachment[0][4];

                  $mime[] = sprintf("Content-Disposition: form-data; name=\"%s\"%s",$name,$this->LE);
                  $mime[] = sprintf("Content-Type: %s %s", $type, $this->LE);

                  //La siguiente linea es la que no tiene que estar siempre
                  $mime[] = sprintf("Content-Transfer-Encoding: %s%s%s", $encoding, $this->LE, $this->LE);
                  $path = $this->attachment[0][0];
                  $mime[] = $this->EncodeFile($path, $encoding);
                  //$mime[] = $this->LE.$this->LE;
                }

        if (count($this->attachment)>1) $mime[] = sprintf("--%s--%s%s", $boundary_attach, $this->LE, $this->LE);
        $mime[] = sprintf("--%s--", $boundary_main);
        return join('', $mime);
      }


    /**
    * Encodes attachment in requested format.  Returns an
    * empty string on failure. From http://phpmailer.worxware.com
    * @return encoded string
    */
      private function EncodeFile ($path, $encoding = 'base64') {
        if(!@$fd = fopen($path, 'rb')) {
          $this->SetError($this->Lang('file_open') . $path);
          return '';
        }
        $magic_quotes = get_magic_quotes_runtime();
        set_magic_quotes_runtime(0);
        $file_buffer = fread($fd, filesize($path));
        $file_buffer = $this->EncodeString($file_buffer, $encoding);
        fclose($fd);
        set_magic_quotes_runtime($magic_quotes);

        return $file_buffer;
      }

    /**
    * Encodes string to requested format. Returns an
    * empty string on failure. From http://phpmailer.worxware.com
    * @access private
    * @return string
    */
      private function EncodeString ($str, $encoding = 'base64') {
        $encoded = '';
        switch(strtolower($encoding)) {
          case 'base64':
            /* chunk_split is found in PHP >= 3.0.6 */
            $encoded = chunk_split(base64_encode($str), 76, $this->LE);
            //$encoded = chunk_split($napa, 76, $this->LE);
            break;
          case '7bit':
          case '8bit':
            $encoded = $this->FixEOL($str);
            //Ñapa para meter un aleatorio en el contenido del sms
            //$encoded .= $this->boundary_maker(15);
            if (substr($encoded, -(strlen($this->LE))) != $this->LE)              
              $encoded .= $this->LE;
            break;
          case 'binary':
            $encoded = $str;
            break;
          case 'quoted-printable':
            $encoded = $this->EncodeQP($str);
            break;
          default:
            break;
        }
        return $encoded;
      }

/**
* Encode string to quoted-printable. From http://phpmailer.worxware.com
* @return encoded string
*/
  private function EncodeQP( $input = '', $line_max = 76, $space_conv = false ) {
    $hex = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
    $lines = preg_split('/(?:\r\n|\r|\n)/', $input);
    $eol = "\r\n";
    $escape = '=';
    $output = '';
    while( list(, $line) = each($lines) ) {
      $linlen = strlen($line);
      $newline = '';
      for($i = 0; $i < $linlen; $i++) {
        $c = substr( $line, $i, 1 );
        $dec = ord( $c );
        if ( ( $i == 0 ) && ( $dec == 46 ) ) { // convert first point in the line into =2E
          $c = '=2E';
        }
        if ( $dec == 32 ) {
          if ( $i == ( $linlen - 1 ) ) { // convert space at eol only
            $c = '=20';
          } else if ( $space_conv ) {
            $c = '=20';
          }
        } elseif ( ($dec == 61) || ($dec < 32 ) || ($dec > 126) ) { // always encode "\t", which is *not* required
          $h2 = floor($dec/16);
          $h1 = floor($dec%16);
          $c = $escape.$hex[$h2].$hex[$h1];
        }
        if ( (strlen($newline) + strlen($c)) >= $line_max ) { // CRLF is not counted
          $output .= $newline.$escape.$eol; //  soft line break; " =\r\n" is okay
          $newline = '';
          // check if newline first character will be point or not
          if ( $dec == 46 ) {
            $c = '=2E';
          }
        }
        $newline .= $c;
      } // end of for
      $output .= $newline.$eol;
    } // end of while
    return $output;
  }

/**
* Encode string to q encoding. From http://phpmailer.worxware.com
* @return encoded string
*/
  private function EncodeQ ($str, $position = 'text') {
    /* There should not be any EOL in the string */
    $encoded = preg_replace("[\r\n]", '', $str);

    switch (strtolower($position)) {
      case 'phrase':
        $encoded = preg_replace("/([^A-Za-z0-9!*+\/ -])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
        break;
      case 'comment':
        $encoded = preg_replace("/([\(\)\"])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
      case 'text':
      default:
        /* Replace every high ascii, control =, ? and _ characters */
        $encoded = preg_replace('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/e',
              "'='.sprintf('%02X', ord('\\1'))", $encoded);
        break;
    }

    /* Replace every spaces to _ (more readable than =20) */
    $encoded = str_replace(' ', '_', $encoded);

    return $encoded;
  }
  
  
/**
* Changes every end of line from CR or LF to CRLF. 
* Modified . Original source on http://phpmailer.worxware.com
* @access private
* @return string
*/
  private function FixEOL($str) {
    $str = str_replace("\r\n", "\n", $str);
    $str = str_replace("\r", "\n", $str);
    $str = str_replace("\n", $this->LE, $str);
    return $str;
  }


/**
* Gets the mime type of the embedded or inline image
* @return mime type of ext
*/
  private function mime_types($ext = '') {
    $mimes = array(
      'amr'   =>  'audio/amr',
      'avi'   =>  'video/avi',
      'asf'   =>  'video/x-ms-asf',
      'bmp'   =>  'image/bmp',
      'doc'   =>  'application/msword',
      'gif'   =>  'image/gif',
      'htm'   =>  'text/html',
      'html'  =>  'text/html',
      'jpe'   =>  'image/pjpeg',
      'jpeg'  =>  'image/pjpeg',
      'jpg'   =>  'image/pjpeg',
      'mid'   =>  'audio/mid',
      'midi'  =>  'audio/mid',
      'mov'   =>  'video/quicktime',
      'movie' =>  'video/x-sgi-movie',
      'mp2'   =>  'audio/mpeg',
      'mp3'   =>  'audio/mpeg',
      'mp4'   =>  'video/mp4',
      'mpe'   =>  'video/mpeg',
      'mpeg'  =>  'video/mpeg',
      'mpg'   =>  'video/mpeg',
      'mpga'  =>  'audio/mpeg',
      'pdf'   =>  'application/pdf',
      'png'   =>  'image/x-png',
      'ppt'   =>  'application/vnd.ms-powerpoint',
      'qt'    =>  'video/quicktime',
      'ra'    =>  'audio/x-realaudio',
      'ram'   =>  'audio/x-pn-realaudio',
      'rm'    =>  'audio/x-pn-realaudio',
      'rpm'   =>  'audio/x-pn-realaudio-plugin',
      'rtf'   =>  'text/rtf',
      'rtx'   =>  'text/richtext',
      'rv'    =>  'video/vnd.rn-realvideo',
      'swf'   =>  'application/x-shockwave-flash',
      'text'  =>  'text/plain',
      'txt'   =>  'text/plain',
      'tif'   =>  'image/tiff',
      'tiff'  =>  'image/tiff',
      'wav'   =>  'audio/wav',
      'wmv'   =>  'video/x-ms-wmv',
      'word'  =>  'application/msword',
      'xml'   =>  'text/xml',
      'zip'   =>  'application/zip'
    );
    return ( ! isset($mimes[strtolower($ext)])) ? 'application/octet-stream' : $mimes[strtolower($ext)];
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
    
//Fin de la clase
}


?>
