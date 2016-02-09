<?php
// Version: 1.1; Help

global $helptxt;

$helptxt = array();

$txt[1006] = 'Fechar esta janela';

$helptxt['manage_boards'] = '
	<b>Editar f&oacute;runs</b><br />
	Neste menu pode criar/ordenar/apagar f&oacute;runs, e as categorias
	acima deles. Por exemplo, se tiver um site abrangente
	que ofere&ccedil;a informa&ccedil;&atilde;o sobre &quot;esportes&quot;, &quot;Autom&oacute;veis&quot; e &quot;M&uacute;sica&quot;, estas
	seriam as Categorias de n&iacute;vel superior que teria de criar. Dentro de cada uma destas categorias
	poderia criar &quot;sub-categorias&quot; hier&aacute;rquicas,
	ou &quot;F&oacute;runs&quot; dentro de cada uma delas. &Eacute; uma hierarquia simples, com esta estrutura: <br />
	<ul>
		<li>
			<b>Esportes</b>
			&nbsp;- A &quot;categoria&quot;
		</li>
		<ul>
			<li>
				<b>Futebol</b>
				&nbsp;- Um f&oacute;rum dentro da categoria de &quot;esportes&quot;
			</li>
			<ul>
				<li>
					<b>Estat&iacute;sticas</b>
					&nbsp;- Um sub-f&oacute;rum dentro do f&oacute;rum de &quot;Futebol&quot;
				</li>
			</ul>
			<li><b>Basquetebol</b>
			&nbsp;- Um f&oacute;rum dentro da categoria de &quot;esportes&quot;</li>
		</ul>
	</ul>
	As Categorias permitem separar o F&oacute;rum em v&aacute;rios assuntos (&quot;Autom&oacute;veis,
	esportes&quot;), e os &quot;F&oacute;runs&quot; dentro delas cont&ecirc;m os t&oacute;picos dentro dos quais
	os membros podem enviar mensagens. Um usu&aacute;rio interessado em Ferraris
	ir&aacute; enviar uma mensagem em &quot;Autom&oacute;veis->Ferraris&quot;. As Categorias permitem que as pessoas
	encontrem rapidamente aquilo que lhes interessa.<br />
	Assim sendo, um F&oacute;rum &eacute; um objecto chave dentro de cada Categoria.
	Se quer enviar mensagens sobre &quot;Ferraris&quot; vai &agrave; categoria &quot;Autom&oacute;veis&quot; e
	entra no f&oacute;rum &quot;Ferraris&quot; para enviar a sua mensagem.<br />
	As fun&ccedil;&otilde;es administrativas neste menu s&atilde;o as de criar novos f&oacute;runs
	dentro de cada categoria, de orden&aacute;-los (colocar &quot;Ferraris&quot; &agrave; frente de &quot;Porsches&quot;), ou
	apagar os f&oacute;runs.';

$helptxt['edit_news'] = '<b>Editar as Not&iacute;cias do F&oacute;rum</b><br />
	Esta zona permite definir o texto que aparece nas Not&iacute;cias. As Not&iacute;cias aparecem no &Iacute;ndice do F&oacute;rum.
	Pode adicionar quantos itens quiser (ex:, &quot;N&atilde;o percam a sess&atilde;o de Chat com o Administrador nesta Ter&ccedil;a-Feira&quot;).
	Cada item deve ser colocado numa caixa separada. As caixas s&atilde;o mostradas aleat&oacute;riamente nas Not&iacute;cias.';

$helptxt['view_members'] = '
	<ul>
		<li>
			<b>Ver Todos os Membros</b><br />
			Ver todos os membros do F&oacute;rum. Aparece uma lista dos membros com links para os seus perfis. Ao clicar
			num membro pode ter acesso aos seus dados (p&aacute;gina pessoal, idade, etc.), e como Administrador
			voc&ecirc; pode modificar estes par&acirc;metros. Voc&ecirc; tem controlo absoluto sobre os membros, incluindo a
			possibilidade de os remover do F&oacute;rum.<br /><br />
		</li>
		<li>
			<b>Esperando Aprova&ccedil;&atilde;o</b><br />
			Esta sec&ccedil;&atilde;o s&oacute; aparece se ativou a aprova&ccedil;&atilde;o de novos membros pelo Administrador. Qualquer pessoa que se registe
			no F&oacute;rum s&oacute; ser&aacute; aceite como membro caso o Administrador aprove esse mesmo registo. Aqui &eacute; poss&iacute;vel ver uma lista
			de todos os membros que est&atilde;o &agrave; espera de aprova&ccedil;&atilde;o. Pode escolher entre aceitar ou rejeitar (apagar) qualquer membro
			nesta lista clicando na caixa correspondente ao membro e escolhendo a ac&ccedil;&atilde;o a partir do menu drop-down no fundo
			do ecr&atilde;. Ao rejeitar um membro, pode escolher se quer apag&aacute;-lo com ou sem notifica&ccedil;&atilde;o da sua decis&atilde;o.<br /><br />
		</li>
		<li>
			<b>Esperando ativa&ccedil;&atilde;o</b><br />
			Esta sec&ccedil;&atilde;o s&oacute; ser&aacute; vis&iacute;vel se tiver ativado a op&ccedil;&atilde;o de enviar um email de ativa&ccedil;&atilde;o aos membros depois do registo.
			Aqui existe uma lista de todos os membros que ainda n&atilde;o ativaram o seu registo. A partir daqui pode escolher entre
			aceitar, rejeitar ou lembrar os membros para ativarem o seu registo. Tamb&eacute;m pode escolher enviar um email aos membros
			para inform&aacute;-los das suas ac&ccedil;&otilde;es.<br /><br />
		</li>
	</ul>';

$helptxt['ban_members'] = '<b>Bloquear Membros</b><br />
	O SMF fornece a possibilidade de &quot;bloquear&quot; usu&aacute;rios, de modo a prevenir que pessoas que violem as regras
	do F&oacute;rum com SPAM, mensagens obscenas, etc, voltem a fazer o mesmo. Como Administrador,
	quando v&ecirc; as mensagens, pode ver o endere&ccedil;o IP de cada usu&aacute;rio. Na lista de bloqueio, 
	basta inserir esse mesmo IP, gravar, e eles j&aacute; n&atilde;o podem enviar nenhuma mensagem desse local.<br />Tamb&eacute;m &eacute; poss&iacute;vel
	bloquear pessoas atrav&eacute;s do seu endere&ccedil;o de email.';

$helptxt['modsettings'] = '<b>Editar Configura&ccedil;&otilde;es e Op&ccedil;&otilde;es</b><br />
	Existem v&aacute;rias funcionalidades nesta sec&ccedil;&atilde;o que podem ser alteradas de acordo com a sua prefer&ecirc;ncia.
        As op&ccedil;&otilde;es para os pacotes instalados normalmente tamb&eacute;m aparecem aqui.';

$helptxt['number_format'] = '<b>Formato dos N&uacute;meros</b><br />
	Pode usar esta op&ccedil;&atilde;o para formatar a forma como os n&uacute;meros ser&atilde;o mostrados no F&oacute;rum. O formato &eacute; o seguinte:<br />
	<div style="margin-left: 2ex;">1,234.00</div><br />
Onde \',\' &eacute; o caracter usado para dividir o grupo dos milhares, \'.\' &eacute; o caracter usado como ponto decimal e o n&uacute;mero de zeros indica a precis&atilde;o dos arredondamentos.';

