<?php include("sessao.php"); ?>
<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Reunião - Cadastro de reuniões
//
// Classe para tratamento das Reuniões do clube
//
////////////////////////////////////////////////////

/**
 * Reuniao - Classe do cadastro de Reuniões
 * @package Reuniões
 * @author Alencar Mendes de Oliveira
 */
class Reuniao
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $ID               = 0;
    var $Data             = "";
    var $Hora             = "";
    var $Local            = "";
    var $Existe           = "N";
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function Reuniao($id) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   id,
			   data,
			   hora,
			   local
			   from
               cad_reuniao
               where id= %d",$id);

    $db->Query($sql);
	
	if ($db->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$db->Next();
			$this->ID               = $id;
			$this->Data             = $db->getValue('data');
			$this->Hora             = $db->getValue('hora');
			$this->Local            = $db->getValue('local');
		}
    $db->Close();

    }

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o codigo da reunião
			return $this->ID;
	}

	function getLocal() {	//Retorna o local da reunião 
			return $this->Local;
	}

	function getData() {	//Retorna a Data da reunião
			return strtotime($this->Data);
	}

	function getHora() {	//Retorna a Hora da reunião
			return strtotime($this->Hora);
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

	function setHora($var) {	//Altera o valor do atributo Hora
			$this->Hora = $var;
	}

 function Grava() { //Grava as informações da reuniao

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 function Inclui() { //Insere nova reunião

		   $x = 0;

		   $db = new BD();

		   $sql = sprintf("insert into cad_reuniao
		   				  (data,hora,local)
						  values ('%s','%s','%s')",
						   date("Y/m/d",$this->getData()),
						   date("H:i",$this->getHora()),
						   $this->getLocal());

    		$db->Exec($sql);

            $this->ID = $db->getInsertID();

			$db->Close();

	}


 function Altera() { //Altera a reunião

		   $db = new BD();

		   $sql = sprintf("update cad_reuniao
		                   set data = '%s',
						       hora = '%s',
						       local = '%s'
							   where 
							   id = %d",
							date("Y/m/d",$this->getData()),
							date("H:i",$this->getHora()),
							$this->getLocal(),
							$this->getID());

     		$db->Exec($sql);

			$db->Close();

	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $db = new BD();
		   
		   $sql = sprintf("delete from cad_reuniao where id = %d"
					   ,$this->getID());
		
     		$db->Exec($sql);
			
			$db->Close();

	}

 function getReunioes($filtro) { // Retorna as reuniões cadastradas

           $reunioes = array();
		   
		   $db = new BD();
		   
           if ($filtro == 'T')
			   $sql = sprintf("select
						   id,
						   local,
						   data,
						   hora
						   from
						   cad_reuniao
						   order by data desc");
			else
            if ($filtro == 'P')
			   $sql = sprintf("select
							   min(id) id
							   from
							   cad_reuniao
							   where
							   data >= curdate()
							   order by data desc");

			$db->Query($sql);

			while($db->Next()) {
					array_push($reunioes,$db->Row);
				}	

			$db->Close();

			return $reunioes;
	}
}

	?>