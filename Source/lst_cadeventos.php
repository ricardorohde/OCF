<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.evento.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadeventos.php">Cadastro de Eventos</a>
      </span>
     
 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadeventos.php?ID=0">Inclur Novo Evento</a>
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

    $eves = Evento::getEventos();

       echo ('         <tr class="cabec" align=left> <td>Data</td> <td>Local</td><td>Fotos</td></tr>')."\n";

       if (count($eves) == 0) {
      	   echo("<tr ><td colspan=7>Nenhum evento cadastrado.</td></tr>");
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
		       
		       $data = sprintf('<a href="frm_cadeventos.php?ID=%d">%s</a>',$e['id'],
					date("d/m/Y",strtotime($e['data'])));

		       $local = sprintf('<a href="frm_cadeventos.php?ID=%d">%s</a>',$e['id'],$e['local']);
		       $fotos = sprintf('<a href="frm_fotoseve.php?ID=%d"><img src="./imagens/camera.png" width="16px" height="16px" border=0/></a>',$e['id']);

		       $linha = sprintf ('<td>%s</td> <td>%s</td><td>%s</td>', $data,$local,$fotos);
		
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
              <a href="frm_cadeventos.php?ID=0">Inclur Novo Evento</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