$helptxt['time_format'] = '<b>Formato da Hora</b><br />
		Voc&ecirc; tem o poder de ajustar a forma como a data e a hora aparecem no site. Existem muitas letrinhas, mas &eacute; muito simples.
	As conven&ccedil;&otilde;es seguem a fun&ccedil;&atilde;o \'strftime\' do PHP e est&atilde;o descritas em baixo (pode encontrar mais informa&ccedil;&otilde;es em <a href="http://www.php.net/manual/function.strftime.php" target="_blank">php.net</a>).<br />
	<br />
	Os seguintes caracteres s&atilde;o reconhecidos da seguinte maneira:  <br />
	<span class="smalltext">
	&nbsp;&nbsp;%a - nome abreviado da semana <br />
	&nbsp;&nbsp;%A - nome da semana<br />
	&nbsp;&nbsp;%b - nome abreviado do m&ecirc;s <br />
	&nbsp;&nbsp;%B - nome do m&ecirc;s<br />
	&nbsp;&nbsp;%d - dia do m&ecirc;s (01 a 31) <br />
	&nbsp;&nbsp;%D<b>*</b> - o mesmo que %m/%d/%y <br />
	&nbsp;&nbsp;%e<b>*</b> - dia do m&ecirc;s (1 a 31) <br />
	&nbsp;&nbsp;%H - rel&oacute;gio com 24 horas (de 00 a 23) <br />
	&nbsp;&nbsp;%I - rel&oacute;gio com 12 horas (de 01 a 12) <br />
	&nbsp;&nbsp;%m - m&ecirc;s como n&uacute;mero (01 a 12) <br />
	&nbsp;&nbsp;%M - minutos<br />
	&nbsp;&nbsp;%p - ou &quot;am&quot; ou &quot;pm&quot; consoante a hora do dia<br />
	&nbsp;&nbsp;%R<b>*</b> - hora na nota&ccedil;&atilde;o 24 horas<br />
	&nbsp;&nbsp;%S - segundos<br />
	&nbsp;&nbsp;%T<b>*</b> - hora atual, igual a %H:%M:%S <br />
	&nbsp;&nbsp;%y - ano com 2 d&iacute;gitos (00 a 99) <br />
	&nbsp;&nbsp;%Y - ano com 4 d&iacute;gitos<br />
	&nbsp;&nbsp;%Z - zona hor&aacute;ria ou nome ou abrevia&ccedil;&atilde;o<br />
	&nbsp;&nbsp;%% - literalmente, um caracter \'%\'<br />
	<br />
	<i>* N&atilde;o funciona em servidores Windows.</i></span>';

$helptxt['live_news'] = '<b>An&uacute;ncios em directo</b><br />
	Esta caixa mostra os an&uacute;ncios em directo de <a href="http://www.simplemachines.org/">www.simplemachines.org</a>.
	Deve verificar estas informa&ccedil;&otilde;es de vez em quando para saber de atualiza&ccedil;&otilde;es, novas vers&otilde;es e informa&ccedil;&otilde;es importantes sobre o F&oacute;rum
	Simple Machines.';

$helptxt['registrations'] = '<b>Gest&atilde;o de Registos</b><br />
	Esta sec&ccedil;&atilde;o cont&eacute;m todas as fun&ccedil;&otilde;es necess&aacute;rias para gerir os novos registos no F&oacute;rum. Existem at&eacute; quatro
	zonas vis&iacute;veis dependendo da configura&ccedil;&atilde;o do seu F&oacute;rum. Elas s&atilde;o:<br /><br />
	<ul>
		<li>
			<b>Registar Novo Membro</b><br />
			A partir desta sec&ccedil;&atilde;o pode efetuar o registo de novos membros. Isto pode ser &uacute;til nos f&oacute;runs que tenham a op&ccedil;&atilde;o de
			registo de novos membros desativada, ou em casos em que o administrador quer criar uma conta de teste.
			Se a op&ccedil;&atilde;o de ativar o registo estiver ativada no F&oacute;rum, ser&aacute; enviado um email ao novo membro com um link de
			ativa&ccedil;&atilde;o da sua conta. Do mesmo modo, pode escolher enviar um email aos membros com uma nova senha.<br /><br />
		</li>
		<li>
			<b>Editar o Acordo de Registo</b><br />
			Esta zona permite definir o texto para o acordo de registo que &eacute; exibido quando membros se registam no seu f&oacute;rum.
			Pode adicionar ou remover o que quiser da vers&atilde;o original incluida no SMF.<br /><br />
		</li>
		<li>
			<b>Editar os Nomes Reservados</b><br />
			Isto permite adicionar palavras ou frases que n&atilde;o quer que as pessoas usem como nome de usu&aacute;rio ou nome
                        vis&iacute;vel.<br /><br />
		</li>
		<li>
			<b>Defini&ccedil;&otilde;es</b><br />
			Esta sec&ccedil;&atilde;o s&oacute; ser&aacute; vis&iacute;vel se voc&ecirc; tiver
                        permiss&atilde;o de administrador do f&oacute;rum. Desta janela pode decidir sobre o m&eacute;todo de registo
			a usar no f&oacute;rum, assim como outras defini&ccedil;&otilde;es de registo.
		</li>
	</ul>';

$helptxt['modlog'] = '<b>Registo dos Moderadores</b><br />
	Esta sec&ccedil;&atilde;o permite que o Administrador possa ter um registo de todas as ac&ccedil;&otilde;es de modera&ccedil;&atilde;o efetuadas pela equipa de Moderadores. Para assegurar que
	os pr&oacute;prios moderadores n&atilde;o apagam as suas ac&ccedil;&otilde;es, estas ficar&atilde;o guardadas e n&atilde;o poder&atilde;o ser apagadas durante 24 horas.';
$helptxt['error_log'] = '<b>Registo de Erros</b><br />
	O registo de Erros regista todos os erros graves encontrados pelos usu&aacute;rios no F&oacute;rum. Lista todos estes erros por ordem cronol&oacute;gica
	e podem ser reordenados clicando na seta preta junto da data. Pode ainda filtrar os erros clicando na imagem junto de cada &iacute;tem do erro.
	 Isto permite filtrar, por exemplo, todos os erros de um determinado membro. Quando existe um filtro ativo, os &uacute;nicos registos que aparecem ser&atilde;o os que forem iguais a esse filtro.';
$helptxt['theme_settings'] = '<b>Configura&ccedil;&otilde;es do Tema</b><br />
	Esta p&aacute;gina de configura&ccedil;&otilde;es permite alterar as configura&ccedil;&otilde;es espec&iacute;ficas de cada tema. Estas configura&ccedil;&otilde;es incluem op&ccedil;&otilde;es tais como a pasta e o URl dos temas e tamb&eacute;m
	op&ccedil;&otilde;es que afectam o layout de cada tema no F&oacute;rum. A maior parte dos temas tem uma variedade de op&ccedil;&otilde;es configur&aacute;veis,
	permitindo adapt&aacute;-los conforme as suas necessidades.';
$helptxt['smileys'] = '<b>Centro de Adminstra&ccedil;&atilde; de Smileys</b><br />
	Aqui pode adicionar ou remover smileys e conjuntos de smileys. Nota importante: Se um smiley existe num conjunto, tem de existir em todos - caso contr&aacute;rio, pode tornar-se
	confuso para os usu&aacute;rios que usem conjuntos de smileys diferentes.<br /><br />

	Voc&ecirc; tamb&eacute;m pode editar &iacute;cones da mensagem aqui, se tiver permiss&otilde;es para tal.';
$helptxt['calendar'] = '<b>Gestor do Calend&aacute;rio</b><br />
	Aqui pode modificar as defini&ccedil;&otilde;es atuais do calend&aacute;rio, assim como adicionar ou remover feriados ou eventos.';

$helptxt['serversettings'] = '<b>Configura&ccedil;&otilde;es do Servidor</b><br />
	Aqui pode executar a configuração central do seu f&oacute;rum. Esta sec&ccedil;&atilde;o inclui as configura&ccedil;&otilde;es da base de dados e URL, bem como outras
	importantes configura&ccedil;&otilde;es tais como as de mail e as de cache. Tenha cuidado sempre que editar alguma destas configura&ccedil;&otilde;es uma vez que basta um erro para que o f&oacute;rum fique inacess&iacute;vel';

$helptxt['topicSummaryPosts'] = 'Permite definir o n&uacute;mero de mensagens anteriores que aparecem no resumo do t&oacute;pico aquando da resposta ao mesmo.';
$helptxt['enableAllMessages'] = 'Defina isto para o número <em>máximo</em> de mensagens que um tópico pode ter para mostrar o link "todas". Ao definir isto para um valor mais baixo do que o &quot;Número máximo de mensagens para mostrar na página do tópico&quot; significa que o link nunca será mostrado. Se definir para um valor superior pode tornar o f&oacute;rum muito lento.';
$helptxt['enableStickyTopics'] = 'Os t&oacute;picos inamov&iacute;veis s&atilde;o t&oacute;picos que permanecem no topo da lista. Normalmente s&atilde;o usados para mensagens 
		importantes. Apenas os moderadores e administradores podem tornar um t&oacute;pico inamov&iacute;vel.';
