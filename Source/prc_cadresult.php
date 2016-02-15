<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadresult.php">Cadastro de Resultados</a>
      </span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

   require_once($_SESSION['DOCROOT']."/classes/class.campeonato.php");
   require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
   
    
   $camp = trim($_POST['camp']);
   $rod = trim($_POST['rodada']);
   $qtj = trim($_POST['jogos']);
   $golsma = array($qtj);
   $golsvi = array($qtj);

   $db = new BD();
   $db2 = new BD();
   $db3 = new BD();
   
   $temerro = 0;


   for ($x=0,$j=0; $x < $qtj;$x++) {
        $j++;
        $nj = sprintf("%02d",$j); 
   		$golsma[$x] = trim($_POST['M'.$nj]);
   		$golsvi[$x] = trim($_POST['V'.$nj]);
//        $ln = sprintf("j=%d m=%d v=%d",$j,$golsma[$x],$golsvi[$x]);
//	 echo '<tr><td> '.$ln.'</td></tr>'."\n";
   }

   gravagols($camp,$rod,$golsma,$golsvi); // Grava gols da rodada e gols da copa
   clasatual($camp,$rod); // Apura classificação geral do bolão até a rodada informada
   if ($camp != 4)
	   bonifica($camp,$rod);	// Calcula bonus por recorde de rodada	
   classifica($camp); // Apura classificação geral do bolão
   clasatual($camp,$rod); // Apura classificação geral do bolão até a rodada informada
   clasrod($camp,$rod);	// Apura classificação da rodada
   if ($camp != 4) {
       pontoscopa($camp,$rod);	// Apura pontuação da copa bolão
	   totalcopa($camp,$rod);	// Totaliza pontuação da copa por grupos
	   clascopa($camp); //Processa classificação da copa
	   estatisticas($camp,$rod); //Grava informações para ranking
	}
/*   oitavas($camp,$rod); //Processa oitavas de final
   quartas($camp,$rod); //Processa quartas de final*/
   $db->Close();
   $db2->Close();
   $db3->Close();

?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
   
function  gravagols($camp,$rod,$golsma,$golsvi) {
  
     global $db, $db2;

     $j = count($golsma);
     $cmp = new Campeonato($camp);

     for ($x = 0; $x < $j;$x++) {
           if ($golsma[$x] != NULL || $golsvi[$x] !=NULL) { //Se informou algum resultado
           $sql = sprintf("update cad_rodada " .
           		"set golsma = %d, " .
           		"golsvi = %d " .
           		"where campeonato = %d " .
           		"and rodada = %d " .
           		"and jogo = %d "
           		,$golsma[$x],$golsvi[$x],$camp,$rod,$x+1);

	         $db->Exec($sql);

	         $sql = sprintf("select userid,p.campeonato,p.rodada,p.jogo,pmanda,pvisita,flouro " .
	         		"from cad_palpite p,
					 cad_rodada r  " .
	         		"where 
					 r.campeonato = p.campeonato 
					 and r.rodada = p.rodada 
					 and r.jogo = p.jogo " .
	         		"and p.campeonato = %d " .
	         		"and p.rodada = %d " .
	         		"and p.jogo = %d "
	           		,$camp,$rod,$x+1);

		     $db->Query($sql);

	         while ($row = $db->Fetch()) {
	         	    $pontos = 0;
					$gols = 0;
	                $psaldo = $row['pmanda'] - $row['pvisita'];
	         	    $pv = " ";
	         	    if ($row['pmanda'] > $row['pvisita']) 
	         	        $pv = "M";
	         	    else
	         	    if ($row['pmanda'] < $row['pvisita'])
	         	        $pv = "V";
	                else    	    
	         	        $pv = "E";
	
	                $rsaldo = $golsma[$x] - $golsvi[$x];
	         	    $rv = " ";
	         	    if ($golsma[$x] > $golsvi[$x])
	         	        $rv = "M";
	         	    else
	         	    if ($golsma[$x] < $golsvi[$x])
	         	        $rv = "V";
	                else    	    
	         	        $rv = "E";
	         	        
				    if ($rv != "E" && $rv == $pv) { // Teve um vencedor e o palpite acertou o vencedor
				    	if ($golsma[$x] == $row['pmanda'] && $golsvi[$x] == $row['pvisita']) {  // Se acertou o placar exato
							$pontos = 8;
							$gols = 2;
				    	}
						else {
							$gols = 1;
				 			if ($rsaldo == $psaldo)
								 $pontos = 5;  
					       	else			
								 $pontos = 3;
						}
						if ($rv == "V" && $camp != 4)
							$pontos += 2; //Bonificação de 2 pontos acertou vitória do visitante		 
				    }
				    else {
				    	if ($rv == "E" && $pv == "E") { // Se deu empate e o palpite é empate
					    	if ($golsma[$x] == $row['pmanda'] && $golsvi[$x] == $row['pvisita']) { // Se acertou o placar exato
								$pontos = 9;
								$gols = 2;
					    	}
							else {	
							    $pontos = 6;  
								$gols = 1;
							}
				    	}
	         		}

	                if ($pontos != 0 && $row['flouro'] == 'S')
						$pontos += 4;
                    if ($gols == 2 && ($golsma[$x] + $golsvi[$x]) > 4) //Se acertou em cheio com 5 ou mais gols vale 3 gols
					    $gols += 1;

	                $linha = sprintf("usr=%d rod=%d j=%d rm=%d rv=%d pm=%d pv=%d po=%d"
	                ,$row['userid'],$rod,$x,$golsma[$x],$golsvi[$x],$row['pmanda'],$row['pvisita'],$pontos);
	
				 //echo '<tr><td> '.$linha.'</td></tr>'."\n";
	
					// Grava a pontuação 
	                if ($camp == 3 && $rod > 1 && $rod != 26) // Se começou a copa no campeonato 3 grava os gols
						 $sql = sprintf("update cad_palpite " .
										"set pontos=%d, " .
       			         				"gols=%d " .
										"where " .
										"userid = %d " .
										"and campeonato = %d " .
										"and rodada = %d " .
										"and jogo = %d "
								,$pontos,$gols,$row['userid'],$camp,$rod,$x+1);
					 else					                        					
						 $sql = sprintf("update cad_palpite " .
										"set pontos=%d " .
										"where " .
										"userid = %d " .
										"and campeonato = %d " .
										"and rodada = %d " .
										"and jogo = %d "
								,$pontos,$row['userid'],$camp,$rod,$x+1);

				     $db2->Exec($sql);
	     			}
     	     $db->Free();
           }
     }
 
     echo '<tr><td>Campeonato: '.$cmp->getDescricaoAno().'</td></tr>'."\n";
	 echo '<tr><td>Rodada: '.$rod.'</td></tr>'."\n";
	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><br></td></tr>'."\n";
	 echo "<tr><td>Resultados gravados com sucesso !</td></tr>\n";
     echo '<tr><td><br></td></tr>'."\n";
   	 echo '<tr><td><br></td></tr>'."\n";
     echo '<tr><td><a href="lst_cadresult.php">OK</a></td></tr>'."\n";

}

