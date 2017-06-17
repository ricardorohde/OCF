<?php
/*
	BD - Classe de acesso ao banco de dados
	Descri��o: Executa opera��es no banco de dados
	Desenvolvido: Alencar
	Data: 28/01/2006
*/
class BD
{
 
		var $Link = "";
		var $ResultSet = "";
		var $Row = "";
		
function BD () { //Construtor da classe

     $this->Conecta();

}
/*
mysql://be9f415ede8850:4b611055@us-cdbr-iron-east-03.cleardb.net/heroku_1bdeda7a0b68034?reconnect=true
*/
function Conecta() {
	
    if ($_SERVER['HTTP_HOST'] == 'clubedoopala.sytes.net') {
			$this->Link = mysql_connect('localhost', 'bolao', 'bolao')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("clubedoopala",$this->Link) 
	 				or die('\nErro Selecionando DB teste: ' . mysql_error($this->Link)); 
			}
	else
	{
			$this->Link = mysql_connect('us-cdbr-iron-east-03.cleardb.net', 'be9f415ede8850', '4b611055')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("heroku_1bdeda7a0b68034",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
		}

//	define("SET CHARACTER SET ascii");
//	define("SET COLLATION_CONNECTION='ascii_general_ci'");

}
/*

*/
function Close() {
	
//   $this->Free();

/*   if ($this->Link != NULL)
	   mysql_close($this->Link); */

}

/*

*/
function Query ($strsql) {
	 
     $this->GravaLog($strsql);
	 
     $this->ResultSet = mysql_query($strsql,$this->Link)
	 				or die('\nErro BD_Query: ' . mysql_error($this->Link)); 

//	 return $this->Fetch(); 
}

/*

*/
function Exec ($strsql) {

     $this->GravaLog($strsql);
//	 echo ($strsql)."\n";
	 
     $this->ResultSet = mysql_query($strsql,$this->Link)
	 				or die('\nErro BD_Exec: ' . mysql_error($this->Link)); 

//	 return $this->Fetch(); 
}

/*


*/
	function Fetch() { //Retorna matriz de resultados

		return mysql_fetch_assoc($this->ResultSet);

	}

/*


*/
	function Next() { //Carrega Pr�ximo registro da tabela

		if ($this->Row = $this->Fetch())
			return TRUE;
		else
			return FALSE;	

	}
/*


*/
	function getValue($ColName) { //Retorna o valor de uma coluna

		return $this->Row[$ColName];

	}

/*

*/
	function Free() { //Libera o ResultSet
	 
 	     if ($this->NumRows() > 0)
		 	 mysql_free_result($this->ResultSet);

		 return;
		 
	}
/*

*/
	function NumRows() { //Retorna o N�mero de linhas do ResultSet

       if ($this->ResultSet)
    	   return mysql_num_rows($this->ResultSet);
	   else
	   	   return 0;

	}

	function getInsertID() { //Retorno o �ltimo insert_id gerado

	   return mysql_insert_id ($this->Link);
	}

/*
	Func�o: BD_GravaLog
	Descri��o: Gera log dos comandos sql executados no banco
	Desenvolvido: Alencar
	Data: 28/01/2006
*/

	function GravaLog($strsql) {

       return;

       $sqllog = sprintf ('insert into log_bolao
	   						(datahora,userid,strsql,programa)
							values ("%s",%d,"%s","%s")',date("Y-m-d H-i-s"),$_SESSION['userid'],		$strsql,$_SERVER['SCRIPT_NAME']);
	
	   
       $this->ResultSet = mysql_query($sqllog,$this->Link)
	 				or die('\nErro incluindo registro no log: ' . mysql_error($this->Link)); 

       //$this->Free();
	      
	}
}
?>
