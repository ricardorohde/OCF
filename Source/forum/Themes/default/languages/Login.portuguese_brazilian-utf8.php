<?php
// Version: 1.1.2; Login

$txt[37] = 'O nome do usu&aacute;rio &eacute; obrigat&oacute;rio.';
$txt[38] = 'N&atilde;o escreveu nenhuma senha.';
$txt[39] = 'A senha est&aacute; incorreta';
$txt[98] = 'Escolha um nome de usu&aacute;rio';
$txt[155] = 'Modo Manuten&ccedil;&atilde;o';
$txt[245] = 'O seu Registro foi efetuado com sucesso';
$txt[431] = 'Parab&eacute;ns!! Voc&ecirc; agora &eacute; um membro deste f&oacute;rum!';
// Use numeric entities in the below string.
$txt[492] = 'e a sua senha &eacute;:';
$txt[500] = 'Por favor insira um endere&ccedil;o de Email v&aacute;lido, %s.';
$txt[517] = 'Preenchimento obrigat&oacute;rio';
$txt[520] = 'Usado apenas para identifica&ccedil;&atilde;o no F&oacute;rum. Pode usar caracteres especiais depois de fazer o Login, indo ao seu Perfil e alterando o seu Nome.';
$txt[585] = 'Concordo';
$txt[586] = 'N&atilde;o concordo';
$txt[633] = 'Aviso!';
$txt[634] = 'Apenas os Membros registrados t&ecirc;m acesso a esta fun&ccedil;&atilde;o.';
$txt[635] = 'Por favor fa&ccedil;a o Login em baixo ou';
$txt[636] = 'Registrar';
$txt[637] = 'no ' . $context['forum_name'] . '.';
// Use numeric entities in the below two strings.
$txt[701] = 'Pode alterar os seus dados depois de fazer o Login e clicando no seu Perfil, ou visitando esta página:';
$txt[719] = 'O seu nome de Usu&aacute;rio é:';
$txt[730] = 'Este endere&ccedil;o de Email (%s) j&aacute; est&aacute; sendo usado por um Membro registrado. Se acha que esta mensagem est&aacute; errada, v&aacute; at&eacute; &agrave; p&aacute;gina de Login e clique em \'Esqueceu a Senha?\'. Use o esse Email para recuperar as suas informa&ccedil;&otilde;es.';

$txt['login_hash_error'] = 'A seguran&ccedil;a das senhas foi recentemente atualizada. Por favor insira a sua senha novamente.';

$txt['register_age_confirmation'] = 'Eu tenho pelo menos %d anos de idade';

// Use numeric entities in the below six strings.
$txt['register_subject'] = 'Bem-vindo ' . $context['forum_name'];

// For the below three messages, %1$s is the display name, %2$s is the username, %3$s is the password, %4$s is the activation code, and %5$s is the activation link (the last two are only for activation.)
$txt['register_immediate_message'] = 'Est&#225; agora registrado com uma conta no ' . $context['forum_name'] . ', %1$s!' . "\n\n" . 'O seu nome do usu&aacute;rio &#233; %2$s e a senha &#233; %3$s.' . "\n\n" . 'Pode alterar a sua senha no seu perfil depois de entrar, ou visitando esta p&#225;gina:' . "\n\n" . $scripturl . '?action=profile' . "\n\n" . $txt[130];
$txt['register_activate_message'] = 'Est&#225; agora registrado com uma conta no ' . $context['forum_name'] . ', %1$s!' . "\n\n" . 'O seu nome do usu&aacute;rio &#233; %2$s e a senha &#233; %3$s (que pode ser alterada depois.)' . "\n\n" . 'Antes de poder entrar, tem de primeiro ativar a sua conta. Para isso, clique por favor no seguinte endere&#231;o:' . "\n\n" . '%5$s' . "\n\n" . 'Se tiver alguma dificuldade na ativa&#231;&#227;o atrav&#233;s deste endere&#231;o, por favor use o c&#243;digo "%4$s".' . "\n\n" . $txt[130];
$txt['register_pending_message'] = 'O seu pedido de registro em ' . $context['forum_name'] . ' foi recebido, %1$s.' . "\n\n" . 'O nome de usu&aacute;rio com que se registrou foi %2$s e a senha &#233; %3$s.' . "\n\n" . 'Antes de se logar e poder come&#231;ar a utilizar o f&#243;rum, o seu registro ter&#225; de ser aprovado.  Quando isso acontecer, voc&ecirc; ir&#225; receber outro e-mail deste endere&#231;o.' . "\n\n" . $txt[130];

