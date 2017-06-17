<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Palpite Registrado</span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
   include ('chaverod.php');

   $camp = trim($_POST['camp']);
   $rod = trim($_POST['rodada']);
   $chv = trim($_POST['key']);
   $qtj = trim($_POST['jogos']);
   $golsma = array($qtj);
   $golsvi = array($qtj);
   $nrojg = array($qtj);
   
   $temerro = 0;

   for ($x=0,$j=0,$y=0; $x < $qtj;$x++) {
        $j++;
        $nj = sprintf("%02d",$j); 
        $teste = $_POST['M'.$nj];
        if ($teste != NULL) {
     		$golsma[$y] = $_POST['M'.$nj];	
    		$golsvi[$y] = $_POST['V'.$nj];
//                $ln = sprintf ("y:%d nj:%d ma:%d vi:%d",$y,$nj,$golsma[$y],$golsvi[$y]);
//                echo ("<tr><td>".$ln."</td></tr>");
		$nrojg[$y] = $nj;
		    $y++;
			}
         
   }

   if ($chv != chaverod($camp,$rod)) {
		 echo '<tr><td><br></td></tr>'."\n";
	     echo '<tr><td>Chave de alteração inválida</td></tr>'."\n";
	     echo '<tr><td><br></td></tr>'."\n";
		 echo "<tr><td>Seu palpite não foi confirmado !</td></tr>\n";
	     echo '<tr><td><br></td></tr>'."\n";
	   	 echo '<tr><td><br></td></tr>'."\n";
	     echo '<tr><td><a href="lst_cadpalpite.php">OK</a></td></tr>'."\n";
   }
   else
	   gravagols($camp,$rod,$golsma,$golsvi,$nrojg);

?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
   
