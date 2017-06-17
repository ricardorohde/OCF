<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.CLACategoria.php");
////////////////////////////////////////////////////
// FRMCLAcategoria - Classe de interface de categorias de classificados
//
// Classe para tratamento das Categorias de classificados
//
////////////////////////////////////////////////////

/**
 * FRMCLACategoria - Classe do cadastro de Categorias de classificados
 * @package Categorias
 * @author Alencar Mendes de Oliveira
 */
class FRMCLACategoria
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

	private $Cat;
	private $Prc;
    /**#@-*/

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
	function FRMCLACategoria($id,$prc) {
   
	   $this->Cat = new CLACategoria($id);
       $this->Prc = $prc;
}

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getForm() {
	
	      $body = sprintf('<body onLoad="document.getElementById(%s).focus();">',"'CatDescricao'");
	      echo ($body)."\n";
	      echo (' <form method="post" action="prc_processo.php" name="FrmCLACateg">')."\n";
          echo ('  <table id="tabform">')."\n";
          $this->getPrc();
          $this->getDescricao();
   	      if ($this->Cat->getExiste() == 'N')
	   	      include($_SERVER['DOCUMENT_ROOT']."/botincluir.php"); 
	      else
              include($_SERVER['DOCUMENT_ROOT']."/botaltexc.php"); 
		  echo ("</table>")."\n";
		  echo ("</form>")."\n";
	      echo ('</body>')."\n";	  
	}

	function getPrc() {	//Retorna o codigo do processo no formulário

	   echo ('<tr> <td><input type="hidden" name="prc" value="'. $this->Prc->getID().'"> </td> </tr>')."\n";

	}

	function getID() {	//Retorna o ID da categoria

	   echo ('<tr> <td><input type="hidden" name="ID" value="'. $this->Cat->getID().'"> </td> </tr>')."\n";

	}

	function getDescricao() {	//Retorna a descricao da categoria

	      echo ('<tr> <td><b>Categoria</b></td></tr>');
          echo ('<tr><td><input size="40" maxlength="30" tabindex="1" name="CatDescricao" value="'.$this->Cat->getDescricao().'"></td> </tr>')."\n";

	}

	function getLista() {

		$fllin = 0;

		$categ = CLACategoria::getLista();

        echo ('         <tr class="cabec" align=left> <td colspan=2>Descricao</td> </tr>')."\n";

		 if (count($categ) == 0) {
			   echo("<tr ><td colspan=7>Nenhuma categoria cadastrada.</td></tr>");
		   }
		
		foreach($categ as $c) {
		       if ($fllin == 0) {
		           $fllin = 1;
		           $cl ='class="rel1"';
		          }
		       else
		          {
		           $fllin = 0;
		           $cl ='class="rel2"';
		        }  

		       $linha = sprintf('<tr %s><td colspan=2><a href="frm_processo.php?ID=%d&prc=2">%s</a></td></tr>',$cl,$c['id'],	$c['descricao']);
			   echo($linha)."\n";

		}

	}
	
}

?>