// For the below two messages, %1$s is the user's display name, %2$s is their username, %3$s is the activation code, and %4$s is the activation link (the last two are only for activation.)
$txt['resend_activate_message'] = 'Est&#225; agora registrado com uma conta no ' . $context['forum_name'] . ', %1$s!' . "\n\n" . 'O seu nome de usu&aacute;rio &#233; "%2$s".' . "\n\n" . 'Antes de poder entrar, tem de primeiro de ativar a sua conta. Para isso, clique por favor no seguinte endere&#231;o:' . "\n\n" . '%4$s' . "\n\n" . 'Se tiver alguma dificuldade na ativa&#231;&#227;o atrav&#233;s deste endere&#231;o, por favor use o c&#243;digo "%3$s".' . "\n\n" . $txt[130];
$txt['resend_pending_message'] = 'O seu pedido de registro em ' . $context['forum_name'] . ' foi recebido, %1$s.' . "\n\n" . 'O nome de usu&aacute;rio com que se registrou foi %2$s.' . "\n\n" . 'Antes de se logar e poder come&#231;ar utilizar o f&#243;rum, o seu registro ter&#225; de ser aprovado.  Quando isso acontecer, voc&ecirc; ir&#225; receber outro e-mail deste endere&#231;o.' . "\n\n" . $txt[130];

$txt['ban_register_prohibited'] = 'Desculpe, mas voc&ecirc; n&atilde;o tem permiss&atilde;o para se registrar neste F&oacute;rum.';
$txt['under_age_registration_prohibited'] = 'Desculpe, mas usu&aacute;rios menores do que %d anos n&atilde;o se podem registrar neste F&oacute;rum.';

$txt['activate_account'] = 'Ativa&ccedil;&atilde;o da conta';
$txt['activate_success'] = 'A sua conta foi ativada com sucesso. Pode a partir de agora Entrar no F&oacute;rum.';
$txt['activate_not_completed1'] = 'O seu endere&ccedil;o de e-mail necessita de ser validado antes de poder entrar no F&oacute;rum. Por favor verifique se recebeu o c&oacute;digo de ativa&ccedil;&atilde;o no seu e-mail!';
$txt['activate_not_completed2'] = 'Precisa de outro e-mail de ativa&ccedil;&atilde;o?';
$txt['activate_after_registration'] = 'Obrigado por se registrar. Ir&aacute; receber em breve um e-mail com um endere&ccedil;o para efetuar a ativa&ccedil;&atilde;o da sua conta.  Se n&atilde;o receber um e-mail dentro de pouco tempo, verifique a sua pasta de SPAM.';
$txt['invalid_userid'] = 'O usu&aacute;rio n&atilde;o existe';
$txt['invalid_activation_code'] = 'C&oacute;digo de ativa&ccedil;&atilde;o inv&aacute;lido';
$txt['invalid_activation_username'] = 'Nome de usu&aacute;rio ou E-Mail';
$txt['invalid_activation_new'] = 'Se se registou com um endere&ccedil;o de e-mail errado, escreva um novo e a sua senha aqui.';
$txt['invalid_activation_new_email'] = 'Novo e-mail';
$txt['invalid_activation_password'] = 'Senha antiga';
$txt['invalid_activation_resend'] = 'Reenviar c&oacute;digo de ativa&ccedil;&atilde;o';
$txt['invalid_activation_known'] = 'Se j&aacute; sabe o seu c&oacute;digo de ativa&ccedil;&atilde;o, escreva-o aqui.';
$txt['invalid_activation_retry'] = 'C&oacute;digo de ativa&ccedil;&atilde;o';
$txt['invalid_activation_submit'] = 'Ativar';

$txt['coppa_not_completed1'] = 'O administrador ainda n&atilde;o recebeu consentimento de ativa&ccedil;&atilde;o da sua conta por parte do seu familiar/tutor.';
$txt['coppa_not_completed2'] = 'Necessita de mais detalhes?';

$txt['awaiting_delete_account'] = 'A sua conta foi marcada como apagada!<br />Se pretende restaurar a sua conta, marque a caixa &quot;Reativar a minha conta&quot; e entre novamente.';
$txt['undelete_account'] = 'Reativar a minha conta';

$txt['change_email_success'] = 'O seu endere&ccedil;o de email foi alterado, e foi enviado um novo e-mail de ativa&ccedil;&atilde;o.';
$txt['resend_email_success'] = 'Um novo e-mail de ativa&ccedil;&atilde;o foi enviado com sucesso.';
// Use numeric entities in the below three strings.
$txt['change_password'] = 'Detalhes da nova senha';
$txt['change_password_1'] = 'As suas informa&#231;&#245;es de entrada em';
$txt['change_password_2'] = 'foram alteradas e a sua senha restaurada. Seguem em baixo os novos dados.';