$helptxt['allow_guestAccess'] = 'Removendo a selec&ccedil;&atilde;o desta caixa far&aacute; com que os visitantes s&oacute; possam fazer opera&ccedil;&otilde;es b&aacute;sicas - entrada, registo, relembrar senha, etc. - no seu F&oacute;rum. Isto n&atilde;o &eacute; o mesmo que desativar o acesso dos visitantes aos f&oacute;runs.';
$helptxt['userLanguage'] = 'Ativando esta op&ccedil;&atilde;o ir&aacute; permitir que os usu&aacute;rios possam escolher o idioma do F&oacute;rum. Isto n&atilde;o afecta
		a selec&ccedil;&atilde;o pr&eacute;-definida.';
$helptxt['trackStats'] = 'Estat&iacute;sticas<br />Isto ir&aacute; permitir que os usu&aacute;rios possam ver as &uacute;ltimas mensagens e os t&oacute;picos mais populares do F&oacute;rum.
		Ir&aacute; tamb&eacute;m mostrar v&aacute;rias estat&iacute;sticas, tal como o maior n&uacute;mero de membros online, novos membros e novos t&oacute;picos.<hr />
		Vistas de p&aacute;gina:<br />Adiciona outra coluna &agrave;s estat&iacute;sticas com o n&uacute;mero de Hits no F&oacute;rum.';
$helptxt['titlesEnable'] = 'Ativando os t&iacute;tulos de customiza&ccedil;&atilde;o ir&aacute; permitir que os membros com permiss&atilde;o para tal possam criar um t&iacute;tulo especial para eles pr&oacute;prios.
		Isto ser&aacute; mostrado por baixo do seu nome.<br /><i>Por exemplo:</i><br />Jo&atilde;o<br />Tipo Porreiro';
$helptxt['topbottomEnable'] = 'Isto ir&aacute; adicionar os bot&otilde;es de ir para o topo/fundo nas mensagens e t&oacute;picos de modo a que os usu&aacute;rios possam ir para o topo ou fundo das p&aacute;ginas 
		sem fazer scroll.';
$helptxt['onlineEnable'] = 'Isto ir&aacute; mostrar uma imagem a indicar se o membro est&aacute; online ou offline';
$helptxt['todayMod'] = 'Isto ir&aacute; mostrar &quot;Hoje&quot;, ou &quot;Ontem&quot;, em vez da data.';
$helptxt['enablePreviousNext'] = 'Isto ir&aacute; mostrar um link para o t&oacute;pico seguinte e para o t&oacute;pico anterior.';
$helptxt['pollMode'] = 'Isto permite definir se as enquetes est&atilde;o ativadas ou n&atilde;o. Se as enquetes estiverem desativadas, todas as enquetes existentes ser&atilde;o escondidas
		da lista de t&oacute;picos. Pode escolher continuar a mostrar os t&oacute;picos com enquetes selecionando a op&ccedil;&atilde;o
		&quot;mostrar enquetes como T&oacute;picos&quot;.<br /><br />Para escolher quem pode iniciar novas enquetes, ver as enquetes, etc,
		basta editar as permiss&otilde;es necess&aacute;rias. Lembre-se disto se as enquetes n&atilde;o estiverem a funcionar por alguma raz&atilde;o.';
$helptxt['enableVBStyleLogin'] = 'Isto ir&aacute; mostrar uma caixa de entrada mais compacta em todas as p&aacute;ginas do F&oacute;rum.';
$helptxt['enableCompressedOutput'] = 'Esta op&ccedil;&atilde;o ir&aacute; comprimir os dados de modo a poupar largura de banda, 
		no entanto &eacute; necess&aacute;rio ter o zlib instalado no seu servidor.';
$helptxt['databaseSession_enable'] = 'Esta op&ccedil;&atilde;o usa a base de dados para o armazenamento das sess&otilde;es - ajuda nos problemas de expira&ccedil;&atilde;o da sess&atilde;o e pode tornar o f&oacute;rum mais r&aacute;pido.';
$helptxt['databaseSession_loose'] = 'Ativando esta op&ccedil;&atilde;o ir&aacute; diminuir a largura de banda do f&oacute;rum, e fazer com que ao clicar no bot&atilde;o BACK a p&aacute;gina n&atilde;o seja recarregada - a desvantagem &eacute; que os &iacute;cones (novo) n&atilde;o ir&atilde;o ser atualizados, entre outras coisas. (a n&atilde;o ser que clique no link para a p&aacute;gina em vez de usar o bot&atilde;o BACK.)';
$helptxt['databaseSession_lifetime'] = 'Isto &eacute; o n&uacute;mero de segundos para a dura&ccedil;&atilde;o das sess&otilde;es. Se uma sess&atilde;o n&atilde;o for acedida durante demasiado tempo, diz-se que &quot;expirou&quot;. Recomenda-se qualquer coisa acima de 2400.';
$helptxt['enableErrorLogging'] = 'Isto ir&aacute; registar todos os erros, tais como entradas (logins) falhadas, de modo a saber o que correu mal.';
$helptxt['allow_disableAnnounce'] = 'Isto ir&aacute; permitir aos usu&aacute;rios optarem por n&atilde;o receber as notifica&ccedil;&otilde;es dos t&oacute;picos que o administrador marcar como "an&uacute;ncios".';
$helptxt['disallow_sendBody'] = 'Esta op&ccedil;&atilde;o remove a possibilidade de receber o texto completo das mensagens e t&oacute;picos nos e-mails de notifica&ccedil;&atilde;o.<br /><br />Muitas vezes, os membros respondem&agrave; notifica&ccedil;&atilde;o via e-mail, o que, na maioria dos casos vai parar &agrave; caixa de correio do webmaster.';
$helptxt['compactTopicPagesEnable'] = 'Isto simplesmente mostra a o n&uacute;mero de p&aacute;ginas.<br /><i>Exemplo:</i>
		&quot;3&quot; para mostrar: 1 ... 4 [5] 6 ... 9 <br />
		&quot;5&quot; para mostrar: 1 ... 3 4 [5] 6 7 ... 9';
$helptxt['timeLoadPageEnable'] = 'Isto ir&aacute; mostrar o tempo (em segundos) que o SMF demorou a criar a p&aacute;gina em visualiza&ccedil;&atiulde;o. Esta informa&ccedil;&atilde;o ser&aacute; mostrada no final da p&aacute;gina';
$helptxt['removeNestedQuotes'] = 'Isto ir&aacute; mostrar a cita&ccedil;&atilde;o da mensagem em quest&atilde;o e n&atilde;o as outras todas.';
$helptxt['simpleSearch'] = 'Isto ir&aacute; mostrar uma pesquisa simples e um link para uma pesquisa mais avan&ccedil;ada.';
$helptxt['max_image_width'] = 'Isto permite definir um tamanho m&aacute;ximo para as imagens enviadas. As imagens mais pequenas do que o tamanho m&aacute;ximo n&atilde;o ser&atilde;o afectadas.';
$helptxt['mail_type'] = 'Isto permite escolher entre o programa de e-mail padr&atilde;o do PHP e o servidor de email. Preencha os dados do seu servidor de email a n&atilde;o ser que tenha escolhido o sendmail.';
$helptxt['attachmentEnable'] = 'Os anexos s&atilde;o arquivos que os membros podem enviar para o f&oacute;rum e anex&aacute;-los a uma mensagem.<br /><br />
		<b>Verifique a extens&atilde;o dos arquivos</b>:<br /> Quer verificar a extens&atilde;o dos arquivos?<br /><br />
		<b>Arquivos permitidos</b>:<br /> Pode definir os arquivos que s&atilde;o permitidos anexar.<br /><br />
		<b>Pasta dos anexos</b>:<br /> O caminho para os arquivos<br />(exemplo: /home/sites/yoursite/www/forum/anexos)<br /><br />
		<b>Tamanho m&aacute;ximo da pasta de anexos</b> (em KB):<br /> Selecione o tamanho pretendido, incluido todos os arquivos.<br /><br />
		<b>Tamanho M&aacute;ximo dos Anexos por Mensagem</b> (em KB):<br /> Defina o tamanho m&aacute;ximo de todos os anexos numa &uacute;nica mensagem.  Se este valor for menor do que o limite definido por anexo, o limite ser&aacute; definido por esta vari&aacute;vel.<br /><br />
		<b>Tamanho M&aacute;ximo de cada anexo</b> (em KB):<br /> Defina o tamanho m&aacute;ximo de cada anexo.<br /><br />
		<b>Tamanho M&aacute;ximo dos Anexos</b> (em kB):<br /> Defina o tamanho m&aacute;ximo dos anexos.<br /><br />
		<b>Mostrar os anexos como imagens nas mensagens</b>:<br /> Se o arquivo anexo for uma imagem, ela aparecer&aacute; na mensagem.<br /><br />
		<b>Redimensionar as imagens que surgem nas mensagens</b>:<br /> Se proceder desta forma, ser&aacute; guardado um outro arquivo (menor) sendo mostrada uma imagem mais pequena.<br /><br />
		<b>Altura e Largura das imagens a aparecer nas mensagens</b>:<br /> S&oacute; &eacute; usado com a op&ccedil;&atilde;o &quot;Redimensionar as imagens que surgem nas mensagens&quot;, usando a largura e altura m&aacute;ximas para redimensionar as imagens. O redimensionamento ser&aacute; feito porporcionalmente.';
