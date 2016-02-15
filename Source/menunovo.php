<public:attach event="ondocumentready" onevent="CSSHover()" />
<script>
window.CSSHover=(function(){var m=/(^|\s)((([^a]([^ ]+)?)|(a([^#.][^ ]+)+)):(hover|active|focus))/i;var n=/(.*?)\:(hover|active|focus)/i;var o=/[^:]+:([a-z\-]+).*/i;var p=/(\.([a-z0-9_\-]+):[a-z]+)|(:[a-z]+)/gi;var q=/\.([a-z0-9_\-]*on(hover|active|focus))/i;var s=/msie (5|6|7)/i;var t=/backcompat/i;var u={index:0,list:['text-kashida','text-kashida-space','text-justify'],get:function(){return this.list[(this.index++)%this.list.length]}};var v=function(c){return c.replace(/-(.)/mg,function(a,b){return b.toUpperCase()})};var w={elements:[],callbacks:{},init:function(){if(!s.test(navigator.userAgent)&&!t.test(window.document.compatMode)){return}var a=window.document.styleSheets,l=a.length;for(var i=0;i<l;i++){this.parseStylesheet(a[i])}},parseStylesheet:function(a){if(a.imports){try{var b=a.imports;var l=b.length;for(var i=0;i<l;i++){this.parseStylesheet(a.imports[i])}}catch(securityException){}}try{var c=a.rules;var r=c.length;for(var j=0;j<r;j++){this.parseCSSRule(c[j],a)}}catch(someException){}},parseCSSRule:function(a,b){var c=a.selectorText;if(m.test(c)){var d=a.style.cssText;var e=n.exec(c)[1];var f=c.replace(o,'on$1');var g=c.replace(p,'.$2'+f);var h=q.exec(g)[1];var i=e+h;if(!this.callbacks[i]){var j=u.get();var k=v(j);b.addRule(e,j+':expression(CSSHover(this, "'+f+'", "'+h+'", "'+k+'"))');this.callbacks[i]=true}b.addRule(g,d)}},patch:function(a,b,c,d){try{var f=a.parentNode.currentStyle[d];a.style[d]=f}catch(e){a.runtimeStyle[d]=''}if(!a.csshover){a.csshover=[]}if(!a.csshover[c]){a.csshover[c]=true;var g=new CSSHoverElement(a,b,c);this.elements.push(g)}return b},unload:function(){try{var l=this.elements.length;for(var i=0;i<l;i++){this.elements[i].unload()}this.elements=[];this.callbacks={}}catch(e){}}};var x={onhover:{activator:'onmouseenter',deactivator:'onmouseleave'},onactive:{activator:'onmousedown',deactivator:'onmouseup'},onfocus:{activator:'onfocus',deactivator:'onblur'}};function CSSHoverElement(a,b,c){this.node=a;this.type=b;var d=new RegExp('(^|\\s)'+c+'(\\s|$)','g');this.activator=function(){a.className+=' '+c};this.deactivator=function(){a.className=a.className.replace(d,' ')};a.attachEvent(x[b].activator,this.activator);a.attachEvent(x[b].deactivator,this.deactivator)}CSSHoverElement.prototype={unload:function(){this.node.detachEvent(x[this.type].activator,this.activator);this.node.detachEvent(x[this.type].deactivator,this.deactivator);this.activator=null;this.deactivator=null;this.node=null;this.type=null}};window.attachEvent('onbeforeunload',function(){w.unload()});return function(a,b,c,d){if(a){return w.patch(a,b,c,d)}else{w.init()}}})();
</script>

<style type="text/css">
{ padding: 0; margin: 0; }
	
ul { width: 795px; height: 38px; margin: 0px auto; list-style: none; left:90px;top:180px; position: relative;  }
ul li { float: left; }
	
ul li a { color: #000; font-size: 11px; display: block; width: 100px; height: 30px; position: relative;}
ul li a span { width: 100%; height: 100%; position: absolute; top: 0; left: 0; cursor: pointer;}
ul li a:hover { background-color: fff;filter:alpha(opacity=30);opacity:.3; }

ul li.mn_item1 a { width: 62px; left:0px;position: relative;}
ul li.mn_item2 a { width: 73px; left:10px;position: relative;}
ul li.mn_item3 a { width: 83px; left:19px;position: relative;}						
ul li.mn_item4 a { width: 56px; left:29px;position: relative;}						
ul li.mn_item5 a { width: 60px; left:37px;position: relative;}						
ul li.mn_item6 a { width: 93px; left:45px;position: relative;}						
ul li.mn_item7 a { width: 68px; left:53px;position: relative;}						

li ul{ background-color:#fff; display:none; }

li hover ul, li ul li a:hover ul, li.over ul, li ul li.over ul{display:block;}

li ul li.mn_item2{border:0; display:block; width:110px;}

</style>

<div>
        <ul>
            <li class="mn_item1"><a href="./index.php" title="Pagina Inicial"><span></span></a></li>
            <li class="mn_item2"><a href="#" title="Informações Sobre o Clube"><span></span></a>
            	<ul>
		            <li><a href="#" title="Estatuto"><span></span>Estatuto</a> </li>
		            <li><a href="#" title="Diretoria"><span></span>Diretoria</a> </li>
            	</ul>
            </li>
            <li class="mn_item3"><a href="#" title="Opaleiros Cadastrados"><span></span></a></li>
            <li class="mn_item4"><a href="#" title="Nossa Galeria de Fotos"><span></span></a></li>
            <li class="mn_item5"><a href="#" title="Troca de Informações com a Comunidade"><span></span></a></li>
            <li class="mn_item6"><a href="#" title="Entrevistas com Nossos Opaleiros"><span></span></a></li>
            <li class="mn_item7"><a href="#" title="Fale Conosco"><span></span></a></li>
        </ul>
</div>



