<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Palpite Registrado</span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

   $camp = trim($_POST['camp']);
   $rod = trim($_POST['rodada']);
   $usr = trim($_POST['usr']);
   $qtj = trim($_POST['jogos']);
   $golsma = array($qtj);
   $golsvi = array($qtj);

   $temerro = 0;

   for ($x=0,$j=0; $x < $qtj;$x++) {
        $j++;
        $nj = sprintf("%02d",$j); 
   		$golsma[$x] = $_POST['M'.$nj];	
   		$golsvi[$x] = $_POST['V'.$nj];

   }

   gravagols($camp,$rod,$golsma,$golsvi,$usr);

?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
   
function  gravagols($camp,$rod,$golsma,$golsvi,$usr) {

     include 'conectadb.php';

     $j = count($golsma);

     for ($x = 0; $x < $j;$x++) {
           $sql = sprintf("select count(*) qtde from cad_palpite " .
           		"where campeonato = %d " .
           		"and rodada = %d " .
           		"and jogo = %d ".
           		"and userid = %d "
           		,$camp,$rod,$x+1,$usr);

           $result = mysql_query($sql)
	 				or die('\nErro consultando registro no banco de dados: ' . mysql_error()); 

		   $row = mysql_fetch_assoc($result);
           if ($row['qtde'] == 0) {   //Se não existe palpite cadastrado, insere
	           $sql = sprintf("insert into cad_palpite " .
    		       		"(campeonato,userid,rodada,jogo,pmanda,pvisita) " .
    		       		"values(%d,%d,%d,%d,%d,%d) "
		           		,$camp,$usr,$rod,$x+1,$golsma[$x],$golsvi[$x]);
           }
           else {
		          $sql = sprintf("update cad_palpite " .
           			"set pmanda = %d, " .
           			"pvisita = %d " .
           			"where campeonato = %d " .
           			"and rodada = %d " .
           			"and jogo = %d ".
           			"and userid = %d "
           		,$golsma[$x],$golsvi[$x],$camp,$rod,$x+1,$usr);
           }
		 mysql_free_result($result);
         $result = mysql_query($sql)
	 				or die('\nErro gravando registro no banco de dados: ' . mysql_error()); 
		 mysql_free_result($result);

     }

    $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

    $result = mysql_query($sql)
   		or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 

    $row = mysql_fetch_assoc($result);

    $descricao = $row['descricao'];
    $ano = $row['ano'];

//     echo '<tr><td>usr='.$usr.'<br></td></tr>'."\n";

     $rodada = sprintf("%02d",$rod);
     echo '<tr><td>Campeonato: <b><span style="color:blue;">'.$descricao.'-'.$ano.'</span></td></tr>'."\n";
	 echo '<tr><td>Rodada: <b><span style="color:blue;">'.$rodada.'</span></td></tr>'."\n";
	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Seu palpite para essa rodada foi registrado com sucesso !</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Esse palpite ainda pode ser alterado com até 1 hora antes do início da rodada.</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
   	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><a href="lst_palpadm.php?usr='.$usr.'">OK</a></td></tr>'."\n";

     mysql_free_result($result);
     mysql_close($link);

}

?>
