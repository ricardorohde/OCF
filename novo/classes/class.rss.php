<?php

/*
   Função para leitura de RSS via PHP
   Gera um output padrão, que pode ser formatado
   Requer a funcao xmlize "by Hans Anderson, www.hansanderson.com/contact/"
   Enjoy
   
   By http://www.manifesto.blog.br/
*/

require_once($_SERVER['DOCUMENT_ROOT']."/xmlize.php") ;

class rss {

   function rss($a) {   
      // $a deve ser o caminho para o rss
      // Primeiro armazenamos o xml
      $data = file_get_contents($a) ;
     
      $info = xmlize($data,1,'ISO-8859-1');      
      $this->title = $info["rss"]["#"]["channel"][0]["#"]["title"][0]["#"]; // Titulo do RSS
      $this->link =$info["rss"]["#"]["channel"][0]["#"]["link"][0]["#"] ;   // Link para a pagina
      $this->itens =  $info["rss"]["#"]["channel"][0]["#"]["item"];   // Conteudo do RSS
   }
   function leitor() {
      // Funcao que le o rss e gera uma caixa sem formatação
      $itens = $this->itens ;
//      $output = "<div class='rss_container'><h3><a href='".$this->link."' > ";
//      $output .= $this->title."</a></h3><div class='rss_inner'><dl>";
      $output = "<div class='rss_container'>";
      $output .= "<div class='rss_inner'><dl>";
      for($i = 0; $i < sizeof($itens); $i++) {
         $link = $itens[$i]["#"]["link"][0]["#"] ;
         $data = date("d/m/y H:i",strtotime($itens[$i]["#"]["pubDate"][0]["#"])) ;
         $titulo = $itens[$i]["#"]["title"][0]["#"] ;
//         $titulo = $itens[$i]["#"]["title"][0]["#"] ;
         $output .= "<dt><a href='$link'>$titulo</a> :: ($data) </dt>";
      }
      $output .= "</dl></div></div>" ;
      return $output ; // Ele retorna o código da caixa
   }
}


class box extends  rss{

   // Aqui eu fiz uma nova classe extendendo o rss
   // Essa classe exibe uma caixa formatada
   // Poderia ter feito sem extensão, mas quis mostrar como estender o script.
   
   var $color = "#000000";
   var $link_color = "#0000EE";
   var $background= "#FFFFFF";
   var $padding= "4px";
   var $width= "250px";
   var $height= "auto";
   var $border= "thin black solid" ;   
   var $h3_background= "#EFEFEF" ;
   var $h3_color= "#000000";
   
   function box($a) {
      // Passa para o rss ;
      $this->rss($a);
   }   
   function show_box() {

      // Funcao que gera uma caixa formatada
      $itens = $this->itens ;
      $output = " ";      
      for($i = 0; $i < 14 /*sizeof($itens)*/; $i++) {
         $link = $itens[$i]["#"]["link"][0]["#"] ;
         $data = date("d/m/y H:i",strtotime($itens[$i]["#"]["pubDate"][0]["#"]));
//         $titulo = $itens[$i]["#"]["title"][0]["#"] ;         
         $titulo = $itens[$i]["#"]["title"][0]["#"];
         $output .= "<tr><td><a target='_blank' href='$link'>($data) - $titulo</a></td></tr>";
      }
      $this->output = $output ;
      return $this->output ;
   }
}
/*
Pode se alterar os valors da caixa pelas seguintes variaveis:

$rss->background
$rss->padding
$rss->width
$rss->height
$rss->border
$rss->color
$rss->h3_background
$rss->h3_color

Ou criando um estilo próprio.
*/
?> 