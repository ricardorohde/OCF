<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr"">Registre seu palpite</span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
<?php 

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');
	include ('chaverod.php');

        $verifica = sprintf("select rod.campeonato,rod.rodada,rod.datahora,cadastro, rod.descricao, rod.ano
								  from
								    (select
								        r.campeonato,r.rodada, min(addtime(data, hora)) datahora, c.descricao, c.ano,max(addtime(data, hora)) datamax
								        from
								          cad_rodada r,
								          cad_inscricao i,
								          cad_campeonato c
								        where
				 				          i.campeonato = r.campeonato
								          and i.userid = %d
								          and r.data <> '0000-00-00'
								          and c.codigo = i.campeonato
										  and c.flandamento = 'S'
								          group by r.campeonato,r.rodada
										  having date_add(now(),interval 1 hour) < datahora) rod
								   left join
								        (select userid,campeonato,rodada,'S' cadastro
								                from cad_palpite
								                where userid = %d
								                group by userid,campeonato,rodada) p
								    on
								      rod.campeonato = p.campeonato
								      and rod.rodada = p.rodada
								      order by rod.ano desc, rod.descricao, rod.rodada",$_SESSION['userid'],$_SESSION['userid']);

				$result = mysql_query($verifica)
											or die('\nErro consultando banco de dados: ' . mysql_error()); 

        if (mysql_num_rows($result) == 0) {
//		    echo ('         <tr> <td colspan=2>Para registrar seu palpite voc� precisa se inscrever no campeonato.</td> </tr>')."\n";
        	echo ('         <tr> <td><br></td> </tr>')."\n";
        }
        else {        	
		        $fllin = 0;
		
			    echo ('         <tr> <td><br></td> </tr>')."\n";
			    echo ('         <tr> <td colspan=4>Clique na rodada que deseja registrar seu palpite</td></tr>')."\n";
			    echo ('         <tr> <td><br></td> </tr>')."\n";
		
		        echo ('         <tr class="cabec"> <td>Campeonato</td> <td align="center">Rodada</td> <td>Data/Hora In�cio</td><td>Situa��o</td></tr>')."\n";
		
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
		// Se for copa do mundo 2006 e data e hora atual for > 08/06/2006 as 23:59 n�o permite mais o palpite
		  if ($row['campeonato'] == 4) {
              $dtini = mktime(date("H"), //Hora
         				   date("i"), //Minuto
         				   date("s"), //Minuto
	      				   date("m"), //Mes
	      				   date("d"), //Dia
	      				   date("Y")); //Ano 

              if (($dtini + 3600) > strtotime('2006-06-08 23:59:59'))
			  		continue;
			}
				
          $dtini = mktime(date("H",strtotime($row['datahora'])), //Hora
         				   date("i",strtotime($row['datahora'])), //Minuto
	          				   0,	//Segundo
	      				   date("m",strtotime($row['datahora'])), //Mes
	      				   date("d",strtotime($row['datahora'])), //Dia
	      				   date("Y",strtotime($row['datahora']))); //Ano 
           $dif = (time() + 3600) - ($dtini - 900); // Hora atual menos 15 minutos
		   if ($dif > 0 && $row['campeonato'] == 3) {
               $descr = sprintf('%s-%s',$row['descricao'],$row['ano']);
           	   $rodada = sprintf('%02d',$row['rodada']);
           	   $dh = sprintf('%s %s <i>%s</i>',date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$dw[date("w",strtotime($row['datahora']))]);
  			   $situa = '<span style="color:red;">Palpites Encerrados</span>';
          		}           	
            else {
	        $descr = sprintf('<a href="frm_cadpalpite.php?camp=%s&rod=%s&key=%s">%s-%s</a>',$row['campeonato'],
     		$row['rodada'],chaverod($row['campeonato'],$row['rodada']),$row['descricao'],$row['ano']);
	        $rodada = sprintf('<a href="frm_cadpalpite.php?camp=%s&rod=%s&key=%s">%02d</a>',$row['campeonato'],
			$row['rodada'],chaverod($row['campeonato'],$row['rodada']),$row['rodada']);
	        $dh = sprintf('<a href="frm_cadpalpite.php?camp=%s&rod=%s&key=%s">%s %s <i>%s</i></a>',$row['campeonato'],
			$row['rodada'],chaverod($row['campeonato'],$row['rodada']),date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$dw[date("w",strtotime($row['datahora']))]);
			if ($row['cadastro'] == 'S') 
			   $situa = '<span style="color:blue;"><b>Palpite Registrado</span>';
			else		
			   $situa = '<span style="color:green;"><b>Registre seu Palpite</span>';
			}
		    $linha = sprintf ('<td>%s</td> <td align="center">%s</td> <td>%s</td> <td style="color:red;">%s</td>', $descr,$rodada,$dh,$situa);
		
            echo ($linha.'</tr>')."\n";
			}

		    echo ('         <tr> <td><br></td> </tr>')."\n";
/*			echo ('         <tr> <td colspan=4>* Os palpites podem ser registrados ou alterados at� 15 minutos antes do in�cio de cada partida</td></tr>')."\n";*/
	}
	
	mysql_free_result($result);
	mysql_close($link);
?>

</table>

<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
