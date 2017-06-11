<?php include("sessao.php"); ?>
<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.reuniao.php");
    $dt = 0;
    $lst = Reuniao::getReunioes("P");
    
    if (empty($lst[0]['id'])) {
	    while (date("w",time() + $dt) <> 6) {
     			$dt += 86400;
		};

//        echo("<h1>".date("Y/m/d",time() + $dt)."</h1>");

		$r = new Reuniao(0);
		$r->setData(date("Y/m/d",time() + $dt));
		$r->setLocal("Chic 10 Av.Alonso y Alonso");
		$r->setHora("15:30");
		$r->Grava();
	}
?>

<div class="painel">
<div class="LeftCorner"> </div>
<div class="TitPainel">.:: Reuni�o Semanal ::.</div>
<div class="RightCorner"> </div>
<div class="corpo"> 
 
  <?php
	$dw = Array(
			"Domingo",
			"Segunda-feira",
			"Ter�a-feira",
			"Quarta-feira",
			"Quinta-feira",
			"Sexta-feira",
			"S�bado");

    foreach($lst as $e) {
         $enq = new Reuniao($e['id']);
          echo("<center><h3>".$dw[date('w',$enq->getData())]."</h3></center>");
		  echo("<center> �".date('d/m/Y',$enq->getData())." - ".date('H:i',$enq->getHora())."hs".chr(171)."</center>");
		  echo("<br>");
		  echo("<b>Local: </b>".$enq->getLocal());
		  echo("<br>");
		  echo("<br>");
    }
				  
   ?>
   </div>
</div>
