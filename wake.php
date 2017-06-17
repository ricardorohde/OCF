<?php

Wake("franca.sytes.net", "0040F45AF534", 3306);

function wake($hostname, $mac, $port) 
{

	$errno = 0;
	$errstr = "";
    $ip = gethostbyname($hostname);
    
    $packet = ""; 
    for($i = 0; $i < 6; $i++) 
       $packet .= chr(0xFF);
	///$$packet = str_repeat(chr(255),6);
    for($j = 0; $j < 16; $j++)
    {
      for($k = 0; $k < 6; $k++) 
      {
        $str = substr($mac, $k * 2, 2);
        $dec = hexdec($str);
		echo "<br/>".$str." ".$dec." ".chr($dec);
        $packet .= chr($dec);
      }
    }
    
    echo "<br/>IP = ".$ip;
    echo "<br/>Port = ".$port;
    echo "<br/>Tam. msg = ".strlen($packet);
    echo "<br/>Msg = ".$packet;
    
//Sending data
//    if (function_exists('socket_create') == FALSE) //
//		echo "<br/>"."Socket nao suportado pelo servidor";

//else {
//        	$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
//        	$sock_data = socket_connect($sock, $ip, 9) //Can connect to the socket

//        	socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 100);  
//        	if (socket_sendto($sock, $packet, strlen($packet), 0x100, $ip, 9) !== FALSE) {/
//				echo "<br/>"."Pacote enviado com sucesso";
//	    			    }    	
//        $sock_data = socket_write($sock, $msg, strlen($msg)); //Send data
//        socket_close($sock); //Close socket
//        return true;

    
    	if (function_exists('fsockopen')) {
    		echo "<br/>Função fsockopen disponivel";
    	}
    	if (function_exists('fwrite')) {
    		echo "<br/>Função fwrite disponivel";
    	}
    	else {
    		echo "<br/>Função fwrite nao disponivel";
    	}
    	$srv = "udp://".$ip; //.":".$port;
//		$nic = stream_socket_client($srv, $errno, $errstr, 100);

        $nic = fsockopen($srv, $port, $errno, $errstr, 100) or die('Could not connect to: '.$ip);; 
        
        if($nic == true) 
          { 
    		echo "<br/>Socket = ".$nic;

    		stream_set_timeout($nic, 0, 30 * 1000);
   			        
        	if (fwrite_with_retry($nic, $packet) ===false)
        	{
    		echo "<br/>Erro gravando msg fputs";
        	}
			//fflush($nic);
			//echo "<br/>Lidos = ".fgets($nic);     
//  		  	$ret = fputs($nic, $packet);
//    		$ret = fwrite($nic, $packet,102);
//    		$ret = fwrite($nic, $packet,102);
    		echo "<br/>Retorno = ".$ret;
    		fclose($nic); 
    		if($ret)
		      return true;
          }
          
//  } 
  return;
} 

function fwrite_with_retry($sock, $data)
{
    $bytes_to_write = strlen($data);
    $bytes_written = 0;

    echo "<br/>Sock fw = ".$sock;
    echo "<br/>msg fw = ".$data;
    while ( $bytes_written < $bytes_to_write )
    {
        if ( $bytes_written == 0 ) {
            $rv = fwrite($sock, $data,strlen($data));
        } else {
            $rv = fwrite($sock, substr($data, $bytes_written));
        }

        if ( $rv === false || $rv == 0 )
            return( $bytes_written == 0 ? false : $bytes_written );

        $bytes_written += $rv;
    }

    return $bytes_written;
}
?>