$helptxt['karmaMode'] = 'O prest&iacute;gio &eacute; uma funcionalidade que mostra a popularidade de um membro. Os Membros, se tiverem permiss&atilde;o para isso, podem
		\'aplaudir\' ou \'denegrir\' os outros membros, ou seja, aumentar ou diminuir a sua popularidade. Pode alterar o n&uacute;mero de mensagens
		m&iacute;nimas para que um membro possa votar no &quot;prest&iacute;gio&quot;, o tempo entre cada prest&iacute;gio dado, e decidido pelo administrador.<br /><br />Se os grupos de membros podem ou n&atilde;o votar no prest&iacute;gio dos outros membros &eacute; controlado
		pelas permiss&otilde;es. Se tiver problemas em colocar esta op&ccedil;&atilde;o a funcionar para todos os membros, verifique com aten&ccedil;&atilde;o as permiss&otilde;es.';
// !!! This should be resused or removed.
$helptxt['cal_enabled'] = 'O calend&aacute;rio pode ser usado para mostrar anivers&aacute;rios, ou outros momentos importantes da sua comunidade.<br /><br />
		<b>Mostrar Dias como Link para \'Colocar Evento\'</b>:<br />Isto ir&aacute; permitir que os membros possam colocar eventos no calend&aacute;rio nesse dia, quando clicam na data.<br />
		<b>Mostrar N&uacute;meros das Semanas</b>:<br />Mostra em que semana estamos.<br />
		<b>M&aacute;ximo de dias em avan&ccedil;o no &iacute;ndice do F&oacute;rum</b>:<br />Se estiver definido para 7, ser&atilde;o mostrados tamb&eacute;m os eventos da semana seguinte.<br />
		<b>Mostrar os Feriados no &Iacute;ndice do F&oacute;rum</b>:<br />Mostra os feriados mais pr&oacute;ximos numa barra no &iacute;ndice do F&oacute;rum.<br />
		<b>Mostrar os Anivers&aacute;rios no &Iacute;ndice do F&oacute;rum</b>:<br />Mostra os anivers&aacute;rios mais pr&oacute;ximos numa barra no &iacute;ndice do F&oacute;rum.<br />
		<b>Mostrar os Eventos no &Iacute;ndice do F&oacute;rum</b>:<br />Mostra os eventos mais pr&oacute;ximos numa barra no &iacute;ndice do F&oacute;rum.<br />
		<b>F&oacute;rum para Colocar os Eventos</b>:<br />Qual &eacute; o f&oacute;rum por padr&atilde;o onde os eventos ser&atilde;o colocados?
		<b>Permitir eventos sem link</b>:<br />Permite que os membros coloquem eventos sem link para nenhum f&oacute;rum.<br />
                <b>Ano M&iacute;nimo</b>:<br />Escolha o &quot;primeiro&quot; ano da lista do calend&aacute;rio.<br />
		<b>Ano M&aacute;ximo</b>:<br />Escolha o &quot;&uacute;ltimo&quot; ano da lista do calend&aacute;rio<br />
		<b>Cor dos Anivers&aacute;rios</b>:<br />Escolha a cor do texto dos anivers&aacute;rios<br />
		<b>Cor dos Eventos</b>:<br />Escolha a cor do texto dos eventos<br />
		<b>Cor dos Feriados</b>:<br />Escolha a cor do texto dos feriados<br />
		<b>Permitir que os Eventos Durem V&aacute;rios Dias</b>:<br />selecione a op&ccedil;&atilde;o para permitir que um evento dure mais do que um dia.<br />
		<b>N&uacute;mero M&aacute;ximo de Dias de Dura&ccedil;&atilde;o de um Evento</b>:<br />Escolha o n&uacute;mero m&aacute;ximo de dias de dura&ccedil;&atilde;o de um evento.<br /><br />
		Lembre-se que o uso do calend&aacute;rio (coloca&ccedil;&atilde;o de eventos, visualiza&ccedil;&atilde;o de eventos, etc.) &eacute; controlada pelas permiss&otilde;es.';
$helptxt['localCookies'] = 'O SMF usa cookies para guardar informa&ccedil;&otilde;es sobre o login dos membros nos seus computadores.
	As cookies podem ser armazenadas globalmente (meuservidor.com) ou localmente (meuservidor.com/caminho/para/forum).<br />
	selecione esta op&ccedil;&atilde;o se est&aacute; a ter problemas em que os usu&aacute;rios est&atilde;o sempre a fazer logout automaticamente.<hr />
	As cookies armazenadas globalmente s&atilde;o menos seguras quando s&atilde;o usadas num servidor partilhado (como o Tripod).<hr />
	As cookies locais n&atilde;o funcionam fora da pasta do F&oacute;rum, portanto, se o seu F&oacute;rum est&aacute; em www.meuservidor.com/forum, as p&aacute;ginas como  www.meuservidor.com/index.php n&atilde;o conseguem aceder &agrave; informa&ccedil;&atilde;o.
	Especialmente quando se usa o SSI.php, as cookies globais s&atilde;o recomendadas.';
$helptxt['enableBBC'] = 'Selecionando esta op&ccedil;&atilde;o ir&aacute; permitir que os membros usem o c&oacute;digo BBC (Bulletin Board Code) nas suas mensagens. Este &eacute; um c&oacute;digo semelhante ao HTML mas mais seguro e f&aacute;cil para utilizar dentro do F&oacute;rum.';
$helptxt['time_offset'] = 'Nem todos os aministradores querem que o seu F&oacute;rum use a mesma hora que o servidor em que est&aacute; alojado. Use esta op&ccedil;&atilde;o para especificar uma diferen&ccedil;a (em horas) da sua hora local e da hora do servidor. S&atilde;o permitidos n&uacute;meros negativos e com decimais.';
$helptxt['spamWaitTime'] = 'Aqui pode definir o tempo m&iacute;nimo entre cada mensagem do mesmo IP. Isto pode ser usado para evitar mensagens de SPAM.';

$helptxt['enablePostHTML'] = 'Permite inserir algumas tags b&aacute;sicas de HTML:
	<ul style="margin-bottom: 0;">
		<li>&lt;b&gt;, &lt;u&gt;, &lt;i&gt;, &lt;s&gt;, &lt;em&gt;, &lt;ins&gt;, &lt;del&gt;</li>
		<li>&lt;a href=&quot;&quot;&gt;</li>
		<li>&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;</li>
		<li>&lt;br /&gt;, &lt;hr /&gt;</li>
		<li>&lt;pre&gt;, &lt;blockquote&gt;</li>
	</ul>';

$helptxt['themes'] = 'Aqui pode definir se o tema padr&atilde;o pode ser escolhido, o tema padr&atilde;o para os Visitantes,
	bem como outras op&ccedil;&otilde;es.';
$helptxt['theme_install'] = 'Isto permite que sejam instalados novos temas. Pode faz&ecirc;-lo atrav&eacute;s de uma pasta j&aacute; criada, atrav&eacute;s do envio de um arquivo, ou copiando o tema Default.<br /><br />Note que a pasta tem que ter o arquivo <tt>theme_info.xml</tt>.';
$helptxt['enableEmbeddedFlash'] = 'Esta op&ccedil;&atilde;o permitir&aacute; que os membros usem aplica&ccedil;&otilde;es
	em Flash directamente nas mensagens. Isto pode ser um risco de seguran&ccedil;a,
	USE COM CUIDADO!';
// !!! Add more information about how to use them here.
$helptxt['xmlnews_enable'] = 'Permite que as pessoas possam subscrever as <a href="' . $scripturl . '?action=.xml;sa=news">Not&iacute;cias Recentes</a> e informa&ccedil;&otilde;es semelhantes via RSS/XML. Tamb&eacute;m &eacute;
	recomendado definir um limite m&aacute;ximo para as mensagens/not&iacute;cias recentes porque, quando os dados do RSS
	s&atilde;o mostrados em alguns programas, tais como o Trillian, espera-se que sejam curtos.';
