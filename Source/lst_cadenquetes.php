<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadenquetes.php">Cadastro de Enquetes</a>
      </span>
     
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
		 <td>  
              <a href="frm_cadenquetes.php?enq=0">Inclur Nova Enquete</a>
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
    require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");

    $enqs = Enquete::getEnquetes("T");

       echo ('         <tr class="cabec" align=left> <td>Pergunta</td> <td>Inicio</td><td>Fim</td></tr>')."\n";

       if (count($enqs) == 0) {
      	   echo("<tr ><td colspan=7>Nenhuma enquete cadastrada.</td></tr>");
       }
		foreach($enqs as $e) {
		       if ($fllin == 0) {
		           $fllin = 1;
		           echo ('        <tr class="rel1"'.'>');
		          }
		       else
		          {
		           $fllin = 0;
		           echo ('        <tr class="rel2"'.'>');
		        }  
		       
		       $dtini = sprintf('<a href="frm_cadenquetes.php?enq=%s">%s</a>',$e['numero'],
					date("d/m/Y",strtotime($e['datainicio'])));

		       $dtfim = sprintf('<a href="frm_cadenquetes.php?enq=%s">%s</a>',$e['numero'],
					date("d/m/Y",strtotime($e['datafim'])));
		
		       $per = sprintf('<a href="frm_cadenquetes.php?enq=%s">%s</a>',$e['numero'],$e['pergunta']);

		       $linha = sprintf ('<td>%s</td> <td>%s</td><td>%s</td>', $per,$dtini,$dtfim);
		
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
              <a href="frm_cadenquetes.php?enq=0">Inclur Nova Enquete</a>
         </td> 
		<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
