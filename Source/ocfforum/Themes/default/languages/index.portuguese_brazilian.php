<?php
// Version: 1.1.5; Index

global $forum_copyright, $forum_version, $webmaster_email;

// Locale (strftime, pspell_new) and spelling. (pspell_new, can be left as '' normally.)
// For more information see:
//   - http://www.php.net/function.pspell-new
//   - http://www.php.net/function.setlocale
// Again, SPELLING SHOULD BE '' 99% OF THE TIME!!  Please read this!
$txt['lang_locale'] = 'pt_BR';
$txt['lang_dictionary'] = 'pt';
$txt['lang_spelling'] = 'brazilian';

// Character set and right to left?
$txt['lang_character_set'] = 'ISO-8859-1';
$txt['lang_rtl'] = false;

$txt['days'] = array('Domingo', 'Segunda-Feira', 'Ter&ccedil;a-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'S&aacute;bado');
$txt['days_short'] = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
// Months must start with 1 => 'January'. (or translated, of course.)
$txt['months'] = array(1 => 'Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$txt['months_titles'] = array(1 => 'Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$txt['months_short'] = array(1 => 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

$txt['newmessages0'] = '&eacute; nova';
$txt['newmessages1'] = 's&atilde;o novas';
$txt['newmessages3'] = 'Novas';
$txt['newmessages4'] = ',';

$txt[2] = 'Admin';

$txt[10] = 'Salvar';

$txt[17] = 'Modificar';
$txt[18] = $context['forum_name'] . ' - &Iacute;ndice';
$txt[19] = 'Membros';
$txt[20] = 'Nome do F&oacute;rum';
$txt[21] = 'Mensagens';
$txt[22] = '&Uacute;ltima Mensagem:';

$txt[24] = '(Sem assunto)';
$txt[26] = 'Mensagens';
$txt[27] = 'Ver Perfil';
$txt[28] = 'Visitante';
$txt[29] = 'Autor';
$txt[30] = '';
$txt[31] = 'Apagar';
$txt[33] = 'Iniciar novo t&oacute;pico';

$txt[34] = 'Login';
// Use numeric entities in the below string.
$txt[35] = 'Usu&aacute;rio';
$txt[36] = 'Senha';

$txt[40] = 'Esse usu&aacute;rio n&atilde;o existe.';

$txt[62] = 'Moderador do F&oacute;rum';
$txt[63] = 'Remover t&oacute;pico';
$txt[64] = 'T&oacute;picos';
$txt[66] = 'Modificar mensagem';
$txt[68] = 'Nome';
$txt[69] = 'Email';
$txt[70] = 'Assunto';
$txt[72] = 'Mensagem';

$txt[79] = 'Editar Perfil';

$txt[81] = 'Escolha uma senha';
$txt[82] = 'Verifique a senha';
$txt[87] = 'Posi&ccedil;&atilde;o';

$txt[92] = 'Ver o Perfil de';
$txt[94] = 'Total';
$txt[95] = 'Mensagens';
$txt[96] = 'Website';
$txt[97] = 'Registrar';

$txt[101] = '&Iacute;ndice de Mensagens';
$txt[102] = 'Not&iacute;cias';
$txt[103] = 'Home';

$txt[104] = 'Trancar/Destrancar T&oacute;pico';
$txt[105] = 'Enviar';
$txt[106] = 'Ocorreu um Erro!';
$txt[107] = 'em';
$txt[108] = 'Sair';
$txt[109] = 'Iniciado por';
$txt[110] = 'Respostas';
$txt[111] = '&Uacute;ltima Mensagem:';
$txt[114] = 'Login Administra&ccedil;&atilde;o';
// Use numeric entities in the below string.
$txt[118] = 'T&oacute;pico';
$txt[119] = 'Ajuda';
$txt[121] = 'Apagar mensagem';
$txt[125] = 'Notificar';
$txt[126] = 'Quer receber um Email de notifica&ccedil;&atilde;o se algu&eacute;m responder a este t&oacute;pico?';
// Use numeric entities in the below string.
$txt[130] = "Atenciosamente,\nA Equipa do " . $context['forum_name'] . '.';
$txt[131] = 'Notificar respostas';
$txt[132] = 'Mover T&oacute;pico';
$txt[133] = 'Mover para';
$txt[139] = 'P&aacute;ginas';
$txt[140] = 'Usu&aacute;rios ativos nos &uacute;ltimos ' . $modSettings['lastActive'] . ' minutos';
$txt[144] = 'Mensagens Pessoais';
$txt[145] = 'Responder com Cita&ccedil;&atilde;o';
$txt[146] = 'Responder';

$txt[151] = 'N&atilde;o tem mensagens...';
$txt[152] = 'voc&ecirc; tem';
$txt[153] = 'mensagens';
$txt[154] = 'Apagar esta mensagem';

$txt[158] = 'Usu&aacute;rios Online';
$txt[159] = 'Mensagem Pessoal';
$txt[160] = 'Ir para';
$txt[161] = 'OK';
$txt[162] = 'Tem a certeza que quer apagar este t&oacute;pico?';
$txt[163] = 'Sim';
$txt[164] = 'N&atilde;o';

$txt[166] = 'Resultados da Pesquisa';
$txt[167] = 'Fim dos resultados';
$txt[170] = 'Pedimos desculpa, mas n&atilde;o foi encontrada nenhuma informa&ccedil;&atilde;o relativa &agrave; sua pesquisa';
$txt[176] = 'em';

$txt[182] = 'Pesquisa';
$txt[190] = 'Todas';

$txt[193] = 'Voltar atr&aacute;s';
$txt[194] = 'lembrar';
$txt[195] = 'T&oacute;pico iniciado por';
$txt[196] = 'T&iacute;tulo';
$txt[197] = 'Enviado por';
$txt[200] = 'Lista pesquis&aacute;vel de todos os Membros registrados.';
$txt[201] = 'Por favor d&ecirc;em as boas vindas a';
$txt[208] = 'Centro de Administra&ccedil;&atilde;o';
$txt[211] = '&Uacute;ltima modifica&ccedil;&atilde;o';
$txt[212] = 'Deseja desativar a Notifica&ccedil;&atilde;o deste t&oacute;pico?';

$txt[214] = 'Mensagens Recentes';

$txt[227] = 'Localidade';
$txt[231] = 'Sexo';
$txt[233] = 'Data de Registro';

$txt[234] = 'Ver as 10 mensagens mais recentes do F&oacute;rum.';
$txt[235] = 'foi o &uacute;ltimo t&oacute;pico a ser respondido';

$txt[238] = 'Masculino';
$txt[239] = 'Feminino';

$txt[240] = 'Caracter inv&aacute;lido usado no nome de Usu&aacute;rio.';

$txt['welcome_guest'] = 'Bem-vindo, <b>' . $txt[28] . '</b>. Por favor fa&ccedil;a o <a href="' . $scripturl . '?action=login">Login</a> ou <a href="' . $scripturl . '?action=register">Registro</a>.';
$txt['welcome_guest_activate'] = '<br />
Perdeu o seu <a href="' . $scripturl . '?action=activate">email de activa&ccedil;&atilde;o?</a>';
$txt['hello_member'] = 'Ol&aacute;,';
// Use numeric entities in the below string.
$txt['hello_guest'] = 'Bem-vindo,';
$txt[247] = 'Ol&aacute;,';
$txt[248] = 'Bem-vindo,';
$txt[249] = 'Por favor fa&ccedil;a o';
$txt[250] = 'Voltar atr&aacute;s';
$txt[251] = 'Por favor selecione um destino';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt[279] = 'Enviado por';

$txt[287] = 'Sorridente';
$txt[288] = 'Zangado';
$txt[289] = 'Contente';
$txt[290] = 'Riso';
$txt[291] = 'Triste';
$txt[292] = 'Piscar';
$txt[293] = 'Sorriso for&ccedil;ado';
$txt[294] = 'Chocado';
$txt[295] = 'Legal';
$txt[296] = 'Hein???';
$txt[450] = 'Rolar os Olhos';
$txt[451] = 'L&iacute;ngua';
$txt[526] = 'Embarassado';
$txt[527] = 'L&aacute;bios selados';
$txt[528] = 'Indeciso';
$txt[529] = 'Beijo';
$txt[530] = 'Chorar';

$txt[298] = 'Moderador';
$txt[299] = 'Moderadores';

$txt[300] = 'Marcar T&oacute;picos como Lidos para este f&oacute;rum';
$txt[301] = 'Visualiza&ccedil;&otilde;es';
$txt[302] = 'Novo';

$txt[303] = 'Ver Todos os Usu&aacute;rios';
$txt[305] = 'Ver';
$txt[307] = 'Email';

$txt[308] = 'Vendo Membros';
$txt[309] = 'de um total de';
$txt[310] = 'Membros';
$txt[311] = 'a';
$txt[315] = 'Esquece a senha?';

$txt[317] = 'Data';
// Use numeric entities in the below string.
$txt[318] = 'De';
$txt[319] = 'Assunto';
$txt[322] = 'Verificar se tem Novas Mensagens';
$txt[324] = 'Para';

$txt[330] = 'T&oacute;picos';
$txt[331] = 'Membros';
$txt[332] = 'Lista de Membros';
$txt[333] = 'H&aacute; Novas Mensagens';
$txt[334] = 'N&atilde;o H&aacute; Novas Mensagens';

$txt['sendtopic_send'] = 'Enviar';

$txt[371] = 'Diferen&ccedil;a Hor&aacute;ria';
$txt[377] = 'ou';

$txt[398] = 'Pedimos desculpa, mas n&atilde;o foram encontrados resultados para a sua pesquisa';

$txt[418] = 'Notifica&ccedil;&atilde;o';

$txt[430] = 'Desculpe %s, mas voc&ecirc; foi proibido de usar este F&oacute;rum!';

$txt[452] = 'Marcar TODAS as mensagens como lidas';

$txt[454] = 'T&oacute;pico Quente (Mais de ' . $modSettings['hotTopicPosts'] . ' Respostas)';
$txt[455] = 'T&oacute;pico Muito Quente (Mais de ' . $modSettings['hotTopicVeryPosts'] . ' Respostas)';
$txt[456] = 'T&oacute;pico Trancado';
$txt[457] = 'T&oacute;pico Normal';
$txt['participation_caption'] = 'T&oacute;pico em que voc&ecirc; participou';

$txt[462] = 'IR';

$txt[465] = 'Imprimir';
$txt[467] = 'Perfil';
$txt[468] = 'Resumo do T&oacute;pico';
$txt[470] = 'N/D';
$txt[471] = 'mensagem';
$txt[473] = 'Este nome j&aacute; est&aacute; em uso por outro Membro.';

$txt[488] = 'Total de Membros';
$txt[489] = 'Total de Mensagens';
$txt[490] = 'Total de T&oacute;picos';

$txt[497] = 'Minutos para permanecer online';

$txt[507] = 'Pr&eacute;-Visualizar';
$txt[508] = 'Ficar sempre online';

$txt[511] = 'Registrado';
// Use numeric entities in the below string.
$txt[512] = 'IP';

$txt[513] = 'ICQ';
$txt[515] = 'WWW';

$txt[525] = 'por';

$txt[578] = 'horas';
$txt[579] = 'dias';

$txt[581] = ', o nosso Membro mais recente.';

$txt[582] = 'Procurar por';

$txt[603] = 'AIM';
// In this string, please use +'s for spaces.
$txt['aim_default_message'] = 'Olá.+Estás+aí?';
$txt[604] = 'YIM';

$txt[616] = 'Lembre-se, o f&oacute;rum est&aacute; em \'Modo Manuten&ccedil;&atilde;o\'.';

$txt[641] = 'Lida';
$txt[642] = 'vezes';

$txt[645] = 'Estat&iacute;sticas';
$txt[656] = 'Membro Mais Recente';
$txt[658] = 'Total de Categorias';
$txt[659] = '&Uacute;ltima Mensagem';

$txt[660] = 'Voc&ecirc; tem';
$txt[661] = 'Clique';
$txt[662] = 'aqui';
$txt[663] = 'para vizualiz&aacute;-las.';

$txt[665] = 'Total de f&oacute;runs';

$txt[668] = 'Imprimir';

$txt[679] = 'Tem de usar um endere&ccedil;o de Email v&aacute;lido.';

$txt[683] = 'Sou um Geek!!';
$txt[685] = $context['forum_name'] . ' - Centro de Informa&ccedil;&atilde;o';

$txt[707] = 'Enviar este T&oacute;pico';

$txt['sendtopic_title'] = 'Enviar o T&oacute;pico &quot;%s&quot; a um amigo.';
// Use numeric entities in the below three strings.
$txt['sendtopic_dear'] = 'Caro %s,';
$txt['sendtopic_this_topic'] = 'Quero que vejas isto: "%s" no ' . $context['forum_name'] . '.  Para ver, basta clicar neste link';
$txt['sendtopic_thanks'] = 'Obrigado';
$txt['sendtopic_sender_name'] = 'O seu nome';
$txt['sendtopic_sender_email'] = 'O seu email';
$txt['sendtopic_receiver_name'] = 'O nome do destinat&aacute;rio';
$txt['sendtopic_receiver_email'] = 'O email do destinat&aacute;rio';
$txt['sendtopic_comment'] = 'Adicionar um coment&aacute;rio';
// Use numeric entities in the below string.
$txt['sendtopic2'] = 'Foi adicionado um coment&aacute;rio relativo a este t&oacute;pico';

$txt[721] = 'Esconder o Email do p&uacute;blico?';

$txt[737] = 'Selecionar tudo';

// Use numeric entities in the below string.
$txt[1001] = 'Erro na Base de Dados';
$txt[1002] = 'Por favor tente novamente. Se voltar a ver este erro, por favor contate o Administrador.';
$txt[1003] = 'Arquivo';
$txt[1004] = 'Linha';
// Use numeric entities in the below string.
$txt[1005] = 'O SMF detectou e tentou reparar automaticamente um erro no banco de dados. Se continuar a sentir problemas, ou continuar a receber estas mensagens, por favor contate a sua empresa de alojamento.';
$txt['database_error_versions'] = '<b>Nota:</b> Parece que a sua base de dados precisa de ser atualizada. Os arquivos do seu F&oacute;rum est&atilde;o na vers&atilde;o ' . $forum_version . ', enquanto que a sua base de dados est&aacute; na vers&atilde;o SMF ' . $modSettings['smfVersion'] . '. Recomenda-se que seja executada a &uacute;ltiuma vers&atilde;o do arquivo de upgrade.php.';
$txt['template_parse_error'] = 'Erro na Template!';
$txt['template_parse_error_message'] = 'Parece que aconteceu alguma coisa com as templates do F&oacute;rum. Este deve ser apenas um problema tempor&aacute;rio, portanto, tenha um pouco de paci&ecirc;ncia e volte a tentar mais tarde. Se continuar a ver esta mensagem, por favor contate o administrador.<br />
<br />
Pode tamb&eacute;m tentar <a href="javascript:location.reload();">atualizar esta p&aacute;gina</a>.';
$txt['template_parse_error_details'] = 'Houve um problema ao carregar a template ou arquivo de idioma <tt><b>%1$s</b></tt>. Por favor verifique os erros e tente novamente - lembre-se, um simples ap&oacute;strofe (<tt>\'</tt>) tem de ser na maioria das vezes antecedido de uma barra (<tt>\\</tt>). Para ver informa&ccedil;&otilde;es mais espec&iacute;ficas dos erros de PHP, tente <a href="' . $boardurl . '%1$s">acessar ao arquivo diretamente</a>.<br />
<br />
Pode  tentar <a href="javascript:location.reload();">atualizar esta p&aacute;gina</a> ou <a href="' . $scripturl . '?theme=1">usar o Tema padr&atilde;o</a>.';

$txt['smf10'] = '<b>Hoje</b> às ';
$txt['smf10b'] = '<b>Ontem</b> &agrave;s ';
$txt['smf20'] = 'Nova enquete';
$txt['smf21'] = 'Pergunta';
$txt['smf23'] = 'Votar';
$txt['smf24'] = 'Votos Totais';
$txt['smf25'] = 'Atalhos: pressione alt+s para enviar ou alt+p para pr&eacute;-visualizar';
$txt['smf29'] = 'Ver resultados.';
$txt['smf30'] = 'Trancar Pesquisa';
$txt['smf30b'] = 'Destrancar Pesquisa';
$txt['smf39'] = 'Editar Pesquisa';
$txt['smf43'] = 'Pesquisa';
$txt['smf47'] = '1 Dia';
$txt['smf48'] = '1 m&ecirc;s';
$txt['smf49'] = '1 Ano';
$txt['smf50'] = 'Sempre';
$txt['smf52'] = 'Login com nome de usu&aacute;rio, senha e dura&ccedil;&atilde;o da sess&atilde;o';
$txt['smf53'] = '1 Hora';
$txt['smf56'] = 'Movido';
$txt['smf57'] = 'Por favor escreva uma breve descri&ccedil;&atilde;o da raz&atilde;o<br />
de ter movido este t&oacute;pico.';
$txt['smf60'] = 'Desculpe, mas voc&ecirc; n&atilde;o tem mensagens suficientes para votar no KARMA - precisa de ter pelo menos ';
$txt['smf62'] = 'Desculpe, mas n&atilde;o pode alterar o KARMA deste membro duas vezes seguidas. Tem de aguardar pelo tempo de espera mínimo de ';
$txt['smf82'] = 'F&oacute;rum';
$txt['smf88'] = 'em';
$txt['smf96'] = 'T&oacute;pico Inamov&iacute;vel';

$txt['smf138'] = 'Apagar';

$txt['smf199'] = 'As suas Mensagens Pessoais';

$txt['smf211'] = 'KB';

$txt['smf223'] = '[Estat&iacute;sticas]';

// Use numeric entities in the below three strings.
$txt['smf238'] = 'C&oacute;digo';
$txt['smf239'] = 'Cita&ccedil;&atilde;o de';
$txt['smf240'] = 'Citar';

$txt['smf251'] = 'Dividir o T&oacute;pico';
$txt['smf252'] = 'Juntar T&oacute;picos';
$txt['smf254'] = 'Assunto para o Novo T&oacute;pico';
$txt['smf255'] = 'Separar apenas esta mensagem.';
$txt['smf256'] = 'Dividir o t&oacute;pico depois desta mensagem incluindo a mesma.';
$txt['smf257'] = 'Selecione as mensagens para dividir.';
$txt['smf258'] = 'Novo T&oacute;pico';
$txt['smf259'] = 'O T&oacute;pico foi dividido em dois com sucesso.';
$txt['smf260'] = 'T&oacute;pico de origem';
$txt['smf261'] = 'Por favor selecione as mensagens que quer dividir.';
$txt['smf264'] = 'Os T&oacute;picos foram unidos com sucesso.';
$txt['smf265'] = 'T&oacute;pico unido Recentemente';
$txt['smf266'] = 'T&oacute;pico a ser unido';
$txt['smf267'] = 'F&oacute;rum  alvo';
$txt['smf269'] = 'T&oacute;pico alvo';
$txt['smf274'] = 'Tem a certeza que quer juntar';
$txt['smf275'] = 'com';
$txt['smf276'] = 'Esta fun&ccedil;&atilde;o ir&aacute; juntar as mensagens de dois t&oacute;picos diferentes em um &uacute;nico. As mensagens ser&atilde;o ordenadas de acordo com a data em que foram enviadas. Como tal, a mensagem mais antiga ser&aacute; a primeira mensagem do novo t&oacute;pico.';

$txt['smf277'] = 'Fixar t&oacute;pico';
$txt['smf278'] = 'N&atilde;o-fixar t&oacute;pico';
$txt['smf279'] = 'Trancar T&oacute;pico';
$txt['smf280'] = 'Destrancar T&oacute;pico';

$txt['smf298'] = 'Pesquisa avan&ccedil;ada';

$txt['smf299'] = 'RISCO DE SEGURAN&Ccedil;A:';
$txt['smf300'] = 'Voc&ecirc; n&atilde;o apagou ';

$txt['smf301'] = 'P&aacute;gina criada em ';
$txt['smf302'] = ' segundos com ';
$txt['smf302b'] = ' procedimentos.';

$txt['smf315'] = 'Use esta fun&ccedil;&atilde;o para denunciar aos Moderadores e Administradores algum uso abusivo do F&oacute;rum ou de alguma mensagem que n&atilde;o se enquadra neste T&oacute;pico.<br />
<i>O seu endereço de email ser&aacute; revelado aos Moderadores se usar esta fun&ccedil;&atilde;o.</i>';

$txt['online2'] = 'Online';
$txt['online3'] = 'Offline';
$txt['online4'] = 'Mensagem Pessoal (Online)';
$txt['online5'] = 'Mensagem Pessoal (Offline)';
$txt['online8'] = 'Estado';

$txt['topbottom4'] = 'Ir para o Topo';
$txt['topbottom5'] = 'Ir para o Fundo';

$forum_copyright = '<a href="http://www.simplemachines.org/" title="Simple Machines Forum" target="_blank">Powered by ' . $forum_version . '</a> | 
<a href="http://www.simplemachines.org/about/copyright.php" title="Free Forum Software" target="_blank">SMF &copy; 2006-2008, Simple Machines LLC</a>';

$txt['calendar3'] = 'Anivers&aacute;rios:';
$txt['calendar4'] = 'Eventos:';
$txt['calendar3b'] = 'Pr&oacute;ximos Anivers&aacute;rios:';
$txt['calendar4b'] = 'Pr&oacute;ximos Eventos:';
// Prompt for holidays in the calendar, leave blank to just display the holiday's name.
$txt['calendar5'] = '';
$txt['calendar9'] = 'M&ecirc;s:';
$txt['calendar10'] = 'Ano:';
$txt['calendar11'] = 'Dia:';
$txt['calendar12'] = 'T&iacute;tulo do Evento:';
$txt['calendar13'] = 'Colocar em:';
$txt['calendar20'] = 'Editar Evento';
$txt['calendar21'] = 'Apagar este evento?';
$txt['calendar22'] = 'Apagar Evento';
$txt['calendar23'] = 'Colocar Evento';
$txt['calendar24'] = 'Calend&aacute;rio';
$txt['calendar37'] = 'Link para o Calend&aacute;rio';
$txt['calendar43'] = 'Link para o Evento';
$txt['calendar47'] = 'Pr&oacute;ximas Datas Importantes';
$txt['calendar47b'] = 'Calend&aacute;rio Hoje';
$txt['calendar51'] = 'Semana';
$txt['calendar54'] = 'N&uacute;mero de Dias:';
$txt['calendar_how_edit'] = 'como editar estes eventos?';
$txt['calendar_link_event'] = 'Linkar eventos com mensagens::';
$txt['calendar_confirm_delete'] = 'Tem certeza que quer apagar este evento?';
$txt['calendar_linked_events'] = 'Eventos linkados';

$txt['moveTopic1'] = 'Colocar um T&oacute;pico de redirecionamento';
$txt['moveTopic2'] = 'Alterar o assunto do T&oacute;pico';
$txt['moveTopic3'] = 'Novo assunto';
$txt['moveTopic4'] = 'Alterar o assunto de todas as mensagens';

$txt['theme_template_error'] = 'N&atilde;o foi poss&iacute;vel abrir a template \'%s\'.';
$txt['theme_language_error'] = 'N&atilde;o foi poss&iacute;vel carregar o arquivo de idioma \'%s\'.';

$txt['parent_boards'] = 'Sub-F&oacute;rum';

$txt['smtp_no_connect'] = 'N&atilde;o foi poss&iacute;vel ligar ao servidor SMTP';
$txt['smtp_port_ssl'] = 'Porta SMTP incorrecta.; Deve ser 465 para servidores SSL.';
$txt['smtp_bad_response'] = 'N&atilde;o foi poss&iacute;vel receber os c&oacute;digos de resposta do servidor de email';
$txt['smtp_error'] = 'Ocorreram alguns problemas durante o envio do email. Erro: ';
$txt['mail_send_unable'] = 'N&atilde;o foi poss&iacute;vel enviar a mensagem para o endere&ccedil;o de e-mail \'%s\'';

$txt['mlist_search'] = 'Procurar por usu&aacute;rios';
$txt['mlist_search2'] = 'Pesquisar novamente';
$txt['mlist_search_email'] = 'Procurar por endere&ccedil;os de email';
$txt['mlist_search_messenger'] = 'Procurar por apelido';
$txt['mlist_search_group'] = 'Procurar por posi&ccedil;&atilde;o';
$txt['mlist_search_name'] = 'Procurar por nome';
$txt['mlist_search_website'] = 'Porcurar por website';
$txt['mlist_search_results'] = 'Resultados da Pesquisa por';

$txt['attach_downloaded'] = 'transferido';
$txt['attach_viewed'] = 'visto';
$txt['attach_times'] = 'vezes';

$txt['MSN'] = 'MSN';

$txt['settings'] = 'Configura&ccedil;&otilde;es';
$txt['never'] = 'Nunca';
$txt['more'] = 'mais';

$txt['hostname'] = 'Servidor';
$txt['you_are_post_banned'] = 'Desculpe %s, mas voc&ecirc; foi impedido de enviar mensagens neste F&oacute;rum.';
$txt['ban_reason'] = 'Raz&atilde;o';

$txt['tables_optimized'] = 'As tabelas da Base de Dados foram otimizadas';

$txt['add_poll'] = 'Adicionar enquete';
$txt['poll_options6'] = 'S&oacute; pode escolher at&eacute; %s op&ccedil;&otilde;es.';
$txt['poll_remove'] = 'Apagar Pesquisa';
$txt['poll_remove_warn'] = 'Tem a certeza que quer apagar esta pesquisa do t&oacute;pico?';
$txt['poll_results_expire'] = 'Os resultados ser&atilde;o divulgados quando a pesquisa for encerrada';
$txt['poll_expires_on'] = 'Pesquisa encerra';
$txt['poll_expired_on'] = 'Pesquisa encerrada';
$txt['poll_change_vote'] = 'Apagar Pesquisa';
$txt['poll_return_vote'] = 'Op&ccedil;&otilde;es das enquetes';

$txt['quick_mod_remove'] = 'Apaga selecionados';
$txt['quick_mod_lock'] = 'Trancar selecionados';
$txt['quick_mod_sticky'] = 'Fixar os selecionados';
$txt['quick_mod_move'] = 'Mover selecionados para';
$txt['quick_mod_merge'] = 'Juntar selecionados';
$txt['quick_mod_markread'] = 'Marcar selecionados como lidos';
$txt['quick_mod_go'] = 'OK!';
$txt['quickmod_confirm'] = 'Tem a certeza que quer continuar?';

$txt['spell_check'] = 'Corretor Ortogr&aacute;fico';

$txt['quick_reply_1'] = 'Resposta R&aacute;pida';
$txt['quick_reply_2'] = 'Com a <i>Resposta R&aacute;pida</i> pode usar o c&oacute;digo BBC e os smileys como numa mensagem normal, mas muito mais rapidamente.';
$txt['quick_reply_warning'] = 'Aviso: este t&oacute;pico est&aacute; fechado!<br />
Apenas os moderadores ou administradores podem enviar respostas.';

$txt['notification_enable_board'] = 'Tem a certeza que deseja ativar a notifica&ccedil;&atilde;o de novos T&oacute;picos neste F&oacute;rum?';
$txt['notification_disable_board'] = 'Tem a certeza que deseja desativar a notifica&ccedil;&atilde;o de novos T&oacute;picos neste F&oacute;rum?';
$txt['notification_enable_topic'] = 'Tem a certeza que deseja ativar a notifica&ccedil;&atilde;o de novas respostas a este T&oacute;pico?';
$txt['notification_disable_topic'] = 'Tem a certeza que deseja desativar a notifica&ccedil;&atilde;o de novas respostas a este T&oacute;pico?';

$txt['rtm1'] = 'Denunciar ao Moderador';

$txt['unread_topics_visit'] = 'T&oacute;picos Recentes N&atilde;o Lidos';
$txt['unread_topics_visit_none'] = 'N&atilde;o h&aacute; t&oacute;picos n&atilde;o lidos desde a sua &uacute;ltima visita.  <a href="' . $scripturl . '?action=unread;all">Clique aqui para ver todos os t&oacute;picos n&atilde;o lidos</a>.';
$txt['unread_topics_all'] = 'Todos os T&oacute;picos N&atilde;o Lidos';
$txt['unread_replies'] = 'T&oacute;picos Atualizados';

$txt['who_title'] = 'Quem est&aacute; Online';
$txt['who_and'] = ' e ';
$txt['who_viewing_topic'] = ' est&atilde;o vendo este t&oacute;pico.';
$txt['who_viewing_board'] = ' est&atilde;o vendo este f&oacute;rum.';
$txt['who_member'] = 'Membro';

$txt['powered_by_php'] = 'Powered by PHP';
$txt['powered_by_mysql'] = 'Powered by MySQL';
$txt['valid_html'] = 'HTML 4.01 V&aacute;lido!';
$txt['valid_xhtml'] = 'XHTML 1.0 V&aacute;lido!';
$txt['valid_css'] = 'CSS V&aacute;lido!';

$txt['guest'] = 'Visitante';
$txt['guests'] = 'Visitantes';
$txt['user'] = 'Membro';
$txt['users'] = 'Membros';
$txt['hidden'] = 'Escondidos';
$txt['buddy'] = 'Amigo';
$txt['buddies'] = 'Amigos';
$txt['most_online_ever'] = 'Recorde de usu&aacute;rios online';
$txt['most_online_today'] = 'Usu&aacute;rios online hoje';

$txt['merge_select_target_board'] = 'Selecione o f&oacute;rum alvo do t&oacute;pico unido';
$txt['merge_select_poll'] = 'Selecione qual das pesquisas o t&oacute;pico final deve conter';
$txt['merge_topic_list'] = 'Selecione os t&oacute;picos para juntar';
$txt['merge_select_subject'] = 'Selecione o assunto do t&oacute;pico unido';
$txt['merge_custom_subject'] = 'Alterar assunto';
$txt['merge_enforce_subject'] = 'Alterar o assunto de todas as mensagens';
$txt['merge_include_notifications'] = 'Incluir notifica&ccedil;&otilde;es?';
$txt['merge_check'] = 'Juntar?';
$txt['merge_no_poll'] = 'Sem enquetes';

$txt['response_prefix'] = 'Re: ';
$txt['current_icon'] = '&Iacute;cone atual';

$txt['smileys_current'] = 'Conjunto de Smileys atual';
$txt['smileys_none'] = 'Sem Smileys';
$txt['smileys_forum_board_default'] = 'Forum/Board Default';

$txt['search_results'] = 'Resultados da Pesquisa';
$txt['search_no_results'] = 'N&atilde;o foram encontrados resultados';

$txt['totalTimeLogged1'] = 'Tempo Total Online: ';
$txt['totalTimeLogged2'] = ' dias, ';
$txt['totalTimeLogged3'] = ' horas e ';
$txt['totalTimeLogged4'] = ' minutos.';
$txt['totalTimeLogged5'] = 'd ';
$txt['totalTimeLogged6'] = 'h ';
$txt['totalTimeLogged7'] = 'm';

$txt['approve_thereis'] = 'H&aacute;';
$txt['approve_thereare'] = 'H&aacute;';
$txt['approve_member'] = 'um Membro';
$txt['approve_members'] = 'Membros';
$txt['approve_members_waiting'] = '&agrave; espera de aprova&ccedil;&atilde;o.';

$txt['notifyboard_turnon'] = 'Deseja receber um email de notifica&ccedil;&atilde;o quando algu&eacute;m iniciar um novo T&oacute;pico neste f&oacute;rum?';
$txt['notifyboard_turnoff'] = 'Tem a certeza que quer receber notifica&ccedil;&otilde;es de novos T&oacute;picos neste F&oacute;rum?';

$txt['activate_code'] = 'O seu código de ativação é';

$txt['find_members'] = 'Encontrar Membros';
$txt['find_username'] = 'Nome, nome de usu&aacute;rio, ou Endere&ccedil;o de Email';
$txt['find_buddies'] = 'Mostrar apenas amigos?';
$txt['find_wildcards'] = 'S&atilde;o permitidos \'Wildcards\': *, ?';
$txt['find_no_results'] = 'N&atilde;o foram encontrados resultados';
$txt['find_results'] = 'Resultados';
$txt['find_close'] = 'Fechar';

$txt['unread_since_visit'] = 'Ver os T&oacute;picos n&atilde;o lidos desde a &uacute;ltima visita.';
$txt['show_unread_replies'] = 'Ver novas respostas aos meus T&oacute;picos.';

$txt['change_color'] = 'Mudar a Cor';

$txt['quickmod_delete_selected'] = 'Apagar selecionados';

// In this string, don't use entities. (&amp;, etc.)
$txt['show_personal_messages'] = 'Recebeu uma ou mais Mensagens Pessoais.\\nVer as Mensagens Pessoais agora (numa nova janela)?';

$txt['previous_next_back'] = '&laquo; t&oacute;pico anterior';
$txt['previous_next_forward'] = 't&oacute;pico seguinte &raquo;';

$txt['movetopic_auto_board'] = '[BOARD]';
$txt['movetopic_auto_topic'] = '[TOPIC LINK]';
$txt['movetopic_default'] = 'Este t&oacute;pico foi movido para ' . $txt['movetopic_auto_board'] . ".\n\n" . $txt['movetopic_auto_topic'];

$txt['upshrink_description'] = 'Comprimir ou expandir o cabe&ccedil;alho.';

$txt['mark_unread'] = 'Marcar como n&atilde;o lido';

$txt['ssi_not_direct'] = 'Por favor n&atilde;o acesse diretamente o arquivo SSI.php; deve usar antes o caminho (%s) ou adicionar ?ssi_function=qualquercoisa.';
$txt['ssi_session_broken'] = 'SSI.php foi incapaz de carregar uma sess&atilde;o! Isto pode causar problemas com o logout e outras fun&ccedil;&otilde;es - certifique-se que SSI.php est&aacute; incluido antes de *qualquer* coisa em todos os scripts!';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['preview_title'] = 'Mensagem anterior';
$txt['preview_fetch'] = 'Carregar pr&eacute;-visualiza&ccedil;&atilde;o...';
$txt['preview_new'] = 'Nova mensagem';
$txt['error_while_submitting'] = 'Os seguintes erros ocorreram enquanto colocava esta mensagem:';

$txt['split_selected_posts'] = 'Mensagens selecionadas';
$txt['split_selected_posts_desc'] = 'As mensagens abaixo ir&atilde;o formar um novo t&oacute;pico depois de divididas.';
$txt['split_reset_selection'] = 'anular selec&ccedil;&atilde;o';

$txt['modify_cancel'] = 'Cancelar';
$txt['mark_read_short'] = 'Marcar como Lido';

$txt['pm_short'] = 'Minhas Mensagens';
$txt['hello_member_ndt'] = 'Ol&aacute;';

$txt['ajax_in_progress'] = 'Carregando...';

?>