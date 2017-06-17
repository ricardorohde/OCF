<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
    <span id="titform"> <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> <a href="lst_cadreuniao.php">Cadastro de Reuniões</a> </span>
<?php include("traco.php"); ?>
<?php include("tophome.php"); ?>
<?php
    require_once($_SESSION['DOCROOT']."/classes/class.reuniao.php");
    $numero = $_GET['ID'];
    $eve = new Reuniao($numero);
?>

<body onLoad="document.getElementById('dia').focus();">
	<form method="post" action="prc_cadreuniao.php" name="frm_cadreuniao" id="frm_cadreuniao" >
	  <table id="tabform"   border="0" cellspacing="0"  width="440px">
		<tr>
		  <td><input type="hidden" name="ID" value="<?php echo($eve->getID()); ?>"></td>
		</tr>
        <tr> <td style="font-weight:bold;" width="30%" >Data:</td> </tr>
		<tr>
		<td width="70%" >
		<input tabindex="11" size="2" maxlength="2" style="width:20px;" name="dia" value="<?php if ($numero <> 0) echo(date("d",$eve->getData()));?>"> /
		<input tabindex="12" size="2" style="width:20px;" maxlength="2" name="mes" value="<?php if ($numero <> 0) echo(date("m",$eve->getData()));?>"> /
		<input tabindex="13" size="4" maxlength="4" style="width:35px;" name="ano" value="<?php if ($numero <> 0) echo(date("Y",$eve->getData()));?>">
		</td>
		</tr>
        <tr> <td style="font-weight:bold;" width="30%" >Hora:</td> </tr>
		<tr>
		<td width="70%" > 
		<input tabindex="14" size="2" maxlength="2" style="width:20px;" name="hh" value="<?php if ($numero <> 0) echo(date("H",$eve->getHora()));?>"> :
		<input tabindex="15" size="2" style="width:20px;" maxlength="2" name="mm" value="<?php if ($numero <> 0) echo(date("i",$eve->getHora()));?>">
		</td>
		</tr>
        <tr><td style="font-weight:bold;" width="30%" >Local:</td> </tr>
        <tr><td width="70%" > <input tabindex="16" size="60" maxlength="60" name="local" value="<?php echo($eve->getLocal());?>"></td> </tr>
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
