<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_expalp.php">Exportação de Palpites</a>
      </span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

   $camp = trim($_GET['camp']);
   $rod = trim($_GET['rod']);

   $filename = sprintf ("palpites_rodada_%02d.txt",$rod);	

   if (!$fp = fopen($filename,"wb"))
	   echo ("<td><td>Erro criando arquivo de exportação</td></tr>");

   include 'conectadb.php';
     
   $sql = sprintf("select " .
   		"u.username, r.rodada, r.jogo, p.pmanda, p.pvisita " .
   		"from " .
   		"cad_rodada r, " .
   		"cad_inscricao i, " .
   		"cad_campeonato c, " .
   		"cad_usuario u " .
   		"left join " .
   		"cad_palpite p " .
   		"on " .
   		"i.userid = p.userid " .
   		"and i.campeonato = p.campeonato " .
   		"and r.rodada = p.rodada " .
   		"and r.jogo = p.jogo " .
   		"where " .
   		"i.campeonato = r.campeonato " .
   		"and i.userid = u.userid " .
   		"and i.campeonato = c.codigo " .
   		"and c.codigo = %d " .
   		"and r.rodada = %d " .
   		"order by u.username, r.rodada, r.jogo",$camp,$rod);

		$result = mysql_query($sql)
 			or die('\nErro consultando rodada no banco de dados: ' . mysql_error()); 
/*
Usuario              Rodada  Jogo  Mandante  Visitante
123456789012345678901234501123401123459912345678999
*/
        $ln = "Usuario             ;Rodada ;Jogo ;Mandante ;Visitante\r\n";
		if (fwrite($fp,$ln) == 0)
			echo ("<td><td>Erro gravando arquivo de exportação</td></tr>");
		while ($row = mysql_fetch_assoc($result)) {
			 $ln = sprintf ("%-20s;    %02d;   %02d;    %02d;        %02d   \r\n"
			 ,$row['username'],$row['rodada'],$row['jogo'],$row['pmanda'],$row['pvisita']);
			if (fwrite($fp,$ln) == 0)
				echo ("<td><td>Erro gravando arquivo de exportação</td></tr>");
		}

	   fclose($fp);
       mysql_free_result($result);
       mysql_close($link);
       
	   echo ("<td><td><br></td></tr>");
	   echo ("<td><td>Para fazer o download do arquivo clique com o botão direito do mouse no link e selecione Salvar Destino Como.<br></td></tr>");
	   echo ("<td><td><br></td></tr>");
       $ln = sprintf ('<a href="'.$filename.'">Clique aqui para baixar o arquivo '.$filename.'</a>');
	   echo ("<td><td>".$ln."</td></tr>");
	   echo ("<td><td><br></td></tr>");
	   
?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
