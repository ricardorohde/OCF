<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Confirmação de Cadastro</span>
      
 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 


   $userid = trim($_GET['usr']);
   $id = trim($_GET['id']);

       include ('conectadb.php');
     
       $consulta = sprintf("select username,email from cad_usuario where userid = %d",$userid);
       $result = mysql_query($consulta);
       $row = mysql_fetch_assoc($result);
       $username = $row['username'];
       $md = trim(md5($username)).trim(md5($row['email']));
        
       mysql_free_result($result);
       if ($id != $md) {
           echo ("<tr><td>Identificação de usuário inválida, confirmação não efetivada </td></tr:")."\n";
           echo '<tr><td><br></td></tr>'."\n";
           echo '<tr><td><br></td></tr>'."\n";
           echo '<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>'."\n";
        }
       else {
             $confirma = sprintf("update cad_usuario set flconfirma = 'S' where userid = %d",$userid);
             echo "<tr><td><b>".$confirma."</b></td></tr>\n";
             $result = mysql_query($confirma)
                   or die ("Erro confirmando e-mail ".mysql_errono().','.mysql_error());

             if (mysql_affected_rows() == 0) {
                 echo ("<tr><td>Erro na confirmação do cadastro entre em contato com o webmaster</td></tr>")."\n";
                 echo '<tr><td><br></td></tr>'."\n";
                 echo '<tr><td><br></td></tr>'."\n";
                 echo '<tr><td><a  href="index.php">Volta</a></td></tr>'."\n";
                }
             else {
                   echo "<tr><td><b>".$username."</b></td></tr>\n";
                   echo '<tr><td><br></td></tr>'."\n";
                   echo "<tr><td>Seu cadastro foi confirmado com sucesso !</td></tr>\n";
                   echo '<tr><td><br></td></tr>'."\n";
                   echo "<tr><td>Seja bem vindo ao Bolao.net !!!<td></tr>\n";
                   echo '<tr><td><br></td></tr>'."\n";
                   echo "<tr><td>A partir de agora você está com acesso livre ao site. Faça o login e divirta-se !<td></tr>\n";
                   echo '<tr><td><br></td></tr>'."\n";
	           echo "<tr><td>Obrigado !!!</td></tr>\n";
                   echo '<tr><td><br></td></tr>'."\n";
	           echo "<tr><td>Bolao.net</td></tr>\n";
                   echo '<tr><td><br></td></tr>'."\n";
                   echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
                 }
           }
       mysql_free_result($result);
       mysql_close($link);

?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
