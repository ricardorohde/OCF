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
 * Reuniao - Classe do cadastro de Eventos no Calendário
 * @package Calendario
 * @author Alencar Mendes de Oliveira
 */
class Calendario
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $ID               = 0;
    var $Data             = "";
    var $Titulo           = "";
    var $Descricao        = "";
    var $Local            = "";
    var $Realizacao       = "";
    var $Existe           = "N";
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function Calendario($id) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   idcalendario,
			   dataevento,
			   titulo,
			   descricao,
			   local,
			   realizacao
			   from
               tb_calendario
               where idcalendario= %d",$id);

    $db->Query($sql);
	
	if ($db->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$db->Next();
			$this->ID               = $id;
			$this->Data             = $db->getValue('dataevento');
			$this->Titulo           = $db->getValue('titulo');
			$this->Descricao        = $db->getValue('descricao');
			$this->Local            = $db->getValue('local');
			$this->Realizacao       = $db->getValue('realizacao');
		}
    $db->Close();

    }

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o codigo da reunião
			return $this->ID;
	}

	function getTitulo() {	//Retorna o titulo do evento
			return $this->Titulo;
	}

	function getData() {	//Retorna a Data do evento
			return strtotime($this->Data);
	}

	function getDescricao() {	//Retorna a Descricao do evento
			return $this->Descricao;
	}
	function getLocal() {	//Retorna o Local do evento
			return $this->Local;
	}
	function getRealizacao() {	//Retorna o Realizador do evento
			return $this->Realizacao;
	}

	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setTitulo($var) {	//Altera o valor do titulo do evento
			$this->Titulo = $var;
	}

	function setData($var) {	//Altera o valor do atributo Data
			$this->Data = $var;
	}

	function setDescricao($var) {	//Altera o valor do atributo Descricao
			$this->Descricao = $var;
	}
	function setLocal($var) {	//Altera o valor do atributo local
			$this->Local = $var;
	}
	function setRealizacao($var) {	//Altera o valor do atributo Realizacao
			$this->Realizacao = $var;
	}

 function Grava() { //Grava as informações da reuniao

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 function Inclui() { //Insere novo evento

		   $x = 0;

		   $db = new BD();

		   $sql = sprintf("insert into tb_calendario
		   				  (dataevento,titulo,descricao,local,realizacao)
						  values ('%s','%s','%s','%s','%s')",
						   date("Y/m/d",$this->getData()),
						   $this->getTitulo(),
						   $this->getDescricao(),
						   $this->getLocal(),
						   $this->getRealizacao());

    		$db->Exec($sql);

            $this->ID = $db->getInsertID();

			$db->Close();

	}


 function Altera() { //Altera a reunião

		   $db = new BD();

		   $sql = sprintf("update tb_calendario
		                   set dataevento = '%s',
						       titulo = '%s',
						       descricao = '%s',
						       local = '%s',
						       realizacao = '%s'
							   where 
							   idcalendario = %d",
							date("Y/m/d",$this->getData()),
							$this->getTitulo(),
							$this->getDescricao(),
							$this->getLocal(),
							$this->getRealizacao(),
							$this->getID());

     		$db->Exec($sql);

			$db->Close();

	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $db = new BD();
		   
		   $sql = sprintf("delete from tb_calendario where idcalendario = %d"
					   ,$this->getID());
		
     		$db->Exec($sql);
			
			$db->Close();

	}

 function getEventos($filtro) { // Retorna as reuniões cadastradas

           $calendario = array();
		   
		   $db = new BD();
		   
           if ($filtro == 'T')
			   $sql = sprintf("select
						   idcalendario,
						   titulo,
						   dataevento,
						   descricao,
						   local,
						   realizacao
						   from
						   tb_calendario
						   order by dataevento desc");
			else
            if ($filtro == 'P')
			   $sql = sprintf("select
								   idcalendario,
								   titulo,
								   dataevento,
								   descricao,
								   local,
								   realizacao
								   from
								   tb_calendario
								   where
								   dataevento >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)
								   and dataevento <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
								   order by dataevento");
			else
            if ($filtro == 'X')
			   $sql = sprintf("select
								   idcalendario,
								   titulo,
								   dataevento,
								   descricao,
								   local,
								   realizacao
								   from
								   tb_calendario
								   where
								   dataevento >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)
								   order by dataevento");

			$db->Query($sql);

			while($db->Next()) {
					array_push($calendario,$db->Row);
				}	

			$db->Close();

			return $calendario;
	}
}
?>