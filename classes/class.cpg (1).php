<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.DAOProcesso.php");
////////////////////////////////////////////////////
// Processo - Classe dos processos do site
//
// Classe para tratamento dos processos do site
//
////////////////////////////////////////////////////

/**
 * Processo - Classe dos processos do site
 * @package Processos
 * @author Alencar Mendes de Oliveira
 */
class Processo
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    private $ID               = 0;
    private $Nome             = "";
    private $ClassePrincipal  = "";
	private $Path             = "";
	private $dao;

    /**#@-*/

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function Processo($id) {
   
   $this->setID($id);
   
   $this->dao = new DAOProcesso();

   try { 
		   $this->dao->Carrega($this);
        } catch(Exception $e) { 
            throw new Exception($e->getMessage()); 
        } 

}

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o id do processo
			return $this->ID;
	}

	function getNome() {	//Retorna o nome do processo
			return $this->Nome;
	}

	function getClassePrincipal() {	//Retorna a classe principal
			return $this->ClassePrincipal;
	}

	function getPath() {	//Retorna o path
			return $this->Path;
	}

	function getExiste() {	//Retorna se o processo existe
			return $this->Existe;
	}

	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setID($var) {	//Altera o valor do atributo descricao
			$this->ID = $var;
	}
	function setNome($var) {	//Altera o valor do atributo Nome
			$this->Nome = $var;
	}
	function setClassePrincipal($var) {	//Altera o valor do atributo ClassePrincipal
			$this->ClassePrincipal = $var;
	}
	function setPath($var) {	//Altera o valor do atributo Path
			$this->Path = $var;
	}
	function setExiste($var) {	//Altera o valor do atributo Existe
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

 function getCategorias() { // Retorna as categorias cadastradas
 
           $lst = new DAOProcesso();
		   
           $lst->AddOrderby("Nome");
		   
           return $lst->Lista();

	}
}

?>