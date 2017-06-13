<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/sessao.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.sms.php");
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario.php");
 
	$username = $_GET['username'];
	$password = $_GET['password'];
	$usr = new Usuario(0);
	$MsgLogin = "";

	if ($usr->Login($username,$password,$MsgLogin) == false) {
			return;
	}

	$destinatario = 1;
	$associados = "S";
	$naoassociados = "N";
	$mensagem = "OpalaClubeFranca Informa: Prezado opaleiro #usuarionosite#, nossa reunião dessa semana será as #hrr# no #localproximareuniao#, contamos com sua presença.Abs!";
	$numero = 0;
/*	
	echo($destinatario)."<br/>";
	echo($associados)."<br/>";
	echo($naoassociados)."<br/>";
	echo($mensagem)."<br/>";
*/

	$sms = new SMS(0);
	$sms->setTexto($mensagem);
	$sms->setIDCliente(1);
	$sms->setIDSite($usr->getUseriD());
	$sms->setLista($destinatario);
	$sms->setAssociados($associados);
	$sms->setNaoAssociados($naoassociados);
	$sms->setNumero($numero);
	$sms->Enviar("N");	
?>
