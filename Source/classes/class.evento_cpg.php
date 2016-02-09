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
			   title
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

 function getEventos() { // Retorna os eventos cadastrados

           $eventos = array();
		   
		   $db = new BDCPG();
		   
		   $sql = sprintf("select aid,title from cpg14x_albums
					where category = 2
					order by aid desc");
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($eventos,$db->Row);
				}	

			$db->Close();

			return $eventos;

	}
}
?>