$helptxt['hotTopicPosts'] = 'Altere o n&uacute;mero de mensagens para que um t&oacute;pico chegue &agrave; condi&ccedil;&atilde;o de
	&quot;quente&quot; ou &quot;muito quente&quot;.';
$helptxt['globalCookies'] = 'Permite o uso de cookies independentes do subdom&iacute;nio. Por exemplo, se...<br />
	O seu site est&aacute; em http://www.simplemachines.org/,<br />
	E o seu F&oacute;rum est&aacute; em http://forum.simplemachines.org/,<br />
	Usando esta modifica&ccedil;&atilde;o ir&aacute; permitir ter acesso &agrave; cookie do F&oacute;rum no seu site.';
$helptxt['securityDisable'] = 'Isto <i>desativa</i> a verifica&ccedil;&atilde;o adicional da senha para a zona de administra&ccedil;&atilde;o. N&atilde;o &eacute; recomendado!';
$helptxt['securityDisable_why'] = 'Esta &eacute; a sua senha atual. (a mesma que usa para entrar no f&oacute;rum.)<br /><br />Ao ter que escrever aqui a sua senha aumenta a seguran&ccedil;a da zona de administra&ccedil;&atilde;o e certifica que &eacute; voc&ecirc; que est&aacute; a alterar os dados da administra&ccedil;&atilde;o.';
$helptxt['emailmembers'] = 'Nesta mensagem pode usar algumas &quot;vari&aacute;veis&quot;:<br />
	{$board_url} - O URL do seu F&oacute;rum.<br />
	{$current_time} - A hora atual.<br />
	{$member.email} - O email do membro atual.<br />
	{$member.link} - O link do membro atual.<br />
	{$member.id} - A ID do membro atual.<br />
	{$member.name} - O nome do membro atual.  (para personaliza&ccedil;&atilde;o.)<br />
	{$latest_member.link} - O link para os membros registados mais recentemente.<br />
	{$latest_member.id} - A ID dos membros registados mais recentemente.<br />
	{$latest_member.name} - O nome dos membros registados mais recentemente.';
$helptxt['attachmentEncryptFilenames'] = 'Encriptar os anexos permite que possa ter mais do que um arquivo
	com o mesmo nome, aumenta a seguran&ccedil;a e permite tamb&eacute;m enviar arquivos .php como anexos. Pode, no entanto, ser mais dif&iacute;cil
	reconstruir a sua base de dados se acontecer alguma cat&aacute;strofe.';

$helptxt['failed_login_threshold'] = 'Defina o n&uacute;mero de tentativas de login falhadas antes de direccionar o usu&aacute;rio para o lembrador de senha.';
$helptxt['oldTopicDays'] = 'Se selecionar esta funcionalidade, quando um membro responder a um t&oacute;pico que n&atilde;o tem respostas durante um certo tempo (em dias), ser-lhe-&aacute; mostrada uma mensagem de aviso. Coloque 0 se quiser desativar.';
$helptxt['edit_wait_time'] = 'N&uacute;mero de segundos permitido entre cada modifica&ccedil;&atilde;o de uma mensagem.';
$helptxt['edit_disable_time'] = 'N&uacute;mero de minutos permitido para que o membro possa editar a sua mensagem. Ap&oacute;s este tempo, deixar&aacute; de ser poss&iacute;vel ao membro editar a sua mensagem. Definir para 0 para desativar. <br /><br /><i>Nota: Isto n&atilde;o afecta os membros com permiss&otilde;es para modificar as mensagens dos outros membros.</i>';
$helptxt['enableSpellChecking'] = 'Ativar o corrector ortogr&aacute;fico. TEM de ter o \'pspell\' instalado no seu servidor e o PHP configurado para usar o \'pspell\'. O seu servidor ' . (function_exists('pspell_new') == 1 ? 'TEM' : 'N&Atilde;O TEM') . ' esta fun&ccedil;&atilde;o ativada.';
$helptxt['lastActive'] = 'Defina o n&uacute;mero de minutos para mostrar os usu&aacute;rios ativos nesse per&iacute;odo de tempo no &iacute;ndice do f&oacute;rum. O tempo padr&atilde;o &eacute; de 15 minutos.';

$helptxt['autoOptDatabase'] = 'Esta op&ccedil;&atilde;o optimiza a base de dados a cada X dias. Defina para 1 para fazer uma optimiza&ccedil;&atilde;o di&aacute;ria. Pode tamb&eacute;m especificar um n&uacute;mero m&aacute;ximo de usu&aacute;rios online, de modo a n&atilde;o sobrecarregar o servidor ou causar alguma inconveni&ecirc;ncia aos usu&aacute;rios.';
$helptxt['autoFixDatabase'] = 'Isto ir&aacute; reparar automaticamente as tabelas da base de dados que estejam estragadas e continuar como se nada se tivesse passado. Isto pode ser &uacute;til, porque a &uacute;nica forma de reparar isto &eacute; REPARAR as tabelas e desta forma o F&oacute;rum n&atilde;o ficar&aacute; fora do ar at&eacute; que voc&ecirc; repare ou seja chamado &agrave; aten&ccedil;&atilde;o. &Eacute;-lhe enviado um email sempre que isto acontece.';

$helptxt['enableParticipation'] = 'Isto mostra um pequeno &iacute;cone nos t&oacute;picos em que o usu&aacute;rio enviou mensagens.';

$helptxt['db_persist'] = 'Mant&eacute;m a liga&ccedil;&atilde;o ativa para aumentar o desempenho. Se n&atilde;o est&aacute; a usar um servidor dedicado, isto pode causar alguns problemas com o seu alojamento.';

$helptxt['queryless_urls'] = 'Isto altera o formato dos URLs de modo a que os motores de busca possam pesquisar melhor no F&oacute;rum. Os endere&ccedil;os ir&atilde;o ficar desta maneira: index.php/topic,1.html.<br /><br />Esta fun&ccedil;&atilde;o ' . (strpos(php_sapi_name(), 'apache') !== false ? '' : 'n&atilde;o') . ' funciona no seu servidor.';
$helptxt['countChildPosts'] = 'Selecionado esta caixa significa que o total das mensagens dos sub-f&oacute;runs aparece na primeira p&aacute;gina.<br /><br />O f&oacute;rum pode tornar-se um pouco mais lento.';
$helptxt['fixLongWords'] = 'Esta op&ccedil;&atilde;o quebra as palavras com mais do que um certo n&uacute;mero de caracteres de modo a n&atilde;o alterar o layout do F&oacute;rum.';

$helptxt['who_enabled'] = 'Esta op&ccedil;&atilde;o permite ativar ou desativar a possibilidadede dos usu&aacute;rios poderem ver quem est&aacute; online no F&oacute;rum e o que est&aacute; a fazer.';

$helptxt['recycle_enable'] = '&quot;Recicla&quot; os t&oacute;picos e mensagens apagadas para um determinado f&oacute;rum.';

$helptxt['enableReportPM'] = 'Esta op&ccedil;&atilde;o permite ativar ou desativar a possibilidadede dos usu&aacute;rios notificarem os administradores de mensagens pessoais enviadas abusivamente por outros membros. Pode ser &uacute;til para acabar com alguns abusos.';
$helptxt['max_pm_recipients'] = 'Esta op&ccedil;&atilde;o permite definir o n&uacute;mero m&aacute;ximo de recipientes permitidos numa mensagem pessoal enviada por um membro do f&oacute;rum. Isto pode ser usado para evitar o envio de spam atrav&eacute;s das MP. Note que os membros com permiss&otilde;es para enviar newsletters est&atilde;o isentos deste limite. Defina para zero para n&atilde;o ter limite.';
$helptxt['pm_posts_verification'] = 'Esta defini&ccedil;&atilde;o ir&aacute; for&ccedil;ar os usu&aacute;rios a inserir o c&oacute;digo mostrado numa imagem de verifica&ccedil;&atilde;o de cada vez que enviam uma mensagem pessoal. Apenas os usu&aacute;rios com um n&uacute;mero de mensagens abaixo do n&uacute;mero definido ter&atilde;o que inserir este c&oacute;digo - isto deve ajudar a combater o spam no seu f&oacute;rum.';
$helptxt['pm_posts_per_hour'] = 'Isto ir&aacute; limitar o n&uacute;mero de mensagens pessoais que podem ser enviadas por um usu&aacute;rio no per&iacute;odo de 1 hora. Esta op&ccedil;&atilde;o n&atilde;o afecta os administradores nem os moderadores.';

