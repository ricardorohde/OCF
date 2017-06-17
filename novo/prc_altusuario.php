<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Alteração de Cadastro</span>
      
 <?php include("traco.php"); ?>

<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario_cpg.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.forum.php"); ?>

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

   $userid = trim($_SESSION['userid']);
   $senhaatual = trim($_POST['senhaatual']);
   $novasenha = trim($_POST['novasenha']);
   $confsenha = trim($_POST['confsenha']);
   $nome = trim($_POST['nomecompleto']);
   $email = trim($_POST['email']);
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

   include 'conectadb.php';
     
   $sql = sprintf("select senha,username,ifnull(idcpg,0),ifnull(idforum,0) from cad_usuario where userid = %d",$userid);
   $result = mysql_query($sql)
								or die('\nErro validando senha: ' . mysql_error()); 
   $row = mysql_fetch_assoc($result);

	 $username = $row['username'];
	 $idcpg = $row['idcpg'];
	 $idforum = $row['idforum'];
 
   $temerro = 0;
   if (empty($senhaatual)) {
  		 echo ("<tr><td>Senha atual não informada </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (md5($senhaatual) <> $row['senha']) {
  		 echo ("<tr><td>Senha atual incorreta </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (empty($novasenha)) {
  		 echo ("<tr><td>Nova senha não informada </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
      if (strlen($novasenha) < 5) {	  
  		 echo ("<tr><td>Senha deve conter no mínimo 5 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if ($novasenha <> $confsenha) {
  		 echo ("<tr><td>Confirmação de senha diferente da nova senha </td></tr>")."\n";
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
  		 echo ("<tr><td colspan=2>E-mail não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
	 if (!eregi($regex, $email)) {
  		 echo ("<tr><td colspan=2>E-mail invalido  </td></tr>")."\n";
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

   if ($temerro == 1) {
            include ("volta.php");
      }
   else {

	   	 $UsrCpg = new Usuario_CPG($idcpg);
   	     $UsrCpg->setPassWord(md5($novasenha));
   	     $UsrCpg->setUserEmail($email);
   	     $UsrCpg->setUserProfile1($cidade.'/'.$estado);
   	     $UsrCpg->setUserProfile5($descricao);

   	     if ($UsrCpg->Existe() == 'S')
   	     		{ $UsrCpg->Grava(); };

	    $Forum = new Forum($idforum);
		$Forum->setPassWD($novasenha);
		$Forum->setEmailAddress($email);
		$Forum->setLocation($cidade.'/'.$estado);
   	     
   	     if ($Forum->Existe() == 'S')
   	     		{ $Forum->Grava(); };
   	     		
   	     mysql_free_result($result);
        
         $sql = sprintf("update cad_usuario 
                          set senha = '%s',
                          nome = '%s',
                          email = '%s',
                          cidade = '%s',
                          estado = '%s',
                          ddd = %d,
                          fone = %d,
                          dddcel = %d,
                          celular = %d,
                          anopala = %d,
                          possuiopala = '%s',
                          descricao = '%s',
                          flpublica = '%s'
                          where userid = %d",
			           md5($novasenha),$nome,$email,$cidade,$estado,$ddd,$fone,$dddcel,$celular,$anopala,$possui,$descricao,$publica,$userid);

         include 'conectadb.php';

       	 $result = mysql_query($sql)
	 		             or die('\nErro alterando registro no banco de dados: ' . mysql_error()); 

//   	     enviaemail($userid, $email, $username);

         mysql_close($link);

         echo "<tr><td>Seu cadastro foi alterado com sucesso !</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
/*				 echo "<tr><td>Vocé receberá um e-mail com seus dados e um link de confirmação do seu e-mail, seu acesso estará disponível somente após essa confirmação.</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
				 echo "<tr><td>Obrigado !!!</td></tr>\n"; */
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";

      }
?>
 </table>
<?php include ("rodape.php"); ?>


<?php

	function enviaemail($userid, $email, $username) {

	include('envmail.php');

   $subject = "Confirmação de cadastro no Opala Clube Franca";
   $msg = "Você está recebendo esse e-mail para confirmação das alterações no seu cadastro no Opala Clube Franca, após essa confirmação o seu acesso será reativado.<br>"
        ."<br><br><a href=http://".$_SERVER['HTTP_HOST']."/prc_confusr.php?usr=".trim($userid)."&id=".trim(md5($username)).trim(md5($email)).">Clique aquí para confirmar o cadastro</a>"
        ."<br><br>Usuário: ".$username."<br>E-mail: ".$email
        ."<br><br><br>Opala Clube Franca";

   $consulta = sprintf("select emailadm from cad_param");

   $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());
 
   $row = mysql_fetch_assoc($result);
   $from = $row['emailadm'];
   envmail($email,$subject,$msg,$from);
} 

?>
