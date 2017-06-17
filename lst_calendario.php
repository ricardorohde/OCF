<?php include("sessao.php"); ?>
<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.calendario.php");

    $lst = Calendario::getEventos("P");
    if (count($lst) == 0)
		return;
?>
<div id="infousr">
<table cellpadding="0" cellspacing="0" frame="box" rules="none">
  <tr align="center">
  	<td background="./imagens/br.gif" colspan=2>
	   		<span style='font-weight:bold;color:#FFFFFF;font-size:13px'>.: Calendário :.</span>
	</td>
	</tr>
  <?php

    $vez = 0;
    foreach($lst as $e) {
         if ($vez != 0) {
		   echo ('<tr><td><hr style="height: 1px; width: 100%;" align="left"></td></tr>')."\n";
			}

          $enq = new Calendario($e['idcalendario']);
          echo("<tr><td><b> ".date('d/m/Y',$enq->getData())."</b>-".$enq->getTitulo()."</td></tr>");
		  $vez = 1;	
		}

   ?>
  <tr><td align="right"><a href="lst_detcalendario.php"><b>mais...</b></a></td></tr>
  </table>
</div>  