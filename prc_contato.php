<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Fale Conosco</span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
	require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
	include('envmail.php');


	$regex = '^'.
				'[-a-z0-9!#$%&\'*+/=?^_<{|}~]+'.          // One or more underscore, alphanumeric, or allowed characters.
				'(\.[-a-zA-Z0-9!#$%&\'*+/=?^_<{|}~]+)*'.  // Followed by zero or more sets consisting of a period
                                         					// of one or more underscore, alphanumeric, or allowed characters.
				'@'.     		                              // Followed by an "at" character.
				'[a-z0-9-]+'.                             // Followed by one or more alphanumeric or hyphen characters.
				'(\.[a-z0-9-]{2,})+'.                     // Followed by one or more sets consisting a period of two
        					                                // or more alphanumeric or hyphen characters.
				'$';

     $dest = $_POST['destino'];
     $nome = $_POST['nome'];
     $email = trim($_POST['email']);
     $assunto = $_POST['assunto'];
     $mensagem = $_POST['mensagem'];
     $temerro = 0;

     if (empty($nome)) {
  		 echo ("<tr><td>Informe o seu nome !  </td></tr>")."\n";
   	     $temerro = 1;
   	  }

     if (empty($email)) {
  		 echo ("<tr><td>Informe o seu e-mail </td></tr>")."\n";
   	     $temerro = 1;
   	  }
	 if (!eregi($regex, $email)) {
  		 echo ("<tr><td>Seu e-mail não é válido </td></tr>")."\n";
   	   $temerro = 1;
   	  }
     if (empty($assunto)) {
  		 echo ("<tr><td>Informe o assunto da mensagem </td></tr>")."\n";
   	     $temerro = 1;
   	  }
     if (empty($mensagem)) {
  		 echo ("<tr><td>Informe o texto da mensagem </td></tr>")."\n";
   	     $temerro = 1;
   	  }

      if ($temerro == 1)
            include ("volta.php");
      else {

		 	
 			   $sql = sprintf("insert into tb_msgcontato (destinatario,nome,email,assunto,mensagem,datahora,userid)
			   values('%s','%s','%s','%s','%s',now(),%d)",$dest,$nome,$email,$assunto,$mensagem,$_SESSION['userid']);
			   
			   $db = new BD();
			   
			   $db->Exec($sql);
			   
			   $db->Close();
			   	
		       include 'conectadb.php';
 
			   $sql = sprintf("select emailadm,emailwbm from cad_param ");
		
			   $result = mysql_query($sql)
			 				or die('\nErro consultando parâmetros: ' . mysql_error()); 

			   $row = mysql_fetch_assoc($result);

               if ($dest == "adm")
				   $to = $row['emailadm'];
 				else
				   $to = $row['emailwbm'];

               $mensagem .= "<br><br><br><br>"."Mensagem enviada por: ".$nome."<br>"."E-mail: ".$email;
			   envmail($to,$assunto,$mensagem,"admin@opalaclubefranca.com.br","Contato Opala Clube");
	                   
	         echo "<tr><td>Mensagem enviada com sucesso !</td></tr>\n";
	         echo '<tr><td><br></td></tr>'."\n";
	         echo '<tr><td><br></td></tr>'."\n";
	         echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
			mysql_free_result($result);
			mysql_close($link);			        
      }


?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
