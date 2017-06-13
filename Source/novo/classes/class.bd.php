<?php
/*
	BD - Classe de acesso ao banco de dados
	Descrição: Executa operações no banco de dados
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
function BD ($bdlink) { //Construtor da classe

     $this->Conecta();
     
     mysql_select_db($bdlink,$this->Link)
 		or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 

}
*/

/*

*/
function Conecta() {


/*    if ($_SERVER['HTTP_HOST'] == 'clubedoopala.sytes.net') {
			$this->Link = mysql_connect('localhost', 'bolao', 'bolao')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("clubedoopala",$this->Link) 
	 				or die('\nErro Selecionando DB teste: ' . mysql_error($this->Link)); 
			}
    elseif ($_SERVER['HTTP_HOST'] == 'localhost') {*/
			$this->Link = mysql_connect('localhost', 'root', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("opalaclubefran",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
//		    echo ('Banco localhost');
/*	}
	else
	{
			$this->Link = mysql_connect('mysql.opalaclubefranca.com.br', 'opalaclubefran', 'racnela')
				or die('Erro BD_Conecta: ' ."<br>". mysql_error($this->Link)); 
			mysql_select_db("opalaclubefran",$this->Link)
	 				or die('\nErro Selecionando DB prod: ' . mysql_error($this->Link)); 
		}*/


/*  ini_set('default_charset','utf-8');
  mysql_set_charset('utf-8'); 
 mysql_query("SET NAMES 'utf-8'");*/
//mysql_query('SET character_set_connection=latin1');
//mysql_query('SET character_set_client=latin1');
//mysql_query('SET character_set_results=latin1');
//define("SET CHARACTER SET latin1");
//define("SET COLLATION_CONNECTION='utf8_general_ci'");

 // ini_set('default_charset','latin1');
//  ini_set('COLLATION_CONNECTION','ISO-8859-1');

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
	function Next() { //Carrega Próximo registro da tabela

		if ($this->Row = $this->Fetch())
			return TRUE;
		else
			return FALSE;	

	}
/*


*/
	function getValue($ColName) { //Retorna o valor de uma coluna
//		return mb_convert_encoding($this->Row[$ColName], "ISO-8859-1", "UTF-8");
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
	function NumRows() { //Retorna o Número de linhas do ResultSet

       if ($this->ResultSet)
    	   return mysql_num_rows($this->ResultSet);
	   else
	   	   return 0;

	}

	function getInsertID() { //Retorno o último insert_id gerado

	   return mysql_insert_id ($this->Link);
	}

/*
	Funcão: BD_GravaLog
	Descrição: Gera log dos comandos sql executados no banco
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