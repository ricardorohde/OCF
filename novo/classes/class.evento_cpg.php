<?php include("sessao.php"); ?>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bdcpg.php");
////////////////////////////////////////////////////
// Evento_CPG : Lista eventos cadastrados na galeria de fotos
//
//
////////////////////////////////////////////////////

/**
 * Eventos - Classe do cadastro de Eventos da galeria de fotos coopermine
 * @package Evento_CPG
 * @author Alencar Mendes de Oliveira
 */
class Evento_CPG
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////
    private $ID			  = 0;
    private $Titulo		  = "";
    private $Data		  = "00/00/0000";
    private $Miniatura    = "";
    private $Existe       = "N";
    private $db;
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function Evento_CPG($idevento) {

   $db = new BDCPG();
   
   $sql = sprintf("select
			   aid,
			   substr(title,14) title,
			   SUBSTR(title,1,10) data,
		   	   (select concat('/album/albums/',filepath,'thumb_',filename) from cpg14x_pictures where pid = thumb) miniatura			   
               from cpg14x_albums
               where aid= %d",$idevento);

    $db->Query($sql);
	
	if ($db->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$db->Next();
			$this->ID               = $idevento;
			$this->Titulo           = $db->getValue('title');
			$this->Data             = $db->getValue('data');			
			$this->Miniatura        = $_SERVER['DOCUMENT_ROOT'].$db->getValue('miniatura');			
    }
    $db->Close();
 	

    }
	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o codigo do evento
			return $this->ID;
	}
	function getTitulo() {	//Retorna o Titulo do evento 
			return $this->Titulo;
	}
	function getData() {	//Retorna a data do evento 
			return $this->Data;
	}
	function getMiniatura() {	//Retorna a data do evento 
			return $this->Miniatura;
	}	
 function getEventos() { // Retorna os eventos cadastrados

           $eventos = array();
		   
		   $db = new BDCPG();
		   
		   $sql = sprintf("select 
		   					aid,
		   					substr(title,14) title,
		   					SUBSTR(title,1,10) data,
		   					(select concat('/album/albums/',filepath,'thumb_',filename) from cpg14x_pictures where pid = thumb) miniatura
							from cpg14x_albums
							where category = 2
							order by aid desc
							limit 8");
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($eventos,$db->Row);
				}	

			$db->Close();

			return $eventos;

	}
}
?>