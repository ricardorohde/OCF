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
class BDFORUM extends BD
{
 		
function BDFORUM () { //Construtor da classe

     $this->Conecta();
     
}

function Conecta() {
	
    if ($_SERVER['HTTP_HOST'] == 'clubedoopala.sytes.net') {
			$this->Link = mysql_connect('localhost', 'bolao', 'bolao')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("clubedoopala",$this->Link) 
	 				or die('\nErro Selecionando DB teste: ' . mysql_error($this->Link)); 
			}
    elseif ($_SERVER['HTTP_HOST'] == 'ocf.localhost') {
			$this->Link = mysql_connect('localhost', 'root', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("opalaclubefran01",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
//		    echo ('Banco localhost');
	}
    elseif ($_SERVER['HTTP_HOST'] == 'localhost') {
			$this->Link = mysql_connect('localhost', 'root', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("opalaclubefran01",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
//		    echo ('Banco localhost');
	}
	else
	{
			$this->Link = mysql_connect('localhost', 'opalaclubefran01', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("opalaclubefran01",$this->Link)
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

//		return mb_convert_encoding($this->Row[$ColName], "ISO-8859-1", "UTF-8");
		Return $this->Row[$ColName];
	}
}
?>
