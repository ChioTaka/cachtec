(function(win){
    var fn = {
	
		/*************************************** VALIDAR DATA  ***************************************************/
		
		tamanhoDaTela: function(alturaOuLargura){
			// Se aluraOuLargura == altura retorna a altura da tela
			// Se aluraOuLargura == largura retorna a largura da tela
			// Ou  retorna {altura: altura, largura: largura}
			var w = 0;var h = 0;
			//IE
			if(!window.innerWidth){
				if(!(document.documentElement.clientWidth == 0)){	
					//strict mode
					w = document.documentElement.clientWidth;h = document.documentElement.clientHeight;
				} else{
					//quirks mode
					w = document.body.clientWidth;h = document.body.clientHeight;
				}
			} else {
				//w3c
				w = window.innerWidth;h = window.innerHeight;
			}
			if(alturaOuLargura == 'a' || alturaOuLargura =='altura'){ 
				return h;
			}else if(alturaOuLargura == 'l' || alturaOuLargura =='largura'){ 
				return w;
			} else{
				return {largura:w,altura:h};
			}
		},
	
		/*************************************** VALIDAR DATA  ***************************************************/
		ValidarData : function (ano, mes, dia){
			dia = dia < 10 ? '0' + parseFloat( dia ) : parseFloat( dia ) ;		
			mes = mes < 10 ? '0' + parseFloat( mes ) : parseFloat( mes ) ;
			var d = ano + '-' + mes + '-' + dia ;
			var data = new Date(d);
			if( (( data.getMonth() + 1 ) != mes ) || (data == 'Invalid Date') ){					
				return false;
			}else{
				return d;
			}
		},
		
		/*************************************** MENSAGEM DE ERRO  ***************************************************/
		
		erro : function (texto, callback){
			if(texto){
				var imagem = 'http://gps.net.co.ao/images/erro.png';
				//var imagem = 'http://127.0.0.1/gps/images/erro.png';
				var corDaLetra = '#9B0000';
				var divAlert = '<div id="divAlert" style="display:none;position:fixed;top:15%;margin:0 auto;text-align:center;width:100%;font-family:Verdana, Geneva, sans-serif;z-index:9;" ><div align="center">        <table align="center" cellspacing="12" style="width:100%;max-width:430px;background-color:#eeeeee;padding:6px;padding-top:0px;border:#06F 1px solid;color:#000;">            <tr><td class="sairDaDivAlert" align="right" style="padding:3px;cursor:pointer;font-weight:normal;font-size:16px;" >X</td></tr>            <tr><td align="left" style="font-size:18px;">Caríssimo (a)</td></tr>            <tr><td id="corDaLetra" align="left" style="-webkit-transition: 0.9s;width:100%; ">	     <table width="100%"> <tr> <td align="center" id="mensagemImagem">  </td><td id="mensagemTexto"> </td></tr></table>	                          	 </td></tr>            <tr><td align="right" class="sairDaDivAlert" > <b  style="padding:6px;padding-left:80px;padding-right:80px;cursor:pointer;background-color:#cbcbcb;font-weight:normal;float:right;"> OK </b></td></tr>        </table>    </div></div>';
				var darkBackGround = '<div class="darkBackGround sairDaDivAlert" style="width:100%;height:100%;position:fixed;top:0px;background-color:#000;opacity:0.75;z-index:7;display:none;"> </div>';
				
				
				if(!($("#divAlert").html())) $(""+divAlert).appendTo('body');
				if(!($(".darkBackGround").html())) $('body').append(darkBackGround);
				
				$("#divAlert #mensagemTexto").html(texto);
				$("#divAlert #mensagemImagem").html('<img  src="'+imagem+'" alt="erro" style="padding:5px; width:auto;height:30px;">');
				
				$(".darkBackGround").fadeIn('fast', function(){ $("#divAlert").show('fast') });
				$(".sairDaDivAlert").click( function (){
					$("#divAlert").hide('fast',function(){ 
						$(".darkBackGround").fadeOut('fast', function(){
							if(callback) callback();
						}) 
					});
				});
			}
		
		},
		
		
		/*************************************** MENSAGEM DE SUCESSO  ***************************************************/
		
		sucesso : function (texto, callback){
			if(texto){
				var imagem = 'http://gps.net.co.ao/images/sucesso.png';
				//var imagem = 'http://127.0.0.1/gps/images/sucesso.png';
				var corDaLetra = '#009191';
				var divAlert = '<div id="divAlert" style="display:none;position:fixed;top:15%;margin:0 auto;text-align:center;width:100%;font-family:Verdana, Geneva, sans-serif;z-index:9;" ><div align="center">        <table align="center" cellspacing="12" style="width:100%;max-width:430px;background-color:#eeeeee;padding:6px;padding-top:0px;border:#06F 1px solid;color:#000;">            <tr><td class="sairDaDivAlert" align="right" style="padding:3px;cursor:pointer;font-weight:normal;font-size:16px;" >X</td></tr>            <tr><td align="left" style="font-size:18px;">Caríssimo (a)</td></tr>            <tr><td id="corDaLetra" align="left" style="-webkit-transition: 0.9s;width:100%; ">	     <table width="100%"> <tr> <td align="center" id="mensagemImagem">  </td><td id="mensagemTexto"> </td></tr></table>	                          	 </td></tr>            <tr><td align="right" class="sairDaDivAlert" > <b  style="padding:6px;padding-left:80px;padding-right:80px;cursor:pointer;background-color:#cbcbcb;font-weight:normal;float:right;"> OK </b></td></tr>        </table>    </div></div>';
				var darkBackGround = '<div class="darkBackGround sairDaDivAlert" style="width:100%;height:100%;position:fixed;top:0px;background-color:#000;opacity:0.75;z-index:7;display:none;"> </div>';
				
				
				if(!($("#divAlert").html())) $(""+divAlert).appendTo('body');
				if(!($(".darkBackGround").html())) $('body').append(darkBackGround);
				
				$("#divAlert #mensagemTexto").html(texto);
				$("#divAlert #mensagemImagem").html('<img  src="'+imagem+'" style="padding:5px; width:auto;height:30px;">');
				
				$(".darkBackGround").fadeIn('fast', function(){ $("#divAlert").show('fast') });
				$(".sairDaDivAlert").click( function (){
					$("#divAlert").hide('fast',function(){ 
						$(".darkBackGround").fadeOut('fast', function(){
							if(callback) callback();
						}) 
					});
				});
			}
			
		},
			
		
					
		/*************************************** MENSAGEM DE ERRO  ***************************************************/
		
		info : function (texto, callback){
			if(texto){
				var imagem = 'http://gps.net.co.ao/images/sucesso.png',
				//var imagem = 'http://127.0.0.1/gps/images/info.png',
					longdesc = "../images/info.png";
				var corDaLetra = '#000';
				var divAlert = '<div id="divAlert" style="display:none;position:fixed;top:15%;margin:0 auto;text-align:center;width:100%;font-family:Verdana, Geneva, sans-serif;z-index:9;" ><div align="center">        <table align="center" cellspacing="12" style="width:100%;max-width:430px;background-color:#eeeeee;padding:6px;padding-top:0px;border:#06F 1px solid;color:#000;">            <tr><td class="sairDaDivAlert" align="right" style="padding:3px;cursor:pointer;font-weight:normal;font-size:16px;" >X</td></tr>            <tr><td align="left" style="font-size:18px;">Caríssimo (a)</td></tr>            <tr><td id="corDaLetra" align="left" style="-webkit-transition: 0.9s;width:100%; ">	     <table width="100%"> <tr> <td align="center" id="mensagemImagem">  </td><td id="mensagemTexto"> </td></tr></table>	                          	 </td></tr>            <tr><td align="right" class="sairDaDivAlert" > <b  style="padding:6px;padding-left:80px;padding-right:80px;cursor:pointer;background-color:#cbcbcb;font-weight:normal;float:right;"> OK </b></td></tr>        </table>    </div></div>';
				var darkBackGround = '<div class="darkBackGround sairDaDivAlert" style="width:100%;height:100%;position:fixed;top:0px;background-color:#000;opacity:0.75;z-index:7;display:none;"> </div>';
				
				
				if(!($("#divAlert").html())) $(""+divAlert).appendTo('body');
				if(!($(".darkBackGround").html())) $('body').append(darkBackGround);
				
				$("#divAlert #mensagemTexto").html(texto);
				$("#divAlert #mensagemImagem").html('<img  src="'+imagem+'" style="padding:5px; width:auto;height:30px;">');
				
				$(".darkBackGround").fadeIn('fast', function(){ $("#divAlert").show('fast') });
				$(".sairDaDivAlert").click( function (){
					$("#divAlert").hide('fast',function(){ 
						$(".darkBackGround").fadeOut('fast', function(){
							if(callback) callback();
						}) 
					});
				});
			}
		
		},
		
	
		
		/*************************************** VALIDAR EMAIL  ***************************************************/
		ValidarEmail : function (thi, valor){

			if(thi || valor){
				if(thi) var mail = thi.value;	
				if(valor) var mail = valor;
				var Email_LegalChars=/^.+@.+\..{2,}$/;		
				var Email_IllegalChars = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;				
				if( !Email_LegalChars.test(mail) || !mail.match(Email_IllegalChars)){			 
					return false ;		
				}else{ return mail ;}  
			} else { return false; }	
		},
		
		
		
		/*************************************** CRIAR O INPUT DATA  ***************************************************/
	
	
		inputData : function( nomeDoCampoDia, nomeDoCampoMes, nomeDoCampoAno, classe ){
			if(nomeDoCampoDia && nomeDoCampoMes && nomeDoCampoAno){
	
				var d = 1; 
				var dias = [ this.DataActual('d')];
				while ( d < 32 ){ 
					if(d) dias.push(d); 
					d++; 
				}
				var campoDia = this.createList(dias, dias, nomeDoCampoDia, (classe ? classe : '') ) ;
				
				var m = 1; 
				var mes = [ this.DataActual('m')]; 
				while ( m < 13 ){ 
					if(m) mes.push(m); 
					m++; 
				}
				var campoMes = this.createList(mes, mes, nomeDoCampoMes, (classe ? classe : '') ) ;
				
				var a = this.DataActual('Y'); 
				var ano = [];
				while ( a < this.DataActual('Y') + 10 ){ 
					if(a) ano.push(a); 
					a++; 
				}
				var campoAno = this.createList(ano, ano, nomeDoCampoAno, (classe ? classe : '') ) ;
				
				return campoDia + '<strong>  </strong>' + campoMes + '<strong>  </strong>' + campoAno ;
			}else{ return false; }
		
		},
		
		
		/*************************************** DATA ACTUAL  ***************************************************/
		
		DataActual : function (dmY){
			var d = new Date();		
			var dia = d.getDate() ;		
			dia = dia < 10 ? '0'+dia : dia ;		
			var mes = parseFloat(d.getMonth()) + 1 ;		
			mes = mes < 10 ? '0'+mes : mes ;
					
			var ano = d.getFullYear();
					
			var hora = d.getHours();	
			hora = hora < 10 ? '0'+hora : hora ;		
			var minuto = d.getMinutes();
			minuto = minuto < 10 ? '0'+minuto : minuto ;			
			var segundo = d.getSeconds();
			segundo = segundo < 10 ? '0'+segundo : segundo ;	
					
			if(dmY == 'd'){			
				var dActual = dia ;		
			}else if(dmY == 'm'){			
				var dActual = mes ;		
			}else if(dmY == 'Y'){			
				var dActual = ano ;		
			}else if(dmY == 'Y-m-d'){			
				var dActual = ano +'-'+ mes +'-'+ dia ;		
			}else if(dmY == 'd-m-Y'){			
				var dActual = dia +'-'+ mes +'-'+ ano ;		
			}else if(dmY == 'H'){			
				var dActual = hora ;		
			}else if(dmY == 'i'){			
				var dActual = minuto ;		
			}else if(dmY == 's'){			
				var dActual = segundo ;		
			}else if(dmY == 'H:i:s'){			
				var dActual = hora +':'+ minuto +':'+ segundo ;
			}else if(dmY == 'd-m-Y H:i:s'){
				var dActual = dia +'-'+ mes +'-'+ ano +' '+ hora +':'+ minuto +':'+ segundo ;		
			}else if(dmY == 'Y-m-d H:i:s'){
				var dActual = ano +'-'+ mes +'-'+ dia +' '+ hora +':'+ minuto +':'+ segundo ;		
			}else{
				var dActual = ano +'-'+ mes +'-'+ dia +' '+hora +':'+ minuto +':'+ segundo  +' '+ d.getMilliseconds();		
			}		
			return dActual; 	
		},
		
			
		/********************************** VALIDAR CAMPOS ****************************************/	
		validar_campo : function ( thi, FormName, classeDeErro ){
			
			if(!(classeDeErro)) classeDeErro = false;
			var campo = false;
	
			if(FormName ){
				campo = $("[name='"+FormName+"']");	
			}else if(thi ){
				campo = thi;	
			}
	
			
			if(campo ){	
				
				if(classeDeErro){
					$(campo).removeClass(classeDeErro);
				}else{ 
					$(campo).css({'border-color':'#ccc','border-width':'1px'});
				}

				if( $(campo).attr('type') == "checkbox" || $(campo).attr('type') == "radio" ){				
					if ( $(campo + ":checked").length == 0 ){					
						if(classeDeErro){
							$(campo).addClass(classeDeErro);
						}else{ 
							$(campo).css({'border-color':'#900','border-width':'3px'});
						}
						return false;				
					}else{ 
						return ($("[name='"+FormName+"']:checked").val()) ; 
					}
					
				}else if( $(campo).attr('type') == "email" ){	
					if( this.ValidarEmail (campo,null) ){ 
						return $(campo).val(); 
					}else { 
						if(classeDeErro){
							$(campo).addClass(classeDeErro);
						}else{ 
							$(campo).css({'border-color':'#900','border-width':'3px'});
						}
						return false; 
					}
					
				}else if( $(campo).val() == '' ){
					if(classeDeErro){
						$(campo).addClass(classeDeErro);
					}else{ 
						$(campo).css({'border-color':'#900','border-width':'3px'});
					}			
					return false;
					
				}else if( $(campo).val().length > 0 ){
					return new String( $(campo).val() );	
				}else{ 
					return false;  
				}		
			}else{  		
				return false;		
			}	
		},	
		/********************************   MAIUSCULAS    *********************************/
		maiusculas : function (Elemento){		
			var valor = Elemento.value;		
			Elemento.value = valor.toUpperCase();	
		},	
		/********************************   SUBSTITUIÇÃO DE PALAVRAS    *********************************/
		str_replace : function (_serch,_replace,variavel){		
			if(variavel){			
				while( !(variavel.indexOf(_serch) == '-1') ){	
					variavel = variavel.replace(_serch,_replace);			
				}		
			}		
			return (variavel);	
		},
		/*************************************** CRIAR CHECK BOX E LISTAS***************************************************/		
		// Retorna o html de uma lista segundo o array arrValue inserido 
		createList : function ( arrValue, arrText, formName, formClass, funcao ){		
			formClass = formClass ? formClass : '';		
			formName = formName ? formName : '';		
			funcao = funcao ? funcao : '';		
			var Res = '';		
			var i = 0;		
			var NewOpt = '';		
			var Option = '<option value="{{value}}"> {{text}} </option> ';		
			if( arrValue ){			
				for(i = 0 ; i < arrValue.length ; i ++ ) {				
					if ( arrValue[i] != 'undefined' ){					
						NewOpt = Option;					
						Res = Res + NewOpt.replace('{{value}}',arrValue[i]).replace('{{text}}',arrText[i]);				
					}			
				}		
			}		
			if(Res.length > 1){ 
				return '<b><select onchange="'+funcao+'" class="'+formClass+'" name="'+formName+'" lang="pt">' + Res + '</select></b>' 
			}else{ return ('');};	
		},	
		/*************************************** CRIAR CHECK BOX ***************************************************/	
		// Retorna o html de uma chekBox segundo o array arrValue inserido 
		createCheckBox : function ( arrValue, arrText, formName, formClass , paragrafo ){		
			formClass = formClass ? formClass : '';
			formName = formName ? formName : '';		
			if(paragrafo && ( paragrafo.length>0 || paragrafo === true ) ) { paragrafo =  '<br />' }else{ paragrafo = ''; };		
			var Res = '';		
			var i = 0;		
			var Radio = '<b><input class="{{class}}" name="{{name}}" type="checkbox" value="{{value}}" lang="pt" /> {{text}} </b>' + paragrafo;		
			if( arrValue ){			
				for(i = 0 ; i < arrValue.length ; i ++ ) {				
					if ( arrValue[i] ){					 
						Res = Res + Radio.replace('{{class}}',formClass).replace('{{name}}',formName + (i+1)).replace('{{value}}',arrValue[i]).replace('{{text}}',arrText[i]);				
					}			
				}		
			}		
			if(Res){ return Res }else{ return ('');};	
		},	
		/****************************************   PRIMEIRALINHA DO ARRAY   **************************************/	
		inserir_primeiraLinha_do_array : function ( _array, primeiraLinha ){		
			var novoArray = [];		
			if(!(primeiraLinha)) primeiraLinha = '';		
			novoArray.push(primeiraLinha) ;		
			for ( i = 0 ; i < _array.length ; i++ ){			
				novoArray.push(_array[i]) ;		
			}		
			return(novoArray);	
		},
		/******************************* LIMPAR A VARIAVEL DE DIGITOS INVALIDOS  ********************************************/
		validarVariavel : function (variavel){
			if (variavel) {
				var newVariavel = variavel.toLowerCase().replace('á','a').replace('é','e').replace('í','i').replace('ó','o').replace('ú','u').
					replace('à','a').replace('è','e').replace('ì','i').replace('ò','o').replace('ù','u').
					replace('ã','a').replace('ç','c').replace('Ç','c').replace('õ','o').
					replace('â','a').replace('ô','o');
					return(newVariavel);
			} else {
				return(false);
			}
		},
		/******************************* Calculo da percentagem  ********************************************/
		percentagem : function (valor, percentagem){
			var c = (parseFloat(valor)*parseFloat(percentagem))/100;
			return parseFloat(c);
		},

		/******************************* Inserir imagem de loading  ********************************************/
		Loading : function ( status, div_for_opacity, img_id ){		
			if(status){ 	
				$('#'+div_for_opacity).fadeTo('fast',0.3);						
				$('#'+img_id).show();		
			}else{			
				$("#"+img_id).hide();			
				$('#'+div_for_opacity).fadeTo('fast',1);		
			}	
		}
		
	};

	win.fn = fn;
	
    
})(window);



/************************************************ FIM DA BIBLIOTECA *******************************/