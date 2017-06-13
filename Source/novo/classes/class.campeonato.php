<?php include("/home/bolaodo/public_html/sessao.php"); ?>

<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Campeonatos - classe Campeonato
//
// Classe para tratamento dos Campeonatos
//
////////////////////////////////////////////////////

/**
 * Campeonato - Classe do cadastro de Campeonato
 * @package Campeonato
 * @author Alencar Mendes de Oliveira
 */
class Campeonato
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Codigo           = "";
    var $Descricao        = "";
    var $Ano              = "";
    var $ValorInscricao   = "";
    var $Tipo             = 0;
    var $Andamento        = "";

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Campeonato($codigo) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   descricao,
			   ano,
			   valorinscr,
			   tipo,
			   flandamento
			   from
               cad_campeonato
               where codigo= %d",$codigo);

    $db->Query($sql);
	
    $row = $db->Fetch();

    $this->Codigo           = $codigo;
    $this->Descricao        = $row['descricao'];
    $this->Ano              = $row['ano'];
    $this->ValorInscricao   = $row['valorinscr'];
    $this->Tipo             = $row['tipo'];
    $this->Andamento        = $row['flandamento'];
    $db->Close();

    }

	function getCodigo() {
		return $this->Codigo;
	}
	function getDescricao() {
			return $this->Descricao;
	}
	function getAno() {
			return $this->Ano;
	}
	function getDescricaoAno() {
			return $this->Descricao.'-'.$this->Ano;
	}
	
	function getValorInscricao() {
			return $this->ValorInscricao;
	}
	function getTipo() {
			return $this->Tipo;
	}
	function getAndamento() {
			return $this->Andamento;
	}


   /*
	   Retorna a lista de campeonatos cadastrados conforme o tipo
   	   Tipo
	   		A = Retorna somente os campeonatos em andamento
			T = Retorna todos os campeonatos cadastrados
			E = Retorna somente os campeonados encerrados
   */	

	function getCampeonatos($tipo) { 

           $wh = "";
		   $Cmp = array();
		   
           if ($tipo == 'A')
		   		$wh = "where flandamento = 'S'";
			elseif($tipo == 'E')
				$wh = "where flandamento <> 'S'";
			else
				$wh = "";

		   $db = new BD();

		   $sql = sprintf("select codigo
							from 
								cad_campeonato
							%s" 
							,$wh);

			$db->Query($sql);
			
			while ($db->Next()) {
					array_push($Cmp,$db->getValue('codigo'));
				}

			$db->Close();

   			return $Cmp;
	}




	function getPrimeiraRodada() { //Retorna o numero da primeira rodada
		   $Rodada = 0;
		   	
		   $db = new BD();
		   
		   $sql = sprintf("select
					   min(rodada) rodada
					   from
					   cad_rodada
					   where campeonato= %d",$this->Codigo);
		
			$db->Query($sql);
			
			$db->Next();
		
			$Rodada = $db->getValue('rodada');
			$db->Close();

   			return $Rodada;
	}
	
	function getUltimaRodada() { //Retorna o numero da ultima rodada
	   $Rodada = 0;
		   	
		   $db = new BD();
		   
		   $sql = sprintf("select
					   max(rodada) rodada
					   from
					   cad_rodada
					   where campeonato= %d",$this->Codigo);
		
			$db->Query($sql);
			
			$db->Next();
		
			$Rodada = $db->getValue('rodada');
			$db->Close();

   			return $Rodada;
	}
	
	function getRodadaAtual() { //Retorna o numero da rodada atual
	       $Rodada = 0;
		   	
		   $db = new BD();
		   
		   $sql = sprintf("select max(rodada) rodada
							from cad_rodada
							where campeonato = %d
							and date_add(now(),interval 1 hour) > subtime(addtime(data, hora),'06:00:00')",$this->Codigo);
		
			$db->Query($sql);
			
			$db->Next();
		 
		 
			$Rodada = $db->getValue('rodada');
			$db->Close();

   			return $Rodada;
	}
	
	function getRodadaAnterior() { //Retorna o numero da rodada atual
	       $Rodada = 0;
		   	
		   $db = new BD();
		   
		   $sql = sprintf("select ifnull(max(rodada),0) rodada
							from cad_rodada
							where campeonato = %d
							and rodada < %d",$this->Codigo,$this->getRodadaAtual());
		
			$db->Query($sql);
			
			$db->Next();
		
			$Rodada = $db->getValue('rodada');
			$db->Close();

   			return $Rodada;
	}
	
	function getProximaRodada() { //Retorna o numero da rodada atual
	       $Rodada = 0;
		   	
		   $db = new BD();
		   
		   $sql = sprintf("select ifnull(min(rodada),0) rodada
							from cad_rodada
							where campeonato = %d
							and rodada > %d",$this->Codigo,$this->getRodadaAtual());
		
			$db->Query($sql);
			
			$db->Next();
		
			$Rodada = $db->getValue('rodada');
			$db->Close();

   			return $Rodada;
	}

	function getArtilheiro() { //Retorna quem marcou mais gols no campeonato

		   $db = new BD();

		   $sql = sprintf("select userid,golsp gols
							from 
								cad_inscricao
							where 
								campeonato = %d
								and flcopa = 'S'
								and campeonato in (select distinct campeonato from cad_rodada)
							order by 
								golsp desc,posefetiva
							limit 1",$this->getCodigo());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

	function getPiorDefesa() { //Retorna o usuario que sofreu mais gols no campeonato

		   $db = new BD();

		   $sql = sprintf("select userid,golsc gols
							from 
								cad_inscricao
							where 
								campeonato = %d
								and flcopa = 'S'
								and campeonato in (select distinct campeonato from cad_rodada)
							order by 
								golsc desc,posefetiva desc
							limit 1",$this->getCodigo());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

	function getPiorAtaque() { //Retorna o usuario que marcou menos gols no campeonato

		   $db = new BD();

		   $sql = sprintf("select userid,golsp gols
							from 
								cad_inscricao
							where 
								campeonato = %d
								and flcopa = 'S'
								and campeonato in (select distinct campeonato from cad_rodada)
							order by 
								golsp,posefetiva desc
							limit 1",$this->getCodigo());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}

	function getMelhorDefesa() { //Retorna o usuario que sofreu menos gols no campeonato

		   $db = new BD();

		   $sql = sprintf("select userid,golsc gols
							from 
								cad_inscricao
							where 
								campeonato = %d
								and flcopa = 'S'
								and campeonato in (select distinct campeonato from cad_rodada)
							order by 
								golsc,posefetiva
							limit 1",$this->getCodigo());

			$db->Query($sql);
			
			$rowart = $db->Fetch();
		
			$db->Close();

   			return $rowart;
	}


}

?>