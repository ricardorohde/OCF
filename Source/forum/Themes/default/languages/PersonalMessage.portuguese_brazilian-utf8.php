<?php
// Version: 1.1; PersonalMessage

$txt[143] = '&Iacute;ndice de mensagens pessoais';
$txt[148] = 'Enviar mensagem';
$txt[150] = 'Para';
$txt[1502] = 'Bcc';
$txt[316] = 'Entrada';
$txt[320] = 'Saida';
$txt[321] = 'Criar nova';
$txt[411] = 'Apagar mensagens';
// Don't translate "PMBOX" in this string.
$txt[412] = 'Apagar todas as mensagens na PMBOX';
$txt[413] = 'Tem a certeza que quer apagar todas as mensagens?';
$txt[535] = 'Destinat&aacute;rio';
// Don't translate the word "SUBJECT" here, as it is used to format the message - use numeric entities as well.
$txt[561] = 'Nova mensagem pessoal: SUBJECT';
// Don't translate SENDER or MESSAGE in this language string; they are replaced with the corresponding text - use numeric entities too.
$txt[562] = 'Acabou de receber uma Mensagem Pessoal enviada por SENDER no ' . $context['forum_name'] . '.' . "\n\n" . 'IMPORTANTE: Lembre-se, isto &#233; apenas uma notifica&#231;&#227;o. Por favor n&#227;o responda a este e-mail.' . "\n\n" . 'A mensagem que lhe foi enviada foi a seguinte:' . "\n\n" . 'MESSAGE';
$txt[748] = '(m&uacute;ltiplos destinat&aacute;rios: \'nome1, nome2\')';
// Use numeric entities in the below string.
$txt['instant_reply'] = 'ATEN&#199;&#195;O N&#195;O RESPONDA a esta mensagem, responda aqui:';

$txt['smf249'] = 'Tem a certeza que quer apagar todas as mensagens selecionadas?';

$txt['sent_to'] = 'Enviada para';
$txt['reply_to_all'] = 'Respoder a Todos';

$txt['pm_capacity'] = 'Capacidade';
$txt['pm_currently_using'] = '%s mensagens, %s%% cheio.';

$txt['pm_error_user_not_found'] = 'N&atilde;o foi poss&iacute;vel encontrar o membro \'%s\'.';
$txt['pm_error_ignored_by_user'] = 'O usu&aacute;rio \'%s\' bloqueou a sua mensagem.';
$txt['pm_error_data_limit_reached'] = 'N&atilde;o foi poss&iacute;vel enviar a MP para \'%s\' devido ao limite m&aacute;ximo de mensagens permitido.';
$txt['pm_successfully_sent'] = 'A mensagem foi enviada com sucesso para \'%s\'.';
$txt['pm_too_many_recipients'] = 'N&atilde;o pode enviar mensagens pessoais a mais do que %d recipiente(s) de cada vez.';
$txt['pm_too_many_per_hour'] = 'Voc&ecirc; excedeu o limite de %d mensagens pessoais por hora.';
$txt['pm_send_report'] = 'Enviar relat&oacute;rio';
$txt['pm_save_outbox'] = 'Guardar uma c&oacute;pia na caixa de saida';
$txt['pm_undisclosed_recipients'] = 'Destinat&aacute;rio n&atilde;o definido';

$txt['pm_read'] = 'Ler';
$txt['pm_replied'] = 'Respondida para';

// Message Pruning.
$txt['pm_prune'] = 'Apagar mensagens';
$txt['pm_prune_desc1'] = 'Apagar todas as mensagens mais antigas do que';
$txt['pm_prune_desc2'] = 'dias.';
$txt['pm_prune_warning'] = 'Tem a certeza que quer apagar as suas mensagens?';

// Actions Drop Down.
$txt['pm_actions_title'] = 'Ac&ccedil;&otilde;es seguintes';
$txt['pm_actions_delete_selected'] = 'Apagar selecionados';
$txt['pm_actions_filter_by_label'] = 'Filtrar por categoria';
$txt['pm_actions_go'] = 'Ir';

// Manage Labels Screen.
$txt['pm_apply'] = 'Aplicar';
$txt['pm_manage_labels'] = 'Administrar marcadores';
$txt['pm_labels_delete'] = 'Tem a certeza que quer apagar os marcadores selecionados?';
$txt['pm_labels_desc'] = 'Aqui pode adicionar, editar e apagar marcadores usados nas suas mensagens.';
$txt['pm_label_add_new'] = 'Adicionar novo marcador';
$txt['pm_label_name'] = 'Nome do marcador';
$txt['pm_labels_no_exist'] = 'Atualmente n&atilde;o tem nenhum marcador definido!';

