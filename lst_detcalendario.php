<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.calendario.php");

    $lst = Calendario::getEventos("X");
    if (count($lst) == 0)
		return;
?>
 <span class="titusr">Calend�rio</span>

 <?php include("traco.php"); ?>

<table  id="menuadm" cellpadding="0" cellspacing="0">
  <?php

    $vez = 0;
    foreach($lst as $e) {
         if ($vez != 0) {
		   echo ('<tr><td><hr style="height: 1px; width: 100%;" align="left"></td></tr>')."\n";
			}
          $enq = new Calendario($e['idcalendario']);
          echo("<tr><td><b> ".date('d/m/Y',$enq->getData())."</b> - ".$enq->getTitulo()."</td></tr>");
          echo("<tr><td><b>Local:</b> ".$enq->getLocal()."</td></tr>");
          echo("<tr><td><b>Realiza��o:</b> ".$enq->getRealizacao()."</td></tr>");
          echo("<tr><td><b>Observa��es:</b> ".$enq->getDescricao()."</td></tr>");
		  $vez = 1;	
		}
   echo ('<tr><td><hr style="height: 1px; width: 100%;" align="left"></td></tr>')."\n";
   ?>
 <?php include("volta.php"); ?>
  </table>

<?php include ("rodape.php"); ?>
