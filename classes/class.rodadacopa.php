<?php include("/home/bolaodo/public_html/sessao.php"); ?>

<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Rodada Copa
//
// Classe para tratamento das Rodadas da copa bolão
//
////////////////////////////////////////////////////

/**
 * Rodada - Classe do cadastro de Rodadas da Copa
 * @package RodadaCopa
 * @author Alencar Mendes de Oliveira
 */
class RodadaCopa
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Rodada           = 0;			//Numero da rodada
    var $Campeonato       = 0;			//Código do campeonato
    var $Jogos            = array();	//Tabela de jogos da rodada

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function RodadaCopa($camp,$rod) {
   
   $db = new BD();
   
   $sql = sprintf("select distinct 
			   campeonato,
			   rodada,
			   jogo
			   from
               cad_rodada_copa
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

	function getArtilheiro() { //Retorna quem marcou mais gols na rodada

		   $db = new BD();

		   $sql = sprintf("select p.userid,p.golsp gols
							from 
								cad_posrodada p,
								cad_inscricao i
							where 
								p.campeonato = i.campeonato
								and p.userid = i.userid
								and p.campeonato = %d
								and p.rodada = %d
								and i.flcopa = 'S'
							order by 
								p.golsp desc,p.posefetiva
							limit 1",$this->getCampeonato(),$this->getRodada());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

	function getPiorDefesa() { //Retorna o usuario que sofreu mais gols na rodada

		   $db = new BD();

		   $sql = sprintf("select p.userid,p.golsc gols
							from 
								cad_posrodada p,
								cad_inscricao i
							where 
								p.campeonato = i.campeonato
								and p.userid = i.userid
								and p.campeonato = %d
								and p.rodada = %d
								and i.flcopa = 'S'
							order by 
								p.golsc desc,p.posefetiva desc
							limit 1",$this->getCampeonato(),$this->getRodada());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

	function getPiorAtaque() { //Retorna o usuario que marcou menos gols na rodada

		   $db = new BD();

		   $sql = sprintf("select p.userid,p.golsp gols
							from 
								cad_posrodada p,
								cad_inscricao i
							where 
								p.campeonato = i.campeonato
								and p.userid = i.userid
								and p.campeonato = %d
								and p.rodada = %d
								and i.flcopa = 'S'
							order by 
								p.golsp,p.posefetiva desc
							limit 1",$this->getCampeonato(),$this->getRodada());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

	function getMelhorDefesa() { //Retorna o usuario que sofreu menos gols no campeonato

		   $db = new BD();

		   $sql = sprintf("select p.userid,p.golsc gols
							from 
								cad_posrodada p,
								cad_inscricao i
							where 
								p.campeonato = i.campeonato
								and p.userid = i.userid
								and p.campeonato = %d
								and p.rodada = %d
								and i.flcopa = 'S'
							order by 
								p.golsc,p.posefetiva
							limit 1",$this->getCampeonato(),$this->getRodada());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

}

?>