$helptxt['default_personalText'] = 'Defina o texto padr&atilde;o que os usu&aacute;rios ter&atilde;o no seu &quot;texto pessoal.&quot;';

$helptxt['modlog_enabled'] = 'Regista todas as ac&ccedil;&otilde;es dos moderadores.';

$helptxt['guest_hideContacts'] = 'Se esta op&ccedil;&atilde;o estiver selecionada, os endere&ccedil;os de email e os contactos de Messenger dos membros
  ser&atilde;o escondidos dos visitantes do F&oacute;rum';

$helptxt['registration_method'] = 'Esta op&ccedil;&atilde;o determina qual o m&eacute;todo de registo usado quando algu&eacute;m se regista no F&oacute;rum. Pode escolher entre:<br /><br />
	<ul>
		<li>
			<b>Registo Desativado:</b><br />
				Desativa o processo de registo, o que significa que n&atilde;o poder&aacute; haver o registo de novos membros no F&oacute;rum.<br />
		</li><li>
			<b>Registo Imediato:</b><br />
				Os novos membros podem entrar e enviar mensagens imediatamente ap&oacute;s o registo.<br />
		</li><li>
			<b>ativa&ccedil;&atilde;o de Membros:</b><br />
				Quando esta op&ccedil;&atilde;o est&aacute; ativada, qualquer membro que se registe no F&oacute;rum ter&aacute; de ativar o seu registo atrav&eacute;s de um link que lhe &eacute; enviado por email. Enquanto que or egisato n&atilde;o for ativado, o usu&aacute;rio n&atilde;o pode entrar no F&oacute;rum.<br />
		</li><li>
			<b>Aprova&ccedil;&atilde;o dos Membros:</b><br />
				Esta op&ccedil;&atilde;o far&aacute; com que cada novo membro que se registe no F&oacute;rum tenha que ser aprovado pelo administrador antes de poder entrar.
		</li>
	</ul>';
$helptxt['send_validation_onChange'] = 'Quando esta op&ccedil;&atilde;o est&aacute; ativada, todos os membros que alterem o seu endere&ccedil;o de email no perfil ter&atilde;o de reativar a sua conta atrav&eacute;s de um email enviado para o endere&ccedil;o indicado.';
$helptxt['send_welcomeEmail'] = 'Quando esta op&ccedil;&atilde;o est&aacute; ativada, todos os novos membros receber&atilde;o um email de boas-vindas ao F&oacute;rum.';
$helptxt['password_strength'] = 'Determina o tamanho m&iacute;nimo da palavra-passe. Quanto maior, menos possibilidade de ser violada, logo mais segura.
	Op&ccedil;&otilde;es dispon&iacute;veis:
	<ul>
		<li><b>Baixa:</b> A palavra-passe tem de ter pelo menos 4 caracteres.</li>
		<li><b>M&eacute;dia:</b> A palavra-passe tem que ter pelo menos oito caracteres e n&atilde;o pode conter o nome ou e-mail do usu&aacute;rio.</li>
		<li><b>Alta:</b> As mesmas caracter&iacute;sticas da m&eacute;dia excepto o facto de ter que conter letras e pelo menos um n&uacute;mero.</li>
	</ul>';

$helptxt['coppaAge'] = 'O valor escrito nesta caixa determina a idade m&iacute;nima dos novos membros para que possam frequentar o f&oacute;rum.
	Durante o registo os usu&aacute;rios tem que confirmar e aceitar os termos de acesso. Cabe aos pais e tutores autorizarem os menores a terem acesso.
	Para ignorar a idade basta colocar 0 neste local.';
$helptxt['coppaType'] = 'Se as restri&ccedil;&otilde;es de idade estiverem ativas, estas ser&atilde;o as defini&ccedil;&otilde;es do que acontecer&aacute; se o usu&aacute;rio tiver idade inferior. Existem duas hip&oacute;teses:
	<ul>
		<li>
			<b>Rejeitar o registo:</b><br />
				Qualquer membro que viole a idade m&iacute;nima ver&aacute; o seu registo imediatamente rejeitado.<br />
		</li><li>
			<b>Requerer aprova&ccedil;&atilde;o paternal:</b><br />
				Qualquer membro que tente registar-se e viole a idade m&iacute;nima ver&aacute; a sua conta marcada como "Aguardando aprova&ccedil;&atilde;o dos pais/tutores". S&oacute; depois tem acesso ao f&oacute;rum.
				Podem aceder aos contactos de forma a poderem enviar o formul&aacute;rio de aprova&ccedil;&atilde;o aos administradores por e-mail ou fax.
		</li>
	</ul>';
$helptxt['coppaPost'] = 'Requere-se o contacto para garantir a aprova&ccedil;&atilde;o paternal para o registo dos menores. Este formul&aacute;rio &eacute; detalhado de forma a garantir que os menores foram de facto autorizados. Tem de ser indicado pelo menos a morada e telefone para contacto.';

$helptxt['allow_hideOnline'] = 'Com esta op&ccedil;&atilde;o ativada, todos os membros poder&atilde;o esconder o seu estado online dos outros usu&aacute;rios (excepto os administradores). Se estiver desativada, apenas os moderadores podem ocultar a sua presen&ccedil;a. NOTA: Esta op&ccedil;&atilde;o n&atiled;o altera o estado de nenhum usu&aacute;rio - apenas evita que eles se possam esconder.';
$helptxt['allow_hideEmail'] = 'Com esta op&ccedil;&atilde;o ativada, os membros podem escolher se querem esconder o seu endere&ccedil;o de email dos outros membros. No entanto, os administradores podem ver sempre os emails de todos os membros.';

$helptxt['latest_support'] = 'Este painel mostra alguns dos problemas e perguntas mais comuns na configura&ccedil;&atilde;o do servidor. N&atilde;o se preocupe, esta informa&ccedil;&atilde;o n&atilde;o fica registada em lado nenhum.<br /><br />Se aparecer a mensagem &quot;Procurando informa&ccedil;&otilde;es de suporte...&quot;, o seu computador provavelmente n&atilde;o consegue fazer a liga&ccedil;&atilde;o a <a href="http://www.simplemachines.org/">www.simplemachines.org</a>.';
$helptxt['latest_packages'] = 'Aqui pode ver alguns dos Pacotes e MODs mais populares, com instala&ccedil;&otilde;es r&aacute;pidas e f&aacute;ceis.<br /><br />Se esta informa&ccedil;&atilde;o n&atilde;o aparecer, o seu computador provavelmente n&atilde;o consegue fazer a liga&ccedil;&atilde;o a <a href="http://www.simplemachines.org/">www.simplemachines.org</a>.';
$helptxt['latest_themes'] = 'Esta &aacute;rea mostra alguns dos temas mais populares directamente de <a href="http://www.simplemachines.org/">www.simplemachines.org</a>. Se n&atilde;o aparecer correctamente, &eacute; provavel que o seu computador n&atilde;o consiga aceder a <a href="http://www.simplemachines.org/">www.simplemachines.org</a>.';

$helptxt['secret_why_blank'] = 'Para sua seguran&ccedil;a, a resposta &agrave; sua pergunta (bem como a sua senha) est&atilde;o encriptadas de forma a que apenas lhe podemos dizer se acertou ou n&atilde;o. N&atilde;o &eacute; poss&iacute;vel mostrar-lhe (e mais importante, n&atilde;o &eacute; poss&iacute;vel mostrar a mais ningu&eacute;m!) qual a resposta &agrave; sua pergunta.';
$helptxt['moderator_why_missing'] = 'Uma vez que a modera&ccedil;&atilde;o &eacute; feita f&oacute;rum a f&oacute;rum, ter&aacute; que tornar os membros moderadores a partir do menu de <a href="javascript:window.open(\'' . $scripturl . '?action=manageboards\'); self.close();">gest&atilde;o de f&oacute;runs</a>.';

