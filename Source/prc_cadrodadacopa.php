<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("tophome.php"); ?>

  <table id="tabform"  border="0" cellspacing="0">

<?php

     include 'conectadb.php';

     $sql = sprintf("delete from cad_rodada_copa"); 

     $result = mysql_query($sql)
	 				or die('\nErro deletando rodadas: ' . mysql_error()); 

     $sql = sprintf("select g.campeonato,g.grupo,g.userid " . 
   		"from " .
   		"cad_grupo_copa g, " .
   		"cad_inscricao i " .
   		"where " .
        "g.campeonato = i.campeonato " .
        "and g.userid = i.userid ".
   		"order by " .
   		"grupo, posefetiva desc");

     $result = mysql_query($sql)
	 				or die('\nErro consultando grupos: ' . mysql_error()); 

    $gant = "";
    $usr = array();
     while ($row = mysql_fetch_assoc($result)) {
            if (empty($gant))
                $gant = $row['grupo'];

            if ($gant != $row['grupo']) { // Gera os jogos na quebra do grupo
            	montajogos($usr,$gant);
				$gant = $row['grupo'];
			    $usr = array();
            }

          echo("<tr><td>".$row['userid']."</td></tr>");

          array_push($usr,$row['userid']);

     }

     montajogos($usr,$gant);

     mysql_free_result($result);
  	 mysql_close($link);


function montajogos($usr,$grp) {

   $x = 0;
   $y = 0;
   $ma = array(); // Mandante no jogo
   $vi = array(); // Visitante no jogo
   $jr = array(array(0,15,32,33),	//Array com as combinações de partidas
   			  array(1,14,27,31), 	//com as 9 rodadas
   			  array(2,8,29,30),
   			  array(3,11,20,24),
   			  array(4,10,35,23),
   			  array(5,13,16,22),
   			  array(6,34,17,21),
   			  array(7,9,18,28),
   			  array(25,26,12,19));

   $t = count($usr);
   for ($x = 0;$x < $t; $x++ ) // Gera todas as combinações possíveis
     for ($y = $x+1;$y<$t;$y++) {
          array_push($ma,$usr[$x]);
          array_push($vi,$usr[$y]);
          echo("<tr><td> Grupo ".$grp." ".$usr[$x]." x ".$usr[$y]."</td></tr>");
	     }

   for ($x=0;$x<count($jr);$x++) {
	   echo("<tr><td>Rodada: ".($x + 1)."</td></tr>");
	   $j = 0;
       for ($y=0;$y<count($jr[$x]);$y++) {
			$j++;
            gravajogo($grp,($x+6),$ma[$jr[$x][$y]],$vi[$jr[$x][$y]]); 
       }
   }
}

function gravajogo($grp,$rod,$manda,$visita) {

       echo("<tr><td> ".$manda." x ".$visita."</td></tr>");

     $sql = sprintf("select ifnull(max(jogo),0) + 1 jogo
						from
						cad_rodada_copa
						where campeonato = %d
						and rodada = %d"
	     		,1,$rod);

     $result = mysql_query($sql)
	 				or die('\nErro consultando numero do jogo: ' . mysql_error()); 

	 $row = mysql_fetch_assoc($result);
	 $jogo = $row['jogo'];

     mysql_free_result($result);
	 	
     $sql = sprintf("insert into cad_rodada_copa " .
     		"(campeonato, rodada,jogo,tipo,userid,grupo) " .
     		"values(%d,%d,%d,'%s',%d,'%s')"
     		,1,$rod,$jogo,'M',$manda,$grp); 

     $result = mysql_query($sql)
	 				or die('\nErro incluindo jogo mandante: ' . mysql_error()); 

     $sql = sprintf("insert into cad_rodada_copa " .
     		"(campeonato, rodada,jogo,tipo,userid,grupo) " .
     		"values(%d,%d,%d,'%s',%d,'%s')"
     		,1,$rod,$jogo,'V',$visita,$grp); 

     $result = mysql_query($sql)
	 				or die('\nErro incluindo jogo visitante: ' . mysql_error()); 

}

function existe($rm,$rv,$ma,$vi) {

    	  if (!pesquisa($ma,$rm) && 
     	  	  !pesquisa($vi,$rm) && 
     	  	  !pesquisa($ma,$rv) &&
     	  	  !pesquisa($vi,$rv)) {
//		      echo("<tr><td> false</td></tr>"); 
     	  	  return false;
     	  	  }
     	  else	{  
	//	      echo("<tr><td> true</td></tr>"); 
     	  	  return true;
     	  }
}


function pesquisa($val,$v) {

	$x = 0;
	foreach ($v as $x) {
			$x++;
			if ($x == $val)
				return $x;
	}

	return false;

}
	
 ?>
  
  </table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
