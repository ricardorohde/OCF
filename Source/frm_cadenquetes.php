<?php include("sessao.php"); ?>

<?php include("vlogin.php"); ?>

<?php include("head.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadenquetes.php">Cadastro de Enquetes</a>
      </span>
     
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadenquetes.php" name="CadEnquete" onload="loadfoco();">
  <table id="tabform"   border="0" cellspacing="0" width="440px">

<?php
    require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");

    $numero = $_GET['enq'];
    $enq = new Enquete($numero);

?>
   <tr> <td><input type="hidden" name="codigo" value=" <?php echo ($enq->getCodigo()); ?>"> </td> </tr>

    <tr> <td> 
	  <fieldset  width="430px" style="width:430px;" align="center">
    	<legend><span style="color:green;"><b>Pergunta</b></legend>
		<input size="65" maxlength="50" tabindex="1" name="pergunta" value="<?php echo($enq->getPergunta()); ?>">
   	</fieldset> 

	</td> </tr> 
    <tr><td align=right>
  <fieldset  width="430px" style="width:430px;" align="center">
    <legend><span style="color:green;"><b>Opções</b></legend>
	1)<input size="60" maxlength="40" tabindex="2" name="op01" value="<?php echo($enq->getOpcao(1)); ?>"><br>
	2)<input size="60" maxlength="40" tabindex="3" name="op02" value="<?php echo($enq->getOpcao(2)); ?>"><br>
	3)<input size="60" maxlength="40" tabindex="4" name="op03" value="<?php echo($enq->getOpcao(3)); ?>"><br>
	4)<input size="60" maxlength="40" tabindex="5" name="op04" value="<?php echo($enq->getOpcao(4)); ?>"><br>
	5)<input size="60" maxlength="40" tabindex="6" name="op05" value="<?php echo($enq->getOpcao(5)); ?>"><br>
	6)<input size="60" maxlength="40" tabindex="7" name="op06" value="<?php echo($enq->getOpcao(6)); ?>"><br>
	7)<input size="60" maxlength="40" tabindex="8" name="op07" value="<?php echo($enq->getOpcao(7)); ?>"><br>
	8)<input size="60" maxlength="40" tabindex="9" name="op08" value="<?php echo($enq->getOpcao(8)); ?>"><br>
	9)<input size="60" maxlength="40" tabindex="10" name="op09" value="<?php echo($enq->getOpcao(9)); ?>"><br>
	10)<input size="60" maxlength="40" tabindex="11" name="op10" value="<?php echo($enq->getOpcao(10)); ?>">
	</fieldset> 
	</td></tr>
	
    <tr><td>
	  <fieldset  width="430px" style="width:430px;" align="center">
         <b>Data de Encerramento: </b>
          <input type="text" style="width:20px;" width="20px" maxlength="2" tabindex="12" name="diafim" value=
		  <?php 
		  		if($numero != 0) 
					echo(date("d",$enq->getDataFim()));
			    else
			        echo ("");
			 ?>> /
          <input type="text" style="width:20px;" width="20px" maxlength="2" tabindex="13" name="mesfim" value=
		  <?php 
		  		if($numero != 0) 
					echo(date("m",$enq->getDataFim()));
			    else
			        echo ("");
			 ?>> /
          <input type="text" style="width:35px;" width="35px" maxlength="4" tabindex="14" name="anofim" value=
  		  <?php 
		  		if($numero != 0) 
					echo(date("Y",$enq->getDataFim()));
			    else
			        echo ("");
			 ?>>
          <input type="checkbox" tabindex="15" name="restrita" value="SIM"
  		  <?php 
		  		if($numero != 0) {
				    if ($enq->getRestrita() == 'S')
					    echo ("checked");
					}
			 ?>>          <b>Restrita a Sócios </b>
	</fieldset> 
	
	</td></tr>

    <tr> <td>

	  <?php
	  		if ($enq->getTipoResposta() == "M") {
				$chkm = 'checked';
				$chku = "";
				}
			else {
				$chkm = "";
				$chku = 'checked';
				}
		?>

	  <fieldset  width="430px" style="width:430px;" align="center">
    	<legend><span style="color:green;"><b>Tipo de Resposta</b></legend>
		 <span style="float:left;">
		     <input  <?php echo ($chku);?> type="radio" tabindex="16" name="resposta" value="unica">Única 
	     </span>
		 <span style="float:right;">
		     <input  <?php echo ($chkm);?> type="radio" tabindex="17" name="resposta" value="multipla" >Múltipla 
	     </span>
      </fieldset> 
	</td> </tr> 

        <?php
        	if ($numero == 0) 
        		include("botincluir.php"); 
			else
        		include("botaltexc.php"); 
        ?>

  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
