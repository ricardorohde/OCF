<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Reenvia E-mail de Confirmação</span>
      
 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

       include ('conectadb.php');
     
       $consulta = sprintf("select username,senha,userid,email from cad_usuario where userid = %d",$_SESSION['userid']);
       $result = mysql_query($consulta)
                   or die ("Erro registrando conexão ".mysql_errono().','.mysql_error());

	   $row = mysql_fetch_assoc($result);

       enviaemail($row['username'], $row['email'],1);

       echo ("<tr><td>E-mail reenviado com sucesso !! </td></tr:")."\n";
       echo ("<tr><td><br></td></tr>")."\n";
       echo ("<tr><td><br></td></tr>")."\n";
       echo ('<tr><td><a href="index.php">OK</a></td></tr>')."\n";

?>
 </table>

<?php	
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

       mysql_free_result($result);

   if ($funcao == 1)
       $reenvia = "Reenvio";
   else
       $reenvia = " ";
       
   $subject = "Confirmação de cadastro no Opala Clube Franca";
   $msg = "Você está recebendo esse e-mail para confirmação do seu cadastro no Opala Clube de Franca, após essa confirmação você terá acesso à todo conteúdo do site e passará a fazer parte desse clube."
        ."<br><br><a href=http://".$_SERVER['HTTP_HOST']."/prc_confusr.php?usr=".trim($userid)."&id=".trim(md5($username)).trim(md5($email)).">Clique aquí para confirmar o cadastro</a>"
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
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
