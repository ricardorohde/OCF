<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadtimes.php">Cadastro de Campeonatos</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

       $codigo = $_POST['codigo'];
       $descricao = $_POST['descricao'];
       $ano = $_POST['ano'];
       $valor = $_POST['valor'];

        if ($_POST['tipo'] == 'Clubes') 
            $tipo = 'C';
        else
            $tipo = 'S';
 
    if (empty($descricao)) {
  		 echo ("<tr><td>Informe a descrição do campeonato </td></tr>")."\n";
   	   $temerro = 1;
   	  }
    if (empty($ano)) {
  		 echo ("<tr><td>Informe o ano do campeonato </td></tr>")."\n";
  		 $temerro = 1;
   	  }
    if (empty($valor)) {
  		 echo ("<tr><td>Informe o valor da inscrição do campeonato </td></tr>")."\n";
  		 $temerro = 1;
   	  }
 
   if ($temerro == 1) {
            include ("volta.php");
      }
   else {
	       include 'conectadb.php';

	       if ($_POST['Excluir'] == 'Excluir')
  	             exclui();
    	   else
      	 if ($_POST['codigo'] == 0)
        	       inclui();
       	else
        	       altera();
    	}

	mysql_close($link);
?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
function exclui() {
   $operacao = "Exclus&atilde;o";

         echo '<tr><td>'.$_POST['descricao'].'</td></tr>'."\n";	
         echo '<tr><td><br></td></tr>'."\n";

	       $exclui = sprintf("delete from cad_campeonato where codigo = '%s'", $POST['codigo']);

	       $result = mysql_query($exclui)
	    		or die('\nErro excluindo registro no banco de dados: ' . mysql_error()); 

                echo '<tr><td><br></td></tr>'."\n";
                echo "<tr><td>Excluido com sucesso !</td></tr>\n";
                echo '<tr><td><br></td></tr>'."\n";
                echo '<tr><td><br></td></tr>'."\n";
                echo '<tr><td><a href="lst_cadcampeonato.php">OK</a></td></tr>'."\n";

}

function inclui() {

   $operacao = "Inclus&atilde;o";

        if ($_POST['tipo'] == 'Clubes') 
            $tipo = 'C';
        else
            $tipo = 'S';

         $insere = sprintf("insert into cad_campeonato(descricao, ano,valorinscr,tipo)
                           values ('%s', '%s','%s','%s')",
                     $_POST['descricao'],$_POST['ano'],$_POST['valor'],$tipo);

		     $result = mysql_query($insere)
	    		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

         echo '<tr><td>'.$_POST['descricao'].'</td></tr>'."\n";	
         echo '<tr><td><br></td></tr>'."\n";
		
         echo '<tr><td><br></td></tr>'."\n";
		     echo "<tr><td>Incluido com sucesso !</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><a href="lst_cadcampeonato.php">OK</a></td></tr>'."\n";

}

function altera() {
   $operacao = "Altera&ccedil;&atilde;o";

        if ($_POST['tipo'] == 'Clubes') 
            $tipo = 'C';
        else
            $tipo = 'S';

         $altera = sprintf("update cad_campeonato 
                            set descricao = '%s', 
                            ano = '%s',
                            valorinscr = '%s',
                            tipo = '%s' where
                            codigo = '%s'",
                            $_POST['descricao'],$_POST['ano'],$_POST['valor'],$tipo,$_POST['codigo']);

         $result = mysql_query($altera)
	    		or die('\nErro alterando registro no banco de dados: ' . mysql_error()); 

         echo '<tr><td>'.$_POST['descricao'].'</td></tr>'."\n";	
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><br></td></tr>'."\n";
		     echo "<tr><td>Alterado com sucesso !</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><a href="lst_cadcampeonato.php">OK</a></td></tr>'."\n";

}

?>
