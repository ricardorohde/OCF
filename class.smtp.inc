<?php
/************************************
/  MailSmtp - Script para enviar email via smtp
/  tipo formmail com auto-resposta opcional...
/  
/  Arquivos necess�rios
/  mailsmtp.php 
/  class.smtp.inc
/  config.php
/
/  Como Utilizar
/  Criar Formul�rio e em action action="mailsmtp.php"
/  ex: 
/  <form name="form1" method="post" action="mailsmtp.php">
/
/  Se quiser que tenha um e-mail de auto resposta defina
/  um campo em seu formul�rio com o nome de email ou com
/  o nome configurado em $autoresposta dentro do config.php
/
/  Vers�o 1.0 
/  Desenvolvido por: Adailton Milhorini
/  E-mail: adailtonof@ig.com.br
/  Linux User# 134234
**************************************/


	define('SMTP_STATUS_NOT_CONNECTED', 1, TRUE);
	define('SMTP_STATUS_CONNECTED', 2, TRUE);

	class smtp{

		var $authenticated;
		var $connection;
		var $recipients;
		var $headers;
		var $timeout;
		var $errors;
		var $status;
		var $body;
		var $from;
		var $host;
		var $port;
		var $helo;
		var $auth;
		var $user;
		var $pass;

		/***************************************
        ** Constructor function. Arguments:
		** $params - An assoc array of parameters:
		**
		**   host    - The hostname of the smtp server		Default: localhost
		**   port    - The port the smtp server runs on		Default: 25
		**   helo    - What to send as the HELO command		Default: localhost
		**             (typically the hostname of the
		**             machine this script runs on)
		**   auth    - Whether to use basic authentication	Default: FALSE
		**   user    - Username for authentication			Default: <blank>
		**   pass    - Password for authentication			Default: <blank>
		**   timeout - The timeout in seconds for the call	Default: 5
		**             to fsockopen()
        ***************************************/


		function smtp($params = array()){

			if(!defined('CRLF'))
				define('CRLF', "\r\n", TRUE);

			$this->authenticated	= FALSE;			
			$this->timeout			= 30;
			$this->status			= SMTP_STATUS_NOT_CONNECTED;
			$this->host			= 'localhost';
			$this->port			= 25;
			$this->helo			= 'localhost';
			$this->auth			= FALSE;
			$this->user			= '';
			$this->pass			= '';
			$this->errors   		= array();

			foreach($params as $key => $value){
				$this->$key = $value;
        
			}
     /*                  echo '<tr><td>'.$this->authenticated.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->timeout.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->status.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->host.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->port.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->helo.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->auth.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->user.'</td></tr>'."\n";
                       echo '<tr><td>'.$this->pass.'</td></tr>'."\n"; */
	}

		/***************************************
        ** Connect function. This will, when called
		** statically, create a new smtp object, 
		** call the connect function (ie this function)
		** and return it. When not called statically,
		** it will connect to the server and send
		** the HELO command.
        ***************************************/

		function &connect($params = array()){

			if(!isset($this->status)){
				$obj = new smtp($params);
				if($obj->connect()){
					$obj->status = SMTP_STATUS_CONNECTED;
				}

				return $obj;

			}else{
				$this->connection = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
				if(function_exists('socket_set_timeout')){
					@socket_set_timeout($this->connection, 5, 0);
				}

				$greeting = $this->get_data();
				if(is_resource($this->connection)){
					return $this->auth ? $this->ehlo() : $this->helo();
				}else{
					$this->errors[] = 'Failed to connect to server: '.$errstr;
					return FALSE;
				}
			}
		}


// Verifica_mail






		/***************************************
        ** Function which handles sending the mail.
		** Arguments:
		** $params	- Optional assoc array of parameters.
		**            Can contain:
		**              recipients - Indexed array of recipients
		**              from       - The from address. (used in MAIL FROM:),
		**                           this will be the return path
		**              headers    - Indexed array of headers, one header per array entry
		**              body       - The body of the email
		**            It can also contain any of the parameters from the connect()
		**            function
        ***************************************/
	function send($params = array()){

			foreach($params as $key => $value){
				$this->set($key, $value);
			}

			if($this->is_connected()){

            //             echo '<tr><td> flauth '.$this->auth,'</td></tr>'."\n";
            //             echo '<tr><td> authenticated '.$this->authenticated,'</td></tr>'."\n";
				// Do we auth or not? Note the distinction between the auth variable and auth() function
				if($this->auth AND !$this->authenticated){
					if(!$this->auth())
						return FALSE;
				}

				$this->mail($this->from);
				if(is_array($this->recipients))
					foreach($this->recipients as $value)
						$this->rcpt($value);
				else
					$this->rcpt($this->recipients);

				if(!$this->data())
					return FALSE;

				// Transparency
				$headers = str_replace(CRLF.'.', CRLF.'..', trim(implode(CRLF, $this->headers)));
				$body    = str_replace(CRLF.'.', CRLF.'..', $this->body);
				$body    = $body[0] == '.' ? '.'.$body : $body;

             //            echo '<tr><td>'.$headers,'</td></tr>'."\n";
                         echo '<tr><td>'.$body,'</td></tr>'."\n";

				$this->send_data($headers);
				$this->send_data('');
				$this->send_data($body);
				$this->send_data('.');

				$result = (substr(trim($this->get_data()), 0, 3) === '250');
				//$this->rset();
				return $result;
			}else{
				$this->errors[] = 'Not connected!';
				return FALSE;
			}
		}
		
		/***************************************
        ** Function to implement HELO cmd
        ***************************************/

		function helo(){
			if(is_resource($this->connection)
					AND $this->send_data('HELO '.$this->helo)
					AND substr(trim($error = $this->get_data()), 0, 3) === '250' ){

				return TRUE;

			}else{
				$this->errors[] = 'HELO command failed, output: ' . trim(substr(trim($error),3));
				return FALSE;
			}
		}
		
		/***************************************
        ** Function to implement EHLO cmd
        ***************************************/

		function ehlo(){
			if(is_resource($this->connection)
					AND $this->send_data('EHLO '.$this->helo)
					AND substr(trim($error = $this->get_data()), 0, 3) === '250' ){

				return TRUE;

			}else{
				$this->errors[] = 'EHLO command failed, output: ' . trim(substr(trim($error),3));
				return FALSE;
			}
		}
		
		/***************************************
        ** Function to implement RSET cmd
        ***************************************/

		function rset(){
			if(is_resource($this->connection)
					AND $this->send_data('RSET')
					AND substr(trim($error = $this->get_data()), 0, 3) === '250' ){

				return TRUE;

			}else{
				$this->errors[] = 'RSET command failed, output: ' . trim(substr(trim($error),3));
				return FALSE;
			}
		}
		
		/***************************************
        ** Function to implement QUIT cmd
        ***************************************/

		function quit(){
			if(is_resource($this->connection)
					AND $this->send_data('QUIT')
					AND substr(trim($error = $this->get_data()), 0, 3) === '221' ){

				fclose($this->connection);
				$this->status = SMTP_STATUS_NOT_CONNECTED;
				return TRUE;

			}else{
				$this->errors[] = 'QUIT command failed, output: ' . trim(substr(trim($error),3));
				return FALSE;
			}
		}
		
		/***************************************
        ** Function to implement AUTH cmd
        ***************************************/

		function auth(){
            //            echo '<tr><td> auth '.$this->user,'</td></tr>'."\n";
            //             echo '<tr><td> auth '.$this->pass,'</td></tr>'."\n";

			if(is_resource($this->connection)
					AND $this->send_data('AUTH LOGIN')
					AND substr(trim($error = $this->get_data()), 0, 3) === '334'
					AND $this->send_data(base64_encode($this->user))			// Send username
					AND substr(trim($error = $this->get_data()),0,3) === '334'
					AND $this->send_data(base64_encode($this->pass))			// Send password
					AND substr(trim($error = $this->get_data()),0,3) === '235' ){

				$this->authenticated = TRUE;
				return TRUE;

			}else{
				$this->errors[] = 'AUTH command failed: ' . trim(substr(trim($error),3));
				return FALSE;
			}
		}

		/***************************************
        ** Function that handles the MAIL FROM: cmd
        ***************************************/
		
		function mail($from){

           //              echo '<tr><td> from '.$from.'</td></tr>'."\n";
			if($this->is_connected()
				AND $this->send_data('MAIL FROM:<'.$from.'>')
				AND substr(trim($this->get_data()), 0, 2) === '250' ){

				return TRUE;

			}else
				return FALSE;
		}

		/***************************************
        ** Function that handles the RCPT TO: cmd
        ***************************************/
		
		function rcpt($to){
          //               echo '<tr><td> to '.$to,'</td></tr>'."\n";

			if($this->is_connected()
				AND $this->send_data('RCPT TO:<'.$to.'>')
				AND substr(trim($error = $this->get_data()), 0, 2) === '25' ){

				return TRUE;

			}else{
				$this->errors[] = trim(substr(trim($error), 3));
				return FALSE;
			}
		}

		/***************************************
        ** Function that sends the DATA cmd
        ***************************************/

		function data(){

			if($this->is_connected()
				AND $this->send_data('DATA')
				AND substr(trim($error = $this->get_data()), 0, 3) === '354' ){
 
				return TRUE;

			}else{
				$this->errors[] = trim(substr(trim($error), 3));
				return FALSE;
			}
		}

		/***************************************
        ** Function to determine if this object
		** is connected to the server or not.
        ***************************************/

		function is_connected(){

			return (is_resource($this->connection) AND ($this->status === SMTP_STATUS_CONNECTED));
		}

		/***************************************
        ** Function to send a bit of data
        ***************************************/

		function send_data($data){

            //             echo '<tr><td> send_data'.$data,'</td></tr>'."\n";
			if(is_resource($this->connection)){
				return fwrite($this->connection, $data.CRLF, strlen($data)+2);
				
			}else
				return FALSE;
		}

		/***************************************
        ** Function to get data.
        ***************************************/

		function &get_data(){

			$return = '';
			$line   = '';
			$loops  = 0;

			if(is_resource($this->connection)){
				while((strpos($return, CRLF) === FALSE OR substr($line,3,1) !== ' ') AND $loops < 100){
					$line    = fgets($this->connection, 512);
					$return .= $line;
					$loops++;
				}
				return $return;

			}else
				return FALSE;
		}

		/***************************************
        ** Sets a variable
        ***************************************/
		
		function set($var, $value){

			$this->$var = $value;
			return TRUE;
		}

	} // End of class
?>