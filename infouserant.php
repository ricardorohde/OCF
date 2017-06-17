<!-- Informações do usuário -->

    <div id="round">
				<span class="rtop">
						<span class="r1"></span>
						<span class="r2"></span>
		  			<span class="r3"></span>
					  <span class="r4"></span>
				</span>

  <table class="frm_login" margin="0" cellpadding="1px" cellspacing="0">
  <?php
       echo ("<tr><td>Seja bem-vindo:<br><span style='font-weight:bold;'>".$_SESSION['username']."</td></tr>")."\n";

	   echo ('<tr> <td>')."\n";
	   echo ('<hr style="height: 1px; width: 100%;" align="left">')."\n";
	   echo ('</td></tr>')."\n";

	   include 'conectadb.php';

	   $sql = sprintf("select c.codigo codcamp, c.descricao,c.ano,i.posicao,(i.pontos+i.bonus+i.bonusrecrod) pts
					from cad_inscricao i,
					cad_campeonato c,
					(select campeonato,datediff(max(data),curdate()) dif
					    from
					      cad_rodada
					      where rodada = 3
					        group by campeonato) r
					where
					i.campeonato = c.codigo
					and r.campeonato = i.campeonato
					and (i.flpago = 'S' or (i.flpago = 'N' and r.dif >=0)) 
					and i.userid = %d
					order by ano desc"
					,$_SESSION['userid']);

	     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

         $flag = 0;
         while ($row = mysql_fetch_assoc($result)) {
    /*             if ($flag == 0) {
			         echo ("<tr><td>Sua participação:</td></tr>")."\n";
                     $flag = 1;
                 } */
		         echo ("<tr><td>".$row['descricao']."-".$row['ano']."</td></tr>")."\n";
		         echo ("<tr><td align=right><a style='color:yellow;' href='lst_detalhe.php?camp=".$row['codcamp']."&usr=".$_SESSION['userid']."'>Posição:".$row['posicao']."  Pontos:".$row['pts']."</a></td></tr>")."\n";
			     echo ('<tr> <td>')."\n";
				 echo ('<hr style="height: 1px; width: 100%;" align="left">')."\n";
	 			 echo ('</td></tr>')."\n";
         }

	     mysql_free_result($result);
    	 mysql_close($link);

         echo('<tr><td><a href="frm_altusuario.php">»Alterar meus dados</a> </td></tr>')."\n";
         echo('<tr><td><a href="prc_logout.php">»Sair </a> </td></tr>')."\n";

   ?>
  </table>

		<span class="rbottom">
			<span class="r4"></span>
			<span class="r3"></span>
			<span class="r2"></span>
			<span class="r1"></span>
		</span>
	</div>
