<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadpagto.php">Confirma Pagamento</a>
      </span>
     
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
<?php 

	include ('conectadb.php');

        $sql = sprintf(
		"select c.codigo,c.descricao,c.ano,c.valorinscr,u.userid,u.username,flpago,datainscricao
			from
			cad_inscricao i,
			cad_campeonato c,
			cad_usuario u
			where
			i.campeonato = c.codigo
			and i.userid = u.userid
			and i.campeonato > 1
			order by c.codigo,username");

		$result = mysql_query($sql)
		or die('\nErro consultando inscrições: ' . mysql_error()); 

       $campant = 0;
       if (mysql_num_rows($result) == 0) {
           echo ('         <tr class="cabec"> <td>Usuário</td> <td align="center">Data de Inscrição</td> <td>Status</td> <td></td> </tr>')."\n";
      	   echo("<tr><td colspan=7>Nenhum usuário inscrito em campeonatos até o momento.</td></tr>");
       }
		while ($row = mysql_fetch_assoc($result)) {
               if ($campant != $row['codigo']) {
              	   $campant = $row['codigo'];
              	   echo("<tr><td><br></td></tr>");
                   $lc = sprintf ("<tr><td style='text-decoration: underline;font-size:11px;' colspan=2><b>Campeonato: %s-%s</td><td style='font-size:11px;'>Valor: %s</td></tr>"
                           ,$row['descricao'],$row['ano'],number_format($row['valorinscr'],2,",","."));  
              	   echo ($lc)."\n";
//		           echo ('<tr><td colspan=2> <table id="menuadm" bordercolor="white" border="1px" cellspacing="0">')."\n"; 
                   echo ('         <tr class="cabec"> <td>Usuário</td> <td align="center">Data de Inscrição</td> <td>Status</td> <td></td> </tr>')."\n";
               }

               if ($row['flpago'] == 'S') {
			       $func = sprintf('<a style="color:red;" href="prc_cadpagto.php?camp=%s&usr=%s&op=C">Cancelar Pagamento</a>',$campant,
						$row['userid']);
                   $st = "<span style='color:blue;'>Confirmado</span>";
               }
				else {	
			       $func = sprintf('<a style="color:blue;" href="prc_cadpagto.php?camp=%s&usr=%s&op=I">Confirmar Pagamento</a>',$campant,
						$row['userid']);
                   $st = "<span style='color:red;'>Em aberto</span>";
				}
		       if ($fllin == 0) {
		           $fllin = 1;
		           echo ('        <tr class="rel1"'.'>');
		          }
		       else
		          {
		           $fllin = 0;
		           echo ('        <tr class="rel2"'.'>');
		        }  
		
		       $descr = sprintf('%s-%s</a>',$row['codigo'],
						$row['descricao'],$row['ano']);
		
		  /*     $dh = sprintf('<a href="frm_cadinscricao.php?camp=%s">%s %s <i>%s</i></a>',$row['codigo'],
    			date("d/m/Y",strtotime($row['data'])),date("H:i",strtotime($row['hora'])),$dw[date("w",strtotime($row['data']))]);*/
		
		       $linha = sprintf ('<td>%s</td> <td align="center">%s</td> <td>%s</td> <td>%s</td>', $row['username'],date("d/m/Y",strtotime($row['datainscricao'])),$st,$func);
		
		       echo ($linha.'</tr>')."\n";
		}

	  echo("<tr><td><br></td></tr>");

	mysql_free_result($result);
	mysql_close($link);


?>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
