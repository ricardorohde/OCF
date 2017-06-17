<?php
	echo "\n"."Enviando sms com agenda de reuniões...";
	$url =  "http://www.opalaclubefranca.com.br/prc_smsagenda.php?username=alencar&password=racnela";
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, TRUE); 
    curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    $head = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
//    echo $head.$httpCode;
    curl_close($ch);
    Echo "\n"."Agenda encaminhada para fila de sms !"
?>