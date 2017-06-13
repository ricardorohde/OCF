<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadnoticia.php">Cadastro de Notícias</a>
      </span>
     
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadnoticia.php" name="CadNoticia">
  <table id="tabform"   border="0" cellspacing="0" width="440px">


<?php

    $cod = $_GET['noticia'];
    $tit = "";
    $noticia = "";

        echo ('      <tr> <td> <input type="hidden" name="codigo" value="'.$cod.'"> </td> </tr>')."\n"; 


        if ($cod != 0) {
			include ('conectadb.php');
		
		   $sql = sprintf("select codigo,titulo,noticia " .
		   		"from " .
		   		"cad_noticias " .
		   		"where " .
		   		"codigo = %d "
		   		,$cod);
		
			$result = mysql_query($sql)
					or die('\nErro consultando inscrições: ' . mysql_error()); 
			$row = mysql_fetch_assoc($result);
			$tit = $row['titulo'];
			$noticia = $row['noticia'];
			mysql_free_result($result);
			mysql_close($link);
        }


?>
			<pre>
	        <tr> <td><b>Título</b></td></tr>
            <tr> <td> <input size="65" maxlength="45" tabindex="1" name="titulo" value="<?php echo($tit); ?>"></td> </tr> 
			
            <tr> <td><b>Notícia </td> </tr>

		<tr><td>
		    <textarea tabindex="2" maxlength="1024" name="noticia" rows=10 cols=50><?php echo($noticia); ?></textarea>
	    </td> </tr>
   			</pre>

        <?php
        	if ($cod == 0) 
        		include("botincluir.php"); 
			else
        		include("botaltexc.php"); 
        ?>

  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
