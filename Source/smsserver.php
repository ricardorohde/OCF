<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.sms.php");

	$sms = new SMS(0);

	$acao = $_GET['acao'];

	$msgserver = "";
		
if ($acao == 'status') {
	if ($sms->StatusSMSServer() == false) {
		$msgserver = "O servidor de SMS est� inativo no momento, p/ enviar mensagens � necess�rio ativ�-lo !!!";
	}
	else 
		$msgserver = "Servidor de SMS Ativo !!!";
}
elseif ($acao == 'ativar') {
	  $sms->WakeSMSServer(); 
      $msgserver = "Ativa��o do servidor SMS em andamento aguarde alguns instantes at� concluir a inicializa��o !!";
}
elseif ($acao == 'desligar') {
	  $sms->DesligaSMSServer(); 
      $msgserver = "Desativa��o do servidor SMS em andamento...";
}
echo mb_convert_encoding($msgserver,"UTF-8", "ISO-8859-1" );
?>
