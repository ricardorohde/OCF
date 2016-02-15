<?php include("sessao.php"); ?>
<?php 
function ResultEnquete($numero) {
    require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");

      $Enq = new Enquete($numero);

	  $tv = $Enq->getVotos("TOTAL");
	  $perc = 0.0;
	  $vt = 0;
	  $wd = "";
      $aux= "";
      for ($x=1;$x < 11;$x++) {
           if ($Enq->getOpcao($x) != NULL) {
		      $vt =  $Enq->getVotos($x);
              if ($vt == 0)
			      $perc = 0;
			  else
			      $perc = $vt / $tv * 100;
			  $wd = sprintf("%02.1d",(120 * $perc / 100));
              echo ('<tr>')."\n";
			  echo ('<td width=10%> </td>')."\n";
			  echo ('<td width=40%>')."\n";			  
	          echo ($Enq->getOpcao($x))."\n";
			  echo ('</td>')."\n";
			  echo ('<td width=50%>')."\n";			  
		      echo ("<IMG SRC='imagens/bluebar.gif' WIDTH='".$wd."' HEIGHT='9' ALT='".
			  sprintf("%2.1f",$perc)."%'>")."\n";
			  
			  $aux = sprintf("%d  (%2.1f%s)",$vt,$perc,'%');
			  
			  echo ($aux)."\n";
			  echo ('</td>')."\n";
			  
              echo ('</tr>')."\n";
			}
	}
	echo ("<tr><td colspan=3 align=center><br><br><b>Total de votos: ".$tv."</td></tr>")."\n";
}	
?>
