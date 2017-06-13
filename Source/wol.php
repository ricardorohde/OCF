<?php
# Wake on LAN - (c) HotKey@spr.at, upgraded by Murzik
# Modified by Allan Barizo http://www.hackernotcracker.com
// Reformatted, improved and OO'ized by Chris Seto http://www.chrisseto.com

class WOL
{
	private $broadcast   = '';
	private $lastStatus  = 'NA';

	/**
	 * void __construct(string $network)
	 * 	Start the WOL class and specify broadcast network
	 *
	 * @param $network				The network to broadcast on
	 * @return void
	 */
	public function __construct($hostname)
	{
		// TODO: Verification
		$this->broadcast = "udp://".gethostbyname($hostname);
	}

	/**
	 * string getLastStatus(void)
	 * 	Get status of last wake up call
	 *
	 * @return string			Result of last wakeOnLan
	 */
	public function getLastStatus()
	{
		return $this->lastStatus;
	}

	/**
	 * bool wakeOnLan(string $mac, int $socket_number)
	 * 	Wake up a remote computer
	 *
	 * @param $mac				The MAC address of the remote computer to wake
	 * @param $socket_number	The socket to wake on, usually port 7
	 * @return true/false
	 */
	public function wakeOnLan($mac, $socket_number=3306)
	{
		$addr_byte = explode(':', $mac);
		$hw_addr   = '';

		for ($a=0; $a <6; $a++)
			$hw_addr .= chr(hexdec($addr_byte[$a]));

		$msg = chr(255).chr(255).chr(255).chr(255).chr(255).chr(255);

		for ($a = 1; $a <= 16; $a++)
			$msg .= $hw_addr;

    echo "<br/>IP = ".$this->broadcast;
    echo "<br/>Port = ".$socket_number;
    echo "<br/>Tam. msg = ".strlen($msg);
    echo "<br/>Msg = ".$msg;

$errno = 0;
$errstr = "";

   $nic = fsockopen($this->broadcast, $socket_number, $errno, $errstr, 100) or die('Could not connect to: '.$ip);; 
        
        if($nic == true) 
          { 
    		echo "<br/>Socket = ".$nic;

    		stream_set_timeout($nic, 0, 30 * 1000);
   			        
        	if (fwrite($nic, $msg) ===false)
        	{
    		echo "<br/>Erro gravando msg fputs";
        	}

//		$ret = fwrite($nic, $msg,102);
 //   		echo "<br/>Retorno = ".$ret;
    		fclose($nic); 
		}
}
}
// Create the WOL object
$wol = new WOL('franca.sytes.net');

// Wake up!
$wol->wakeOnLan("00:40:F4:5A:F5:34");

// Handle the status for the last call to WakeOnLan()
switch ($wol->getLastStatus())
{
	case 'OK':
	echo 'Magic packet sent!';
	break;

	case 'NA':
	echo 'No call to wakeOnLan() has been made...';
	break;

	case 'socket_create_fail':
	echo 'Could not create socket!';
	break;

	case 'setsockopt_fail':
	echo 'Could not set socket option!';
	break;

	case 'send_fail':
	echo 'Could not send packet!';
	break;

	default:
	echo 'I have no idea what happened.';
	break;
}
?>