<?php include("sessao.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>
<?php 
function saida() {

  include("head.php"); 

 echo ('<span class="titusr">Login</span>');
      
 include("traco.php");

echo ('  <table id="menuadm" border="0" cellspacing="0">');

}

require_once("prc_execsql.php");
	
   $username = trim($_POST['username']);
   $senha = trim($_POST['senha']);

       include ('conectadb.php');
     
       $consulta = sprintf("select username,senha,userid,flconfirma,nivel,email,aprovado from cad_usuario where upper(username) = '%s'",strtoupper($username));
       $result = mysql_query($consulta);
       $row = mysql_fetch_assoc($result);

       if (mysql_num_rows($result) == 0 || trim(md5($senha)) <> $row['senha']) {
	   	   saida();
           echo ("<tr><td>Usuário e senha inválida ! </td></tr:")."\n";
           include ("volta.php");
          }
       else
       if ($row['flconfirma'] <> 'S') {
	       saida();
           $_SESSION['logado'] = "NAO";
           $_SESSION['userid'] = $row['userid'];
           $_SESSION['niveluser'] = 0;
           $_SESSION['username'] = $row['username'];
           $_SESSION['email'] = $row['email'];
           echo ("<tr><td>Você não confirmou seu cadastro pelo e-mail que foi enviado. </td></tr:")."\n";
           echo ('<tr><td><br></td></tr>')."\n";
           echo ('<tr><td><br></td></tr>')."\n";
           echo ("<tr><td>Sem essa confirmação você não poderá prosseguir.</td></tr:")."\n";
           echo ('<tr><td><br></td></tr>')."\n";
           echo ('<tr><td><br></td></tr>')."\n";
           echo ('<tr><td>Se você não recebeu o e-mail <a  href="prc_envmail.php">clique aquí</a></td></tr>')."\n";
           echo ('<tr><td><br></td></tr>')."\n";
           echo ('<tr><td><br></td></tr>')."\n";
           echo ('<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>')."\n";
       	}
/*       else
       if ($row['aprovado'] <> 'S') {
	       saida();
           $_SESSION['logado'] = "NAO";
           $_SESSION['userid'] = $row['userid'];
           $_SESSION['niveluser'] = 0;
           $_SESSION['username'] = $row['username'];
           $_SESSION['email'] = $row['email'];

		   echo('<tr><td><p class="titusr" style="font-weight: bold; font-size: 12px">Prezado '.$_SESSION['username'].".<br></td></tr>");

		   echo("<tr><td>".'<p class="titusr" style="font-weight: bold; font-size: 12px">Conforme definição em assembleia dos associados do clube ficou definido que para ter acesso a áreas restritas do site é necessário confirmar sua associação seguindo esses passos: </p>
            <ul>
              <li class="titusr" style="font-size: 12px">Participar da primeira reuni&atilde;o para apresenta&ccedil;&atilde;o e avalia&ccedil;&atilde;o da diretoria e aos demais membros do clube. </li>
              <li class="titusr" style="font-size: 12px">Submeter seu opala ou caravan a avalia&ccedil;&atilde;o pela diretoria t&eacute;cnica. </li>
              <li class="titusr" style="font-size: 12px">Pagar taxa de inscri&ccedil;&atilde;o de R$ 50,00 (com o pagamento dessa taxa voc&ecirc; recebe uma camiseta e um adesivo do clube). </li>
              <li class="titusr" style="font-size: 12px">Contribuir mensalmente com a taxa de R$ 20,00. </li>
              <li class="titusr" style="font-size: 12px">Frequentar as reuni&otilde;es pelo menos 1 vez a cada trimestre. </li>
              <li class="titusr" style="font-size: 12px">Somente o associado ter&aacute; seu nome relacionado na lista de membros, acesso ao site no mural de recados, classificados e outras &aacute;reas restritas. </li>
            </ul>'."</td></tr>");
		   echo("<tr><td>".'<p class="titusr" style="font-weight: bold; font-size: 12px">Sua participação oficial e efetiva é muito importante para a preservação da história do opala e o fortalecimento de nossa associação.'."</td></tr>");
		   echo("<tr><td><br>".'<p class="titusr" style="font-weight: bold; font-size: 12px">As portas do Opala Clube de Franca estão abertas a todos.'."</td></tr>");

		   echo("<tr><td><br>".'<p class="titusr" style="font-weight: bold; font-size: 12px">Caso tenha alguma dúvida entre em contato pelo fale conosco ou pelo e-mail admin@opalaclubefranca.com.br.'."</td></tr>");

           echo ('<tr><td><br><a  href="javascript:history.go(-1)">OK</a></td></tr>')."\n";
       	}
   */    else {

   			 $confirma = sprintf("delete from usr_online where userid = %d",$row['userid']);
             $result = mysql_query($confirma)
                   or die ("Erro registrando conexão ".mysql_errono().','.mysql_error());

             $unixtime = (strtotime('NOW') + 3600);
   			 $confirma = sprintf("insert into usr_online (sessao,userid,datetime) values ('%s',%d,%s)",$_ID,$row['userid'],$unixtime);
             $result = mysql_query($confirma)
                   or die ("Erro registrando conexão ".mysql_errono().','.mysql_error());

              $_SESSION['logado'] = "SIM";
              $_SESSION['userid'] = $row['userid'];
              $_SESSION['niveluser'] = $row['nivel'];
              $_SESSION['username'] = $row['username'];
	          $_SESSION['email'] = $row['email'];
			  $_SESSION['registro'] = 'SIM'; // Registra a identificação do acesso
			  $_SESSION['aprovado'] = $row['aprovado']; // Registra a identificação do acesso
              setcookie("OpalaUserid",$row['userid'],time()+60*60*24*360);
              setcookie("LoginOpala",md5("LITTLEBOY-LOGADO".$row['userid'].trim($row['email'])),time()+60*60*24*360);

              Usuario::LogUsuario($row['userid'],'FORM','SIM');

              echo "<script> window.location = 'index.php'; </script>"; 

           }
//       mysql_close($link);

?>
 </table>
 
<?php include ("rodape.php"); ?>
