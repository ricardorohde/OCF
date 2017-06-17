<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php 
	$regusr = '^'.'[:alnum:]'.'$';
	echo ('Teste Função eregi<br>');

	if (validauser('alencar_(mendes'))
		echo ('True');
	else
		echo ('False');

function validauser($usr) {
	
	$cad= 'abcdefghijklmonpqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789_-@%$#';

	   		if (strspn($usr,$cad) != strlen($usr))
				return FALSE;
	
	return true;

}
?>




</body>
</html>
