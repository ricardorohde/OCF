<?php include("sessao.php"); ?>
<div>
        <ul id="menu">
            <li class="mn_item1"><a href="./index.php" title="Pagina Inicial"><span>Home</span></a></li>
            <li class="mn_item2"><a href="#" title="Informa��es Sobre o Clube"><span>O Clube</span></a>
            	<ul>
		            <li><a href="#" title="Nossa Hist�ria">Nossa Hist�ria</a> </li>
		            <li><a target="_blank" href="estatuto.doc" title="Estatuto">Estatuto</a> </li>
		            <li><a href="frm_diretoria.php" title="Diretoria">Diretoria</a> </li>
		            <li><a href="#" title="Como se associar ao Opala Clube Franca">Como Ser S�cio</a> </li>
					<?php 
					       if ($_SESSION['logado'] == "SIM" && $_SESSION['niveluser'] == 999999) {
					             echo ("<li> <a href='menu_admin.php'>Administra&ccedil;&atilde;o</a> </li>")."\n";
					          }
					       if ($_SESSION['logado'] == "SIM" && $_SESSION['aprovado'] == 'S') {
					             echo ("<li> <a target='_blank' href='caixa.xls'>Caixa</a> </li>")."\n";
					          }
					   ?>            	
            	</ul>
            </li>
            <li class="mn_item3"><a href="#" title="Opaleiros Cadastrados"><span>Opaleiros</span></a>
              	<ul>
		            <li><a href="lst_membros.php" title="Nossos Associados">Associados</a> </li>
		            <li><a href='lst_cadastro.php' title="Cadastro de Opaleiros">Opaleiros</a> </li>
		            <li><a href="frm_cadusuario.php" title="Cadastre-se em Nosso Site">Cadastre-se</a> </li>
            	</ul>
            </li>
            <li class="mn_item4"><a href="./album" target="_blank" title="Nossa Galeria de Fotos"><span>Fotos</span></a></li>
            <li class="mn_item5"><a href="./forum" target="_blank" title="Troca de Informa��es com a Comunidade"><span>Forum</span></a></li>
            <li class="mn_item6"><a href="#" title="Informa��es Uteis e Curiosidades"><span>Informa��es</span></a>
              	<ul>
		            <li><a href="http://www2.uol.com.br/bestcars/classicos/opala-1.htm" target="_blank" title="Conhe�a a hist�ria do opala">Hist�ria do Opala</a> </li>
		            <li><a href="fichatecnica.php" target="_blank" title="Caracter�sticas t�cnicas do opala">Ficha T�cnica</a> </li>
		            <li><a href="javascript:janela('identchassi.php',50,50,500,500);" title="Identifique o opala pelo numero do chassi">Identifica��o por Chassi</a> </li>
		            <li><a href="entrevistas.php" title="Entrevistas com Nossos Opaleiros">Entrevistas c/ Opaleiros</a> </li>
		            <li><a href="javascript:janela('oracao.php',50,50,300,300);" title="Ora��o nossa de cada dia">Ora��o do Opala</a> </li>
		            <li><a href="#" title="Sites uteis">Sites �teis</a></li>
		            <li><a href="#" title="Manuais do propriet�rio, Catalogo de pe�as, etc">Downloads</a></li>
		            <li><a href="#" title="Calend�rio Anual de Eventos">Calend�rio de Eventos</a></li>
            	</ul>
            </li>
            <li class="mn_item7"><a href="frm_contato.php" title="Fale Conosco"><span>Contato</span></a></li>
        </ul>
</div>