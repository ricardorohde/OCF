<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
?>
<?php
/*
	BD - Classe de acesso ao banco de dados
	Descrição: Executa operações no banco de dados
	Desenvolvido: Alencar
	Data: 14/07/2012
*/
class BDSMS extends BD
{
 		
function BDSMS () { //Construtor da classe

     $this->Conecta();

}

function Conecta() {

	if ($_SERVER['HTTP_HOST'] == 'localhost') {
			$this->Link = mysql_connect('franca.sytes.net', 'usr_smslib', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("smslib",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
//		    echo ('Banco localhost');
	}
	else
	{
			$this->Link = mysql_connect('franca.sytes.net', 'usr_smslib', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("smslib",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
	}

//    ini_set('default_charset','utf-8');
//      mysql_set_charset('utf-8'); 
//	mysql_query("SET NAMES 'utf-8'");
//mysql_query('SET character_set_connection=latin1');
//mysql_query('SET character_set_client=latin1');
//mysql_query('SET character_set_results=latin1');
 // define("SET CHARACTER SET UTF-8");
  //  define("SET COLLATION_CONNECTION='utf8_general_ci'");

//	define("SET CHARACTER SET ascii");
//	define("SET COLLATION_CONNECTION='ascii_general_ci'");

}
	function getValue($ColName) { //Retorna o valor de uma coluna

		return mb_convert_encoding($this->Row[$ColName], "ISO-8859-1", "UTF-8");
//		return $this->Row[$ColName];
	}
}
?>