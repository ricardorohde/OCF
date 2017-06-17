<?php
////////////////////////////////////////////////////
// Time - classe time
//
// Classe time para acesso aos atributos dos times cadastrados
////////////////////////////////////////////////////

class Time
{
    /////////////////////////////////////////////////
    // Variáveis publicas
    /////////////////////////////////////////////////


private:
    int    $Codigo      = 0;
    string $Nome 		= " ";
    string $Tipo        = " ";
    boolean $Cadastrado	= false;

    
    function Time($codigo) {

   		$this->CarregaDados($codigo);

    }


	/*
	 * Retorna o código do time na instancia da classe
	 */
	public  function getCodigo() {
    	return $this->Codigo;	
    }
	/*
	 * Retorna o nome do time na instância da classe
	 */
	public  function getNome() {
    	return $this->Nome;	
    }

	/*
	 * Retorna o tipo do time na instância da classe
	 */
	public function getTipo() {
    	return $this->Tipo;	
    }


	/*
	 * Retorna o link para informações do time
	 */
	public  function getLink() {
    	
    	$a = sprintf ("<a href='lst_infotime.php?time=%d'>%s</a>",$this->Codigo,$this->Nome);
    	
    	return $a;	
    }
    /**
     * @access private
     * @return void
     */
	public	function CarregaDados($codigo) {

		  $sql = sprintf("Select codigo,nome,tipo from cad_times where codigo = %d",$codigo);
	
		  $result = mysql_query($sql)
				or die('\nErro consultando cad_times na classe Time: ' . mysql_error()); 
		
          $row = mysql_fetch_assoc($result);

          if (mysql_num_rows($result)) {
              $this->Cadastrado = true;
			  $this->Codigo = $codigo;
	          $this->Nome = $row['nome'];
	          $this->Tipo = $row['tipo'];
          }
          else {
          	$this->Cadastrado = false;
          }
          
		mysql_free_result($result);
		
	}

}

?>