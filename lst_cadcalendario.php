<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.calendario.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadcalendario.php">Cadastro de Calendário</a>
      </span>
     
 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadcalendario.php?ID=0">Inclur Novo Evento</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>
      <tr>
	 <td>
		<br>
         </td>
      </tr>


<?php 

    $eves = Calendario::getEventos('T');

       echo ('         <tr class="cabec" align=left> <td>Data</td><td>Evento</td> </tr>')."\n";

       if (count($eves) == 0) {
      	   echo("<tr ><td colspan=7>Nenhum evento cadastrado no calendário.</td></tr>");
       }
		foreach($eves as $e) {
		       if ($fllin == 0) {
		           $fllin = 1;
		           echo ('        <tr class="rel1"'.'>');
		          }
		       else
		          {
		           $fllin = 0;
		           echo ('        <tr class="rel2"'.'>');
		        }  
		       
		       $data = sprintf('<a href="frm_cadcalendario.php?ID=%d">%s</a>',$e['idcalendario'],
					date("d/m/Y",strtotime($e['dataevento'])));
		       $evento = sprintf('<a href="frm_cadcalendario.php?ID=%d">%s</a>',$e['idcalendario'],
					$e['titulo']);

		       $linha = sprintf ('<td>%s</td> <td>%s</td>', $data,$evento);
		
		       echo ($linha.'</tr>')."\n";
		}

	  echo("<tr><td><br></td></tr>");

?>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadcalendario.php?ID=0">Inclur Novo Evento</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>
<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