function bonifica($camp,$rod) {
  global $db, $db2;


     $sql = sprintf("delete from tmp_class where useridpro = %d"
     ,$_SESSION['userid']);

    $db->Exec($sql);  // limpa a tabela temporaria

    $sql = sprintf("update cad_inscricao " .
     		"set bonus = 0, " .
     		"bonusrecrod = 0, " .
     		"titulosrod = 0, " .
     		"maiorpont = 0," .
     		"qtde1 = 0," .
     		"qtde2 = 0," .
     		"qtde3 = 0," .
     		"qtde4 = 0," .
     		"qtde5 = 0," .

     		"qtdb1 = 0," .
     		"qtdb2 = 0," .
     		"qtdb3 = 0," .
     		"qtdb4 = 0," .
     		"qtdb5 = 0," .

     		"flag1 = 'N'," .
     		"flag2 = 'N'," .
     		"flag3 = 'N'," .
     		"flag4 = 'N'," .
     		"flag5 = 'N' " .

     		"where campeonato = %d "
     		,$camp);

     $db->Exec($sql); // Limpa classificações para nova apuração

     $sql = sprintf("select userid,p.campeonato,p.rodada,sum(pontos) pt " .
     		"from " .
     		"cad_palpite p, " .
     		"cad_rodada r " .
     		"where p.campeonato = %d " .
     		"and r.campeonato = p.campeonato " .
     		"and r.rodada = p.rodada " .
     		"and r.jogo = p.jogo " .
     		"and (r.golsma is not null or r.golsvi is not null) " .
     		"group by userid,campeonato,rodada " .
     		"order by p.campeonato,p.rodada,pt desc",$camp);

    $db->Query($sql); // busca a classificacao por rodada

    $pos = 0;
    $pontoant = 0;
    $rodada = 0;
    $ptsrec = 0;  // Total de pontos do recorde de rodadas
    $userrec = 0; // Usuário que fez maior número de pontos
    $posef = 0; // Posição efetiva na rodada.
    while ($row = $db->Fetch()) {
    	    if ($rodada <> $row['rodada']) {
    	    	$rodada = $row['rodada'];
    	    	$pos = $posef = $pontoant = 0;
    	    }
    	    if ($row['pt'] > $ptsrec) { // Apura o recordista de pontos nas rodadas
    	    	$ptsrec = $row['pt'];
    	    	$userrec = $row['userid'];
    	    }
            $posef += 1; 
    	    if ($pontoant != $row['pt']) { // Apura a posição na rodada
    	        $pos = $posef;
    	        $pontoant = $row['pt'];
    	    }
            if ($pos <= 5) { 
	    	    $sql = sprintf ("insert into tmp_class " .
	    	    		" (useridpro,campeonato,rodada,posicao,userid,pontos,posefetiva) " .
	    	    		" values (%d,%d,%d,%d,%d,%d,%d)",$_SESSION['userid'],$row['campeonato'],$row['rodada'],$pos,$row['userid'],$row['pt'],$posef);
	
			    $db2->Exec($sql); // Insere na tabela temporaria para classificacao
            }
    }
    $db->Free();

    $sql = sprintf("select userid,posicao,count(*) qtde,max(pontos) pontos " .
     		"from tmp_class " .
     		"where useridpro = %d " .
     		"group by userid,posicao " .
     		"order by userid, posicao desc ",$_SESSION['userid']);

    $db->Query($sql); // busca a classificacao por rodada

    $p = array(0,0,0,0,0);
    $usr = 0;
    $titrod = 0;
    $bonusrec = 0;
    $ptsrod = 0;
    while ($row = $db->Fetch()) {
//          $lin = sprintf ("user:%d  x:%d  p:%d",$row['userid'],$row['posicao'],$row['qtde']);
//  		   echo '<tr><td> '.$lin.'</td></tr>'."\n";
		
           if ($usr == 0) {
//      		   echo '<tr><td> Zero: '.$lin.'</td></tr>'."\n";
               $usr = $row['userid'];
           	   $p[$row['posicao'] - 1] = $row['qtde'];
           }                
           else
           if ($usr == $row['userid']) {
           	    $p[$row['posicao'] - 1] = $row['qtde'];
//      		   echo '<tr><td> Carrega: '.$lin.'</td></tr>'."\n";
           }
           else {
                if ($userrec == $usr) // Bonus por maior pontuação numa rodada
                    $bonusrec = 12;
                else
                    $bonusrec = 0;
               
           		calcbonus($usr,$camp,$p,$titrod,$bonusrec,$ptsrod,$rod);

				$p[0] = $p[1] = $p[2] = $p[3] = $p[4] = 0;
	            $titrod = 0; 
	            $ptsrod = 0; 
	            $usr = $row['userid'];
	            $p[$row['posicao'] - 1] = $row['qtde'];
//	            $lin = sprintf ("user:%d  x:%d  p:%d",$row['userid'],$row['posicao'],$row['qtde']);
	// 			echo '<tr><td> Quebra</td></tr>'."\n";
	//    		echo '<tr><td> Carrega: '.$lin.'</td></tr>'."\n";
           }
          if ($row['posicao'] == 1) {
          	  $titrod = $row['qtde'];  //Armazena o número de títulos diretos de rodadas do usuário
          }
 		  if ($row['pontos'] > $ptsrod) {
 		  	  $ptsrod = $row['pontos'];           
 		  }     
    }
    if ($usr != 0) {
        if ($userrec == $usr)
            $bonusrec = 12;
        else
            $bonusrec = 0;

   		calcbonus($usr,$camp,$p,$titrod,$bonusrec,$ptsrod,$rod);
    }
       
//    $db->Free();

    $sql = sprintf("delete from tmp_class where useridpro = %d"
     ,$_SESSION['userid']);

    $db->Exec($sql);  // limpa a tabela temporaria

}

