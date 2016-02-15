<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// DAOProcesso - Classe de acesso a dados de processos
//
// Classe para tratamento dos processos
//
////////////////////////////////////////////////////

/**
 * DAOProcesso - Classe de tratamento de processos
 * @package Processos
 * @author Alencar Mendes de Oliveira
 */
class DAOProcesso
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

 function DAOProcesso() {
   $this->db = new BD();
  }

function __destruct(){

	$this->db->Close();

}

/* function ~DAOCLACategoria() {
   
    $db->Close();

    }
*/

public function Carrega($Prc) {

   $sql = sprintf("select
			   id,
			   nome,
			   classeprincipal,
			   path
			   from
               processos
               where id= %d",$Prc->getID());

   $this->db->Query($sql);

	if ($this->db->NumRows() == 0)
		$Prc->setExiste('N');
    else {
		    $Prc->setExiste('S');
			$this->db->Next();
			$Prc->setNome($this->db->getValue('nome'));
			$Prc->setClassePrincipal($this->db->getValue('classeprincipal'));
			$Prc->setPath($this->db->getValue('path'));
		}
		
 }

 function Inclui($Prc) { //Insere novo processo

    $sql = sprintf("insert into processos
		   				  (nome,classeprincipal,path)
						  values ('%s','%s','%s')",
						   $Prc->getNome(),
						   $Prc->getClassePrincipal(),
						   $Prc->getPath());

    $this->db->Exec($sql);

    $Prc->setID($this->db->getInsertID());

	}

 function Altera($Prc) { //Altera o processo

		   $sql = sprintf("update processos
		                   set nome = '%s',
						       classeprincipal = '%s',
							   path = '%s'
							   where 
							   id = %d",
							$Cat->getNome(),
							$Cat->getClassePrincipal(),
							$Cat->getPath(),
							$Cat->getID());

     		$this->db->Exec($sql);
	}

 function Exclui($Prc) { //Exclui o processo

           if ($Prc->getExiste() == 'N')
		       return;

		   $sql = sprintf("delete from processos where id = %d"
					   ,$Prc->getID());

    		$this->db->Exec($sql);
			
	}

 function AddWhere($str) { // Retorna as categorias cadastradas
 
 	  $this->Wh .= $str;
 
 }

function AddOrderby($str) {

	  $this->Order .= $str;

}

function Lista() {

           $prc = array();
		   
    	   $sql = sprintf("select
						   id,
						   nome,
						   classeprincipal,
						   path
						   from
						   processos");

	        if (!empty($this->Wh))
			    $sql .= " where ".$this->Wh;
			
	        if (!empty($this->Order))
			    $sql .= " order by ".$this->Order;
			
			$this->db->Query($sql);

			while($this->db->Next()) {
					array_push($prc,$this->db->Row);
				}	

			return $prc;
	}
}

?>