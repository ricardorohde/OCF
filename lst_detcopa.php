<?php 
session_cache_limiter('nocache');
include("sessao.php"); 
?>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Bolao.net">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Bolão dos campeonatos de futebol">
  <META NAME="keywords" CONTENT="Bolão, bolão do alex,brasileirão,copa bolão">

  <title>Classificação do Bolão - http://bolao.sytes.net</title>
  <link rel="stylesheet" type="text/css" media="screen" href="estilos.css" />

 </head>

<body class="padrao">

	<span class="titusr">Classificação da Copa Telê Santana</span>
     <?php include("traco.php"); ?>
	<div style="width:430px;border:solid 1px #a0b0b0;background:#fff;">

<table id="menuadm" cellspacing="0" cellpadding="0" width="430px" style="width:430px;">
  <tr> <td>
      <table width="430px" bordercolor="white" class='dettab' border="1px" cellspacing=0 frame="box" rules="all">

<?php
   require_once($_SESSION['DOCROOT']."/classes/class.usuario.php");

   include 'conectadb.php';

   $sql = sprintf("select gc.campeonato,grupo,username,gc.userid,gc.pontos,
					jogos,vitorias,gp,gc,gc.posicao,(gp - gc) sg,derrotas,empates,classificado
							from
					cad_grupo_copa gc,
					cad_usuario u,
					cad_inscricao i,
					cad_campeonato c
						where
					gc.userid = u.userid
					and gc.userid = i.userid
					and gc.campeonato = i.campeonato
					and ifnull(gc.fase,0) = 0
					and c.codigo = i.campeonato
					and c.flandamento = 'S'
					order by
					campeonato,grupo,posicao,posefetiva,username");

	     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao da copa: ' . mysql_error()); 

         $grpant = "";
         $posant = 0;
         $pos = 0;
         while ($row = mysql_fetch_assoc($result)) {
                if ($grpant != $row['grupo']) {
                	if (!empty($grpant)) 
			            echo ("<tr bgcolor=white><td colspan=10><br></td></tr>\n");                	
                	$pos = 0;
                	$grpant =  $row['grupo'];
                    echo ("<tr  class='cabec'><td colspan=10>Grupo ".$row['grupo']."</td></tr>\n");                	
                    echo ("<tr  class='cabec'><td align=center>Pos</td><td>Participante</td><td align=center>Pts</td><td align=center>&nbspJ&nbsp</td><td align=center>&nbspV&nbsp</td><td align=center>&nbspD&nbsp</td><td align=center>&nbspE&nbsp</td><td align=center>GP</td><td align=center>GC</td><td align=center>SG</td></tr>\n");                	
                }
             	if ($posant != $row['posicao'])
					$posant = $pos = $row['posicao'];
				else
					$pos = " ";
                 $usr = new Usuario($row['userid']);
				 
                $lu = $usr->getLinkUsuario();

   /*             if ($row['classificado'] == 'S')
					$stl =   "style='background:#ffffa6;'";
                else*/
                if ($_SESSION['logado'] == "SIM" && $_SESSION['userid'] == $row['userid'])
					$stl =   "style='background:rgb(204, 255, 255);'";
				else
					$stl =   " ";
			    	
				$linha = "<tr ".$stl.">".
					"<td align=center>".$pos."</td>".
					"<td>".$lu."</td>".
					"<td align=center style='background:rgb(255, 194, 133);'><b>".$row['pontos']."</b></td>".
					"<td align=center>".$row['jogos']."</b></td>".
					"<td align=center>".$row['vitorias']."</b></td>".
					"<td align=center>".$row['derrotas']."</b></td>".
					"<td align=center>".$row['empates']."</b></td>".
					"<td align=center>".$row['gp']."</b></td>".
					"<td align=center>".$row['gc']."</b></td>".
					"<td align=center>".($row['gp'] - $row['gc'])."</b></td>".
					"</tr>\n";
                echo ($linha);                	

         }
		echo("<tr><td colspan=10><br></td></tr>")."\n";

     mysql_free_result($result);
     mysql_close($link);
?>
	</table>
  	</td>
  	</tr>
</table>
</div>
</body>  	