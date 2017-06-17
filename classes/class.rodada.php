<?php include("/home/bolaodo/public_html/sessao.php"); ?>

<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Rodada
//
// Classe para tratamento das Rodadas
//
////////////////////////////////////////////////////

/**
 * Rodada - Classe do cadastro de Rodadas
 * @package Rodada
 * @author Alencar Mendes de Oliveira
 */
class Rodada
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Rodada           = 0;
    var $Campeonato       = 0;
    var $Jogos            = array();

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Rodada($camp,$rod) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   campeonato,
			   rodada,
			   jogo
			   from
               cad_rodada
               where campeonato = %d
			   and rodada = %d",$camp,$rod);

    $db->Query($sql);
	

    $this->Campeonato       = $camp;
	$this->Rodada	        = $rod;
	while ($db->Next()) {
			array_push($this->Jogos,$db->getValue('jogo'));
		}

    $db->Close();

    }

	function getCampeonato() {
		return $this->Campeonato;
	}
	function getRodada() {
			return $this->Rodada;
	}
	function getJogos() {
			return $this->Jogos;
	}

	function getInicio() { //Retorna a data e hora inicio da rodada

		   $dataini = 0;

		   $db = new BD();
		   
		   $sql = sprintf("select
					   min(addtime(data,hora)) dataini
					   from
					   cad_rodada
					   where 
					   campeonato= %d 
					   and rodada = %d"
					   ,$this->getCampeonato()
					   ,$this->getRodada());
		
			$db->Query($sql);
			
			$db->Next();
		
			$dataini = $db->getValue('dataini');
			$db->Close();

   			return $dataini;
	}
	
	function getFim() { //Retorna o numero da ultima rodada
     	   $datafim = 0;
		   	
		   $db = new BD();
		   
		   $sql = sprintf("select
					   max(addtime(data,hora)) datafim
					   from
					   cad_rodada
					   where 
					   campeonato= %d 
					   and rodada = %d"
					   ,$this->getCampeonato()
					   ,$this->getRodada());
			
			$db->Query($sql);
			
			$db->Next();
		
			$datafim = $db->getValue('datafim');
			$db->Close();

   			return $datafim;
	}
	

}

?>