// Labeling Drop Down.
$txt['pm_current_label'] = 'Marcadores';
$txt['pm_msg_label_title'] = 'Mensagem de marcador';
$txt['pm_msg_label_apply'] = 'Adicionar marcador';
$txt['pm_msg_label_remove'] = 'Remover marcador';
$txt['pm_msg_label_inbox'] = 'Caixa de Entrada';
$txt['pm_sel_label_title'] = 'Marcador selecionado';
$txt['labels_too_many'] = 'Desculpe, %s mensagens j&aacute; tem o n&uacute;mero m&aacute;ximo de marcadores permitidos!';

// Sidebar Headings.
$txt['pm_labels'] = 'Marcadores';
$txt['pm_messages'] = 'Mensagens';
$txt['pm_preferences'] = 'Prefer&ecirc;ncias';

$txt['pm_is_replied_to'] = 'Voc&ecirc; reencaminhou ou respondeu a esta mensagem.';

// Reporting messages.
$txt['pm_report_to_admin'] = 'Denunciar ao Administrador';
$txt['pm_report_title'] = 'Denunciar mensagem pessoal';
$txt['pm_report_desc'] = 'Atrav&eacute;s desta p&aacute;gina voc&ecirc; pode denunciar uma mensagem pessoal que tenha recebido ao administrador do f&oacute;rum. Por favor certifique-se que inclui uma descri&ccedil;&atilde;o do porqu&ecirc; de estar a den&uacute;nciar esta mensagem, isto ir&aacute; ser enviado juntamente com o conte&uacute;do da mensagem original.';
$txt['pm_report_admins'] = 'Administrador para o qual enviar a den&uacute;ncia';
$txt['pm_report_all_admins'] = 'Enviar para todos os administradores do f&oacute;rum';
$txt['pm_report_reason'] = 'Raz&atilde;o pela qual est&aacute; a den&uacute;nciar esta mensagem';
$txt['pm_report_message'] = 'Denunciar mensagem';

// Important - The following strings should use numeric entities.
$txt['pm_report_pm_subject'] = '[REPORT] ';
// In the below string, do not translate "{REPORTER}" or "{SENDER}".
$txt['pm_report_pm_user_sent'] = '{REPORTER} denunciou a seguinte mensagem pessoal, que lhe foi enviada por {SENDER}, pela seguinte raz&#227;o:';
$txt['pm_report_pm_other_recipients'] = 'Outros destinat&#225;rios da mensagem inclu&#237;dos:';
$txt['pm_report_pm_hidden'] = '%d destinat&"225;rio(s) escondido(s)';
$txt['pm_report_pm_unedited_below'] = 'Em baixo est&#227;o os conteudos orignais das mensagens que est&#227;o a ser denunciadas:';
$txt['pm_report_pm_sent'] = 'Enviada:';

$txt['pm_report_done'] = 'Obrigado por enviar esta den&uacute;ncia. Receber&aacute; novidades do administrador em breve';
$txt['pm_report_return'] = 'Voltar &agrave; caixa de entrada';

$txt['pm_search_title'] = 'Procurar mensagens pessoais';
$txt['pm_search_bar_title'] = 'Procurar mensagens';
$txt['pm_search_text'] = 'Procurar por';
$txt['pm_search_go'] = 'Procurar';
$txt['pm_search_advanced'] = 'Procura avan&ccedil;ada';
$txt['pm_search_user'] = 'por usu&aacute;rio';
$txt['pm_search_match_all'] = 'Corresponder todas as palavras';
$txt['pm_search_match_any'] = 'Corresponder qualquer palavra';
$txt['pm_search_options'] = 'Op&ccedil;&otilde;es';
$txt['pm_search_post_age'] = 'Idade';
$txt['pm_search_show_complete'] = 'Mostrar mensagem completa nos resultados.';
$txt['pm_search_subject_only'] = 'Procurar apenas por assunto e por autor';
$txt['pm_search_between'] = 'Entre';
$txt['pm_search_between_and'] = 'e';
$txt['pm_search_between_days'] = 'dias';
$txt['pm_search_order'] = 'Ordenar resultados por';
$txt['pm_search_choose_label'] = 'Escolha o separador procurar, ou procurar tudo';

$txt['pm_search_results'] = 'Procurar resultados';
$txt['pm_search_none_found'] = 'Nenhuma mensagem encontrada';

$txt['pm_search_orderby_relevant_first'] = 'Mais importantes primeiro';
$txt['pm_search_orderby_recent_first'] = 'Mais recentes primeiro';
$txt['pm_search_orderby_old_first'] = 'Mais antigas primeiro';

$txt['pm_visual_verification_label'] = 'Verifica&ccedil;&atilde;o';
$txt['pm_visual_verification_desc'] = 'Por favor insira o c&oacute;digo da imagem em cima para poder enviar esta mensagem pessoal.';
$txt['pm_visual_verification_listen'] = 'Ouvir o c&oacute;digo';

?>