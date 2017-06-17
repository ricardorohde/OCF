<?php include("/home/bolaodo/public_html/sessao.php"); ?>

<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Jogo Copa
//
// Classe para tratamento dos Jogos da Copa
//
////////////////////////////////////////////////////

/**
 * JogoCopa - Classe do cadastro de Rodadas da Copa
 * @package JogoCopa
 * @author Alencar Mendes de Oliveira
 */
class JogoCopa
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Rodada           = 0;			//Numero da rodada
    var $Campeonato       = 0;			//Código do campeonato
    var $Jogo             = 0;			//Numero do jogo na rodada
	var $Mandante		  = 0;			//Codigo do usuario mandante
	var $Visitante		  = 0;			//Codigo do usuario visitante
	var $GolsMa			  = 0;			//Gols do mandante
	var $GolsVi			  = 0;		    //Gols do Visitante
	var $PontosMa		  = 0;			//Pontos do Mandante no jogo
	var $PontosVI		  = 0;			//Pontos do Visitante no jogo
	var $Grupo			  = 0;			//Grupo do jogo
				
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function JogoCopa($camp,$rod,$jg) {
   
   $db = new BD();
   
   $sql = sprintf("select  
			   campeonato,
			   rodada,
			   jogo,
			   tipo,
			   userid,
			   golsp,
			   pontos,
			   grupo
			   from
               cad_rodada_copa
               where campeonato = %d
			   and rodada = %d
			   and jogo = %d",$camp,$rod,$jg);

    $db->Query($sql);
	
    $this->Campeonato       = $camp;
	$this->Rodada	        = $rod;
	$this->Jogo 	        = $jg;
	while ($db->Next()) {
	
			if ($db->getValue('tipo') == 'M') {
				$this->Mandante = $db->getValue('userid');
				$this->GolsMa	= $db->getValue('golsp');
				$this->PontosMa = $db->getValue('pontos');
				}
			else {
				$this->Visitante = $db->getValue('userid');
				$this->GolsVi	 = $db->getValue('golsp');
				$this->PontosVi  = $db->getValue('pontos');
			}

		$this->Grupo = $db->getValue('grupo');

		}

    $db->Close();

    }

	function getCampeonato() { 	return $this->Campeonato; }
	function getRodada() { 	return $this->Rodada; }
	function getJogo() {  return $this->Jogo; }
	function getMandante() {   return $this->Mandante; }
    function getGolsMandante() { return $this->GolsMa; }
	function getPontosMandante() { return $this->PontosMa; }
	function getVisitante() {   return $this->Visitante; }
    function getGolsVisitante() { return $this->GolsVi; }
	function getPontosVisitante() { return $this->PontosVi; }

}

?>