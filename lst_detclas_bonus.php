<?php include("sessao.php"); ?>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Bolao.net">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Bol�o dos campeonatos de futebol">
  <META NAME="keywords" CONTENT="Bol�o, bol�o do alex,brasileir�o,copa bol�o">
  <META HTTP-EQUIV="refresh" CONTENT="120">

  <title>Classifica��o do Bol�o - http://bolao.sytes.net</title>
  <link rel="stylesheet" type="text/css" media="screen" href="estilos.css" />

 </head>

<body class="padrao">
	<span class="titusr">Classifica��o do Bol�o</span>
     <?php include("traco.php"); ?>
	<div style="width:430px;border:solid 1px #a0b0b0;background:#fff;">

<table id="menuadm" cellspacing="0" cellpadding="0" width="430px" style="width:430px;">
  <tr> <td>
      <table width="430px" bordercolor="white" class='dettab' border="1px" cellspacing=0 frame="box" rules="all">

<?php

   include 'conectadb.php';

   $sql = sprintf("select i.campeonato,i.userid,u.username,i.posicao,i.posefetiva,i.bonusrecrod, " .
   		"i.pontos+i.bonus total," .
   		"i.qtde1," .
   		"i.qtde2," .
   		"i.qtde3," .
   		"i.qtde4," .
   		"i.qtde5," .
   		"i.qtdb1," .
   		"i.qtdb2," .
   		"i.qtdb3," .
   		"i.qtdb4," .
   		"i.qtdb5," .
   		"i.flag1," .
   		"i.flag2," .
   		"i.flag3," .
   		"i.flag4," .
   		"i.flag5," .
   		"i.bonus " .
   		"from " .
   		"cad_inscricao i, " .
   		"cad_usuario u, " .
   		"cad_campeonato c " .
   		"where " .
   		"i.campeonato = c.codigo " .
   		"and i.userid = u.userid " .
   		"and c.flandamento = 'S' " .
   		"order by " .
   		"c.ano desc," .
   		"i.campeonato," .
   		"i.posefetiva");

	     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

         $camp = 0;
         $posant = 0;
         $pos = 0;
        if (mysql_num_rows($result) == 0) {
        	echo ('         <tr> <td>N�o existe campeonatos cadastrados ou em andamento no momento.<br></td> </tr>')."\n";
        }
        else {        	
		         while ($row = mysql_fetch_assoc($result)) {
		                if ($camp <> $row['campeonato']) {
		                	if ($camp != 0) 
			                    echo ("<tr><td colspan=4><br></td></tr>\n");                	
		                	$pos = 0;
							$sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$row['campeonato']);
		     			     $rs = mysql_query($sql)
			 						or die('\nErro consultando classificacao: ' . mysql_error()); 
		                	$rc = mysql_fetch_assoc($rs);
		                    echo ("<tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);'><td colspan=10 align=center><b>".$rc['descricao']."-".$rc['ano']."</td></tr>\n");                	
		                    echo ("<tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);'><td colspan=3 align=center><b>Classifica��o do Bol�o</td><td colspan=10 align=center><b>Posi��o nas Rodadas</td></tr>\n");                	
						    mysql_free_result($rs);
						    $camp = $row['campeonato'];
		                    echo ("<tr  class='cabec'><td align=center>Pos</td><td>Participante</td><td align=center>Pontos</td><td align=center>1�</td><td align=center>2�</td><td align=center>3�</td><td align=center>4�</td><td align=center>5�</td><td align=center>B�nus</td></tr>\n");                	
		                }
		             	if ($posant != $row['posicao']) {
							$pos = $row['posefetiva'];
							$posant = $row['posicao'];
		             	}
						else
							$pos = " ";

    	                 $lu = '<a href="lst_detalhe.php?camp='.$row['campeonato'].'&usr='.$row['userid'].'&org=0">'.$row['username'].'</a>';

		                if ($_SESSION['logado'] == "SIM" && $_SESSION['userid'] == $row['userid'])
							$stl =   "style='background:rgb(204, 255, 255);'";
						else
							$stl =   " ";

	    			    if ($row['bonusrecrod'] > 0)
	    			    	$obs = " (*)";
	    			    else
	    			    	$obs = " ";
	    			    	
	    			    if ($row['flag1'] == 'S') 
	    			    	$acr1 = '<acronym title="'.$row['qtdb1'].' vezes 1� equivale a b�nus de '.$row['bonus'].' pontos">';
	    			    else
	    			        $acr1 = " ";
	    			    if ($row['flag2'] == 'S') 
	    			    	$acr2 = '<acronym title="'.($row['qtde2']-$row['qtdb2']).' vezes 2� equivale a '.(($row['qtde2']-$row['qtdb2']) / 2).' 1�">';
	    			    else
	    			        $acr2 = " ";
	    			    if ($row['flag3'] == 'S') 
	    			    	$acr3 = '<acronym title="'.($row['qtde3']-$row['qtdb3']).' vezes 3� equivale a '.(($row['qtde3']-$row['qtdb3']) / 2).' 2�">';
	    			    else
	    			        $acr3 = " ";
	    			    if ($row['flag4'] == 'S') 
	    			    	$acr4 = '<acronym title="'.($row['qtde4']-$row['qtdb4']).' vezes 4� equivale a '.(($row['qtde4']-$row['qtdb4']) / 2).' 3�">';
	    			    else
	    			        $acr4 = " ";
	    			    if ($row['flag5'] == 'S') 
	    			    	$acr4 = '<acronym title="'.($row['qtde5']-$row['qtdb5']).' vezes 5� equivale a '.(($row['qtde5']-$row['qtdb5']) / 2).' 4�">';
	    			    else
	    			        $acr4 = " ";
	    			    	
						$linha = "<tr ".$stl.">".
							"<td align=center>".$pos."</td>".
							"<td>".$lu.$obs."</td>".
							"<td align=center style='background:rgb(255, 194, 133);'><b>".$row['total']."</b></td>".
							"<td align=center style='".(($row['flag1'] == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr1.(($row['qtdb1'] == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $row['qtdb1'])."</td>".
							"<td align=center style='".(($row['flag2'] == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr2.(($row['qtdb2'] == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $row['qtdb2'])."</td>".
							"<td align=center style='".(($row['flag3'] == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr3.(($row['qtdb3'] == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $row['qtdb3'])."</td>".
							"<td align=center style='".(($row['flag4'] == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr4.(($row['qtdb4'] == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $row['qtdb4'])."</td>".
							"<td align=center style='".(($row['flag5'] == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr5.(($row['qtdb5'] == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $row['qtdb5'])."</td>".
							"<td align=center class='dettab'>".(($row['bonus'] == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $row['bonus'])."</td>".
							"</tr>\n";
 		                echo ($linha);                	

		         }
				echo("<tr><td colspan=10><br></td></tr>")."\n";
		        echo("<tr><td colspan=10 rowspan=2>(*) Recordista de pontos em uma rodada direito a b�nus de 12 pontos no final do campeonato.</td></tr>")."\n"; 
        }
			
     mysql_free_result($result);
     mysql_close($link);
?>
	</table>
  	</td>
  	</tr>
</div>
</body>  	