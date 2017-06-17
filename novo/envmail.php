
<?php
function envmail($email,$subject,$msg,$from,$fromname = "Opala Clube Franca") {

	require_once("class.phpmailer.php");
	$mail = new phpmailer();

	$mail->ClearAddresses();
	$mail->ClearAllRecipients();
    $mail->ClearAddresses();
    $mail->ClearCustomHeaders();
    $mail->IsSMTP();
//    $mail->IsSendmail();

	$mail->From     = $from;
	$mail->FromName = $fromname;
// 	$mail->Hostname = "smtp.gmail.com";
//	$mail->Host     = "smtp.gmail.com";
	$mail->SMTPSecure = "ssl";
 	$mail->Hostname = "smtp.opalaclubefranca.com.br";
	$mail->Host     = "smtp.opalaclubefranca.com.br";
//    $mail->SMTPDebug = 2;
 	$mail->Username = "admin@opalaclubefranca.com.br";
	$mail->Password = "racnela";
	$mail->SMTPAuth = true;
	$mail->Port = 465;
	$mail->Timeout = 120;

    $body  = $msg;
    $text_body  = $msg;

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $text_body;
	
    if (is_array($email)) 
	    foreach($email as $em) {
	  	        $mail->AddAddress($em, "");
		 }
    else 
	    $mail->AddAddress($email, "");

  /*  echo '<tr><td>To '.$email.'</td></tr>'."\n";
    echo '<tr><td>Assunto '.$subject.'</td></tr>'."\n";
    echo '<tr><td>Mensagem '.$msg.'</td></tr>'."\n";
    echo '<tr><td>From '.$from.'</td></tr>'."\n";
*/
    $exito = $mail->Send();
    $v=0;
//    echo "<tr><td>ErrorInfo " . $mail->ErrorInfo . "<br></td></tr>";
    while((!$exito)&&($v<5)&&($mail->ErrorInfo!="SMTP Error: Data not accepted.")) {
            sleep(2);
            $exito = $mail->Send();
		     echo "<tr><td>ErrorInfo " . $mail->ErrorInfo . "<br></td></tr>";
            $v=$v+1;
            }

     if(!$exito) {
        echo "<tr><td>There has been a mail error sending to " . $mail->ErrorInfo . "<br></td></tr>";
      }

    $mail->ClearAddresses();
    $mail->ClearAttachments();
	
	return $mail->ErrorInfo;
}
?>
