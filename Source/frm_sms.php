<?php include("head.php"); ?>
<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/sessao.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario.php");
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.sms.php");
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.reuniao.php");
require_once($_SERVER['DOCUMENT_ROOT']."/vlogin.php"); 
?> 
      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="frm_sms.php">Enviar Mensagem SMS</a> 
      </span>
 <?php include("traco.php"); ?>
 <div style="font-size:12px;padding:5px;">
 <?php 
$erroValida = 0;
if (isset($_POST['enviar'])) {
	if ($_POST['enviar'] == 'Enviar') {
			if (EnviaMsg() == 0) {
				return ;
				}
			}
	}
?>
<form method="post" action="frm_sms.php" name="smssend">
<span><b>Mensagem</b></span><br/>
<textarea maxlength="160" name="mensagem" tabindex="0" rows=6 cols=60 onKeyUP="conta()"><?php echo (isset($_POST['mensagem']) ? $_POST['mensagem']:""); ?></textarea>
<br/><span style="border:0;font-size:10px;">Caracteres restantes: </span><span id="letras" style="border:0;font-size:10px;"></span> 
<br/><br/><span>Enviar a mensagem para: </span>
<div style="border:1px;border-style:solid;padding:5px;border-color:#c4e8ca;"><select name="destinatario" tabindex="1">
				<option value="0"></option>
				<option value="1">Todos Cadastrados no site</option>
				<option value="2">Somente Residentes em Franca</option>
				<option value="3">Somente DDD 16</option>
</select> 
<input type="checkbox" value="S" tabindex="2" name="associados">Associados</input>
<input type="checkbox" value="S" tabindex="3" name="naoassociados">Não Associados</input>
<br/><br/>Enviar somente p/ o Número (DDD+Numero)(Ex.1681234567): <input size="20" tabindex="5" name="numero">
</div>
<br/><br/><br/>
<div>
<br/><span>Termos substituíveis:</span>
<br/><span><b>#usuarionosite# :</b> Será substituido pelo nome de usuário do site (15 posições)</span>
<br/><span><b>#primeiro_nome# :</b>Corresponde ao primeiro nome do membro cadastrado (15 posições)</span>
<br/><span><b>#dtreuniao# :</b> Corresponde a data da próxima reunião (10 posições)</span>
<br/><span><b>#hrr# :</b> Corresponde a hora da próxima reunião (5 posições)</span>
<br/><span><b>#localproximareuniao# :</b> Corresponde ao local da próxima reunião (21 posições)</span>
</div>
<?php include("traco.php"); ?>
<div style="float:left;"> <input style="border:0;" tabindex="4" name="enviar" value="Enviar" type="submit">  </div>
</form>
<br/><br/>
</div>
<script type="text/javascript" language="JavaScript"> 
function setFocus() {
	if (document.forms['smssend'].mensagem.value.length == 0) 
	    document.forms['smssend'].mensagem.value = "OpalaClubeFranca Informa: ";
	
	document.getElementById('letras').innerHTML = 160 - document.forms['smssend'].mensagem.value.length;
	document.forms['smssend'].mensagem.focus();
}
function conta(){ 

		
		if (document.forms['smssend'].mensagem.value.length > 160)
			document.forms['smssend'].mensagem.value = document.forms['smssend'].mensagem.value.substring(0, 160);

	    document.getElementById('letras').innerHTML = 160 - document.forms['smssend'].mensagem.value.length;
}
document.onload=setFocus();
</script>

<?php 
function EnviaMsg () {
	
	$contamsg = 0;

	$destinatario = trim($_POST['destinatario']);
	$associados = isset($_POST['associados']) ? trim($_POST['associados']) == "S" ? "S" : "N" : "N";
	$naoassociados = isset($_POST['naoassociados']) ? trim($_POST['naoassociados']) == "S" ? "S" : "N" : "N";
	$mensagem = trim($_POST['mensagem']);
	$numero = isset($_POST['numero']) ? $_POST['numero'] : 0;
/*	
	echo($destinatario)."<br/>";
	echo($associados)."<br/>";
	echo($naoassociados)."<br/>";
	echo($mensagem)."<br/>";
*/
	$temerro = 0;
	echo('<div style="color:red;">');
	if ($destinatario == 0 && $numero == 0) {
		echo("<br>Selecione a lista para quem vc deseja enviar a mensagem");
		$temerro = 1;
	}
	if ($associados == "N" && $naoassociados == "N" && $numero == 0) {
		echo("<br>Informe se a mensagem será enviada para os associados, não associados ou ambos");
		$temerro = 1;
	}
	if (empty($mensagem) || $mensagem =="OpalaClubeFranca Informa:") {
		echo("<br>Informe a mensagem a ser enviada");
		$temerro = 1;
	}
	echo('</div>');
	
	if ($temerro == 1)
		return $temerro;

	echo("<br/><b>Mensagem:</b><br/>".$mensagem);

	$sms = new SMS(0);
	$sms->setTexto($mensagem);
	$sms->setIDCliente(1);
	$sms->setIDSite($_SESSION['userid']);
	$sms->setLista($destinatario);
	$sms->setAssociados($associados);
	$sms->setNaoAssociados($naoassociados);
	$sms->setNumero($numero);
	$sms->Enviar("S");	
	echo("<br/><br/>");	
	echo('<a href="frm_sms.php">Enviar Outra Mensagem SMS</a>');
 	include ("rodape.php");
	return 0;
}
?>
<?php include ("rodape.php"); ?>
