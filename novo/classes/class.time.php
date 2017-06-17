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
class Time
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Codigo           = "";
    var $Nome             = "";
    var $Tipo             = "";
    var $Simbolo          = "";

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Time($codigo) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   codigo,
			   nome,
			   tipo,
			   simbolo
			   from
               cad_times
               where codigo= %d",$codigo);

    $db->Query($sql);
	
    $db->Next();

    $this->Codigo           = $codigo;
    $this->Nome             = $db->getValue('nome');
    $this->Tipo             = $db->getValue('tipo');
    $this->Simbolo          = $db->getValue('simbolo');

    $db->Close();

    }

	function getCodigo() { //Retorna o codigo do time
		return $this->Codigo;
	}
	function getNome() {	//Retorna o Nome do time
			return $this->Nome;
	}
	function getTipo() {	//Retorna o tipo do time
			return $this->Tipo;
	}
	function getSimbolo() {	//Retorna o caminho do simbolo
			return $this->Simbolo;
	}

	function getLink() { //Retorna o nome do time com link para a tela de detalhes do time
	
	   $js = " ";
	   $lnk = " ";

	   $js = sprintf("javascript:janela('./lst/lst_dettime.php?cod=%d',10,50,650,500);",$this->getCodigo());
	   
       $smb = "";
       if ( $this->getSimbolo() != NULL )
	      if ($this->getTipo() != 'S')
             $smb = '<img src="'.$this->getSimbolo().'" border=none  width=17 height=17 alt title="'.$this->getNome().'">';
		  else	
             $smb = '<img src="'.$this->getSimbolo().'" border=none alt title="'.$this->getNome().'">';

		$lnk = $smb.'<a href="'.$js.'">'.$this->getNome().'</a>';
	
		return $lnk;
	
	}

	function getHistorico() { //Retorna uma matriz com o historico de confrontos do time

           $Hst = array();
		   
		   $db = new BD();
		   
		   $sql = sprintf("select
					   campeonato,
					   rodada,
					   manda,
					   vi.nome visitante,
					   ma.nome mandante,
					   visita,
					   golsma,
					   golsvi,
					   addtime(data,hora) datahora
					   from
					   cad_rodada,
					   cad_times ma,
					   cad_times vi
					   where 
					   (manda = %d
					   or visita = %d)
					   and ma.codigo = manda
					   and vi.codigo = visita
   					   order by campeonato desc,rodada desc,data desc,hora desc"
					   ,$this->getCodigo(),$this->getCodigo());
		
			$db->Query($sql);
			
			while ($db->Next()) {
					array_push($Hst,$db->Row);
			}
			$db->Close();

   			return $Hst;
	}
	
}

?>