function calcbonus($usr,$camp,$p,$titrod,$bonusrec,$ptsrec,$rod)  {  //Calcula bonificação 
  global $db, $db2, $db3;


		$pef = $p;
 	    $flb = array('N','N','N','N','N');
   	    for ($x=4;$x>0;$x--) { // Considera rodadas de quinto ao segundo lugar 
//	           $lin = sprintf ("user:%d  x:%d  p:%d",$usr,($x+1),$p[$x]);
//   			   echo '<tr><td> Grava: '.$lin.'</td></tr>'."\n";
  			       $qt = $p[$x];
       				while ($p[$x] >= 2) {
       				       $p[$x] -= 2;
       				       $p[$x - 1] += 1;
       				       $flb[$x] = 'S';
       			}
           	}
//        $lin = sprintf ("user:%d  x:%d  p:%d",$usr,($x+1),$p[$x]);
//        echo '<tr><td> Grava: '.$lin.'</td></tr>'."\n";
   		$bonus = 0;
   		$pgua = $p[0];
   		while ($p[0] >= 2) {
   		       $p[0] -= 2;
   		       $bonus += 12;   // bonificação por 2 primeiros lugares em rodadas
   			   $flb[0] = 'S';	
   		}
        $p[0] = $pgua;
        
		$sql = sprintf("update cad_inscricao " .
     		"set bonus = %d, " .
     		"bonusrecrod = %d, " .
     		"titulosrod = %d, " .
     		"maiorpont = %d," .
     		"qtde1 = %d," .
     		"qtde2 = %d," .
     		"qtde3 = %d," .
     		"qtde4 = %d," .
     		"qtde5 = %d," .

     		"qtdb1 = %d," .
     		"qtdb2 = %d," .
     		"qtdb3 = %d," .
     		"qtdb4 = %d," .
     		"qtdb5 = %d," .

     		"flag1 = '%s'," .
     		"flag2 = '%s'," .
     		"flag3 = '%s'," .
     		"flag4 = '%s'," .
     		"flag5 = '%s' " .

     		"where userid = %d " .
     		"and campeonato = %d "
     		,$bonus,$bonusrec,$titrod,$ptsrec
     		,$pef[0],$pef[1],$pef[2],$pef[3],$pef[4]
     		,$p[0],$p[1],$p[2],$p[3],$p[4]
     		,$flb[0],$flb[1],$flb[2],$flb[3],$flb[4]
     		,$usr,$camp);

//         echo ("<tr><td>".$sql."</td></tr>");
    	$db3->Exec($sql); // grava bonus na cad_inscricao

		$sql = sprintf("update cad_posrodada " .
     		"set bonus = %d, " .
     		"bonusrecrod = %d, " .
     		"titulosrod = %d, " .
     		"maiorpont = %d," .
     		"qtde1 = %d," .
     		"qtde2 = %d," .
     		"qtde3 = %d," .
     		"qtde4 = %d," .
     		"qtde5 = %d," .

     		"qtdb1 = %d," .
     		"qtdb2 = %d," .
     		"qtdb3 = %d," .
     		"qtdb4 = %d," .
     		"qtdb5 = %d," .

     		"flag1 = '%s'," .
     		"flag2 = '%s'," .
     		"flag3 = '%s'," .
     		"flag4 = '%s'," .
     		"flag5 = '%s' " .

     		"where userid = %d " .
     		"and campeonato = %d ".
     		"and rodada = %d "
     		,$bonus,$bonusrec,$titrod,$ptsrec
     		,$pef[0],$pef[1],$pef[2],$pef[3],$pef[4]
     		,$p[0],$p[1],$p[2],$p[3],$p[4]
     		,$flb[0],$flb[1],$flb[2],$flb[3],$flb[4]
     		,$usr,$camp,$rod);

//       echo ("<tr><td>".$sql."</td></tr>");
    	$db3->Exec($sql); // grava bonus na cad_inscricao

}

