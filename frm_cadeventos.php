<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
    <span id="titform"> <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> <a href="lst_cadeventos.php">Cadastro de Eventos</a> </span>
<?php include("traco.php"); ?>
<?php include("tophome.php"); ?>
<?php
    require_once($_SESSION['DOCROOT']."/classes/class.evento.php");
    $numero = $_GET['ID'];
    $eve = new Evento($numero);
?>

<body onLoad="document.getElementById('dia').focus();">
	<form method="post" action="prc_cadeventos.php" name="frm_cadeventos" id="frm_cadeventos" >
	  <table id="tabform"   border="0" cellspacing="0"  width="440px">
		<tr>
		  <td><input type="hidden" name="ID" value="<?php echo($eve->getID()); ?>"></td>
		</tr>
        <tr> <td style="font-weight:bold;" width="30%" >Data:</td> </tr>
		<tr>
		<td width="70%" > 
		<input tabindex="1" size="2" maxlength="2" style="width:20px;" name="dia" value="<?php if ($numero <> 0) echo(date("d",$eve->getData()));?>"> /
		<input tabindex="2" size="2" style="width:20px;" maxlength="2" name="mes" value="<?php if ($numero <> 0) echo(date("m",$eve->getData()));?>"> /
		<input tabindex="3" size="4" maxlength="4" style="width:35px;" name="ano" value="<?php if ($numero <> 0) echo(date("Y",$eve->getData()));?>">
		</td>
		</tr>
        <tr><td style="font-weight:bold;" width="30%" >Local:</td> </tr>
        <tr><td width="70%" > <input tabindex="4" size="60" maxlength="60" name="local" value="<?php echo($eve->getLocal());?>"></td> </tr>
        <tr><td colspan=2 style="font-weight:bold;" width="30%" >Descrição do Evento:</td>	</tr>
        <tr><td colspan=2><textarea tabindex="5" maxlength="1024" name="descricao" rows=10 cols=50><?php echo($eve->getDescricao());?></textarea></td></tr>
        <?php
        	if ($numero == 0) 
        		include("botincluir.php"); 
			else
        		include("botaltexc.php"); 
        ?>
        </table>
    </form>
	</body>
   <?php include ("bothome.php"); ?>
   <?php include ("rodape.php"); ?>