$txt['maintenance3'] = 'Este f&oacute;rum est&aacute; em modo de manuten&ccedil;&atilde;o.';

// These two are used as a javascript alert; please use international characters directly, not as entities.
$txt['register_agree'] = 'Por favor leia e aceite o acordo antes se registrar.';
$txt['register_passwords_differ_js'] = 'As duas senhas que inseriu não correspondem!';

$txt['approval_after_registration'] = 'Obrigado por se registrar. O Administrador tem de aprovar o seu registo antes que voc&ecirc; possa come&ccedil;ar a usar a sua conta, ir&aacute; receber um e-mail em breve a informar da decis&atilde;o do Administrador.';

$txt['admin_settings_desc'] = 'Aqui pode alterar uma variedadade de defini&ccedil;&otilde;es relacionadas com o registo de novos membros.';

$txt['admin_setting_registration_method'] = 'M&eacute;todo de registo aplicado para novos membros';
$txt['admin_setting_registration_disabled'] = 'Registro desativado';
$txt['admin_setting_registration_standard'] = 'Registro imediato';
$txt['admin_setting_registration_activate'] = 'Ativa&ccedil;&atilde;o pelo usu&aacute;rio';
$txt['admin_setting_registration_approval'] = 'Aprovado pelo administrador';
$txt['admin_setting_notify_new_registration'] = 'Informar administradores quando um membro se registra';
$txt['admin_setting_send_welcomeEmail'] = 'Enviar e-mail de boas vindas aos novos membros';

$txt['admin_setting_password_strength'] = 'Qualidade das senhas dos membros';
$txt['admin_setting_password_strength_low'] = 'Fraca - 4 caracteres m&iacute;nimos';
$txt['admin_setting_password_strength_medium'] = 'M&eacute;dia - n&atilde;o pode conter nome de usu&aacute;rio';
$txt['admin_setting_password_strength_high'] = 'Alta - mistura de caracteres';

$txt['admin_setting_image_verification_type'] = 'Complexity of visual verification image';
$txt['admin_setting_image_verification_type_desc'] = 'The more complex the image the harder it is for bots to bypass';
$txt['admin_setting_image_verification_off'] = 'Disabled';
$txt['admin_setting_image_verification_vsimple'] = 'Very Simple - Plain text on image';
$txt['admin_setting_image_verification_simple'] = 'Simple - Overlapping coloured letters, no noise';
$txt['admin_setting_image_verification_medium'] = 'Medium - Overlapping coloured letters, with noise';
$txt['admin_setting_image_verification_high'] = 'High - Angled letters, considerable noise';
$txt['admin_setting_image_verification_sample'] = 'Sample';
$txt['admin_setting_image_verification_nogd'] = '<b>Note:</b> as this server does not have the GD library installed the different complexity settings will have no effect.';

$txt['admin_setting_coppaAge'] = 'Idade para aplicar restri&ccedil;&otilde;es de registro';
$txt['admin_setting_coppaAge_desc'] = '(Defina como 0 para desativar)';
$txt['admin_setting_coppaType'] = 'Ac&ccedil;&atilde;o a tomar quando o usu&aacute;rio n&atilde;o tiver a idade m&iacute;nima permitida';
$txt['admin_setting_coppaType_reject'] = 'Rejeitar o registro';
$txt['admin_setting_coppaType_approval'] = 'Requerer aprova&ccedil;&atilde;o do familiar/tutor';
$txt['admin_setting_coppaPost'] = 'Endere&ccedil;o postal para onde as declara&ccedil;&otilde;es de aprova&ccedil;&atilde;o devem ser enviadas';
$txt['admin_setting_coppaPost_desc'] = 'Apenas se aplica se a restri&ccedil;&atilde;o da idade estiver em ordem';
$txt['admin_setting_coppaFax'] = 'N&uacute;mero de Fax para onde as declara&ccedil;&otilde;es de aprova&ccedil;&atilde;o devem ser enviadas';
$txt['admin_setting_coppaPhone'] = 'N&uacute;mero de contato que os familiares podem usar para colocar quest&otilde;es sobre a restri&ccedil;&atilde;o';
$txt['admin_setting_coppa_require_contact'] = 'Deve colocar  um endere&ccedil;o postal ou de fax se a aprova&ccedil;&atilde;o por parte dos familiares/tutores for necess&aacute;ria.';

