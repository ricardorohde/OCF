<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadtimes.php">Cadastro de Times</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

       $operacao = '';
 
       include 'conectadb.php';


       if ($_POST['Excluir'] == 'Excluir')
               exclui();
       else
       if ($_POST['codigo'] == 0)
               inclui();
       else
               altera();

	mysql_close($link);
?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
function exclui() {
   $operacao = "Exclus&atilde;o";

               echo '<tr><td>'.$_POST['nometime'].'</td></tr>'."\n";	
               echo '<tr><td><br></td></tr>'."\n";

	       $exclui = sprintf("delete from cad_times where codigo = '%s'", $_POST['codigo']);

	       $result = mysql_query($exclui)
	    		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

                echo '<tr><td><br></td></tr>'."\n";
                echo "<tr><td>Excluido com sucesso !</td></tr>\n";
                echo '<tr><td><br></td></tr>'."\n";
                echo '<tr><td><br></td></tr>'."\n";
                echo '<tr><td><a href="lst_cadtimes.php">OK</a></td></tr>'."\n";

}

function inclui() {

   $operacao = "Inclus&atilde;o";


        if ($_POST['tipo'] == 'Clube') 
            $tipo = 'C';
        else
            $tipo = 'S';

        if ($_POST['nometime'] == '') {
            echo '<tr><td>Informe o Nome do Time que deseja cadastrar !</td></tr>'."\n";
            echo '<tr><td><br></td></tr>'."\n";
            echo '<tr><td><br></td></tr>'."\n";
            echo '<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>'."\n";

        }
        else {

              $verifica = sprintf("Select count(*) qtde from cad_times where nome = '%s'",
   			$_POST	['nometime']);

	      $result = mysql_query($verifica)
	 		or die('\nErro consultando banco de dados: ' . mysql_error()); 

	      $row = mysql_fetch_assoc($result);
              echo '<tr><td>'.$_POST['nometime'].'</td></tr>'."\n";	
              echo '<tr><td><br></td></tr>'."\n";

	      if ($row['qtde'] <> 0) {
        	    echo '<tr><td>Time informado j&aacute est&aacute cadastrado !</td></tr>'."\n";
                    echo '<tr><td><br></td></tr>'."\n";
                    echo '<tr><td><br></td></tr>'."\n";
                    echo '<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>'."\n";
        	    }
  	      else {
	             $insere = sprintf("insert into cad_times(Nome, Tipo) values ('%s', '%s')",
			        $_POST['nometime'],$tipo);

		     $result = mysql_query($insere)
	    		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 
		
                     echo '<tr><td><br></td></tr>'."\n";
		     echo "<tr><td>Incluido com sucesso !</td></tr>\n";
                     echo '<tr><td><br></td></tr>'."\n";
                     echo '<tr><td><br></td></tr>'."\n";
                     echo '<tr><td><a href="lst_cadtimes.php">OK</a></td></tr>'."\n";
		}

	}

}

function altera() {
   $operacao = "Altera&ccedil;&atilde;o";

        if ($_POST['tipo'] == 'Clube') 
            $tipo = 'C';
        else
            $tipo = 'S';

        if ($_POST['nometime'] == '') {
            echo '<tr><td>Informe o Nome do Time que deseja alterar !</td></tr>'."\n";
            echo '<tr><td><br></td></tr>'."\n";
            echo '<tr><td><br></td></tr>'."\n";
            echo '<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>'."\n";

        }
        else {

              $verifica = sprintf("Select count(*) qtde from cad_times where nome = '%s' and codigo <> %s",
   			$_POST	['nometime'],$_POST['codigo']);

	      $result = mysql_query($verifica)
	 		or die('\nErro consultando banco de dados: ' . mysql_error()); 

	      $row = mysql_fetch_assoc($result);
              echo '<tr><td>'.$_POST['nometime'].'</td></tr>'."\n";	
              echo '<tr><td><br></td></tr>'."\n";

	      if ($row['qtde'] <> 0) {
        	    echo '<tr><td>Time informado j&aacute est&aacute cadastrado !</td></tr>'."\n";
                    echo '<tr><td><br></td></tr>'."\n";
                    echo '<tr><td><br></td></tr>'."\n";
                    echo '<tr><td><a  href="javascript:history.go(-1)">Volta</a></td></tr>'."\n";
        	    }
              else {   
	            $altera = sprintf("update cad_times set Nome = '%s', Tipo = '%s' where
                                  codigo = '%s'", $_POST['nometime'],$tipo,$_POST['codigo']);

	            $result = mysql_query($altera)
	    		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

                     echo '<tr><td><br></td></tr>'."\n";
		     echo "<tr><td>Alterado com sucesso !</td></tr>\n";
                     echo '<tr><td><br></td></tr>'."\n";
                     echo '<tr><td><br></td></tr>'."\n";
                     echo '<tr><td><a href="lst_cadtimes.php">OK</a></td></tr>'."\n";
		}
        }

}

?>
