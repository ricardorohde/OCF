<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.Processo.php"); ?>
<span id="titform">
   <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
<?php 
   $prc = new Processo($_GET['prc']);
   $lnk = sprintf ('<a href="lst_processo.php?prc=%d">%s</a>',$prc->getID(),$prc->getNome()); 
   echo ($lnk);
  ?>
</span>
     
 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
		 <td><a href="frm_processo.php?ID=0&prc=<?php echo ($prc->getID()); ?>">Incluir</a></td> 
		 <td><a href="menu_admin.php">Menu Principal</a></td>
      </tr>
      <tr> <td> <br> </td> </tr>
<?php 
    $classe = "FRM".$prc->getClassePrincipal();
	$pth = $_SERVER['DOCUMENT_ROOT']."/".$prc->getPath()."/class.".$classe.".php";
//	echo ("<tr><td>".$pth."</td></tr>");
//	echo ("<tr><td>".$classe."</td></tr>");
    require_once($_SERVER['DOCUMENT_ROOT']."/".$prc->getPath()."/class.".$classe.".php");	
	$obj = new $classe(0,$prc);
    $obj->getLista();

    echo("<tr><td><br></td></tr>");

?>
      <tr>
	 <td> <br> </td>
      </tr>
      <tr style="a:text-decoration:underline;">
		 <td><a href="frm_processo.php?ID=0&prc=<?php echo ($prc->getID()); ?>">Incluir</a></td> 
  	     <td><a href="menu_admin.php">Menu Principal</a></td>
      </tr>

</table>

<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
