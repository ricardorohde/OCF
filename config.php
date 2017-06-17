<?
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

//Configura��es de Assuntos
      
	$msg_assunto = "Formul�rio de Contato";	//assunto para mensagem enviada	

	$msg_assuntoresposta = "Seu E-mail foi recebido...";	//assunto para mensagem de auto-resposta

	$msg_para = "seuemail@destino.com.br";	//endere�o para qual vai o e-mail enviado

//mensagem de auto-resposta
      $msg_resposta= " ";

	$pagina_ok="obrigado.htm"; 	//p�gina de Redirecionamento de confirma��o de envio      

	$pagina_erro="erro.htm"; 	//p�gina de Redirecionamento de erro de envio


//nome do campo do formul�rio no qual recebe o endere�o de auto resposta, preencher se quizer auto -resposta
	$autoresposta="email"; 	

//configuracoes da p�gina de erro de auto-resposta
$erro_titulo="Erro, Preenchimento Incorreto...";  //titulo da pagina de erro de preenchimento de campo auto-resposta
$background='#0000cc';					  //background da pagina de erro de preenchimento
$texto='#ffffff';				              //Cor do Texto
$link='#ccccc';				              //Cor do Link de Voltar
$erro_msg="<br><h1>Erro...</h1><br><h2>Campo de E-mail preenchido incorretamente</h2><br>\n"; //mensagem de erro

//configura��o de endere�os...
  $params['host'] = 'smtp.mail.yahoo.com.br';	//endere�o de smtp
	$params['port'] = 25;	// n�o mexer
	$params['helo'] = 'mail.yahoo.com.br'; //exec('localhost'); // n�o mexer
	$params['auth'] = true; // true, se precisar de autentica��o no servidor smtp
	$params['user'] = 'a1encar';	// nome do usuario se necess�io autentica��o
	$params['pass'] = 'racnela';	// senha se necess�rio autentica��o










// n�o mexer nos parametros abaixo........

	$send_params['recipients']	= explode(',',$msg_para);
	$send_params['headers']		= array("From: " . $$autoresposta,"To: $msg_para","Subject: $msg_assunto");
	$send_params['from']		= $$autoresposta;	
	$send_params['body']		= " ";		

function email_ok($endereco) {  
  if(eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $endereco)) return TRUE;  
  else return FALSE;  
} 
?>