function  gravagols($camp,$rod,$golsma,$golsvi,$nrojg) {


  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

     include 'conectadb.php';

    if ($camp == 3) {
		$sql = sprintf("select subtime(min(addtime(data,hora)),'00:15:00') limite
						from cad_rodada
						where campeonato = %d and rodada = %d",$camp,$rod);
	
		$result = mysql_query($sql)
			or die('\nErro consultando limite palpite: ' . mysql_error()); 
	
		$row = mysql_fetch_assoc($result);
		 if ((strtotime('NOW') + 3600) > strtotime($row['limite']))
			  	return;
	}
        

    $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

    $result = mysql_query($sql)
   		or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 

    $row = mysql_fetch_assoc($result);

    $descricao = $row['descricao'];
    $ano = $row['ano'];

     $j = count($golsma);
     $tabela = '<table  border="1px" bordercolor="gray" cellspacing="0"  bgcolor=#FFFEE2>'."\n";
     $tabela .= sprintf ('<tr><td colspan=4><b>%s-%s</td><td align=center>Rodada:<b> %02d</td></tr>',$row['descricao'],$row['ano'],$rod)."\n";
     $tabela .= '<tr bgcolor=#D6FFD7 style="background:#D6FFD7;font-weight:bold;" ><td align=center>Jogo</td><td align=right>Mandante</td><td align=center> x </td><td>Visitante</td><td>Data/Hora</td>'."\n";
     for ($x = 0; $x < $j;$x++) {

           $sql = sprintf("select subtime(addtime(data,hora),'00:15:00') limite 
		   					from cad_rodada " .
           		"where campeonato = %d " .
           		"and rodada = %d " .
           		"and jogo = %d "
           		,$camp,$rod,$nrojg[$x]);

           $result = mysql_query($sql)
	 				or die('\nErro consultando registro no banco de dados: ' . mysql_error()); 
		   $row = mysql_fetch_assoc($result);

		 if ((strtotime('NOW') + 3600) > strtotime($row['limite']))
			  	continue;

           $sql = sprintf("select count(*) qtde from cad_palpite " .
           		"where campeonato = %d " .
           		"and rodada = %d " .
           		"and jogo = %d ".
           		"and userid = %d "
           		,$camp,$rod,$nrojg[$x],$_SESSION['userid']);

           $result = mysql_query($sql)
	 				or die('\nErro consultando registro no banco de dados: ' . mysql_error()); 

		   $row = mysql_fetch_assoc($result);
           if ($row['qtde'] == 0) {   //Se não existe palpite cadastrado, insere
	           $sql = sprintf("insert into cad_palpite " .
    		       		"(campeonato,userid,rodada,jogo,pmanda,pvisita,data,hora,useridcad) " .
    		       		"values(%d,%d,%d,%d,%d,%d,date(date_add(now(),interval 1 hour)),subtime(curtime(),'01:00:00'),%d) "
		           		,$camp,$_SESSION['userid'],$rod,$nrojg[$x],$golsma[$x],$golsvi[$x],$_SESSION['userid']);
           }
           else {
		          $sql = sprintf("update cad_palpite " .
           			"set pmanda = %d, " .
           			"pvisita = %d, " .
           			"data = date(date_add(now(),interval 1 hour)), ".
           			"hora = subtime(curtime(),'01:00:00'), ".
           			"useridcad = %d ".
           			"where campeonato = %d " .
           			"and rodada = %d " .
           			"and jogo = %d ".
           			"and userid = %d "
           		,$golsma[$x],$golsvi[$x],$_SESSION['userid'],$camp,$rod,$nrojg[$x],$_SESSION['userid']);
           }
		   
		   
		 mysql_free_result($result);
         $result = mysql_query($sql)
	 				or die('\nErro gravando registro no banco de dados: ' . mysql_error()); 

         $sql = sprintf("select tm.nome ma,tv.nome vi,r.data,r.hora " .
         		"from " .
         		"cad_times tv," .
         		"cad_times tm," .
         		"cad_rodada r " .
         		"where " .
         		"r.campeonato = %d " .
         		"and r.rodada = %d " .
         		"and r.jogo = %d " .
         		"and tm.codigo = r.manda " .
         		"and tv.codigo = r.visita " .
         		"order by r.campeonato,r.rodada,r.jogo"
				,$camp,$rod,$nrojg[$x]);
         $result = mysql_query($sql)
	 				or die('\nErro consulta rodada no banco de dados: ' . mysql_error()); 
	     $row = mysql_fetch_assoc($result);
         $tabela .= sprintf('<tr>' .
         		'<td align=center>%s</td>' . //Jogo
         		'<td align=right>%s</td>' . //Mandante
         		'<td align=center><b>%s x %s</td>' . //Resultado
         		'<td>%s</td>' . //Visitante
         		'<td>%s %s <i>%s</td></tr>'
         		,$nrojg[$x],$row['ma'],$golsma[$x],$golsvi[$x],$row['vi'],date("d/m/Y",strtotime($row['data'])),date("H:i",strtotime($row['hora'])),$dw[date("w",strtotime($row['data']))])
         		."\n";
		 mysql_free_result($result);

     }
     $tabela .= "</table>\n";
//     echo ($tabela);
     
     enviaemail($rod,$tabela);
     
     $rodada = sprintf("%02d",$rod);
     echo '<tr><td>Campeonato: <b><span style="color:blue;">'.$descricao.'-'.$ano.'</span></td></tr>'."\n";
	 echo '<tr><td>Rodada: <b><span style="color:blue;">'.$rodada.'</span></td></tr>'."\n";
	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Seu palpite para essa rodada foi registrado com sucesso !</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
	 if ($camp != 4)
     	 echo "<tr><td>Esse palpite ainda pode ser alterado com até 15 minutos antes do início de cada partida.</td></tr>\n";

     echo '<tr><td><br></td></tr>'."\n";
   	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><a href="lst_cadpalpite.php">OK</a></td></tr>'."\n";

     mysql_close($link);

}

function enviaemail($rod,$tabela) {

   include('envmail.php');

   $subject = sprintf ("Palpite Rodada %02d",$rod);
   $msg = sprintf ("%s, seu palpite para a Rodada %02d foi registrado com sucesso.<br>",$_SESSION['username'],$rod);
   $msg .= "<br><br>".$tabela
        ."<br><br>Boa Sorte !!!!"
        ."<br><br><br>www.bolaodoalex.com<br><br><br>";

   $consulta = sprintf("select emailadm from cad_param");

   $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());
 
   $row = mysql_fetch_assoc($result);
   $from = $row['emailadm'];

   envmail($_SESSION['email'],$subject,$msg,$from);
     
}
?>