function classifica($camp) {  //Apura classificação após registro de resultados

  global $db, $db2;

   $sql = sprintf("select i.campeonato,i.userid,u.username, " .
   		"ifnull(sum(p.pontos),0) pt, " .
   		"ifnull(sum(p.pontos)+i.bonus+i.bonusrecrod,0) total, " .
   		"ifnull(sum(p.pontos)+i.bonus,0) totalsb, " .
   		"max(i.bonusrecrod) bonusrecrod, " .
   		"i.titulosrod " .
   		"from " .
   		"cad_inscricao i, " .
   		"cad_usuario u, " .
   		"cad_campeonato c " .
   		"left join " .
   		"cad_palpite p " .
   		"on " .
   		"p.campeonato = i.campeonato " .
   		"and p.userid = i.userid " .
   		"where i.userid = u.userid " .
   		"and c.codigo = i.campeonato " .
   		"and c.codigo = %d " .
   		"group by i.campeonato,i.userid,u.username " .
   		"order by " .
   		"total desc, " .
   		"totalsb desc, " .
   		"pt desc, " .
   		"username "
//   		"titulosrod desc"
   		,$camp); //segundo critério número de títulos diretos de rodadas

	     $db->Query($sql);

         $pos = 0;
         $posef = 0;
         $pontoant = 0;
         while ($row = $db->Fetch()) {
				$posef += 1;
                if ($pontoant != $row['totalsb']) {
					$pontoant = $row['totalsb'];
                	$pos = $posef;
                }
				$sql = sprintf("update cad_inscricao " .
								"set pontos = %d, " .
								"posicao = %d," .
								"posefetiva = %d " .
								"where userid = %d " .
								"and campeonato = %d",$row['pt'],$pos,$posef,$row['userid'],$camp);

		        $db2->Exec($sql);
		
         }

    $db->Free();

}

function clasatual($camp,$rod) {  //Apura classificação após registro de resultados até a rodada informada
  global $db, $db2;


  $sql = sprintf ("delete from cad_posrodada where campeonato = %d and rodada =%d",$camp,$rod);

  $db->Exec($sql);

   $sql = sprintf("select i.campeonato,i.userid,u.username, " .
   		"ifnull(sum(p.pontos),0) pt, " .
   		"ifnull(sum(p.pontos)+i.bonus+i.bonusrecrod,0) total, " .
   		"ifnull(sum(p.pontos)+i.bonus,0) totalsb, " .
   		"max(i.bonusrecrod) bonusrecrod, " .
   		"i.titulosrod " .
   		"from " .
   		"cad_inscricao i, " .
   		"cad_usuario u, " .
   		"cad_campeonato c " .
   		"left join " .
   		"cad_palpite p " .
   		"on " .
   		"p.campeonato = i.campeonato " .
   		"and p.userid = i.userid " .
   		"and p.rodada <= %d " .
   		"where i.userid = u.userid " .
   		"and c.codigo = i.campeonato " .
   		"and c.codigo = %d " .
   		"group by i.campeonato,i.userid,u.username " .
   		"order by " .
//   		"total desc, " .
   		"totalsb desc, " .
   		"pt desc, " .
   		"username "
//   		"titulosrod desc"
   		,$rod,$camp); //segundo critério número de títulos diretos de rodadas

	     $db->Query($sql);

         $pos = 0;
         $posef = 0;
         $pontoant = 0;
         while ($row = $db->Fetch()) {
				$posef += 1;
                if ($pontoant != $row['totalsb']) {
					$pontoant = $row['totalsb'];
                	$pos = $posef;
                }
                $sql = sprintf("insert into cad_posrodada " .
                		"(campeonato,rodada,userid,pontos,posicao,posefetiva) ".
                		"values(%d,%d,%d,%d,%d,%d)"
                		,$camp,$rod,$row['userid'],$row['pt'],$pos,$posef);

		        $db2->Exec($sql);
		
         }

    $db->Free();
}


