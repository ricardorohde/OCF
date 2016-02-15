<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.DAOCLACategoria.php");
////////////////////////////////////////////////////
// CLAcategoria - Classe de categorias de classificados
//
// Classe para tratamento das Categorias de classificados
//
////////////////////////////////////////////////////

/**
 * CLACategoria - Classe do cadastro de Reuniões
 * @package Categorias
 * @author Alencar Mendes de Oliveira
 */
class CLACategoria
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    private $ID               = 0;
    private $Descricao        = "";
    private $Existe           = "N";
	private $dao;
    /**#@-*/

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function CLACategoria($id) {
   
   $this->setID($id);
   
   $this->dao = new DAOCLACategoria();

   try { 
		   $this->dao->Carrega($this);
        } catch(Exception $e) { 
            throw new Exception($e->getMessage()); 
        } 

}

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o codigo da categoria
			return $this->ID;
	}

	function getDescricao() {	//Retorna a descricao da categoria
			return $this->Descricao;
	}

	function getExiste() {	//Retorna a descricao da categoria
			return $this->Existe;
	}

	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setID($var) {	//Altera o valor do atributo descricao
			$this->ID = $var;
	}
	function setDescricao($var) {	//Altera o valor do atributo descricao
			$this->Descricao = $var;
	}
	function setExiste($var) {	//Altera o valor do atributo descricao
			$this->Existe = $var;
	}


 function Grava() { //Grava as informações da categoria

           if ($this->getExiste() == 'N')
		       $this->dao->Inclui($this);
		   else
		       $this->dao->Altera($this);

	}

 function Exclui() { //Exclui a categoria

           if ($this->getExiste() == 'N')
		       return;

           $this->dao->Exclui($this);

	}

 function getLista() { // Retorna as categorias cadastradas
 
           $lst = new DAOCLACategoria();
		   
           $lst->AddOrderby("descricao");
		   
           return $lst->Lista();

	}
}

?>