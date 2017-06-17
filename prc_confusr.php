<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Confirmação de Cadastro</span>
      
 <?php include("traco.php"); ?>

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
        
       if ($id != $md) {
           echo ("<tr><td>Identificação de usuário inválida, confirmação não efetivada </td></tr:")."\n";
           echo '<tr><td><br></td></tr>'."\n";
           echo '<tr><td><br></td></tr>'."\n";
           echo '<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>'."\n";
        }
       else {
             $confirma = sprintf("update cad_usuario set recmail = 'S' where userid = %d",$userid);
             $result = mysql_query($confirma)
                   or die ("Erro confirmando e-mail ".mysql_errono().','.mysql_error());

             echo "<tr><td><b>".$username."</b></td></tr>\n";
             echo '<tr><td><br></td></tr>'."\n";
             echo "<tr><td>Seu e-mail foi confirmado com sucesso !</td></tr>\n";
             echo '<tr><td><br></td></tr>'."\n";
             echo "<tr><td>Acompanhe as datas e locais de reunião para que possa iniciar sua participação no Opala Clube Franca. Se tiver alguma dúvida entre em contato pelo fale conosco ou pelo e-mail admin@opalaclubefranca.com.br. <td></tr>\n";
             echo '<tr><td><br></td></tr>'."\n";
	           echo "<tr><td>Obrigado !!!</td></tr>\n";
             echo '<tr><td><br></td></tr>'."\n";
	           echo "<tr><td>www.opalaclubefranca.com.br</td></tr>\n";
             echo '<tr><td><br></td></tr>'."\n";
             echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
           }
       mysql_close($link);

?>
 </table>
 <?php include ("rodape.php"); ?>
