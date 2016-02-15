<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Novo Membro do Clube</span>
      
 <?php include("traco.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

	$regex = '^'.
				'[-a-z0-9!#$%&\'*+/=?^_<{|}~]+'.          // One or more underscore, alphanumeric, or allowed characters.
				'(\.[-a-zA-Z0-9!#$%&\'*+/=?^_<{|}~]+)*'.  // Followed by zero or more sets consisting of a period
                                         					// of one or more underscore, alphanumeric, or allowed characters.
				'@'.     		                              // Followed by an "at" character.
				'[a-z0-9-]+'.                             // Followed by one or more alphanumeric or hyphen characters.
				'(\.[a-z0-9-]{2,})+'.                     // Followed by one or more sets consisting a period of two
        					                                // or more alphanumeric or hyphen characters.
				'$';

   $cad= 'abcdefghijklmonpqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789_-@%$#';
   $username = trim($_POST['username']);
   $senha = trim($_POST['senha']);
   $confsenha = trim($_POST['confsenha']);
   $nome = trim($_POST['nomecompleto']);
   $email = trim($_POST['email']);
   $endereco = trim($_POST['endereco']);
   $numero = trim($_POST['numero']);
   $cep1 = trim($_POST['cep1']);
   $cep2 = trim($_POST['cep2']);
   $cidade = trim($_POST['cidade']);
   $estado = trim($_POST['estado']);
   $ddd = trim($_POST['DDD']);
   $fone = trim($_POST['fone']);
   $dddcel = trim($_POST['DDDCEL']);
   $celular = trim($_POST['celular']);

   if (trim($_POST['possui']) == "SIM")
       $possui = "S";
   else
       $possui = "N";

   $anopala = trim($_POST['anopala']);
   $descricao = trim($_POST['descricao']);

   if (trim($_POST['publica']) == "S")
       $publica = "S";
   else
       $publica = "N";

   if (trim($_POST['recados']) == "S")
       $recmail = "S";
   else
       $recmail = "N";

   if (trim($_POST['aceite']) == "S")
       $aceite = "S";
   else
       $aceite = "N";

   $temerro = 0;   
   if (empty($username)) {
  		 echo ("<tr><td>Usuário não informado </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (strspn($username,$cad) != strlen($username)) {
  		 echo ("<tr><td>Usuário Inválido, caracteres permitidos:A-Z 0-9 _-@%$#</td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (strlen($username) < 3) {	  
  		 echo ("<tr><td>Usuário deve conter no mínimo 3 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (is_numeric($username)) {	  
  		 echo ("<tr><td>Usuário deve conter letras </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($senha)) {
  		 echo ("<tr><td>Senha não informada </td></tr>")."\n";
   	   $temerro = 1;
   	  } 
   else
      if (strlen($senha) < 5) {	  
  		 echo ("<tr><td>Senha deve conter no mínimo 5 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if ($senha <> $confsenha) {
  		 echo ("<tr><td>Senha não confirmada  </td></tr>")."\n";
   	   $temerro = 1;
   	  } 
   if (empty($nome)) {
  		 echo ("<tr><td>Nome completo não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  } 
   else	  
   if (strlen($nome) < 6) {	  
  		 echo ("<tr><td>Nome completo deve conter no mínimo 6 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (is_numeric($nome)) {	  
  		 echo ("<tr><td>Nome completo deve conter letras </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($email)) {
  		 echo ("<tr><td>E-mail não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
	 if (!eregi($regex, $email)) {
  		 echo ("<tr><td>E-mail invalido  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($cidade)) {
  		 echo ("<tr><td>Cidade não informada  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (is_numeric($nome)) {
  		 echo ("<tr><td>Nome completo deve conter letras </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($estado)) {
  		 echo ("<tr><td>Estado não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (empty($endereco)) {
  		 echo ("<tr><td>Endereço não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (empty($numero)  && !is_numeric($numero)) {
  		 echo ("<tr><td>Informe o número do endereço corretamente  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (!empty($ddd) && !is_numeric($ddd)) {
  		 echo ("<tr><td>DDD inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (!empty($fone) && !is_numeric($fone)) {
  		 echo ("<tr><td>Telefone inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (!empty($dddcel) && !is_numeric($dddcel)) {
  		 echo ("<tr><td>DDD do Celular inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (!empty($celular) && !is_numeric($celular)) {
  		 echo ("<tr><td>Celular inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if ($aceite <> "S") {
  		 echo ("<tr><td>Para efetuar o pré-cadastro é necessário que vc concorde com o estatudo e regras de inscrição. </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if ($possui == "S" && $anopala == 0)  {
  		 echo ("<tr><td>Informe o ano do seu opala </td></tr>")."\n";
   	   $temerro = 1;
		}

   if ($possui == "S" && empty($descricao))  {
  		 echo ("<tr><td>Descreva seu opala </td></tr>")."\n";
   	   $temerro = 1;
		}

   if (jaexiste($username, $email)) {
  		 echo ("<tr><td>Nome de usuário já está em uso, tente outro usuário </td></tr>")."\n";
   	   $temerro = 1;
		}

   if ($temerro == 1) {
            include ("volta.php");
      }
   else {
         $insere = sprintf("insert into cad_usuario(username,senha,nome,email,cidade,estado,ddd,fone,dddcel,celular,flpublica,nivel,dtcadastro,possuiopala,descricao,anopala,recmail,endereco,numero,cep)
                     values ('%s', '%s','%s','%s','%s','%s',%d,%d,%d,%d,'%s','0','%s','%s','%s',%d,'%s','%s','%d','%d')",
			        $username,md5($senha),$nome,$email,$cidade,$estado,$ddd,$fone,$dddcel,$celular,$publica,date("Y-m-d H-i-s"),$possui,$descricao,$anopala,$recmail,$endereco,$numero,($cep1 * 1000 + $cep2));

         inclui($insere);
   	     enviaemail($username, $email,0);

         echo "<tr><td>Seu pré-cadastro foi realizado com sucesso !</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";

		 echo "<tr><td>Na barra esquerda do site você se informa da data e local das reuniões. Caso tenha alguma dúvida entre em contato pelo fale conosco ou pelo e-mail admin@opalaclubefranca.com.br.</td></tr>\n";

     	 echo "<tr><td>Você receberá um e-mail com seus dados e um link de confirmação do seu e-mail, após essa confirmação seu pré-cadastro será confirmado.</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
				 echo "<tr><td>Obrigado !!!</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";

      }
?>
 </table>
 
<?php include ("rodape.php"); ?>


<?php
function jaexiste($username, $email) {

       include 'conectadb.php';
     
       $consulta = sprintf("select username,email from cad_usuario where username = '%s'",$username);
       $result = mysql_query($consulta);
       
       if (mysql_num_rows($result) == 0)
           $jc = false;
       else
           $jc = true;
           
       mysql_close($link);

   	   return $jc;
	
}
   
function inclui($insere) {

         include 'conectadb.php';

	 $result = mysql_query($insere)
	 		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

	       mysql_close($link);


}
	function enviaemail($username, $email, $funcao) {

	include('envmail.php');

         include ('conectadb.php');

         $consulta = sprintf("select userid from cad_usuario where username = '%s'",$username);

         $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());
                   
       if (mysql_num_rows($result) == 0)
           $userid = 999999;
       else {
             $row = mysql_fetch_assoc($result);
             $userid = $row['userid'];
            }

   if ($funcao == 1)
       $reenvia = "Reenvio";
   else
       $reenvia = " ";
       
   $subject = "Confirmação de dados Opala Clube Franca";
   $msg = "Você está recebendo esse e-mail para confirmação do seu e-mail no Opala Clube de Franca, após essa confirmação seu pré-cadastro será confirmado."
        ."<br><br><a href=http://".$_SERVER['HTTP_HOST']."/prc_confusr.php?usr=".trim($userid)."&id=".trim(md5($username)).trim(md5($email)).">Clique aquí para confirmar o e-mail</a>"
        ."<br><br>Usuário: ".$username."<br>E-mail: ".$email
        ."<br><br><br>Opala Clube Franca<br>www.opalaclubefranca.com.br";

 
   $consulta = sprintf("select emailadm from cad_param");

   $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());

   $row = mysql_fetch_assoc($result);

   $from = $row['emailadm'];

   envmail($email,$subject,$msg,$from);
          
   mysql_close($link);

}

?>
