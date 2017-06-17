<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Deixe Seu Recado no Mural</span>

 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadmural.php" name="CadMural">
  <table id="tabform"   border="0" cellspacing="0">
	<pre>
        <tr> <td><b>Recado</td> </tr>
		<tr><td>
		    <textarea maxlength="256" name="recado" tabindex="1" rows=15 cols=50> </textarea>
	    </td> </tr>
   	</pre>
    <?php
         echo ('<tr> <td colspan=10>');
         include("traco.php");
	     echo ('</td></tr>')."\n";
         echo ('<tr> <td> <div style="float:left;"> <input tabindex="2" name="enviar" value="Enviar" type="submit">  </div> </td>  </tr>')."\n";
  	?>
  </table>
 </form>
<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
