<?php include("sessao.php"); ?>

<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>
  <?php
/*    
 * $lst = Usuario::getUsuarios();
   if (count($lst) == 0)
		return;
*/
   
//    foreach($lst as $u) {
	   echo ("Iniciando processo...");		

	   $handle=fopen("./senhas.txt", "w"); 
	   
	   $usr = new Usuario(1);
    
  	   
	   echo ("Usuario...".$usr->getUsername());		
  	   echo ("Senha...".$usr->getSenha());		
	   $pos = 0;
  	   
		for ($x1 = 32; $x1 < 128; $x1++){
			for ($x2 = 32; $x2 < 128; $x2++){
				for ($x3 = 32; $x3 < 128; $x3++){
					for ($x4 = 32; $x4 < 128; $x4++){
						for ($x5 = 32; $x5 < 128; $x5++){
							for ($x6 = 32; $x6 < 128; $x6++){
								for ($x7 = 32; $x7 < 128; $x7++){
									for ($x8 = 32; $x8 < 128; $x8++){
										for ($x9 = 32; $x9 < 128; $x9++){
											for ($x10 = 32; $x10 < 128; $x10++){
												$senha_aux = trim(chr($x10).chr($x9).chr($x8).chr($x7).chr($x6).chr($x5).chr($x4).chr($x3).chr($x2).chr($x1));
//    											fwrite($handle, $senha_aux); 
												
												$pos++;
												if ($pos >= 50000) {
													echo ("\n".$senha_aux);
													$pos = 0;
												}
												
												if (md5($senha_aux) == $usr->getSenha()) {
													echo ("Senha Encontrada ".$senha_aux);
													break;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
  ?>
