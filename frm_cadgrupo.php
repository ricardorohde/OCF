<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

<script language="javascript">

function inclui(opc) {

var x=0;
       cmb = lst1.document.getElementById("lstd[]");
       cmb2 = lst2.document.getElementById("lsts[]");

       for (x=0;x < cmb.length;x++) {
           if (cmb.options[x].selected || opc == 1) {
               cmb2.options[cmb2.length] = new Option(cmb.options[x].text,cmb.options[x].value);
               cmb.options[x] = null;
               x--;
             }
       } 

}

function exclui(opc) {

var x=0;

       cmb2= lst1.document.getElementById("lstd[]");
       cmb = lst2.document.getElementById("lsts[]");
      
       for (x=0;x < cmb.length;x++) {
           if (cmb.options[x].selected || opc == 1) {
               cmb2.options[cmb2.length] = new Option(cmb.options[x].text,cmb.options[x].value);
               cmb.options[x] = null;
               x--;
             }
       } 
     
}

function seltime(cmb,grp) {

    document.all.lst1.src='prc_times.php?lst=1&camp='+cmb.options[cmb.selectedIndex].value+'&grp='+grp.value;
    document.all.lst2.src='prc_times.php?lst=2&camp='+cmb.options[cmb.selectedIndex].value+'&grp='+grp.value;

}
      
function Enviaform() { 
var x=0;

      tm = new Array();       
      cmb = lst2.document.getElementById("lsts[]");
      
      for (x=0;x < cmb.length;x++)
           tm[x] = cmb.options[x].value;

      camp = document.getElementById("cmbcamp");
      for (x=0;x < camp.length;x++) {
           if (camp.options[x].selected) {
               document.getElementById('camp').setAttribute("value", camp.options[x].value); 
               break;
             }
       }

      grp = document.getElementById("grupo");

//      alert(msg); 
      document.getElementById('grp').setAttribute("value", grp.value); 
      document.getElementById('times').setAttribute("value", tm); 
      return true; 
      } 

</script>


      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadgrupo.php">Cadastro de Grupos</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadgrupo.php" name="frm_cadgrupo" onload="cmbcamp.setfocus();" 
 					onSubmit="return Enviaform()">
  <table id="tabform"   border="0" cellspacing="0">

     <tr> 
     <td> <span  style="font-weight:bold;">Campeonato</span>
	<?php
     $camp = $_GET['camp'];
     $grp = $_GET['grp'];

     if (empty($grp))
         $grp = ' ';

     if ($camp == 0) {
     	  $dis = ' ';
     	  echo ('       <select name="cmbcamp" width=200 style="width:200px" tabindex="1" onchange="seltime(cmbcamp,grupo);"> 
      	      <option value="0"> </option>')."\n"; 
       }
     else {
     	  $dis = 'disabled';
     	  echo ('       <select name="cmbcamp" width=200 style="width:200px" tabindex="1" disabled onchange="seltime(cmbcamp,grupo);"> 
      	      <option value="0"> </option>')."\n"; 
			}

     include ('conectadb.php');
	   $sql = sprintf("Select codigo,descricao,ano from cad_campeonato order by descricao");
		 $result = mysql_query($sql)
						or die('\nErro consultando banco de dados: ' . mysql_error()); 
     
     
		 while ($row = mysql_fetch_assoc($result)) {
             if ($camp == $row['codigo'])
                 $sel = ' selected';
             else
                 $sel = ' ';
  	         echo ('<option value="'.$row['codigo'].'"'.$sel.'>'.$row['descricao'].'-'.$row['ano'].'</option>')."\n";
			}
       mysql_free_result($result);
   		mysql_close($link);
        ?>
	</select> 
     </td>
     <td> </td>
     <td>
     		<span style="font-weight:bold;">Grupo</span><br>
        <input type="text" size="2" maxlength="2" name="grupo" value='<?php echo($grp);?>' <?php echo($dis); ?> tabindex="1" onblur="seltime(cmbcamp,grupo);"> </td>
		</tr>
     
     <tr>
        <td><span  style="font-weight:bold;">Disponíveis</span></td>
        <td> </td>
        <td><span  style="font-weight:bold;">Selecionados</span></td>
     </tr>
     <tr>
     
      <td>
      <iframe name="lst1" width=200 style="width:200px" src="prc_times.php?lst=1&<?php echo("camp=".$camp."&grp=".$grp);?>" frameborder=0 scrolling=no MARGINWIDTH=0 MARGINHEIGHT=0>
       </iframe>
      </td>
      <td valign="center" align="center">
        <input tabindex="0" name="Incluir" value=">" type="button" onclick="inclui(0);">
        <br>
        <input tabindex="0" name="Incall" value=">>" type="button" onclick="inclui(1);">
        <br>
        <input tabindex="0" name="Excluir" value="<" type="button" onclick="exclui(0);">
        <br>
        <input tabindex="0" name="Excall" value="<<" type="button" onclick="exclui(1);">
      </td>
      <td>
      <iframe name="lst2" width=200 style="width:200px" src="prc_times.php?lst=2&<?php echo("camp=".$camp."&grp=".$grp);?>" frameborder=0 scrolling=no MARGINWIDTH=0 MARGINHEIGHT=0>
      </iframe>
      </td>
     </tr>

     <?php 
         if ($camp == 0) {
         	    echo ('<tr> <td colspan=10>');
				      include("traco.php");
      				echo ('</td></tr>')."\n";
	    				echo ('	 <tr> <td colspan="2"> <div style="float:left;"> <input tabindex="3" name="gravar" value="Gravar" type="submit"> ')."\n";
				}
         else
              include('botaltexc.php');
     ?>

     <input type=hidden name="times"  value="">
     <input type=hidden name="camp"  value="">
     <input type=hidden name="grp"  value="">
  
  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
