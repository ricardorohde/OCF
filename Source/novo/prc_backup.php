<?php 
	session_cache_limiter('nocache');
	session_start();
	
	require("class.phpmailer.php");

    require_once ("prc_execsql.php");
	   
	$consulta = sprintf("select emailwbm from cad_param");

   	$result = execsql($consulta);

    $row = mysql_fetch_assoc($result);

	$mail = new phpmailer();

	$mail->ClearAddresses();
	$mail->ClearAllRecipients();
    $mail->ClearAddresses();
    $mail->ClearCustomHeaders();
    $mail->IsSMTP();
	$mail->From     = "bolaodoalex@yahoo.com.br";
	$mail->FromName = "Backup Bolão";
 	$mail->Hostname = "smtp.netsite.com.br";
	$mail->Host     = "smtp.netsite.com.br";
//    $mail->SMTPDebug = 2;
 	$mail->Username = "alencarmo";
	$mail->Password = "12345678";
	$mail->SMTPAuth = true;
	$mail->Timeout = 120;

    $body  = "Backup automático do bolão";
    $text_body  = "Backup automático do bolão";

    $mail->isHTML(true);
    $mail->Subject = sprintf ("Backup Bolão do dia %s",date("d/m/Y H:i:s"));
    $mail->Body    = $body;
    $mail->AltBody = $text_body;
    $mail->AddAddress($row['emailwbm'], "");

	$mail->AddAttachment("/home/bkbolao/bkdados.tar.gz");
	$mail->AddAttachment("/home/bkbolao/bkfontes.tar.gz");

    $exito = $mail->Send();
    $v=0;

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

    mysql_free_result($result);
    mysql_close($link);

?>
