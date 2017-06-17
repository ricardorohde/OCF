<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Fale Conosco</span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_contato.php" name="frmcontato">

              <p class="titusr" style="font-size: 12px">Não envie mensagens de anúncios de venda e compra de carros ou peças, eles não serão repassados para os membros do clube, para isso utilize a sessão de classificados do Forum.</p>
              <p class="titusr" style="font-size: 12px">O Opala Clube Franca agradece !!! </p>
              <p class="titusr" style="font-size: 15px">Seja um opaleiro de verdade, faça parte desse clube. </p>
             
  <table id="tabform"   border="0" cellspacing="0" width="440px">

        <tr>
        	<td><b>Destinatário</b><br>
            	<input checked="checked" tabindex="1" name="destino" value="Adm" type="radio">Administrador <br>
            	<input tabindex="2" name="destino" value="wbm"	 type="radio">Webmaster 
            </td>
        </tr>

		<pre>
        <tr> <td><b>Nome </b></td></tr>
        <?php
           if ($_SESSION['logado'] == "SIM")
               echo ('<tr> <td> <input size="65" maxlength="60" tabindex="2" name="nome" value="'.$_SESSION['username'].'" ></td> </tr>')."\n"; 
           else
               echo ('<tr> <td> <input size="65" maxlength="60" tabindex="2" name="nome"></td> </tr>')."\n"; 
		?>
		
        <tr> <td><b>Seu E-mail</b></td></tr>
        <?php
           if ($_SESSION['logado'] == "SIM")
               echo ('<tr> <td> <input size="65" maxlength="60" tabindex="3" name="email" value="'.$_SESSION['email'].'" ></td> </tr>')."\n"; 
           else
               echo ('<tr> <td> <input size="65" maxlength="60" tabindex="3" name="email"></td> </tr>')."\n"; 
		?>

        <tr> <td><b>Assunto </td> </tr>
        <tr><td> <input size="65" maxlength="60" tabindex="4" name="assunto" ></td> </tr> 

		<tr> <td><b>Mensagem </td> </tr> 

		<tr><td>
		    <textarea style="width:100%" tabindex="5" maxlength="1024" name="mensagem" rows=10 cols=50> </textarea>
	    </td> </tr>

  	    <tr> <td colspan=10>
	        <?php include("traco.php"); ?>
        </td></tr>
	    <tr> <td colspan="2"> <div style="float:left;"> 
	        <input tabindex="6" name="enviar" value="Enviar Mensagem" type="submit"> 
	    </td> </tr>

  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
