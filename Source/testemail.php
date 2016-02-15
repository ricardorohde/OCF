<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Fale Conosco</span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
	include('envmail.php');


     $dest = "adm";
     $nome = "Teste";
     $email = "alencar.mendes@yahoo.com.br";
     $assunto = "Teste de Email";
     $mensagem = "Testando o envio de e-mail pelo google";
     $temerro = 0;


     $to = "admin@opalaclubefranca.com.br";

               $mensagem .= "<br><br><br><br>"."Mensagem enviada por: ".$nome."<br>"."E-mail: ".$email;
			   envmail($to,$assunto,$mensagem,"admin@opalaclubefranca.com.br","Contato Opala Clube");
	                   
	         echo "<tr><td>Mensagem enviada com sucesso !</td></tr>\n";
	         echo '<tr><td><br></td></tr>'."\n";
	         echo '<tr><td><br></td></tr>'."\n";
	         echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
      


?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
