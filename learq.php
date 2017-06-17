<html>
<head>
</head>
<body>
<?php
echo ("<h1>abertura</h1>");

$f = fopen("arquivo.txt","r") or die('Erro na abertura do arquivo');
$w = fopen("saida.txt","w") or die('Erro na abertura do arquivo');

echo ("<h1>abriu</h1>");

$data=''; 
$Nomeparte = '';
$valor = 0;

echo ("<h1>Leitura</h1>");

while(!feof($f)) { 
//	echo ("<h5>Leitura</h5>");
	
       $data=fgets($f);

       //echo "\n".$data;

	   if (!strncmp("Total da Parte",$data,14)) {

	   			 fwrite($w,str_replace(chr(10),';',str_replace(chr(13),';',$data)).chr(13).chr(10));
//	   			 $NomeParte =fgets($f);
//	   			 $valor= fgets($f);
	   }
}

echo ("<h1>Fechamento</h1>");

fclose($f); 

echo ("<h1>Encerra</h1>");

?>
</body>
</html>