<?php
/*
	Funcão: lnkusuario
	Descrição: Retorna um link para a exibição de informações do usuário
	Desenvolvido: Alencar
	Data: 28/01/2006
*/

require_once($_SERVER['DOCUMENT_ROOT'].'/functions/fn_execsql.php');

function lnkusuario ($usuario) {

   $js = " ";
   $lnk = " ";
   $sql = " ";
   
   $sql = sprintf("select username " .
					"from " .
					"cad_usuario " .
					"where " .
					"userid = %d ",$usuario);

   $result = execsql($sql);
   $row = mysql_fetch_assoc($result);
   
   $js = sprintf("javascript:janela('./lst/lst_detusuario.php?usr=%d',10,50,400,500);",$usuario);

	$lnk = '<a href="'.$js.'">'.$row['username'].'</a>';

	return $lnk;

}