<?php include("head.php"); ?>

 <span class="titusr">Nova Senha</span>
      
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

   $username = trim($_POST['username']);
   $email = trim($_POST['email']);
   
   $temerro = 0;   
   if (empty($username)) {
  		 echo ("<tr><td>Usuário não informado </td></tr>")."\n";
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

   if ($temerro == 1) {
            include ("volta.php");
      }
   else {

         $sql = sprintf("Select username,email from cad_usuario where username = '%s' and email = '%s'",
                          $username,$email);
                          
         include ('conectadb.php');

         $result = mysql_query($sql)
                   or die ("Erro consultando usuário ".mysql_errono().','.mysql_error());
                   
         if (mysql_num_rows($result) == 0) {
             echo "<tr><td>Usuario ou e-mail inválidos !</td></tr>\n";
             echo '<tr><td><br></td></tr>'."\n";
             include ("volta.php");
         	  }
         else {
               $novasenha = "b".date("YmdHis");
               $sql = sprintf("update cad_usuario set senha = '%s' where username = '%s'",
			            						md5($novasenha),$username);
			            						
               $result = mysql_query($sql)
                   or die ("Erro gerando nova senha ".mysql_errono().','.mysql_error());

         	     enviaemail($username, $email, $novasenha);
         	     
			         echo "<tr><td>Nova senha gerada com sucesso !</td></tr>\n";
         			 echo '<tr><td><br></td></tr>'."\n";
				 			 echo "<tr><td>Você receberá um e-mail com a nova senha, para sua segurança sugerimos que você altere a senha logo após o primero acesso.</td></tr>\n";
         			 echo '<tr><td><br></td></tr>'."\n";
         			 echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
            }

       mysql_close($link);
    }
?>
 </table>
 
<?php include ("rodape.php"); ?>


<?php
	function enviaemail($username, $email, $novasenha) {

	include('envmail.php');

   include ('conectadb.php');
       
   $subject = "Nova senha do Opala Clube Franca";
   $msg = "Você está recebendo uma nova senha do Opala Clube Franca conforme você solicitou.".
        "<br><br>Para sua segurança sugerimos que após o primeiro acesso você altere essa senha.<br><br>"
        ."Nova senha: ".$novasenha
        ."<br><br>Opala clube Franca"
        ."<br>www.opalaclubefranca.com.br";


   $consulta = sprintf("select emailadm from cad_param");

   $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());

   $row = mysql_fetch_assoc($result);

   $from = $row['emailadm'];

   envmail($email,$subject,$msg,$from);
}

?>