$helptxt['permissions'] = 'As permiss&otilde;es s&atilde;o o m&eacute;todo que voc&ecirc; tem para permitir ou negar grupos de realizarem certas ac&ccedil;&otilde;es.<br /><br />Pode modificar m&uacute;ltiplos f&oacute;runs ao mesmo tempo com as caixas de verifica&ccedil;&atilde;o, ou ver as permiss&otilde;es para um grupo espec&iacute;fico clicando em  \'Modificar.\'';
$helptxt['permissions_board'] = 'Se um f&oacute;rum est&aacute; definido para \'Global,\' significa que o f&oacute;rum n&atilde;o tem nenhumas permiss&otilde;es especiais. \'Local\' significa que o f&oacute;rum tem permiss&otilde;es espec&iacute;ficas - separadas das permiss&otilde;es globais. Isto permite ter um f&oacute;rum com mais ou menos permiss&otilde;es do que outro, sem ser necess&aacute;rio defini-las para cada f&oacute;rum individualmente.';
$helptxt['permissions_quickgroups'] = 'Isto permite usar as configura&ccedil;&otilde;es por &quot;padr&atilde;o&quot; das permiss&otilde;es - normal significa \'nada de especial\', restritivo significa \'igual a um visitante\', moderador significa \'aquilo a que um moderador tem acesso\', e finalmente \'manuten&ccedil;&atilde;o\' significa ter permiss&otilde;es quase iguais a um administrador.';
$helptxt['permissions_deny'] = 'Negar permiss&otilde;es pode ser &uacute;til quando se pretende tirar permiss&otilde;es a certos membros. Pode-se adicionar o grupo de membros sem permiss&otilde;es e colocar os membros que pretendemos que fiquem sem permiss&otilde;es.<br /><br />Use com cuidado, negar permiss&otilde;es a um membro far&aacute com que deixe de as ter independentemente dos grupos a que pertencer.';
$helptxt['permissions_postgroups'] = 'Ao ativar as permiss&otilde;es para grupos baseados em mensagens permitir&aacute; atribuir permiss&otilde;es a membros que j&aacute; tenham escrito algumas mensagens.  As permiss&otilde;es para membros baseadas em n&uacute;mero de mensagens s&atilde;o <em>adicionadas</em> &agraves permiss&otilde;es dos grupos normais.';
$helptxt['permissions_by_board'] = 'ativar esta op&ccedil;&atilde;o far&aacute; com que se possa configurar diferentes permiss&otilde;es para cada f&oacute;rum em cada grupo de membros. Por padr&atilde;o, os f&oacute;runs assumem as permiss&otilde;es globais, mas com esta op&ccedil;&atilde;o ativada, pode-se definir permiss&otilde;es individuais. Assim ter&aacute; uma forma sofisticada de gerir as suas permiss&otilde;es.';
$helptxt['membergroup_guests'] = 'O grupo dos visitantes &eacute; o grupo dos usu&aacute;rios que n&atilde;o entraram no F&oacute;rum ou que n&atilde;o est&atilde;o registados.';
$helptxt['membergroup_regular_members'] = 'Membros regulares s&atilde;o todos os que est&atilde;o registados e entraram no F&oacute;rum, mas n&atilde;o pertencem a nenhum grupo de membros especial.';
$helptxt['membergroup_administrator'] = 'O administrador pode, por padr&atilde;o, fazer qualquer coisa e ver todos os f&oacute;runs. Como tal n&atilde;o existe possibilidade de configurar as permiss&otilde;es para os administradores.';
$helptxt['membergroup_moderator'] = 'O grupo dos moderadores &eacute; um grupo especial. Existem permiss&otilde;es especificas para este grupo aplicadas a todos os moderadores definidos como tal <em>no f&oacute;rum do qual s&atilde;o moderadores</em>. Fora desses f&oacute;runs eles permanecem como simples membros.';
$helptxt['membergroups'] = 'No SMF h&aacute; dois tipos de grupos de que os membros podem fazer parte. Estes s&atilde;o:
	<ul>
		<li><b>Grupos Regulares:</b> &Eacute; um grupo em que os membros n&atilde;o s&atilde;o automaticamente inscritos. Para incluir um usu&aacute;rio neste tipo de grupos, &eacute; necess&aacute;rio ir ao Perfil e clicar em &quot;Configura&ccedil;&otilde;es da Conta&quot;. A partir daqui pode inclu&iacute;-lo em qualquer grupo regular.</li>
		<li><b>Grupos de Mensagens:</b> Ao contr&aacute;rio dos grupos regulares, os grupos baseados em mensagens incluem os membros automaticamente quando estes atingem o n&uacute;mero m&iacute;nimo de mensagens para aceder a esse grupo.</li>
	</ul>';

$helptxt['calendar_how_edit'] = 'Pode editar estes eventos clicando no asterisco vermelho (*) pr&oacute;ximo dos nomes.';

$helptxt['maintenance_general'] = 'A partir daqui pode optimizar todas as tabelas da base de dados (torn&aacute;-las mais pequenas e r&aacute;pidas!), certificar-se que tem as vers&otilde;es mais recentes dos arquivos, procurar erros que possam dar problemas ao bom funcionamento do F&oacute;rum, recontar os totais, e limpar os registos.<br /><br />Os &uacute;ltimos dois devem ser evitados a n&atilde;o ser que haja alguma coisa errada.';
$helptxt['maintenance_backup'] = 'Esta &aacute;rea permite gravar uma c&oacute;pia de todas as mensagens, configura&ccedil;&otilde;es, membros, e outras informa&ccedil;&otilde;es do F&oacute;rum num arquivo muito grande.<br /><br />&Eacute; recomendado fazer isto v&aacute;rias vezes, talvez semanalmente, por raz&otilde;es de seguran&ccedil;a.';
$helptxt['maintenance_rot'] = 'Isto permite remover <b>completamente</b> e <b>irremediavelmente</b> todos os t&oacute;picos mais antigos. &Eacute; recomendado que fa&ccedil;a primeiro um backup, para o caso de ocorrer alguma desgra&ccedil;a.<br /><br />Use esta op&ccedil;&atilde;o com muito cuidado.';

$helptxt['avatar_allow_server_stored'] = 'Isto permite que os membros possam escolher avatars guardados no seu servidor. Eles est&atilde;o, normalmente, dentro do SMF na pasta Avatars.<br />DICA: Se criar pastas dentro dessa pasta, pode criar &quot;categorias&quot; de avatars.';
$helptxt['avatar_allow_external_url'] = 'Com esta op&ccedil;&atilde;o ativada, os membros podem selecionar um avatar a partir de um site externo atrav&eacute;s de um URL. O negativo disto &eacute; que, em alguns casos, eles podem querer usar avatars demasiado grandes ou usar imagens que voc&ecirc; n&atilde;o quer no seu F&oacute;rum.<br /><br />Lembre-se que os membros precisam de ter permiss&atilde;o para escolher um avatar remoto para que esta op&ccedil;&atilde;o funcione.';
$helptxt['avatar_download_external'] = 'Com esta op&ccedil;&atilde;o ativada, o avatar escolhido pelo usu&aacute;rio ser&aacute; transferido para o seu servidor. Se tudo correr bem, ser&aacute; como se o usu&aacute;rio tivesse enviado a sua imagem.';
$helptxt['avatar_allow_upload'] = 'Esta op&ccedil;&atilde;o &eacute; semelhante &agrave; de &quot;Permitir que os membros escolham um avatar externo&quot;, excepto que voc&ecirc; tem mais controlo sobre os avatars, uma maior rapidez ao redimension&aacute;-los, e os seus membros n&atilde;o precisam de ter um local para colocarem os seus avatars.<br /><br />No entanto, o negativo disto &eacute; que pode ocupar bastante espa&ccedil;o no seu servidor.';
$helptxt['avatar_download_png'] = 'Os PNGs s&atilde;o maiores, mas oferecem uma melhor qualidade de compress&atilde;o. Se esta op&ccedil;&atilde;o estiver desativada, ser&aacute; usado o formato JPEG - que normalmente &eacute; mais pequeno, mas tamb&eacute;m tem uma qualidade de imagem pior.';

$helptxt['disableHostnameLookup'] = 'Isto desativa a verifica&ccedil;&atilde;o do hostname, o que, em alguns servidores, pode ser muito lento. Note que isto ir&aacute; tornar o bloqueio menos eficiente.';