$txt['admin_register'] = 'Registro de novo usu&aacute;rio';
$txt['admin_register_desc'] = 'A partir daqui pode registrar novos usu&aacute;rios no F&oacute;rum, e de desejado, enviar os dados por email.';
$txt['admin_register_username'] = 'Novo nome de usu&aacute;rio';
$txt['admin_register_email'] = 'Endere&ccedil;o de e-mail';
$txt['admin_register_password'] = 'Senha';
$txt['admin_register_username_desc'] = 'Nome de usu&aacute;rio';
$txt['admin_register_email_desc'] = 'Endere&ccedil;o de e-mail';
$txt['admin_register_password_desc'] = 'Senha';
$txt['admin_register_email_detail'] = 'Enviar nova senha para o usu&aacute;rio';
$txt['admin_register_email_detail_desc'] = 'Endere&ccedil;o de e-mail necess&aacute;rio mesmo que n&atilde;o marcado';
$txt['admin_register_email_activate'] = 'Requerer que o usu&aacute;rio ative a conta';
$txt['admin_register_group'] = 'Grupo';
$txt['admin_register_group_desc'] = 'O grupo a que o membro ir&aacute; pertencer';
$txt['admin_register_group_none'] = '(sem grupo)';
$txt['admin_register_done'] = 'O usu&aacute;rio %s foi registrado com sucesso!';

$txt['admin_browse_register_new'] = 'Registrar novo usu&aacute;rio';

// Use numeric entities in the below three strings.
$txt['admin_notify_subject'] = 'Um novo usu&aacute;rio foi registrado';
$txt['admin_notify_profile'] = '%s acabou de se tornar um membro do F&#243;rum. Clique no link abaixo para ver o seu perfil.';
$txt['admin_notify_approval'] = 'Antes de poder come&#231;ar a colocar mensagens a sua conta ter&#225; de ser aprovada. Clique no link abaixo para ir para o ecr&#227; de aprova&#231;&#227;o.';

$txt['coppa_title'] = 'F&oacute;rum de idade restrita';
$txt['coppa_after_registration'] = 'Bem-vindo ao ' . $context['forum_name'] . '.<br /><br />Devido a teres idade inferior a {MINIMUM_AGE}, &eacute; um requerimento legal
	obter autoriza&ccedil;&atilde;o do seu familiar ou tutor antes que possas come&ccedil;ar a utilizar a tua conta.  Para obter a ativa&ccedil;&atilde;o da conta imprima o formul&aacute;rio abaixo:';
$txt['coppa_form_link_popup'] = 'Carregar formul&aacute;rio numa nova janela';
$txt['coppa_form_link_download'] = 'Fazer download como arquivo de texto';
$txt['coppa_send_to_one_option'] = 'Depois e s&oacute; pedir ao teu familiar/tutor que envie o formul&aacute;rio completo por:';
$txt['coppa_send_to_two_options'] = 'Depois e s&oacute; pedir ao teu familiar/tutor que envie o formul&aacute;rio completo por uma destas formas:';
$txt['coppa_send_by_post'] = 'Postal, para o seguinte endere&ccedil;o:';
$txt['coppa_send_by_fax'] = 'Fax, para o seguinte n&uacute;mero:';
$txt['coppa_send_by_phone'] = 'Pode tamb&eacute;m pedir para ligarem para o administrador pelo seguinte n&uacute;mero {PHONE_NUMBER}.';

$txt['coppa_form_title'] = 'Formul&aacute;rio de permiss&atilde;o para registro em ' . $context['forum_name'];
$txt['coppa_form_address'] = 'Endere&ccedil;o';
$txt['coppa_form_date'] = 'Data';
$txt['coppa_form_body'] = 'Eu {PARENT_NAME},<br /><br />Declaro autorizar {CHILD_NAME} (nome do menor) a ser um membro registrado do seguinte F&oacute;rum: ' . $context['forum_name'] . ', com o nome de usu&aacute;rio: {USER_NAME}.<br /><br />Declaro compreender que certo tipo de informa&ccedil;&atilde;o pessoal facultada por {USER_NAME} poder&aacute; ser mostrada a outros usu&aacute;rio do f&oacute;rum.<br /><br />Assinatura:<br />{PARENT_NAME} (Familiar/Tutor).';

$txt['visual_verification_label'] = 'Verifica&ccedil;&atilde;o visual';
$txt['visual_verification_description'] = 'Insira as letras mostradas na imagem';
$txt['visual_verification_sound'] = 'Ouvir as letras';
$txt['visual_verification_sound_again'] = 'Reproduzir novamente';
$txt['visual_verification_sound_close'] = 'Fechar esta janela';
$txt['visual_verification_request_new'] = 'Pedir para mostrar uma nova imagem';
$txt['visual_verification_sound_direct'] = 'Est&aacute; a ter problemas em ouvir isto?  Experimente um link direto para o arquivo.';

?>