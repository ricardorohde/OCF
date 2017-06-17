<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadrodada.php">Cadastro de Rodadas</a> 
      </span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

   $camp = trim($_POST['camp']);
   $rod = trim($_POST['rodada']);
   $op = trim($_POST['op']);
   $qtj = trim($_POST['jogos']);
   $manda = array($qtj);
   $visita = array($qtj);
   $data = array($qtj);
   $hora = array($qtj);
   $grp = array($qtj);
   $ouro = array($qtj);

   $temerro = 0;
   if ($op == 'I' && jaexiste($camp,$rod)) {
    	echo ("<tr><td>Essa rodada já está cadastrada </td></tr>")."\n";
		$temerro = 1;
        }
   if ($rod == 0) {
    	echo ("<tr><td>Informe o número da rodada </td></tr>")."\n";
		$temerro = 1;
        }


   for ($x=0,$j=0; $x < $qtj;$x++) {
        $j++;
        $nj = sprintf("%02d",$j); 
   		$manda[$x] = $_POST['M'.$nj];	
   		$visita[$x] = $_POST['V'.$nj];
   		$data[$x] = $_POST['ANO'.$nj].'/'.$_POST['MES'.$nj].'/'.$_POST['DIA'.$nj];
   		$hora[$x] = $_POST['HH'.$nj].':'.$_POST['MM'.$nj];
   		$hh = $_POST['HH'.$nj];
   		$mm = $_POST['MM'.$nj];
   		$grp[$x] = $_POST['GRP'.$nj];
		
	   if (trim($_POST['OU'.$nj]) == "S")
		   $ouro[$x] = "S";
	   else
		   $ouro[$x] = "N";

        if ($manda[$x] == 0 && $visita[$x] != 0) {
			echo ("<tr><td>Informe o mandante do jogo ".$j."</td></tr>")."\n";
			$temerro = 1;
        }
        if ($manda[$x] != 0 && $visita[$x] == 0) {
			echo ("<tr><td>Informe o visitante do jogo ".$j."</td></tr>")."\n";
			$temerro = 1;
        }
        if ($manda[$x] != 0) {
        	if (!checkdate($_POST['MES'.$nj],$_POST['DIA'.$nj],$_POST['ANO'.$nj])) { 
			    echo ("<tr><td>Data do jogo ".$j." inválida !</td></tr>")."\n";
			    $temerro = 1;
                }
	        if ($hh == 0 && $mm == 0) {
				echo ("<tr><td>Informe a hora do jogo ".$j."</td></tr>")."\n";
				$temerro = 1;
        		}
	        if ($hh > 23 || $mm > 59) {
				echo ("<tr><td>Hora do jogo ".$j." inválida !</td></tr>")."\n";
				$temerro = 1;
        		}
        }
        if ($manda[$x] != 0) {
            $ja = array_search($manda[$x],$manda);
        	if ($ja != $x) {
				echo ("<tr><td>Mandante do jogo ".$j." já é mandante do jogo ".($ja+1)."</td></tr>")."\n";
				$temerro = 1;
        	}
	        $ja = array_search($manda[$x],$visita);
    	    if (!($ja === FALSE)) {
				echo ("<tr><td>Mandante do jogo ".$j." já é visitante do jogo ".($ja+1)."</td></tr>")."\n";
				$temerro = 1;
        	}
        }
        if ($visita[$x] != 0) {
        	$ja = array_search($visita[$x],$visita);
        	if ($ja != $x) {
				echo ("<tr><td>visitante do jogo ".$j." já é visitante do jogo ".($ja+1)."</td></tr>")."\n";
				$temerro = 1;
        	}
	        $ja = array_search($visita[$x],$manda);
        	if (!($ja === FALSE)) {
				echo ("<tr><td>Visitante do jogo ".$j." já é mandante do jogo ".($ja+1)."</td></tr>")."\n";
				$temerro = 1;
        	}
        }
        	
   }

   if ($temerro == 1) {
            include ("volta.php");
      }   
   else 
   if ($op == 'I')
       inclui($camp,$rod,$manda,$visita,$data,$hora,$grp,$ouro);
   else
   if ($op == 'A')
       if ($_POST['Excluir'] == 'Excluir')
          exclui($camp,$rod);
       else
          altera($camp,$rod,$manda,$visita,$data,$hora,$grp,$ouro);



