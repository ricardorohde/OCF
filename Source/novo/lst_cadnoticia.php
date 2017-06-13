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
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadnoticia.php?noticia=0">Inclur Nova Notícia</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>
      <tr>
	 <td>
		<br>
         </td>
      </tr>


<?php 

	include ('conectadb.php');

   $sql = sprintf("select codigo,titulo,username,datahora " .
   		"from " .
   		"cad_noticias n, " .
   		"cad_usuario u " .
   		"where " .
   		"n.userid = u.userid " .
   		"order by " .
   		"n.datahora desc ");

		$result = mysql_query($sql)
		or die('\nErro consultando notícias: ' . mysql_error()); 

       $campant = 0;
       echo ('         <tr class="cabec" align=left> <td align=center>Data/Hora</td> <td>Título</td><td>Por</td></tr>')."\n";
       if (mysql_num_rows($result) == 0) {
      	   echo("<tr ><td colspan=7>Nenhuma notícia cadastrada.</td></tr>");
       }
		while ($row = mysql_fetch_assoc($result)) {
		       if ($fllin == 0) {
		           $fllin = 1;
		           echo ('        <tr class="rel1"'.'>');
		          }
		       else
		          {
		           $fllin = 0;
		           echo ('        <tr class="rel2"'.'>');
		        }  
		
		       $dh = sprintf('<a href="frm_cadnoticia.php?noticia=%s">%s %s</a>',$row['codigo'],
					date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])));
		
		       $tit = sprintf('<a href="frm_cadnoticia.php?noticia=%s">%s</a>',$row['codigo'],$row['titulo']);

		       $por = sprintf('<a href="frm_cadnoticia.php?noticia=%s">%s</a>',$row['codigo'],$row['username']);
		
		       $linha = sprintf ('<td align="center">%s</td> <td>%s</td><td>%s</td>', $dh,$tit,$por);
		
		       echo ($linha.'</tr>')."\n";
		}

	  echo("<tr><td><br></td></tr>");

	mysql_free_result($result);
	mysql_close($link);


?>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadnoticia.php?noticia=0">Inclur Nova Notícia</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
