<?php include("sessao.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario.php"); ?>
<?php
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == "SIM") // Se estiver logado apresenta as informações do usuário
        include ("infouser.php");
    else {
			if (isset($_SESSION['registro']) && $_SESSION['registro'] == 'SIM') { // Se já registrou o acesso só apresenta o formulário de login
	     		include("frm_login.php");
				}
			else {
					$_SESSION['registro'] = 'SIM'; // Registra a identificação do acesso
					require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
					$db = new BD();

					if (isset($_COOKIE['OpalaUserid'])) {
		    				$_SESSION['userid'] = $_COOKIE['OpalaUserid'];
							 
							$usr = new Usuario($_COOKIE['OpalaUserid']);

							if ($_COOKIE['LoginOpala'] == md5("LITTLEBOY-LOGADO".$usr->getUserid().trim($usr->getEMail())) && $usr->getAprovado() == 'S') { // Ainda não registrou mas estava logado quando fechou a ultima vez registra o acesso e entra logado.
								 $sql = sprintf("delete from usr_online where userid = %d",$usr->getUserid());
								 $db->Exec($sql);
	
								 $unixtime = (strtotime('NOW') + 3600);
								 $sql = sprintf("insert into usr_online (sessao,userid,datetime) values ('%s',%d,%s)",$_ID,$usr->getUserid(),$unixtime);
								 $db->Exec($sql);
	
								 $_SESSION['logado'] = "SIM";
								 $_SESSION['userid'] = $usr->getUserid();
								 $_SESSION['niveluser'] = $usr->getNivel();
								 $_SESSION['username'] = $usr->getUsername();
								 $_SESSION['email'] = $usr->getEMail();
								 $_SESSION['aprovado'] = $usr->getAprovado();

             					 Usuario::LogUsuario($usr->getUserid(),'COOKIE','SIM');
								 					 	
								  //gera log de acesso dos usuários
						         include ("infouser.php"); 
							 }
							else { // Se não está logado

								 $sql = sprintf("delete from usr_online where userid = %d",$usr->getUserid());
								 $db->Exec($sql);

             					 Usuario::LogUsuario($usr->getUserid(),'COOKIE','NAO');
				                 include("frm_login.php");
								}
						}
					else { // Se o cookie não está setado registro sem o userid
       					 Usuario::LogUsuario(99999999,'COOKIE','NAO');
		                 include("frm_login.php");
						}
				}
		}
?>
