<?php include("sessao.php"); ?>

<tr><td colspan=10 align="center">
<fieldset>
 <table id=menuadm border="0" cellspacing="0" style="width:450px;" width="450px"> 
<?php 
  require_once($_SESSION['DOCROOT']."/classes/class.campeonato.php");
  require_once($_SESSION['DOCROOT']."/classes/class.rodadacopa.php");
  require_once($_SESSION['DOCROOT']."/classes/class.usuario.php");
  require_once($_SESSION['DOCROOT']."/classes/class.jogocopa.php");
  require_once($_SESSION['DOCROOT']."/classes/class.inscricao.php");

   $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

   $Lst = Campeonato::getCampeonatos('A');

   $rodatual = 0;
   
		foreach ($Lst as $c) {
					if ($c > 3)
						continue;
						
                  $cmp = new Campeonato($c);
 				  $rodatual = $cmp->getRodadaatual();

                  $linha = sprintf('<tr style="color:green;"> <td><b>%s</td> <td><b>Campeonato</td> <td><b>Rodada</td> </tr>',$cmp->getDescricao());

		          echo ('<tr>'.$linha.'</tr>')."\n";

				  $r = new RodadaCopa($c,$rodatual);

				  $rowc = $cmp->getArtilheiro();
				  $rowr = $r->getArtilheiro();
				  $usrc = new Usuario($rowc['userid']);
				  $usrr = new Usuario($rowr['userid']);
				  
		          $linha = sprintf ('<td>Artilheiro</td> '.
					          		'<td>%s %s gols</td> '.
					          		'<td>%s %s gols</td> ' 
					          		,$usrc->getLinkUsuario()
									,$rowc['gols']
					          		,$usrr->getLinkUsuario()
									,$rowr['gols']);

		          echo ('<tr>'.$linha.'</tr>')."\n";

				  $rowc = $cmp->getPiorAtaque();
				  $rowr = $r->getPiorAtaque();
				  $usrc = new Usuario($rowc['userid']);
				  $usrr = new Usuario($rowr['userid']);
				  
		          $linha = sprintf ('<td>Pior Ataque</td> '.
					          		'<td>%s %s gols</td> '.
					          		'<td>%s %s gols</td> ' 
					          		,$usrc->getLinkUsuario()
									,$rowc['gols']
					          		,$usrr->getLinkUsuario()
									,$rowr['gols']);

		          echo ('<tr>'.$linha.'</tr>')."\n";


				  $rowc = $cmp->getMelhorDefesa();
				  $rowr = $r->getMelhorDefesa();
				  $usrc = new Usuario($rowc['userid']);
				  $usrr = new Usuario($rowr['userid']);
				  
		          $linha = sprintf ('<td>Melhor Defesa</td> '.
					          		'<td>%s %s gols</td> '.
					          		'<td>%s %s gols</td> ' 
					          		,$usrc->getLinkUsuario()
									,$rowc['gols']
					          		,$usrr->getLinkUsuario()
									,$rowr['gols']);

		          echo ('<tr>'.$linha.'</tr>')."\n";

				  $rowc = $cmp->getPiorDefesa();
				  $rowr = $r->getPiorDefesa();
				  $usrc = new Usuario($rowc['userid']);
				  $usrr = new Usuario($rowr['userid']);
				  
		          $linha = sprintf ('<td>Pior Defesa</td> '.
					          		'<td>%s %s gols</td> '.
					          		'<td>%s %s gols</td> ' 
					          		,$usrc->getLinkUsuario()
									,$rowc['gols']
					          		,$usrr->getLinkUsuario()
									,$rowr['gols'] );

		          echo ('<tr>'.$linha.'</tr>')."\n";
				  
                  if ($_SESSION['logado'] == 'SIM') {
					  $ins = new Inscricao($c,$_SESSION['userid']);
					  $rodant = $cmp->getRodadaAnterior();
					  $proxrod = $cmp->getProximaRodada();
					  
   	                  echo ('<tr><td colspan=3>');
					  include('traco.php');
					  echo ('</tr>')."\n";

					//Mostra os jogos da rodada atual
					  $jgs = $ins->getJogosCopa($rodatual);
					  $dsc = 'Jogos da Rodada:';
					  foreach($jgs as $j) {
					  		$jg = new JogoCopa($c,$rodatual,$j);
							$usrm = new Usuario($jg->getMandante());
						    $usrv = new Usuario($jg->getVisitante());
							$linha = sprintf ("<td style='color:green;'><b>%s</td><td  colspan=2>%s <b>%d x %d</b> %s</td>",$dsc,$usrm->getLinkUsuario(),$jg->getGolsMandante(),$jg->getGolsVisitante(),$usrv->getLinkUsuario());
			                echo ('<tr>'.$linha.'</tr>')."\n";
							$dsc = "";
						  }

					// Mostra os jogos da rodada anterior
					  $jgs = $ins->getJogosCopa($rodant);
					  $dsc = 'Jogos Anteriores:';
   	                  echo ('<tr><td colspan=3>');
					  include('traco.php');
					  echo ('</tr>')."\n";
					  foreach($jgs as $j) {
					  		$jg = new JogoCopa($c,$rodant,$j);
							$usrm = new Usuario($jg->getMandante());
						    $usrv = new Usuario($jg->getVisitante());
							$linha = sprintf ("<td style='color:green;'><b>%s</td><td colspan=2>%s <b>%d x %d</b> %s</td>",$dsc,$usrm->getLinkUsuario(),$jg->getGolsMandante(),$jg->getGolsVisitante(),$usrv->getLinkUsuario());
			                echo ('<tr>'.$linha.'</tr>')."\n";
							$dsc = "";
						  }

					// Mostra os jogos da próxima rodada
					  $jgs = $ins->getJogosCopa($proxrod);
					  $dsc = 'Próximos Jogos:';
   	                  echo ('<tr><td colspan=3>');
					  include('traco.php');
					  echo ('</tr>')."\n";
					  foreach($jgs as $j) {
					  		$jg = new JogoCopa($c,$proxrod,$j);
							$usrm = new Usuario($jg->getMandante());
						    $usrv = new Usuario($jg->getVisitante());
							$linha = sprintf ("<td style='color:green;'><b>%s</td><td colspan=2>%s <b>x</b> %s</td>",$dsc,$usrm->getLinkUsuario(),$usrv->getLinkUsuario());
			                echo ('<tr>'.$linha.'</tr>')."\n";
							$dsc = "";
						  }


					  }

			}

?>
 </table>
</fieldset>
 		</td></tr>
