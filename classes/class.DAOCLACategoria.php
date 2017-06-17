<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// DAOCLAcategoria - Classe de acesso a dados da categorias de classificados
//
// Classe para tratamento das Categorias de classificados
//
////////////////////////////////////////////////////

/**
 * DAOCLACategoria - Classe do cadastro de Reuniões
 * @package Categorias
 * @author Alencar Mendes de Oliveira
 */
class DAOCLACategoria
{

	private $Wh = "";
    private $Order = "";
	private $db;
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */

 function DAOCLACategoria() {
   $this->db = new BD();

  }

function __destruct(){

	$this->db->Close();

}

/* function ~DAOCLACategoria() {
   
    $db->Close();

    }
*/

public function Carrega($Cat) {

   $sql = sprintf("select
			   id,
			   descricao
			   from
               cla_categoria
               where id= %d",$Cat->getID());

   $this->db->Query($sql);

	if ($this->db->NumRows() == 0)
		$Cat->setExiste('N');
    else {
		    $Cat->setExiste('S');
			$this->db->Next();
			$Cat->setDescricao($this->db->getValue('descricao'));
		}
		
 }

 function Inclui($Cat) { //Insere nova categoria

    $sql = sprintf("insert into cla_categoria
		   				  (descricao)
						  values ('%s')",
						   $Cat->getDescricao());

    $this->db->Exec($sql);

    $Cat->setID($this->db->getInsertID());

	}

 function Altera($Cat) { //Altera a categoria

		   $sql = sprintf("update cla_categoria
		                   set descricao = '%s'
							   where 
							   id = %d",
							$Cat->getDescricao(),
							$Cat->getID());

     		$this->db->Exec($sql);

	}

 function Exclui($Cat) { //Exclui a categoria

           if ($Cat->getExiste() == 'N')
		       return;

		   $sql = sprintf("delete from cla_categoria where id = %d"
					   ,$Cat->getID());

    		$this->db->Exec($sql);
			
	}

 function AddWhere($str) { // Retorna as categorias cadastradas
 
 	  $this->Wh .= $str;
 
 }

function AddOrderby($str) {

	  $this->Order .= $str;

}

function Lista() {

           $cat = array();
		   
    	   $sql = sprintf("select
						   id,
						   descricao
						   from
						   cla_categoria");

	        if (!empty($this->Wh))
			    $sql .= " where ".$this->Wh;
			
	        if (!empty($this->Order))
			    $sql .= " order by ".$this->Order;
			
			$this->db->Query($sql);

			while($this->db->Next()) {
					array_push($cat,$this->db->Row);
				}	

			return $cat;
	}
}

?>