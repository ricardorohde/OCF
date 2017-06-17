<?php include("sessao.php"); ?>
<!-- Informações do usuário -->
<table  class="InfoUser" cellpadding="3" cellspacing="0" border="0" width="400px">
<tr valign="middle">
<td>Bem-vindo  <a href="frm_altusuario.php" title="Clique aqui para alterar seus dados"><?php echo($_SESSION['username']);?> </a> !</td>
<td><a href="painelctrl.php" title="Clique aqui para alterar suas configurações">  »Painel de Controle</a></td>
<?php if ($_SESSION['aprovado'] == 'S') {
	     echo('<td><a href="http://webmail.opalaclubefranca.com.br" target="_blank" title="Clique aqui para acessar seu webmail">  »E-Mail </a></td>');
		}
?>	
<td><a href="prc_logout.php" title="Clique aqui para sair">    »Sair </a></td>
</tr>
</table>