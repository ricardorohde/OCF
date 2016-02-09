<?php include("/home/bolaodo/public_html/sessao.php"); ?>

<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Inscricao - classe inscricao
//
// Classe para tratamento do objeto inscrição
//
////////////////////////////////////////////////////

/**
 * Inscricao - Classe do cadastro de Inscrições
 * @package Inscricao
 * @author Alencar Mendes de Oliveira
 */
class Inscricao
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Userid           = 0;  //Usuario da inscricao
    var $Campeonato       = 0;	//Campeonato da inscricao
    var $DataInscricao    = "";	//Data da inscricao
    var $Pago             = "";	//Pago "S"
    var $DataPagto        = "";	//Data do Pagamento da inscricao
    var $UseridPagto      = 0;	//Usuário que registrou o pagamento da inscricao
	var $Status			  = 0;	//Status da inscricao
	var $Bonus			  = 0;	//Bonus por títulos de rodadas
	var $Posicao		  = 0;	//Posição do usuário no campeonato
	var $Pontos			  = 0;	//Pontos marcados no campeonato
	var $BonusRecRodadas  = 0;	//Bonus por recorde de pontos numa rodada
	var $TitulosRodadas   = 0;	//Número de títulos de rodadas
	var $MaiorPontuacao   = 0;	//Maior Pontuação numa rodada
	var $Qtde1            = 0;	//Qtde de títulos de rodadas
	var $Qtde2			  = 0;	//Qtde de segundos lugares nas rodadas
	var $Qtde3		      = 0;	//Qtde de terceiros lugares nas rodadas
	var $Qtde4            = 0;	//Qtde de quartos lugares nas rodadas
	var $Qtde5            = 0;	//Qtde de quintos lugares nas rodadas
	var $PosEfetiva       = 0;	//Posição efetiva no campeonato
	var $QtdeB1			  = 0;	//Qtde de primeiros lugares bonificados
	var $QtdeB2			  = 0;	//Qtde de segundos lugares bonificados
	var $QtdeB3			  = 0;	//Qtde de terceiros lugares bonificados
	var $QtdeB4	          = 0;	//Qtde de quartos lugares bonificados
	var $QtdeB5           = 0;	//Qtde de quintos lugares bonificados
	var $Flag1 			  = 0;	//Indica se foi bonificado pelo primeiro lugar
	var $Flag2			  = 0;	//Indica se foi bonificado pelo segundo lugar
	var $Flag3			  = 0;	//Indica se foi bonificado pelo terceiro lugar
	var $Flag4			  = 0;	//Indica se foi bonificado pelo quarto lugar
	var $Flag5			  = 0;	//Indica se foi bonificado pelo quinto lugar
	var $Golsp			  = 0;	//Gols marcados no campeonato
	var $Golsc			  = 0;	//Gols sofridos no campeonato

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Inscricao($Campeonato,$Userid) {
   
   $db = new BD();
   
   $sql = sprintf("select
				   Userid        
				  ,Campeonato    
				  ,DataInscricao 
				  ,flPago          
				  ,DataPgto     
     			  ,UseridPgto   
					,Status	       
					,Bonus		     
					,Posicao	     
					,Pontos	       
					,BonusRecRod   
					,TitulosRod    
					,MaiorPont
					,Qtde1         
					,Qtde2		     
					,Qtde3		     
					,Qtde4         
					,Qtde5         
					,PosEfetiva    
					,QtdB1	       
					,QtdB2	       
					,QtdB3	       
					,QtdB4	       
					,QtdB5        
					,Flag1 	       
					,Flag2		     
					,Flag3		     
					,Flag4		     
					,Flag5		     
					,golsp		     
					,golsc		     
				from cad_inscricao
               where campeonato= %d and userid = %d",$Campeonato,$Userid);

    $db->Query($sql);
	
    $db->Next();

		$this->Userid   		= $db->getValue('Userid');   			        
		$this->Campeonato       = $db->getValue('Campeonato');      
		$this->DataInscricao    = $db->getValue('DataInscricao');   
		$this->Pago             = $db->getValue('flPago');            
		$this->DataPagto        = $db->getValue('DataPagto');       
		$this->UseridPagto      = $db->getValue('UseridPagto');     
		$this->Status			= $db->getValue('Status');			    
		$this->Bonus			= $db->getValue('Bonus');			      
		$this->Posicao		    = $db->getValue('Posicao');		      
		$this->Pontos			= $db->getValue('Pontos');			    
		$this->BonusRecRodadas  = $db->getValue('BonusRecRod'); 
		$this->TitulosRodadas   = $db->getValue('TitulosRod'); 
		$this->MaiorPontuacao   = $db->getValue('MaiorPont');  
		$this->Qtde1            = $db->getValue('Qtde1');           
		$this->Qtde2			= $db->getValue('Qtde2');			      
		$this->Qtde3		    = $db->getValue('Qtde3');		        
		$this->Qtde4            = $db->getValue('Qtde4');           
		$this->Qtde5            = $db->getValue('Qtde5');           
		$this->PosEfetiva       = $db->getValue('PosEfetiva');      
		$this->QtdeB1			= $db->getValue('QtdB1');			    
		$this->QtdeB2			= $db->getValue('QtdB2');			    
		$this->QtdeB3			= $db->getValue('QtdB3');			    
		$this->QtdeB4	        = $db->getValue('QtdB4');	        
		$this->QtdeB5           = $db->getValue('QtdB5');          
		$this->Flag1 	        = $db->getValue('Flag1'); 			    
		$this->Flag2		    = $db->getValue('Flag2');			      
		$this->Flag3		    = $db->getValue('Flag3');			      
		$this->Flag4		    = $db->getValue('Flag4');			      
		$this->Flag5		    = $db->getValue('Flag5');			      
		$this->Golsp		    = $db->getValue('golsp');			      
		$this->Golsc		    = $db->getValue('golsc');			      
	    $db->Close();

    }

	function getUserid() {  return $this->Userid;    }   			
	function getCampeonato() {  return $this->Campeonato;    }     
	function getDataInscricao() {  return $this->DataInscricao;    }  
	function getPago() {  return $this->Pago;    }           
	function getDataPagto() {  return $this->DataPagto;    }      
	function getUseridPagto() {  return $this->UseridPagto;    }    
	function getStatus() {  return $this->Status;    }			    
	function getBonus() {  return $this->Bonus;    }			    
	function getPosicao() {  return $this->Posicao;    }		    
	function getPontos() {  return $this->Pontos;    }			    
	function getBonusRecRodadas() {  return $this->BonusRecRodadas;    }
	function getTitulosRodadas() {  return $this->TitulosRodadas;    } 
	function getMaiorPontuacao() {  return $this->MaiorPontuacao;    } 
	function getQtde1() {  return $this->Qtde1;    }          
	function getQtde2() {  return $this->Qtde2;    }			    
	function getQtde3() {  return $this->Qtde3;    }		      
	function getQtde4() {  return $this->Qtde4;    }          
	function getQtde5() {  return $this->Qtde5;    }          
	function getPosEfetiva() {  return $this->PosEfetiva;    }     
	function getQtdeB1() {  return $this->QtdeB1;   }			    
	function getQtdeB2() {  return $this->QtdeB2;    }			    
	function getQtdeB3() {  return $this->QtdeB3;    }			    
	function getQtdeB4() {  return $this->QtdeB4;    }	        
	function getQtdeB5() {  return $this->QtdeB5;    }         
	function getFlag1() {  return $this->Flag1;    } 			    
	function getFlag2() {  return $this->Flag2;    }			    
	function getFlag3() {  return $this->Flag3;    }			    
	function getFlag4() {  return $this->Flag4;    }			    
	function getFlag5() {  return $this->Flag5;    }			    
	function getGolsp() {  return $this->Golsp;    }			    
	function getGolsc() {  return $this->Golsc;    }			    



	function getLinkPontos() {

	    return $this->montaLnkPts(($this->getPontos()+$this->getBonus()+$this->getBonusRecRodadas()));
	
	}
 
	function getLinkPontosParam($pts) {
		return $this->montaLnkPts($pts);
	}

    function montaLnkPts($pt) {
	 $js = " ";
	 $lnk = " ";
	 
	   $js = sprintf ("javascript:janela('lst_detalhe.php?camp=%d&usr=%d&org=1',10,50,660,600);",$this->Campeonato,$this->Userid);

	   $lnk = '<a href="'.$js.'">'.$pt.'</a>';
	
	   return $lnk;
	}

	function getJogosCopa($rodada) {

	$Adv = array();
		
	   $db = new BD();
	
	   $sql = sprintf ("select jogo
						 from cad_rodada_copa
						 where campeonato = %d
						 and rodada = %d
						 and userid = %d",
						$this->getCampeonato(),
						$rodada,
						$this->getUserid());
						

	    $db->Query($sql);
	
    	while($db->Next()) {
			array_push($Adv,$db->getValue('jogo'));
		}
		
		$db->Close();	

		return $Adv;	
	}

}

?>