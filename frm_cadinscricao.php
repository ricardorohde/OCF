<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Inscreva-se no bolão</span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <table id="menuadm" border="0" cellspacing="0">

	<?php
     $camp = $_GET['camp'];
 
	 echo ("     <tr>")."\n";
     campeonato($camp);
	 echo ("     </tr>")."\n";

 ?>
  
</table>

<?php

function campeonato($camp) {

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

     include ('conectadb.php');
     $sql = sprintf("Select c.codigo codigo,c.descricao descricao,c.ano ano,c.valorinscr valor,c.tipo tipo
		from
		cad_campeonato c
		where
		c.codigo = %d
		order by c.ano,c.descricao", $camp);

	 $result = mysql_query($sql)
			or die('\nErro consultando banco de dados: ' . mysql_error()); 
     
	 $row = mysql_fetch_assoc($result);
	 
     echo ('<tr> <td><br></td></tr>')."\n";
     echo ('<tr> <td><b>'.$row['descricao'].'-'.$row['ano'].'</b></td></tr>')."\n";
     echo ('<tr> <td><br></td></tr>')."\n";
     echo ('<tr> <td><br></td></tr>')."\n";
     echo ('<tr> <td>Valor da Inscrição <b>R$ '.number_format($row['valor'],2,",",".").'</b></td></tr>')."\n";

     echo ('<tr> <td><br></td></tr>')."\n";

     echo ('<tr><td><a href="prc_cadinscricao.php?camp='.$camp.'">Clique aquí para confirmar a inscrição</a></td></tr>')."\n";

     echo ('<tr> <td><br></td></tr>')."\n";

     mysql_free_result($result);
   	 mysql_close($link);
}



?>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
