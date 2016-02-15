<?php include("sessao.php"); ?>
<?php include_once("scpbolao.php"); ?>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Bolao.net">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Bolão dos campeonatos de futebol">
  <META NAME="keywords" CONTENT="Bolão, bolão do alex,brasileirão,copa bolão">
  <META HTTP-EQUIV="refresh" CONTENT="120">

  <title>Classificação do Bolão - http://www.bolaodoalex.com</title>
  <link rel="stylesheet" type="text/css" media="screen" href="estilos.css" />

 </head>

<body class="padrao">
	<span class="titusr">Classificação do Bolão</span>
     <?php include("traco.php"); ?>
	<div style="width:430px;border:solid 1px #a0b0b0;background:#fff;">

<table id="menuadm" cellspacing="0" cellpadding="0" width="430px" style="width:430px;">
  <tr> <td>
      <table width="430px" bordercolor="white" class='dettab' border="1px" cellspacing=0 frame="box" rules="all">

<?php
   require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
   require_once($_SESSION['DOCROOT']."/classes/class.usuario.php");
   require_once($_SESSION['DOCROOT']."/classes/class.campeonato.php");
   require_once($_SESSION['DOCROOT']."/classes/class.inscricao.php");

   $db = new BD();

   $sql = sprintf("select i.campeonato,i.userid ".
   		"from " .
   		"cad_inscricao i, " .
   		"cad_usuario u, " .
   		"cad_campeonato c " .
   		"where " .
   		"i.campeonato = c.codigo " .
   		"and i.userid = u.userid ".
		"and c.flandamento = 'S'" .
   		"order by " .
   		"c.ano desc," .
   		"i.campeonato," .
   		"i.posefetiva,".
		"u.username");

	     $db->Query($sql);

         $camp = 0;
         $posant = 0;
         $pos = 0;
        if ($db->NumRows() == 0) {
        	echo ('         <tr> <td>Não existe campeonatos cadastrados ou em andamento no momento.<br></td> </tr>')."\n";
        }
        else {        	
		         while ($db->Next()) {
		                if ($camp <> $db->getValue('campeonato')) {
		                	if ($camp != 0) 
			                    echo ("<tr><td colspan=4><br></td></tr>\n");                	
		                	$pos = 0;
							$cmp = new Campeonato($db->getValue('campeonato'));
		                    echo ("<tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);'><td colspan=10 align=center><b>".$cmp->getDescricaoAno()."</td></tr>\n");                	
		                    echo ("<tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);'><td colspan=10 align=center><b>Classificação do Bolão</td>
							</tr>\n");                	
						    $camp = $cmp->getCodigo();
		                    echo ("<tr  class='cabec'><td align=center>Pos</td><td>Participante</td><td align=center>Pontos</td><td align=center>1º</td><td align=center>2º</td><td align=center>3º</td><td align=center>4º</td><td align=center>5º</td><td align=center>Bônus</td></tr>\n");                	
		                }
					   $usr = new Usuario($db->getValue('userid'));
			           $ins = new Inscricao($cmp->getCodigo(),$usr->getUserid());

		             	if ($posant != $ins->getPosicao()) {
							$pos = $ins->getPosefetiva();
							$posant = $ins->getPosicao();
		             	}
						else
							$pos = " ";

                        if ($pos == 999999)
							$pos = " ";

			           $lu = $usr->getLinkUsuario();
                        if ($ins->getPago() == 'S')
						    $pg = "<img src='imagens/cifrao.jpg' border=none width=13 height=13>";                        else
							$pg = " "; 


		                if ($_SESSION['logado'] == "SIM" && $_SESSION['userid'] == $usr->getUserid())
							$stl =   "style='background:rgb(204, 255, 255);'";
						else
							$stl =   " ";

	    			    if ($ins->getBonusRecRodadas() > 0)
	    			    	$obs = " (*)";
	    			    else
	    			    	$obs = " ";
	    			    	
	    			    if ($ins->getFlag1() == 'S') 
	    			    	$acr1 = '<acronym title="'.$ins->getQtdeB1().' vezes 1º equivale a bônus de '.$ins->getBonus().' pontos">';
	    			    else
	    			        $acr1 = " ";
	    			    if ($ins->getFlag2() == 'S') 
	    			    	$acr2 = '<acronym title="'.($ins->getQtde2()-$ins->getQtdeB2()).' vezes 2º equivale a '.(($ins->getQtde2()-$ins->getQtdeB2()) / 2).' 1º">';
	    			    else
	    			        $acr2 = " ";
	    			    if ($ins->getFlag3() == 'S') 
	    			    	$acr3 = '<acronym title="'.(($ins->getQtde3()-$ins->getQtdeB3())).' vezes 3º equivale a '.(($ins->getQtde3()-$ins->getQtdeB3()) / 2).' 2º">';
	    			    else
	    			        $acr3 = " ";
	    			    if ($ins->getFlag4() == 'S') 
	    			    	$acr4 = '<acronym title="'.($ins->getQtde4()-$ins->getQtdeB4()).' vezes 4º equivale a '.(($ins->getQtde4()-$ins->getQtdeB4()) / 2).' 3º">';
	    			    else
	    			        $acr4 = " ";
	    			    if ($ins->getFlag5() == 'S') 
	    			    	$acr5 = '<acronym title="'.($ins->getQtde5()-$ins->getQtdeB5()).' vezes 5º equivale a '.(($ins->getQtde5()-$ins->getQtdeB5()) / 2).' 4º">';
	    			    else
	    			        $acr5 = " ";
	    			    	
						$linha = "<tr ".$stl.">".
							"<td align=center>".$pos."</td>".
							"<td>".$lu.$pg.$obs."</td>".
							"<td align=center style='background:rgb(255, 194, 133);'><b>".$ins->getLinkPontos()."</b></td>".
							"<td align=center style='".(($ins->getFlag1() == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr1.(($ins->getQtdeB1() == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $ins->getQtdeB1())."</td>".
							"<td align=center style='".(($ins->getFlag2() == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr2.(($ins->getQtdeB2() == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $ins->getQtdeB2())."</td>".
							"<td align=center style='".(($ins->getFlag3() == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr3.(($ins->getQtdeB3() == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $ins->getQtdeB3())."</td>".
							"<td align=center style='".(($ins->getFlag4() == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr4.(($ins->getQtdeB4() == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $ins->getQtdeB4())."</td>".
							"<td align=center style='".(($ins->getFlag5() == 'S') ? 'background:rgb(255, 194, 133);' : 'background:rgb(255, 245, 210);')."'>".$acr5.(($ins->getQtdeB5() == 0) ? "&nbsp&nbsp&nbsp&nbsp" : $ins->getQtdeB5())."</td>".
							"<td align=center class='dettab'>".
							( (($ins->getBonus() + $ins->getBonusRecRodadas()) == 0) ? "&nbsp&nbsp" : ($ins->getBonus() + $ins->getBonusRecRodadas()))."</td>".
							"</tr>\n";
 		                echo ($linha);                	
						$usr = NULL;
						$ins = NULL;
		         }
				echo("<tr><td colspan=10><br></td></tr>")."\n";
		        echo("<tr><td colspan=10 rowspan=2>(*) Recordista de pontos em uma rodada direito a bônus de 12 pontos no final do campeonato.</td></tr>")."\n"; 
        }
			
     $db->Close();

?>
	</table>
  	</td>
  	</tr>
</div>
</body>  	