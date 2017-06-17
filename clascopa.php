<?php include("sessao.php"); ?>

    <table bordercolor="white" class="dettab" border="1px" cellspacing=0 frame="box" rules="all">
        <tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);'><td colspan=10 align=center><b>Copa Telê Santana</td></tr>                	

<?php

   include 'conectadb.php';

   $sql = sprintf("select gc.campeonato,grupo,username,gc.userid,gc.pontos,
					jogos,vitorias,gp,gc,gc.posicao,(gp - gc) sg,classificado
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
			            echo ("<tr><td colspan=10><br></td></tr>\n");                	
                	$pos = 0;
                	$grpant =  $row['grupo'];
                    echo ("<tr  class='cabec'><td colspan=10>Grupo ".$row['grupo']."</td></tr>\n");                	
                    echo ("<tr  class='cabec'><td align=center>Pos</td><td>Participante</td><td align=center>Pts</td><td align=center>&nbspJ&nbsp</td><td align=center>&nbspV&nbsp</td><td align=center>GP</td><td align=center>GC</td><td align=center>SG</td></tr>\n");                	
                }
             	if ($posant != $row['posicao'])
					$posant = $pos = $row['posicao'];
				else
					$pos = " ";
                 $js = sprintf("javascript:janela('lst_detalhe.php?camp=%d&usr=%d&org=1',50,50,660,500);",$row['campeonato'],$row['userid']);
                 $lu = '<a href="'.$js.'">'.$row['username'].'</a>';

/*                if ($row['classificado'] == 'S')
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
