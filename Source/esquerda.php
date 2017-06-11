<?php include("sessao.php"); ?>
<?php include("lst_reuniao.php"); ?>
<?php
  if ($_SERVER ['REQUEST_URI'] == "/" || $_SERVER ['REQUEST_URI'] == "/index.php")
     echo ('<div align="center" style="margin-bottom:10px;"> <a  target="_blank" href="http://www.autopecas-online.pt/"> <img style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
" alt="http://Autopecas-Online.pt" title="Loja online com uma grande variedade de peças de carros" border="0px" src="./imagens/autopecas-online_142x60.gif"/></a></div>');
?>

<?php include("lst_enquetes.php"); ?>
<?php include("lst_calendario.php"); ?>
<?php include("prc_infouser.php"); ?>
<!--<iframe src='http://selos.climatempo.com.br/selos/MostraSelo.php?CODCIDADE=443&SKIN=padrao' scrolling='no' frameborder='0' width=150 height='170' marginheight='0' marginwidth='0'></iframe> -->