function clasrod($camp,$rod) {  //Apura classificação da rodada

  global $db, $db2;

	     $sql = sprintf("select p.userid,p.campeonato,p.rodada,sum(pontos) pt " .
	     		"from " .
	     		"cad_palpite p, " .
	     		"cad_rodada r, " .
	     		"cad_usuario u " .
	     		"where p.campeonato = %d " .
	     		"and r.rodada = %d " .
	     		"and p.userid = u.userid " .
	     		"and r.campeonato = p.campeonato " .
	     		"and r.rodada = p.rodada " .
	     		"and r.jogo = p.jogo " .
	     		"and (r.golsma is not null or r.golsvi is not null) " .
	     		"group by userid,campeonato,rodada " .
	     		"order by p.campeonato,p.rodada,pt desc,u.username",$camp,$rod);

	    $db->Query($sql); // busca a classificacao por rodada

        $pos = 0;
		$ptsant = 0;
        $posef = 0;
	    while ($row = $db->Fetch()) {
               $posef += 1;
               if ($ptsant != $row['pt']) {
               	   $pos = $posef;
               	   $ptsant = $row['pt'];
             		}
		       $sql = sprintf("select userid " .
			     		"from " .
			     		"cad_claroda " .
			     		"where campeonato = %d " .
			     		"and rodada = %d " .
			     		"and userid = %d "
			     		,$camp,$rod,$row['userid']);
			    $db2->Query($sql); // Consulta se registro existe na tabela para inserir ou alterar
                
                if ($db2->NumRows() == 0) { // Se não existe insere na tabela
                    $sql = sprintf("insert into cad_claroda " .
			     		"(campeonato,rodada,userid,posicao,posefetiva,pontos) " .
			     		"values (%d,%d,%d,%d,%d,%d) " 
			     		,$camp,$rod,$row['userid'],$pos,$posef,$row['pt']); 
				    $db2->Exec($sql); // Insere registro na tabela de classificação de rodadas

                }
				else {		// Atualiza classificação na rodada
					
					$db2->Free();
                    $sql = sprintf("update cad_claroda " .
                    		"set " .
                    		"posicao = %d, " .
                    		"posefetiva = %d, " .
                    		"pontos = %d " .
                    		"where " .
                    		"campeonato = %d " .
                    		"and rodada = %d " .
                    		"and userid = %d"
			     		,$pos,$posef,$row['pt'],$camp,$rod,$row['userid']); 
				    $db2->Exec($sql); // Altera registro na tabela de classificação de rodadas
					
				}                	
		
	    }
	$db->Free();
}

