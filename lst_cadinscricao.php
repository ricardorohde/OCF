<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Inscreva-se no bolão</span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
<?php 

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');

        $sql = sprintf(
		"Select codigo,descricao,ano,valorinscr valor,tipo
		from
		cad_campeonato
		where flandamento = 'S'
		and codigo not in
		(select campeonato from cad_inscricao
                        where userid = %d)
		order by ano,descricao", $_SESSION['userid']);

		$result = mysql_query($sql)
		or die('\nErro consultando banco de dados: ' . mysql_error()); 

        if (mysql_num_rows($result) == 0) {
		    echo ('         <tr> <td colspan=2>Não existe campeonatos com inscrições abertas no momento ou você já está inscrito nos campeonatos em andamento.</td> </tr>')."\n";
        	echo ('         <tr> <td><br></td> </tr>')."\n";
        }
        else {        	
		        $fllin = 0;

			    echo ('         <tr> <td><br></td> </tr>')."\n";

		        echo ('         <tr class="cabec"> <td>Campeonato</td> </tr>')."\n";
		
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
		
		               $descr = sprintf('<a href="frm_cadinscricao.php?camp=%s">%s-%s</a>',$row['codigo'],
							$row['descricao'],$row['ano']);
		
		
			           $linha = sprintf ('<td>%s</td>', $descr);
		
		               echo ($linha.'</tr>')."\n";
				}

			    echo ('         <tr> <td><br></td> </tr>')."\n";
			    echo ('         <tr> <td colspan=2>Clique no link do campeonato que deseja se inscrever</td></tr>')."\n";
			    echo ('         <tr> <td><br></td> </tr>')."\n";

   }    
	mysql_free_result($result);
	mysql_close($link);


?>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
