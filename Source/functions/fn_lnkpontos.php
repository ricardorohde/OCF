<?php
/*
	Func�o: lnkpontos
	Descri��o: Retorna um link para a exibi��o do detalhamento da pontua��o do participante
	Desenvolvido: Alencar
	Data: 28/01/2006
*/

function lnkpontos($campeonato,$usuario,$pontos) {

 $js = " ";
 $lnk = " ";
 
   $js = sprintf ("javascript:janela('lst_detalhe.php?camp=%d&usr=%d&org=1',10,50,660,600);",$campeonato,$usuario);
   
   $lnk = '<a href="'.$js.'">'.$pontos.'</a>';

   return $lnk;
}