?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
function jaexiste($camp, $rod) {

       include 'conectadb.php';
     
       $consulta = sprintf("select * from cad_rodada where campeonato = '%s' and rodada = '%s'",$camp,$rod);
       $result = mysql_query($consulta);
       
       if (mysql_num_rows($result) == 0)
           $jc = false;
       else
           $jc = true;
           
       mysql_free_result($result);
       mysql_close($link);

   	   return $jc;
	
}
   
function  inclui($camp,$rod,$manda,$visita,$data,$hora,$grp,$ouro) {

         include 'conectadb.php';

     $j = count($manda);

     for ($x = 0; $x < $j;$x++) {
           $sql = sprintf("insert into cad_rodada (campeonato,rodada,jogo,manda,visita,data,hora,grupo,golsma,golsvi,flouro)" .
           		" values(%d,%d,%d,%d,%d,'%s','%s','%s',null,null,'%s')",$camp,$rod,$x+1,$manda[$x],$visita[$x],$data[$x],$hora[$x],$grp[$x],$ouro[$x]);

         $result = mysql_query($sql)
	 				or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

     }

    $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

    $result = mysql_query($sql)
   		or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 

    $row = mysql_fetch_assoc($result);

    $descricao = $row['descricao'];
    $ano = $row['ano'];

     echo '<tr><td>Campeonato: '.$descricao.'-'.$ano.'</td></tr>'."\n";
	 echo '<tr><td>Rodada: '.$rod.'</td></tr>'."\n";
	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Incluída com sucesso !</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
   	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><a href="lst_cadrodada.php">OK</a></td></tr>'."\n";

     mysql_free_result($result);
     mysql_close($link);


}
function  altera($camp,$rod,$manda,$visita,$data,$hora,$grp,$ouro) {

    include 'conectadb.php';

     $j = count($manda);

     for ($x = 0; $x < $j;$x++) {
           $sql = sprintf("update cad_rodada " .
           		"set manda = %d," .
           		"visita = %d," .
           		"data = '%s'," .
           		"hora = '%s'," .
           		"grupo = '%s', " .
           		"flouro = '%s' " .
           		"where campeonato = %d " .
           		"and rodada = %d " .
           		"and jogo = %d "
           		,$manda[$x],$visita[$x],$data[$x],$hora[$x],$grp[$x],$ouro[$x],$camp,$rod,$x+1);
         
         $result = mysql_query($sql)
	 				or die('\nErro gravando registro no banco de dados: ' . mysql_error()); 

     }

    $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

    $result = mysql_query($sql)
   		or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 

    $row = mysql_fetch_assoc($result);

    $descricao = $row['descricao'];
    $ano = $row['ano'];

     echo '<tr><td>Campeonato: '.$descricao.'-'.$ano.'</td></tr>'."\n";
	 echo '<tr><td>Rodada: '.$rod.'</td></tr>'."\n";
	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Alterada com sucesso !</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
   	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><a href="lst_cadrodada.php">OK</a></td></tr>'."\n";

     mysql_free_result($result);
     mysql_close($link);


}

function  exclui($camp,$rod) {

         include 'conectadb.php';

        $sql = sprintf("delete from cad_rodada " .
           		"where campeonato = %d " .
           		"and rodada = %d"
           		,$camp,$rod);

         $result = mysql_query($sql)
	 				or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

    $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

    $result = mysql_query($sql)
   		or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 

    $row = mysql_fetch_assoc($result);

    $descricao = $row['descricao'];
    $ano = $row['ano'];

     echo '<tr><td>Campeonato: '.$descricao.'-'.$ano.'</td></tr>'."\n";
	 echo '<tr><td>Rodada: '.$rod.'</td></tr>'."\n";
	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Excluída com sucesso !</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
   	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><a href="lst_cadrodada.php">OK</a></td></tr>'."\n";

     mysql_free_result($result);
     mysql_close($link);
}


?>
