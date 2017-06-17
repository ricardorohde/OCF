<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.sms.php");

	$sms = new SMS(0);

	$acao = $_GET['acao'];

	$msgserver = "";
		
if ($acao == 'status') {
	if ($sms->StatusSMSServer() == false) {
		$msgserver = "O servidor de SMS está inativo no momento, p/ enviar mensagens é necessário ativá-lo !!!";
	}
	else 
		$msgserver = "Servidor de SMS Ativo !!!";
}
elseif ($acao == 'ativar') {
	  $sms->WakeSMSServer(); 
      $msgserver = "Ativação do servidor SMS em andamento aguarde alguns instantes até concluir a inicialização !!";
}
elseif ($acao == 'desligar') {
	  $sms->DesligaSMSServer(); 
      $msgserver = "Desativação do servidor SMS em andamento...";
}
echo mb_convert_encoding($msgserver,"UTF-8", "ISO-8859-1" );
?>
