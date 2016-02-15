<?php include("sessao.php"); ?>

<tr><td colspan=10 align="center">
  <fieldset>
<?php 
  require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
  require_once($_SESSION['DOCROOT']."/classes/class.campeonato.php");
  require_once($_SESSION['DOCROOT']."/classes/class.time.php");

   $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

   $db = new BD();

   $sql = sprintf("select r2.campeonato campeonato from
						(select max(subtime(addtime(data, hora),'06:00:00')) datarod
								from cad_rodada r,
								cad_campeonato c
								where date_add(now(),interval 1 hour)  > subtime(addtime(data, hora),'06:00:00')
								and c.codigo = r.campeonato
								and c.`flandamento` = 'S'
								having date_add(now(),interval 1 hour) > datarod) r,
						(select campeonato,max(subtime(addtime(data, hora),'06:00:00')) datarod
								from cad_rodada r,
								cad_campeonato c
								where date_add(now(),interval 1 hour) > subtime(addtime(data, hora),'06:00:00')
								and c.codigo = r.campeonato
								and c.`flandamento` = 'S'
								group by r.campeonato
								having date_add(now(),interval 1 hour) > datarod) r2
						where r.datarod = r2.datarod");

   $db->Query($sql);
   $db->Next();
   $camp = $db->getValue('campeonato');
   
   $cmp = new Campeonato($camp);

   $db->Close();	

   $cab = sprintf ('<legend><span style="color:green;"><b>Rodada Atual</b></legend>');
	echo($cab)."\n";
					
?>	
 <table id=menuadm frame=box  bordercolor="white" border="1px" cellspacing="0" style="width:450px;" width="450px"> 
          <tr class="cabec"><td width="105px"  align="right">Mandante</td><td  width="40px" align="center">x</td><td width="105px">Visitante</td><td align="center">Data/Hora</td> <td align="center">Palpite</td> <td align="center">Pts</td> </tr>


<?php 

   $sql = sprintf("select r.rodada,r.jogo,r.golsma,r.golsvi,r.manda cmanda, r.visita cvisita,
					tm.nome manda,tv.nome visita,
					addtime(r.data, r.hora) datahora,p.pmanda,p.pvisita,p.pontos
					from
					cad_times tm,
					cad_times tv,
					cad_rodada r
					left join
					cad_palpite p
					on
					p.campeonato = r.campeonato
					and p.rodada = r.rodada
					and p.jogo = r.jogo
					and p.userid = %d
					where
					r.campeonato = %d
					and r.rodada = %d
					and r.manda = tm.codigo
					and r.visita = tv.codigo"
					,$_SESSION['userid'],$cmp->getCodigo(),$cmp->getRodadaAtual());

        $db = new BD();
        $db->Query($sql);

		while ($db->Next()) {

		          $tm = new Time($db->getValue('cmanda'));
		          $tv = new Time($db->getValue('cvisita'));

		          $linha = sprintf ('<td align="right">%s</td>'.
				          		'<td  align="center">%s x %s</td> '.
				          		'<td>%s</td> ' .
				          		'<td>%s %s</td> '.
				          		'<td  align="center">%s x %s</td> '.
				          		'<td  align="center">%s</td> '
				          		,$tm->getLink()
				          		,$db->getValue('golsma')
				          		,$db->getValue('golsvi')
				          		,$tv->getLink()
								,date("d/m/Y H:i",strtotime($db->getValue('datahora')))
								,$dw[date("w",strtotime($db->getValue('datahora')))]
				          		,$db->getValue('pmanda')
				          		,$db->getValue('pvisita')
				          		,$db->getValue('pontos')
				          		);

		          echo ('<tr class="dettab">'.$linha.'</tr>')."\n";
				}

	$db->Close();

?>
</fieldset>
 </table>
 	</td></tr>
