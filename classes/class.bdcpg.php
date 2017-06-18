<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
?>
<?php
/*
	BD - Classe de acesso ao banco de dados
	Descri��o: Executa opera��es no banco de dados
	Desenvolvido: Alencar
	Data: 28/01/2006
*/
class BDCPG extends BD
{
 		
function BDCPG () { //Construtor da classe

     $this->Conecta();
     
}

function Conecta() {
	
 			$server = '107.180.21.14'; //$url["host"];
			$username = 'opalaclubefranca';
			$password = 'Jf?lOi~_a4%^';
			$db = 'opalaclubefranca';

			$this->Link = new mysqli($server, $username, $password, $db);
			
			if ($this->Link->connect_errno)
				die('Erro BD_Conecta: '	 ."<br>". $this->Link.connect_errno.' '.$this->Link.connect_error); 
				
//    ini_set('default_charset','utf-8');
	//mysql_set_charset('latin1'); 
//	mysql_query("SET NAMES 'latin1'");
//mysql_query('SET character_set_connection=latin1');
//mysql_query('SET character_set_client=latin1');
//mysql_query('SET character_set_results=latin1');
  //  define("SET CHARACTER SET UTF-8");
//    define("SET COLLATION_CONNECTION='utf8_general_ci'");

}
	function getValue($ColName) { //Retorna o valor de uma coluna

		return $this->Row[$ColName];

//		return mb_convert_encoding($this->Row[$ColName], "ISO-8859-1", "UTF-8");

	}
}
?>
