<?php include("sessao.php"); ?>
<?php include("head.php"); ?>

<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>

 <span class="titusr">Cadastro Geral de Usuários</span>

 <?php include("traco.php"); ?>
  <table  id="tabform" style="width:600px;">
  <tr  class="cabec"><td>Nome</td><td>Desde</td><td>Cidade</td><td align=center>UF</td><td align=center>Ano</td><td>Fone</td><td>Celular</td><td></td></tr>
  <?php
    $lst = Usuario::getCadastrados();
    if (count($lst) == 0)
		return;

    $cor = 0;

    foreach($lst as $u) {
	     $pasta = sprintf ("./pics/U%06d/",$u['userid']);

         if (is_dir($pasta))
	         $ft = scandir($pasta);
		 else
		 	 $ft = array();
			 
		 if (count($ft) > 2)
		     $i = sprintf ('<a href="lst_detmembro.php?usr=%d"><img src="./imagens/camera.png" width="16px" height="16px" border=0/>',$u['userid']);
	     else
		     $i = " ";

         $usr = new Usuario($u['userid']);

         $linha = sprintf ("<td>%s</td><td align=center>%s</td><td>%s</td><td align=center>%s</td><td align=center>%s</td><td align=right>%s-%s</td><td align=right>%s-%s</td><td align=center>%s</td>",
		          $usr->getLinkNome(),$usr->getLinkDtCadastro(),$usr->getLinkCidade(),$usr->getLinkEstado(),$usr->getLinkAno(),$usr->getLinkDDD(),$usr->getLinkFone(),$usr->getLinkDDDCel(),$usr->getLinkCelular(),$i);		
				  
		 if ($cor == 0) {
		     $cor = 1;		  
             echo('<tr class="rel1">'.$linha.'</tr>')."\n"; 
			 }
	     else {
		     $cor = 0;		  
             echo('<tr class="rel2">'.$linha.'</tr>')."\n"; 
		    }
	}
   ?>
  </table>
<?php include ("rodape.php"); ?>