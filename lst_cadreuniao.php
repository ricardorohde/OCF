<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.reuniao.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadreuniao.php">Cadastro de Reuniões</a>
      </span>
     
 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadreuniao.php?ID=0">Inclur Nova Reunião</a>
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

    $eves = Reuniao::getReunioes('T');

       echo ('         <tr class="cabec" align=left> <td>Data</td><td>Hora</td> <td>Local</td></tr>')."\n";

       if (count($eves) == 0) {
      	   echo("<tr ><td colspan=7>Nenhuma reunião cadastrado.</td></tr>");
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
		       
		       $data = sprintf('<a href="frm_cadreuniao.php?ID=%d">%s</a>',$e['id'],
					date("d/m/Y",strtotime($e['data'])));
		       $hora = sprintf('<a href="frm_cadreuniao.php?ID=%d">%s</a>',$e['id'],
					date("H:i",strtotime($e['hora'])));

		       $local = sprintf('<a href="frm_cadreuniao.php?ID=%d">%s</a>',$e['id'],$e['local']);

		       $linha = sprintf ('<td>%s</td> <td>%s</td><td>%s</td>', $data,$hora,$local);
		
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
              <a href="frm_cadreuniao.php?ID=0">Inclur Nova Reunião</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
