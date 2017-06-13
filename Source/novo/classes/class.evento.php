<?php include("sessao.php"); ?>
<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Evento - Cadastro de evento
//
// Classe para tratamento dos Eventos do clube
//
////////////////////////////////////////////////////

/**
 * Eventos - Classe do cadastro de Eventos
 * @package Evento
 * @author Alencar Mendes de Oliveira
 */
class Evento
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $ID               = 0;
    var $Data             = "";
    var $Local            = "";
    var $Descricao        = "";
    var $Existe           = "N";
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function Evento($idevento) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   id,
			   data,
			   local,
			   descricao
			   from
               cad_eventos
               where id= %d",$idevento);

    $db->Query($sql);
	
	if ($db->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$db->Next();
			$this->ID               = $idevento;
			$this->Data             = $db->getValue('data');
			$this->Local            = $db->getValue('local');
			$this->Descricao        = $db->getValue('descricao');
		}
    $db->Close();

    }

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o codigo do evento
			return $this->ID;
	}
	function getLocal() {	//Retorna o local do evento 
			return $this->Local;
	}
	function getData() {	//Retorna a Data do evento
			return strtotime($this->Data);
	}
	function getDescricao() {	//Retorna a Descricao do evento
			return $this->Descricao;
	}


	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setLocal($var) {	//Altera o valor do atributo local
			$this->Local = $var;
	}
	function setData($var) {	//Altera o valor do atributo Data
			$this->Data = $var;
	}

	function setDescricao($var) {	//Altera o valor do atributo Descricao
			$this->Descricao = $var;
	}

 function Grava() { //Grava as informações do evento

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 function Inclui() { //Insere novo evento

		   $x = 0;

		   $db = new BD();
		   
		   $sql = sprintf("insert into cad_eventos
		   				  (data,local,descricao)
						  values ('%s','%s','%s')",
						   date("Y/m/d",$this->getData()),
						   $this->getLocal(),
						   $this->getDescricao());
		
    		$db->Exec($sql);

            $this->ID = $db->getInsertID();

			$pasta = "./eventos";
   
		   if (is_dir($pasta) == false) {
				mkdir($pasta) or die("erro criando diretorio");
				chmod($pasta,0777);
			}


			$pasta = sprintf ("./eventos/%06d/",$this->ID);
   
		   if (is_dir($pasta) == false) {
				mkdir($pasta) or die("erro criando diretorio");
				chmod($pasta,0777);
			}

			$db->Close();

	}


 function Altera() { //Altera a enquete

		   $db = new BD();

		   $sql = sprintf("update cad_eventos
		                   set data = '%s',
						       local = '%s',
							   descricao = '%s'
							   where 
							   id = %d",
							date("Y/m/d",$this->getData()),
							$this->getLocal(),
							$this->getDescricao(),
							$this->getID());

     		$db->Exec($sql);

			$db->Close();

	}

 function Exclui() { //Exclui o evento

           if ($this->Existe == 'N')
		       return;

		   $db = new BD();
		   
		   $sql = sprintf("delete from cad_eventos where id = %d"
					   ,$this->getID());
		
     		$db->Exec($sql);
			
			$db->Close();

			$pasta = sprintf ("./eventos/%06d/",$this->getID());
   
		   if (is_dir($pasta) == true) {
				rmdir($pasta) or die("erro excluindo diretorio");
			}

	}

 function getEventos() { // Retorna os eventos cadastrados

           $eventos = array();
		   
		   $db = new BD();
		   
		   $sql = sprintf("select
					   id,
					   local,
					   data,
					   descricao
					   from
					   cad_eventos
					   order by data desc");
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($eventos,$db->Row);
				}	

			$db->Close();

			return $eventos;

	}


}

	?>