$helptxt['search_weight_frequency'] = 'Os factores de Peso s&atilde;o usados para determinar a relev&acirc;ncia dos resultados da pesquisa. Altere estes factores para aqueles que acha serem mais adequados para o seu F&oacute;rum. Por exemplo, um F&oacute;rum de um site de not&iacute;cias, poder&aacute; querer uma maior relev&acirc;ncia para o factor \'idade da &uacute;ltima mensagem\'. Todos os valores s&atilde;o relativos em rela&ccedil;&atilde;o aos outros e t&ecirc;m de ser valores positivos.<br /><br />Este factor conta a quantidade de mensagens coincidentes e divide-as pelo n&uacute;mero total de mensagens de cada t&oacute;pico.';
$helptxt['search_weight_age'] = 'Os factores de Peso s&atilde;o usados para determinar a relev&acirc;ncia dos resultados da pesquisa. Altere estes factores para aqueles que acha serem mais adequados para o seu F&oacute;rum. Por exemplo, um F&oacute;rum de um site de not&iacute;cias, poder&aacute; querer uma maior relev&acirc;ncia para o factor \'idade da &uacute;ltima mensagem\'. Todos os valores s&atilde;o relativos em rela&ccedil;&atilde;o aos outros e t&ecirc;m de ser valores positivos.<br /><br />Este factor d&aacute; um valor &agrave; idade da &uacute;ltima mensagem de um t&oacute;pico. Quanto mais recente for a mensagem, mais alto ser&aacute; o seu valor.';
$helptxt['search_weight_length'] = 'Os factores de Peso s&atilde;o usados para determinar a relev&acirc;ncia dos resultados da pesquisa. Altere estes factores para aqueles que acha serem mais adequados para o seu F&oacute;rum. Por exemplo, um F&oacute;rum de um site de not&iacute;cias, poder&aacute; querer uma maior relev&acirc;ncia para o factor \'idade da &uacute;ltima mensagem\'. Todos os valores s&atilde;o relativos em rela&ccedil;&atilde;o aos outros e t&ecirc;m de ser valores positivos.<br /><br />Este factor baseia-se no tamanho do t&oacute;pico. Quantas mais mensagens tiver um t&oacute;pico, mais alto ser&aacute; o seu valor.';
$helptxt['search_weight_subject'] = 'Os factores de Peso s&atilde;o usados para determinar a relev&acirc;ncia dos resultados da pesquisa. Altere estes factores para aqueles que acha serem mais adequados para o seu F&oacute;rum. Por exemplo, um F&oacute;rum de um site de not&iacute;cias, poder&aacute; querer uma maior relev&acirc;ncia para o factor \'idade da &uacute;ltima mensagem\'. Todos os valores s&atilde;o relativos em rela&ccedil;&atilde;o aos outros e t&ecirc;m de ser valores positivos.<br /><br />Este factor verifica se o termo da pesquisa pode ser encontrado no assunto do t&oacute;pico.';
$helptxt['search_weight_first_message'] = 'Os factores de Peso s&atilde;o usados para determinar a relev&acirc;ncia dos resultados da pesquisa. Altere estes factores para aqueles que acha serem mais adequados para o seu F&oacute;rum. Por exemplo, um F&oacute;rum de um site de not&iacute;cias, poder&aacute; querer uma maior relev&acirc;ncia para o factor \'idade da &uacute;ltima mensagem\'. Todos os valores s&atilde;o relativos em rela&ccedil;&atilde;o aos outros e t&ecirc;m de ser valores positivos.<br /><br />Este factor verifica se o termo da pesquisa pode ser encontrado na primeira mensagem do t&oacute;pico.';
$helptxt['search_weight_sticky'] = 'Os factores de peso s&atilde;o usados para determinar a relev&acirc;ncia do resultado de uma pesquisa. Altere estes factores de peso para que os resultados reflictam aquilo que &eacute; realmente importante no seu f&oacute;rum. Por exemplo, um f&oacute;rum de um site de not&iacute;cias poder&aacute; querer um valor relativamente alto para \'idade da &uacute;ltima mensagem\'. Todos os valores s&atilde;o relativos em rela&ccedil;&atilde;o aos outros e devem ser algarismos positivos.<br /><br />Este factor verifica se um t&oacute;pico &eacute; inamov&iacute;vel e aumenta a relev&acirc;ncia dos resultados.';
$helptxt['search'] = 'Ajuste aqui todas as configura&ccedil;&otilde;es para a fun&ccedil;&atilde;o de pesquisa.';
$helptxt['search_why_use_index'] = 'Um &iacute;ndice pode aumentar bastante a velocidade das pesquisas no f&oacute;rum. Especialmente quando o n&uacute;mero de mensagens no f&oacute;rum vai crescendo, a pesquisa sem um &iacute;ndice pode demorar muito tempo e aumentar a carga no servidor e na base de dados. Se o seu f&oacute;rum tem mais de 50.000 mensagens, recomendamos a cria&ccedil;&atilde;o de um &iacute;ndice para melhorar o desempenho do seu f&oacute;rum.<br /><br />Note que um &iacute;ndice pode ocupar bastante espa&ccedil;o no servidor. Um &iacute;ndice de texto completo &eacute; uma funcionalidade do MySQL. &Eacute; relativamente compacto (aproximadamente do mesmo tamanho que a tabela de mensagens), mas muitas palavras n&atilde;o s&atilde;o indexadas e pode fazer com que algumas pesquisas se tornem muito lentas. O &iacute;ndice customizado &eacute; geralmente maior (dependendo da sua configura&ccedil;&atilde;o pode ser at&eacute; 3 vezes o tamanho da tabela de mensagens) mas o seu desempenho &eacute; melhor e mais est&aacute;vel do que um &iacute;ndice de texto completo.';

$helptxt['see_admin_ip'] = 'Os endere&ccedil;os de IP s&atilde;o mostrados aos administradores e moderadores para facilitar a modera&ccedil;&atilde;o e para tornar mais f&aacute;cil seguir os passos dados pelos usu&aacute;rios com fins malignos. De notar que nem todos os endere&ccedil;os de IP podem ser identificados, e a maioria dos IPs muda periodicamente.<br /><br />Os membros tamb&eacute;m podem ver o seu pr&oacute;prio IP.';
$helptxt['see_member_ip'] = 'O seu endere&ccedil;o de IP &eacute; mostrado apenas a si e aos moderadores. Esta informa&ccedil;&atilde;o n&atilde;o permite identific&aacute;-lo, e a maioria dos IPs mudam periodicamente.<br /><br />Voc&ecirc; n&atilde;o pode ver os IPs dos outros usu&aacute;rios, da mesma forma que eles tamb&eacute;m n&atilde;o podem ver o seu.';

$helptxt['ban_cannot_post'] = 'Colocar um membro como \'n&atilde;o pode postear\', aos olhos dele o f&oacute;rum torna-se apenas de leitura, sendo um usu&aacute;rio bloqueado. Este usu&aacute;rio fica pro&iacute;bido de criar novos t&oacute;picos, ou responder aos existentes, enviar mensagens pessoais ou votar nas enquetes. Os usu&aacute;rios bloqueados podem no entanto ler as mensagens pessoais e os t&oacute;picos.<br /><br />Uma mensagem de aviso &eacute; mostrada aos usu&aacute;rios bloqueados desta forma.';

$helptxt['posts_and_topics'] = '
	<ul>
		<li>
			<b>Defini&ccedil;&otilde;es das mensagens</b><br />
			Aqui pode modificar as defini&ccedil;&otilde;es relacionadas com as mensagens e a forma como as mesmas s&atilde;o mostradas. Pode-se tamb&eacute;m ativar aqui o corrector ortogr&aacute;fico.
		</li><li>
			<b>C&oacute;digo BBC</b><br />
			ativar o c&oacute;digo que mostrar&aacute; as mensagens com a formata&ccedil;&atilde;o correcta. Pode  tamb&eacute;m ajustar quais os c&oacute;digos permitidos e os proibidos.
		</li><li>
			<b>Palavras censuradas</b><br />
			De forma a manter o n&iacute;vel da linguagem do f&oacute;rum sob controlo, pode-se definir a censura de certas palavras. Esta fun&ccedil;&atilde;o permite converter palavras proibidas em vers&otilde;es mais inocentes.
		</li><li>
			<b>Defini&ccedil;&otilde;es dos t&oacute;picos</b><br />
			Modificar as defini&ccedil;&otilde;es relacionadas com os t&oacute;picos. O n&uacute;mero de t&oacute;picos por p&aacute;gina, a possibilidade de ter t&oacute;picos inamov&iacute;veis, o n&uacute;mero de mansagens necess&aacute;rias para que o t&oacute;pico seja considerado quente, etc.
		</li>
	</ul>';

?>