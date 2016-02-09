<?php include("sessao.php"); ?>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");

	include('envmail.php');

	$codigo = 0;
	$user = 0;
	$userrec = 0;
	$email = " ";
    $msg = "";
    $username = "";
	$linkexc = "";
	
	$db = new BD();
	$db2 = new BD();

    $sql = sprintf("select m.codigo,u.userid,email,mensagem,m.userid useridrec from
								cad_mural m,
								cad_usuario u
								where
								u.recmail = 'S'
								and u.aprovado = 'S'
								and (m.codigo,u.userid)
								not in
								(select codigo,userid from log_mural)
								limit 45");

    $db->Query($sql);
	
    while ($db->Next()) {
			$codigo  = $db->getValue('codigo');
			$user    = $db->getValue('userid');
			$userrec = $db->getValue('useridrec');
			$email   = $db->getValue('email');
			$msg     = $db->getValue('mensagem');

        $sql = sprintf("select username from cad_usuario where userid = %d",$userrec);

	    $db2->Query($sql);
		$db2->Next();
	    $username = $db2->getValue('username');

		$msg .= "<br><br><br>"."Mensagem enviada por: <b>".$username;
		$msg .= "<br>"."Opala Clube Franca.";
		$msg .= "<br><br><br>"."Se não deseja receber as mensagens por e-mail clique no link abaixo.";
        $linkexc = sprintf ("<a href=http://".$_SERVER['HTTP_HOST']."/prc_excmail.php?usr=".trim($user)."&id=".md5(trim(trim($username).'lstmailexc'.trim($email))).">Clique aquí p/ não receber mais os recados por e-mail</a>"); 
		$msg .="<br>".$linkexc;

		$ln = sprintf ("Codigo:%d - User:%d - Username:%s - Email:%s<br>",$codigo,$user,$username,$email);
//		echo ($ln)."\n";

        $st = envmail($email,"Recado Opala Clube Franca",$msg,"admin@opalaclubefranca.com.br");


        $sql = sprintf("insert into log_mural (codigo,userid,dataenvio,status)
						values (%d,%d,now(),'%s')",$codigo,$user,$st);

		$db2->Exec($sql);
		
		}

    $db->Close();
	$db2->Close();

   foreach (glob("/home/opalaclu/prc_envrecado.php.*") as $filename) {
	    unlink($filename);
	}

?>
