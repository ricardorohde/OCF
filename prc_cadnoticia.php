<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadnoticia.php">Cadastro de Notícias</a>
      </span>
     
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 


     $cod = $_POST['codigo'];
     $tit = $_POST['titulo'];
     $noticia = $_POST['noticia'];

     include 'conectadb.php';

       if ($_POST['Excluir'] == 'Excluir')
               exclui($cod);
       else
               grava($cod,$tit,$noticia);

	mysql_close($link);
 
 
?>

</table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
 

<?php 
function exclui($cod) {

    $sql = sprintf("delete from cad_noticias where codigo = %d", $cod);

    $result = mysql_query($sql)
	    		or die('\nErro excluindo notícia: ' . mysql_error()); 

    echo '<tr><td><br></td></tr>'."\n";
    echo "<tr><td>Notícia excluida com sucesso !</td></tr>\n";
    echo '<tr><td><br></td></tr>'."\n";
    echo '<tr><td><br></td></tr>'."\n";
    echo '<tr><td><a href="lst_cadnoticia.php">OK</a></td></tr>'."\n";
               
	
} 

function grava($cod,$tit,$noticia) {

     $temerro = 0;

     if (empty($tit)) {
  		 echo ("<tr><td>Informe o título da notícia  </td></tr>")."\n";
   	     $temerro = 1;
   	  }
     if (empty($noticia)) {
  		 echo ("<tr><td>Informe o texto da notícia  </td></tr>")."\n";
   	     $temerro = 1;
   	  }


      if ($temerro == 1)
            include ("volta.php");
      else {
		
			   if ($cod != 0) {  // Se já está cadastrado altera
				   $sql = sprintf("update cad_noticias " .
				   		"set titulo = '%s', " .
				   		"noticia = '%s' " .
				   		"where " .
				   		"codigo = %d",$tit,$noticia,$cod);

			   	   $result = mysql_query($sql)
			 				or die('\nErro alterando notícia: ' . mysql_error()); 
				   }
               else {
				   $sql = sprintf("insert into cad_noticias (titulo, noticia,userid,datahora) " .
				   		"values('%s','%s',%d,'%s')",$tit,$noticia,$_SESSION['userid'],date("Y/m/d H:i"));
			   	   $result = mysql_query($sql)
			 				or die('\nErro incluindo notícias: ' . mysql_error()); 
 
               }   

    echo '<tr><td><br></td></tr>'."\n";
    echo "<tr><td>Notícia gravada com sucesso !</td></tr>\n";
    echo '<tr><td><br></td></tr>'."\n";
    echo '<tr><td><br></td></tr>'."\n";
    echo '<tr><td><a href="lst_cadnoticia.php">OK</a></td></tr>'."\n";
               
               
      }
	
}

?>
 