function pontoscopa($camp,$rod) {  //Apura pontuação da copa bolão

  global $db, $db2, $db3;

  $sql = sprintf("select campeonato,rodada,userid,min(jogo) jg1, max(jogo) jg2
					from 
						cad_rodada_copa
					where
						campeonato = %d
						and rodada = %d
					group by 
						campeonato,rodada,userid",$camp,$rod);
   $db3->Query($sql);
   while ($db3->Next()) {

   			// Apura os gols do primeiro jogo
		  $sql = sprintf("select tipo,sum(gols) gols
							from
								cad_rodada_copa r
							left join
								cad_palpite p
							on
							  p.campeonato = r.campeonato
							  and p.rodada = r.rodada
							  and p.userid = r.userid
							  and p.jogo between 1 and 5
							where 
								r.campeonato = %d
								and r.rodada = %d
								and r.userid = %d
								and r.jogo = %d
								group by r.campeonato,r.rodada,r.userid,r.jogo"
								,$camp,$rod,$db3->getValue('userid'),$db3->getValue('jg1'));
	     $db->Query($sql);
		 $db->Next();

		$sql = sprintf("update cad_rodada_copa " .
						"set golsp = %d " .
						"where campeonato= %d " .
						"and rodada = %d " .
						"and jogo = %d " .
						"and tipo = '%s'",						
						$db->getValue('gols'),
						$camp,
						$rod,
						$db3->getValue('jg1'),
						$db->getValue('tipo'));
 
		$db2->Exec($sql); // Atualiza dados do mandante

	// Apura os gols do segundo jogo
   	  $sql = sprintf("select tipo,sum(gols) gols
							from
								cad_rodada_copa r
							left join
								cad_palpite p
							on
							  p.campeonato = r.campeonato
 							  and p.rodada = r.rodada
							  and p.userid = r.userid
							  and p.jogo between 6 and 10
							where 
								r.campeonato = %d
								and r.rodada = %d
								and r.userid = %d
								and r.jogo = %d
								group by r.campeonato,r.rodada,r.userid,r.jogo"
								,$camp,$rod,$db3->getValue('userid'),$db3->getValue('jg2'));
	     $db->Query($sql);
		 $db->Next();

		$sql = sprintf("update cad_rodada_copa " .
						"set golsp = %d " .
						"where campeonato= %d " .
						"and rodada = %d " .
						"and jogo = %d " .
						"and tipo = '%s'"
						,$db->getValue('gols'),$camp,$rod,$db3->getValue('jg2'),$db->getValue('tipo'));

		$db2->Exec($sql); // Atualiza dados do mandante
	}
		
        $sql = sprintf ("select ma.jogo,ma.userid,ma.golsp golsma,vi.userid,vi.golsp golsvi from
								(select campeonato,rodada,jogo,userid,tipo,golsp
								from
									cad_rodada_copa
								where campeonato = %d
								and rodada = %d
								and tipo = 'M') ma,
								(select campeonato,rodada,jogo,userid,tipo,golsp
								from
									cad_rodada_copa
								where campeonato = %d
								and rodada = %d
								and tipo = 'V') vi
								where ma.campeonato = vi.campeonato
								and ma.rodada = vi.rodada
								and ma.jogo = vi.jogo",$camp,$rod,$camp,$rod);
	     $db->Query($sql);
         while ($db->Next()) {
				if ($db->getValue('golsma') > $db->getValue('golsvi')) { // Se manda venceu
					$ptsma = 3;
					$ptsvi = 0;
					$resma = "V";
					$resvi = "D";
				}
				elseif ($db->getValue('golsma') < $db->getValue('golsvi')) { // Se visitante venceu
					$ptsma = 0;
					$ptsvi = 3;
					$resma = "D";
					$resvi = "V";
				}
				else {	// Se ocorreu empate
					$ptsma = 1;
					$ptsvi = 1;
					$resma = "E";
					$resvi = "E";
				}

				$sql = sprintf("update cad_rodada_copa " .
								"set pontos = %d," .
								"result= '%s', " .
								"golsc = %d " .
								"where campeonato= %d " .
								"and rodada = %d " .
								"and jogo = %d " .
								"and tipo = 'M'"
								,$ptsma,$resma,$db->getValue('golsvi'),$camp,$rod,$db->getValue('jogo'));

		        $db2->Exec($sql); // Atualiza dados do mandante

				$sql = sprintf("update cad_rodada_copa " .
								"set pontos = %d," .
								"result= '%s', " .
								"golsc = %d " .
								"where campeonato= %d " .
								"and rodada = %d " .
								"and jogo = %d " .
								"and tipo = 'V'"
								,$ptsvi,$resvi,$db->getValue('golsma'),$camp,$rod,$db->getValue('jogo'));

		        $db2->Exec($sql); // Atualiza dados do mandante
     }

    $db->Free();

}

function totalcopa($camp,$rod) {  //Totaliza a pontuação por grupos

  global $db, $db2;

  $pontos = 0;
  $golsp = 0;
  $golsc = 0;
  $vitorias = 0;
  $jogos = 0;
  $derrotas = 0;
  $empates = 0;
  $PR = 0;
  $RA = 0;


     $cmp = new Campeonato($camp);
     $PR = $cmp->getPrimeiraRodada();
	 $RA = $cmp->getRodadaAtual();
	 
		   $sql = sprintf ("select campeonato,userid,grupo,min(rodada) menorrodada,max(rodada) 								maiorrodada
							from cad_rodada_copa r, cad_campeonato c
							where r.campeonato = %d
							and c.codigo = r.campeonato
							and c.flandamento = 'S'
							group by campeonato,userid,grupo
							having %d between menorrodada and maiorrodada",$camp,$rod);

	     $db->Query($sql);

         while ($db->Next()) {
              
               // Apuração dos gols contra,pontos e jogos dentro do grupo do usuário
               $sql = sprintf ("select sum(pontos) pontos,sum(golsc) golsc,count(*) jogos
								from cad_rodada_copa 
								where rodada between %d and %d
								and campeonato = %d
								and userid = %d",
								$PR,
								$RA,
								$db->getValue('campeonato'),
								$db->getValue('userid'));

		        $db2->Query($sql);
                $db2->Next();
				$jogos = $db2->getValue('jogos');
				$pontos = $db2->getValue('pontos');
				$golsc = $db2->getValue('golsc');
				
               // Apura os gols pro do usuario dentro do grupo
               $sql = sprintf ("select sum(gols) golsp
								from cad_palpite p, cad_campeonato c
								where
								rodada between %d and %d
								and campeonato = %d
								and c.codigo = p.campeonato
								and c.flandamento = 'S'
								and userid = %d",
								$db->getValue('menorrodada'),
								$db->getValue('maiorrodada'),
								$db->getValue('campeonato'),
								$db->getValue('userid'));

		        $db2->Query($sql);
                $db2->Next();
				$golsp = $db2->getValue('golsp');

               // Apura o numero de vitorias do usuário dentro do grupo
               $sql = sprintf ("select count(*) vitoria
								from cad_rodada_copa
								where
								campeonato = %d
								and userid = %d
								and grupo = '%s'
								and result = 'V'",
								$db->getValue('campeonato'),
								$db->getValue('userid'),
								$db->getValue('grupo'));

		        $db2->Query($sql);
                $db2->Next();
				$vitorias = $db2->getValue('vitoria');

               // Apura o numero de derrotas do usuário dentro do grupo
               $sql = sprintf ("select count(*) derrotas
								from cad_rodada_copa
								where
								campeonato = %d
								and userid = %d
								and grupo = '%s'
								and result = 'D'",
								$db->getValue('campeonato'),
								$db->getValue('userid'),
								$db->getValue('grupo'));

		        $db2->Query($sql);
                $db2->Next();
				$derrotas = $db2->getValue('derrotas');

               // Apura o numero de empates do usuário dentro do grupo
               $sql = sprintf ("select count(*) empates
								from cad_rodada_copa
								where
								campeonato = %d
								and userid = %d
								and grupo = '%s'
								and result = 'E'",
								$db->getValue('campeonato'),
								$db->getValue('userid'),
								$db->getValue('grupo'));

		        $db2->Query($sql);
                $db2->Next();
				$empates = $db2->getValue('empates');

				$sql = sprintf("update cad_grupo_copa " .
								"set pontos = %d, " .
								"jogos = %d," .
								"vitorias = %d," .
								"gp = %d," .
								"gc = %d, " .
								"derrotas = %d, " .
								"empates = %d " .
								"where campeonato= %d " .
								"and userid = %d and grupo = '%s'"
								,$pontos,$jogos,$vitorias,$golsp,$golsc,$derrotas,$empates,$camp,$db->getValue('userid'),$db->getValue('grupo'));

		        $db2->Exec($sql); // Atualiza dados do mandante
		
         }

    $db->Free();

}

function clascopa($camp) {  //Processa classificação da primeira fase dos grupos da copa
  global $db, $db2;

   $sql = sprintf("select gc.campeonato,grupo,gc.userid,gc.pontos,jogos,vitorias,gp,gc,(ifnull(gp,0) - ifnull(gc,0)) sg
						from
						cad_grupo_copa gc,
						cad_usuario u,
						(select campeonato,userid,max(golsp) maiorgol
						      from
						        cad_rodada_copa
						      group by
						        campeonato,userid) mg
						where gc.userid = u.userid
						and gc.campeonato = mg.campeonato
						and gc.userid = mg.userid
						and gc.campeonato = %d
						and ifnull(gc.fase,0) = 0 
						order by
						grupo, pontos desc,gp desc, vitorias desc, sg desc, maiorgol desc,username"
			   		,$camp); //Apura a classificação dos grupos da copa

	     $db->Query($sql);

		 $pos = 0;
		 $grpant = "";
		 $cl = "N";
         while ($row = $db->Fetch()) {

                if ($grpant != $row['grupo']) {
                	$grpant = $row['grupo'];
                	$pos = 0;
                }
                	
				$pos += 1;
 
                if ($pos <= 4)
                	$cl = "S";
                else
                	$cl = "N";	
				$sql = sprintf("update cad_grupo_copa " .
								"set posicao = %d, " .
								"classificado = '%s' " .
								"where campeonato= %d " .
								"and grupo = '%s' ".
								"and userid = %d "
								,$pos,$cl,$camp,$row['grupo'],$row['userid']);

		        $db2->Exec($sql); // Atualiza dados do mandante

         }

/*    $db->Free();

	//Verifica entre os não classificados quem teve melhor posição na quinta rodada
   $sql = sprintf("select g.grupo,g.userid,r.posefetiva,r.pontos
						from
						cad_grupo_copa g,
						cad_posrodada r
						where
						g.campeonato = r.campeonato
						and g.userid = r.userid
						and g.classificado = 'N'
						and r.rodada = 14
						and r.campeonato = %d
                        and ifnull(g.fase,0) = 0
						order by r.posefetiva"
			   		,$camp); //Apura a classificação dos grupos da copa

	$db->Query($sql);

	$row = $db->Fetch();

	$sql = sprintf("update cad_grupo_copa " .
					"set classificado = 'S' " .
					"where campeonato= %d " .
					"and grupo = '%s' ".
					"and userid = %d "
					,$camp,$row['grupo'],$row['userid']);

    $db->Free();
    $db->Exec($sql); // Atualiza 16 classificados */
	
}

function oitavas($camp,$rod) {  //Processa classificação das oitavas da copa
  global $db, $db2;

	if ($rod != 14)
		return;
		
   $sql = sprintf("delete from cad_grupo_copa where fase = 8 and campeonato = %d"
   			   		,$camp); //Elimina registros para inclusão atualizada

   $db->Exec($sql);

   $sql = sprintf("insert into cad_grupo_copa " .
   		"(campeonato,grupo,userid,fase)" .
   		"(select %d,'F',userid,8 from cad_grupo_copa where campeonato = %d and classificado = 'S' and ifnull(fase,0) = 0)"
   			   		,$camp,$camp); //Cria grupo com os classificados para as oitavas de final

    $db->Exec($sql);
  
   $sql = sprintf("delete from cad_rodada_copa where rodada in (15,16) and campeonato = %d"
   			   		,$camp); //Elimina registros para inclusão atualizada

   $db->Exec($sql);


   $sql = sprintf("select g.userid,i.posefetiva FROM
					cad_grupo_copa g,
					cad_posrodada i
					where
					g.userid = i.userid
					and g.campeonato = i.campeonato
					and g.campeonato = %d
					and g.classificado = 'S'
					and ifnull(fase,0) = 0
				    and i.rodada = 14
					order by i.posefetiva"
   			   		,$camp); //Elimina registros para inclusão atualizada

   $db->Query($sql);


     $jg = 0;
     $p = 0;
     $tipo = 'M';
     while ($row = $db->Fetch()) {

               $p++;
               if ($p == 9)
					$tipo = 'V';
               else
               if ($p > 8) {  //Jogo de 1 a 8 mandante e acima visitante
               		$jg--;
					$tipo = 'V';
               }
               else {
               		$jg++;
					$tipo = 'M';
               }

			   $sql = sprintf("insert into cad_rodada_copa " .
			   		"(campeonato,rodada,jogo,tipo,userid,grupo)" .
			   		"values (%d,%d,%d,'%s',%d,'F')"
			   		,$camp,($rod+1),$jg,$tipo,$row['userid']); //Cria Rodada das oitavas
			
			    $db2->Exec($sql);
			
			   $sql = sprintf("insert into cad_rodada_copa " .
			   		"(campeonato,rodada,jogo,tipo,userid,grupo)" .
			   		"values (%d,%d,%d,'%s',%d,'F')"
			   		,$camp,($rod+2),$jg,$tipo,$row['userid']); //Cria Rodada das oitavas
			
			    $db2->Exec($sql);
			
    }
}

function quartas($camp,$rod) {  //Processa classificação das quartas da copa
  global $db, $db2;

	if ($rod != 16)
		return;
		
   $sql = sprintf("delete from cad_grupo_copa where fase = 4 and campeonato = %d"
   			   		,$camp); //Elimina registros para inclusão atualizada

   $db->Exec($sql);

   $sql = sprintf("insert into cad_grupo_copa " .
   		"(campeonato,grupo,userid,fase)" .
   		"(select %d,'G',userid,4 from cad_grupo_copa where campeonato = %d and classificado = 'S' and fase = 8)"
   			   		,$camp,$camp); //Cria grupo com os classificados para as quartas de final

    $db->Exec($sql);

   $sql = sprintf("delete from cad_rodada_copa where rodada in (17,18) and campeonato = %d"
   			   		,$camp); //Elimina registros para inclusão atualizada

   $db->Exec($sql);

   $sql = sprintf("select g.userid,i.posefetiva FROM
					cad_grupo_copa g,
					cad_posrodada i
					where
					g.userid = i.userid
					and g.campeonato = i.campeonato
					and g.campeonato = %d
					and g.classificado = 'S'
					and g.fase = 8
					and i.rodada = 14
					order by i.posefetiva"
   			   		,$camp); //Seleciona os classificados nas oitavas para montagem das rodadas das quartas

   $db->Query($sql);

     $jg = 0;
     $p = 0;
     $tipo = 'M';
     while ($row = $db->Fetch()) {

               $p++;

               if ($p == 9)
					$tipo = 'V';
               else
               if ($p > 4) {//Jogo de 1 a 4 mandante e acima visitante
               		$jg--;
					$tipo = 'V';
               }
               else {
               		$jg++;
					$tipo = 'M';
               }
 
               $p++;

			   $sql = sprintf("insert into cad_rodada_copa " .
			   		"(campeonato,rodada,jogo,tipo,userid,grupo)" .
			   		"values (%d,%d,%d,'%s',%d,'G')"
			   		,$camp,($rod+1),$jg,$tipo,$row['userid']); //Cria Rodada das quartas
			
			    $db2->Exec($sql);
			
			   $sql = sprintf("insert into cad_rodada_copa " .
			   		"(campeonato,rodada,jogo,tipo,userid,grupo)" .
			   		"values (%d,%d,%d,'%s',%d,'G')"
			   		,$camp,($rod+2),$jg,$tipo,$row['userid']); //Cria Rodada das quartas
			
			    $db2->Exec($sql);

    }
}

function estatisticas($camp,$rod) {

  global $db, $db2;

  $sql = sprintf("select userid,sum(golsp) golsp, sum(golsc) golsc
					from cad_rodada_copa
					where campeonato = %d
					and rodada = %d
					group by userid
					order by golsp,golsc"
   			   		,$camp,$rod); //Apura os gols marcados e sofridos na rodada

   $db->Query($sql);

    while ($db->Next()) {
	
	       $sql = sprintf ("update cad_posrodada 
		   						set golsp = %d,
									golsc = %d
								where 
									campeonato = %d
									and rodada = %d
									and userid = %d",
							$db->getValue('golsp'),
							$db->getValue('golsc'),
							$camp,$rod,$db->getValue('userid'));

           $db2->Exec($sql);

		   }

  $sql = sprintf("select userid,sum(golsp) golsp,sum(golsc) golsc
					  from
						  cad_posrodada
					  where
						   campeonato = %d
					  group by
						   userid"
   			   		,$camp); //Apura os gols marcados e sofridos na rodada

   $db->Query($sql);

    while ($db->Next()) {
	
	       $sql = sprintf ("update cad_inscricao 
		   						set golsp = %d,
									golsc = %d
								where 
									campeonato = %d
									and userid = %d",
							$db->getValue('golsp'),
							$db->getValue('golsc'),
							$camp,$db->getValue('userid'));

           $db2->Exec($sql);

		   }

}

	?>
