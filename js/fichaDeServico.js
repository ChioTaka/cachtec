// JavaScript Document



function getDadosDestasTabelas(tabelas){
    stopDefaultEvent();

    if(app.id_do_cliente){
        var param = {'bd': 'netcoaos_cachv3', 'tabelas': tabelas,'id_do_cliente':app.id_do_cliente ? app.id_do_cliente : false,  }

        aguarde(1);        
        $.ajax({
                url:"../../php/ficha/getDadosDestasTabelas.php",
                data: { 'dados':JSON.stringify(param) },
                dataType:"json",
                async:true,
                type:"POST",
                error: function (data){
                        if(navigator.onLine) { 
                                alerta('<b style="color:red">Houve um erro actualize a página</b>');
                        }else{  
                                alerta('Não há Internet') ;
                        }
                },
                success: function(data){
                    aguarde();
                   console.log(data);
                        if(data.status){
                                $("#conteudoDiv01").slideUp();
                                setTimeout(function(){
                                        $("#conteudoDiv01").html(data.sucesso).fadeIn();
                                },500);

                        }else{ 
                                if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                        }
                }
        });
    }else{
       alerta('Procure o cliente a esquerda do cabeçalho');
        $("#searchString").focus();
    }

}



function getFormDestaTabela(tabela,thi){
    
    stopDefaultEvent();

    if(app.id_do_cliente){
        
        var i = 0, j = 0;
        var kits_ = [];
        while(app.kitsRv[j]){
            kits_[i] = app.kitsRv[j];
            i++;
            j++;
        }
        j = 0;
        while(app.kitsAlarme[j]){
            kits_[i] = app.kitsRv[j];
            i++;
            j++;
        }
        j = 0;
        while(app.kitsCamera[j]){
            kits_[i] = app.kitsRv[j];
            i++;
            j++;
        }
        j = 0;
        while(app.kitsAlarmeResidencial[j]){
            kits_[i] = app.kitsRv[j];
            i++;
            j++;
        }
        j = 0;
        while(app.kitsCamerasAuto[j]){
            kits_[i] = app.kitsRv[j];
            i++;
            j++;
        }
        j = 0;
        while(app.kitsCampahinha[j]){
            kits_[i] = app.kitsRv[j];
            i++;
            j++;
        }
        
        var select = [
            {'nome':'origem',valor:app.origemDeClientes},
            {'nome':'departamento',valor:app.rh.funcoes},
            {'nome':'servico',valor:app.servicos},
            {'nome':'tipo_de_servico',valor:[ {nome:"INSTALAÇÃO"}, {nome:"MANUTENÇÃO"} ]},
            {'nome':'servico_para',valor:[ {nome:"MÓVEL"}, {nome:"IMÓVEL"} ]},
            {'nome':'kit',valor:kits_},
            {'nome':'local_do_dispositivo',valor:app.local_do_dispositivo},
            {'nome':'comudo',valor:app.comudos},
            {'nome':'visualizacoes',
                valor: [{nome:"TELEFONE"}, {nome:"COMPUTADOR"}, {nome:"NVR"}, {nome:"TELA INTERNA"}, {nome:"TV"}, 
                    {nome:"TELEFONE E NVR"}, {nome:"TELEFONE E COMPUTADOR"}, {nome:"TELEFONE E TELA INTERNA"}, {nome:"TELEFONE E TV"},
                    {nome:"TELEFONE, NVR E COMPUTADOR"}, {nome:"OUTRO"}] },
            {'nome':'local_da_fonte',valor:[{nome:"NA CX DE DERIVAÇÃO"}, {nome:"COMPARTILHADA"}, {nome:"POE"}, {nome:"TEJADILHO"}, 
                    {nome:"BARRA LATERAL DO VIDRO DE FRENTE"}, {nome:"ATRAS DO QUADRO DE INSTRUMENTOS"}, 
                    {nome:"A ESQUERDA DA COBERTURA DO PEDAL DE EMBREAGEM"}, {nome:"OUTRO"}] },
            {'nome':'tipo_de_conexao',valor:[{nome:"WIFI"}, {nome:"CABO UTP"}, {nome:"CABO COAXIAL"}, {nome:"CABO ESPECÍFICO"}, {nome:"OUTRO"}] },
            {'nome':'posicao_da_camara_e_a_cx_de_derivacao',valor:[{nome:"CÂMARA POR CIMA DA CX DE DERIVAÇÃO"}, {nome:"CÂMARA MUITO PROXIMO DA CX DE DERIVAÇÃO"},
                    {nome:"CÂMARA À 1 METRO DA CX DE DERIVAÇÃO"},{nome:"CÂMARA À 2 METRO DA CX DE DERIVAÇÃO"},{nome:"CÂMARA À 3 METRO DA CX DE DERIVAÇÃO"},
                    {nome:"CÂMARA À MAIS DE 3 METRO DA CX DE DERIVAÇÃO"}, {nome:"OUTRO"}] },
            {'nome':'bloqueio',valor:app.bloqueios},
            {'nome':'forma_de_pagamento',valor:[{nome:'TPA'},{nome:'TRANSFERÊNCIA'},{nome:'DINHEIRO'},{nome:'OUTRO'},]},
            {'nome':'tipo_de_pagamento',valor:[{nome:'A PRONTO'},{nome:'PARCELADO'},{nome:'A CRÉDITO'},{nome:'OUTRO'},]}
        ];

        if(thi.id == 'imovelSelecionado'){
            var id_do_imovel = thi.value, id_do_movel = false;
        }else{
            var id_do_movel = thi.value , id_do_imovel = false;
        }

        var param = {'bd': 'netcoaos_cachv3', 'tabela': tabela,'id_do_cliente':app.id_do_cliente ? app.id_do_cliente : false, 'select': select,'id_do_movel':id_do_movel,
            'id_do_imovel':id_do_imovel, 'id_do_operador':app.id_do_operador, 'operador':app.operador,'nome_do_cliente':app.nome_do_cliente ? app.nome_do_cliente : false   }

        aguarde(1);        
        $.ajax({
            url:"../../php/ficha/getFormDestaTabela.php",
            data: { 'dados':JSON.stringify(param) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                if(navigator.onLine) { 
                        alerta('<b style="color:red">Houve um erro actualize a página</b>');
                }else{  
                        alerta('Não há Internet') ;
                }
            },
            success: function(data){
                aguarde();
               console.log(data);
                if(data.status){
                    $("#formDestaTabela").slideUp();
                    setTimeout(function(){
                            $("#formDestaTabela").html(data.sucesso).fadeIn();
                    },500);

                }else{ 
                    if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                }
            }
        });
        
    }else{
       alerta('Procure o cliente a esquerda do cabeçalho');
        $("#searchString").focus();
    }
}



function enviarFormDestaTabela(){
    
    stopDefaultEvent();
    
    var daddos = checkFormulario(false, 'formDestaTabela123', ['descricao','valor_pago','serie','reclamacao','notificacao']);
    
    if(daddos.status){
        aguarde(1);        
        $.ajax({
            url:"../../php/ficha/enviarFormDestaTabela.php",
            data: { 'dados':JSON.stringify(daddos) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                if(navigator.onLine) { 
                        alerta('<b style="color:red">Houve um erro actualize a página</b>');
                }else{  
                        alerta('Não há Internet') ;
                }
            },
            success: function(data){
                aguarde();
               console.log(data);
                if(data.status){
                        $("#formDestaTabela").slideUp();
                        alerta('<b>Sucesso</b>');
                }else{ 
                        if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                }
            }
        });
    }
}


function getEsteMovelOuImovel(id_do_movelOuImovel,tabela){
	
	var param = {'tabela': tabela, 'bd': 'netcoaos_cachv3', 'valor':id_do_movelOuImovel, 'coluna': 'id' }

        aguarde(1);        
        $.ajax({
            url:"../../php/ficha/getEsteMovelOuImovel.php",
            data: { 'dados':JSON.stringify(param) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                if(navigator.onLine) { 
                        alerta('<b style="color:red">Houve um erro actualize a página</b>');
                }else{  
                        alerta('Não há Internet') ;
                }
            },
            success: function(data){
                aguarde();
               console.log(data);
                if(data.status){
                        $("#conteudoDiv01").slideUp();
                        setTimeout(function(){
                                $("#conteudoDiv01").html(data.sucesso).fadeIn();
                        },500);

                }else{ 
                        if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                }
            }
        });
}




function formNovoRegisto(tabela){
	
	if(app.id_do_cliente){
	
		var param = {'tabela': tabela, 'bd': 'netcoaos_cachv3', 'id_do_cliente': app.id_do_cliente, }

		aguarde(1);        
                $.ajax({
			url:"../../php/ficha/formNovoRegisto.php",
			data: { 'dados':JSON.stringify(param) },
			dataType:"json",
			async:true,
			type:"POST",
			error: function (data){
				if(navigator.onLine) { 
					alerta('<b style="color:red">Houve um erro actualize a página</b>');
				}else{  
					alerta('Não há Internet') ;
				}
			},
			success: function(data){
                            aguarde();
				console.log(data);
				var novo = '<div align="center" class="classNovoRegisto"><button onclick="formNovoRegisto(\''+tabela+'\')" > Novo(a) '+tabela+' </button></div>';
				if(data.status){
					$("#conteudoDiv01").slideUp();
					setTimeout(function(){
						$("#conteudoDiv01").html(novo + data.sucesso).fadeIn();
					},500);
				}else{ 
					if(data.erro){
						alerta('<b style="color:red"> '+data.erro+' </b>');
					}
				}
			}
		});

	}else{
		alerta('Procure o cliente a esquerda do cabeçalho');
		$("#searchString").focus();
	}
}



function registarCobranca( descricao){
    
    var param = {'bd': 'netcoaos_cachv3','operador': app.operador, 'descricao': descricao, 'id_do_cliente':app.id_do_cliente ? app.id_do_cliente : false,  }
        $.ajax({
            url:"../../php/ficha/registarCobrancas.php",
            data: { 'dados':JSON.stringify(param) },
            //dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                if(navigator.onLine) { 
                        alerta('<b style="color:red">Houve um erro actualize a página</b>');
                }else{  
                        alerta('Não há Internet') ;
                }
            },
            success: function(data){                
               console.log(data);
                if(data.status){

                }else{ 
                    if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');

                }
            }
	});

	stopDefaultEvent();
	
        
}























	
	




function getFirstSearch(thi){
	if(thi.value.length > 3  ){
		
		var width = parseFloat($("#td_searchString").css("width")) + parseFloat($("#td_firstSearchSelectSelected").css("width"));
		width = width - 10;
		$("#firstSearchResult").css("width",width+"px");
		
		switch ($("#firstSearchSelected").val().toLowerCase()){
			case "telefone".toLowerCase() :getFirstSearchCliente(thi,'telefone','clientes','firstSearchResult'); break;
			case "Nome".toLowerCase() : getFirstSearchCliente(thi,'nome','clientes','firstSearchResult'); break;
			case "Id da ficha".toLowerCase() : getFirstSearchCliente(thi,'id','servicos','firstSearchResult'); break;
			case "SIM".toLowerCase() : getFirstSearchCliente(thi,'codigo','consumiveis_de_servicos','firstSearchResult'); break;
			case "Imei".toLowerCase() : getFirstSearchCliente(thi,'codigo','consumiveis_de_servicos','firstSearchResult'); break;
			case "Matrícula".toLowerCase() : getFirstSearchCliente(thi,'matricula','movel','firstSearchResult'); break;
			case "Marca".toLowerCase() : getFirstSearchCliente(thi,'marca','movel','firstSearchResult'); break;
			case "Modelo".toLowerCase() : getFirstSearchCliente(thi,'modelo','movel','firstSearchResult'); break;
			case "Camara UID".toLowerCase() : getFirstSearchCliente(thi,'codigo','consumiveis_de_servicos','firstSearchResult'); break;
			//case "Camara Kit".toLowerCase() : getFirstSearchCliente(thi,'kit','imovel','firstSearchResult'); break;
			//case "Camara Bairro".toLowerCase() : getFirstSearchCliente(thi,'bairro','imovel','firstSearchResult'); break;
			case "Data(aaaa-mm-dd)".toLowerCase() : getFirstSearchCliente(thi,'data','servicos','firstSearchResult'); break;
			default : "Selecione";  break;
		}
	}else if($("#firstSearchSelected").val() == "Id da ficha" ){
		getFirstSearchCliente(thi,'id','servicos','firstSearchResult');
	}else{
            
            if($("#firstSearchResult .firstSearchResultDiv01").html() == ''){
                $("#firstSearchResult .firstSearchResultDiv01").html('<p style=" padding:20px 0px; text-shadow: 1px 1px green, -1px 1px blue, -1px -1px blue;color:#fff; ">continua...</p>');
                slideUpOrDonw(thi,'firstSearchResult');
            }
        }
}





/*

function getFirstSearchCodigo(thi,campo,tabela,idDoResultado){
	
	if(thi.value && campo){
		
		var jSon = JSON.stringify({'idDoResultado': idDoResultado,'tabela': tabela, 'bd': 'netcoaos_cachv3', 'valor': thi.value, 'coluna': campo});
		
		$.ajax({
			url:"../../php/ficha/getFirstSearch.php",
			data: { 'dados':jSon },
			dataType:"json",
			async:true,
			type:"POST",
			error: function (data){
				if(navigator.onLine) { 
					alerta('<b style="color:red">Houve um erro actualize a página</b>');
				}else{  
					alerta('Não há Internet') ;
				}
			},
			success: function(data){
			   console.log(data);
				if(data.status){
					$("#"+ idDoResultado+" .firstSearchResultDiv01").html(data.sucesso);
					 slideUpOrDonw(thi,idDoResultado);

				}else{ 
					var erro = '<p style=" padding:20px 0px; text-shadow: 1px 1px red, -1px 1px red, -1px -1px red;color:#fff; ">'+data.erro+'</p>';
					$("#"+ idDoResultado+" .firstSearchResultDiv01").html(erro);
					 slideUpOrDonw(thi,idDoResultado);

				}
			}
		});

		stopDefaultEvent();
	}
}


*/



function getFirstSearchCliente(thi,campo,tabela,idDoResultado){
	
	if(thi.value && campo){
		
		var jSon = JSON.stringify({'idDoResultado': idDoResultado,'tabela': tabela, 'bd': 'netcoaos_cachv3', 'valor': thi.value, 'coluna': campo});
		
		$.ajax({
			url:"../../php/ficha/getFirstSearch.php",
			data: { 'dados':jSon },
			dataType:"json",
			async:true,
			type:"POST",
			error: function (data){
				if(navigator.onLine) { 
					alerta('<b style="color:red">Houve um erro actualize a página</b>');
				}else{  
					alerta('Não há Internet') ;
				}
			},
			success: function(data){
			   console.log(data);
				if(data.status){
					$("#"+ idDoResultado+" .firstSearchResultDiv01").html(data.sucesso);
					 slideUpOrDonw(thi,idDoResultado);

				}else{ 
					var erro = '<p style=" padding:20px 0px; text-shadow: 1px 1px red, -1px 1px red, -1px -1px red;color:#fff; ">'+data.erro+'</p>';
					$("#"+ idDoResultado+" .firstSearchResultDiv01").html(erro);
					 slideUpOrDonw(thi,idDoResultado);

				}
			}
		});

		stopDefaultEvent();
	}
}

	
	
function maisResultadosFirstSearchResult(param){
		
	var jSon = JSON.stringify(param);

	aguarde(1);        
        $.ajax({
		url:"../../php/ficha/maisResultadosFirstSearchResult.php",
		data: { 'dados':jSon },
		dataType:"json",
		async:true,
		type:"POST",
		error: function (data){
			if(navigator.onLine) { 
				alerta('<b style="color:red">Houve um erro actualize a página</b>');
			}else{  
				alerta('Não há Internet') ;
			}
		},
		success: function(data){
                    aguarde();
		   console.log(data);
			if(data.status){
				$("#"+ param.idDoResultado+" .firstSearchResultDiv01").html(data.sucesso);
				 //slideUpOrDonw(thi,idDoResultado);

			}else{ 
				if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');

			}
		}
	});

	stopDefaultEvent();
}
	
	

function firstSearchResultClicked(thi,param){

	
	aguarde(1);        
        $.ajax({
		url:"../../php/ficha/getFirstSearchResultClicked.php",
		data: { 'dados':JSON.stringify(param) },
		dataType:"json",
		async:true,
		type:"POST",
		error: function (data){
			if(navigator.onLine) { 
				alerta('<b style="color:red">Houve um erro actualize a página</b>');
			}else{  
				alerta('Não há Internet') ;
			}
		},
		success: function(data){
                    aguarde();
		   console.log(data);
			if(data.status){
				$("#td_TituloDoCliente").html(data.titulo);
				
				app.id_do_cliente = data.id_do_cliente;
				app.telefone_do_cliente = data.telefone_do_cliente;
				app.telefone2_do_cliente = data.telefone2_do_cliente;
				app.nome_do_cliente = data.nome_do_cliente;
				
				if($("#conteudoDiv01").css('display') == 'block'){
					$("#conteudoDiv01").fadeOut(200);
					setTimeout(function(){
						$("#conteudoDiv01").html(data.dadosDoCliente).fadeIn();
					},200)
				}else{
					$("#conteudoDiv01").html(data.dadosDoCliente).fadeIn();
				}
				
				
				//getServicos(app.id_do_cliente,( param.id_do_servico ? param.id_do_servico : false ));
				checkRenovacoes(app.id_do_cliente);
				 //slideUpOrDonw(thi,'firstSearchResult');

			}else{ 
				if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');

			}
		}
	});

	stopDefaultEvent();
	
}


function checkRenovacoes(id_do_cliente){
    app.ClienteComDivida = {};
    $("#alertaDeDivida").slideUp(); 
    $.ajax({
        url:"../../php/ficha/checkRenovacoes.php",
        data: { 'id':id_do_cliente, },
        dataType:"json",
        async:true,
        type:"POST",
        error: function (data){
            if(navigator.onLine) { 
                    alerta('<b style="color:red">Houve um erro actualize a página</b>');
            }else{  
                    alerta('Não há Internet') ;
            }
        },
        success: function(data){
            aguarde();
           console.log(data);
            if(data.status){                
                $("#alertaDeDivida_Div01 div").html( data.sucesso ); 
                if(data.ClienteComDivida){
                    app.ClienteComDivida = data.ClienteComDivida;
                }
                setTimeout(function(){ 
                    $("#alertaDeDivida").slideDown(); 
                    var corpo_ = parseFloat( $("#corpo").css('height'));
                    var div_ = parseFloat( $("#alertaDeDivida_Div01 div").css('height'));
                    if((corpo_ / 2) < div_){
                       $("#alertaDeDivida_Div01 div").css({'overflow':'scroll','height': (corpo_ / 2)+'px'});
                    }else{
                        $("#alertaDeDivida_Div01 div").css({'overflow':'auto','height':'auto'});
                        
                    }
                    
                },600);
            }
        }
    });

    stopDefaultEvent();
	
}



function cobrarAnualidade(){
    if(app.ClienteComDivida){
         var mensagem = 'CACHTEC Inovações %0a%0aNota informativa %0a%0aCaríssimo '+app.nome_do_cliente+'%0a'+
            'Sua subscrição para acesso ao aplicativo de rastreamento veicular completou aos '+(app.ClienteComDivida.data ? app.ClienteComDivida.data : false )+' um ano,%0a'+
            'Para que o dispositivo GPS seja útil em situações de urgência solicitamos que faça o pagamento da atualização da sua subscrição anual. %0a%0a'+
            'O valor da subscrição anual é de 15.000 akz, acrescido de 12.000 aks para recargas mensais ao longo do ano (acréscimo opcional),%0a%0a'+
            'Com a sua subscrição paga poderemos então auxiliar com mais recursos as eventuais necessidades dos nossos serviços. %0a%0a'+
            'A subscrição é paga por unidade de veículo. %0a%0a%0a%0aLista dos veículos: %0a%0a'+( app.ClienteComDivida.veiculos ? app.ClienteComDivida.veiculos : false )+ 
            ' %0a%0a O pagamento pode ser feito por transferencia e o comprovativo enviado para os numeros abaixo, \n\
            %0a%0a BANCO BAI %0a CACHTEC PRESTAÇÃO DE SERVIÇOS LDA %0a CONTA Nº 78900261-10-001 %0a IBAN AO06 0040 0000 7890 0261 1014 7 %0a%0a%0a A CACHTEC agradece pela escolha%0a%0a%0aPara mais informações%0a%0a924 35 35 55 – Dir. Comercial. %0a912 69 21 90 – Dir. Técnico. %0a%0aVisite-nos%0a'+
            'Loja Xyami Kilamba%0aLoja Xyami Nova Vida%0aLoja Kero Sequele%0a%0ainfo@gps.net.co.ao%0awww.cachtec.net.co.ao%0awww.gps.net.co.ao%0a%0aOperador: '+app.operador+'%0a';
    
        whatsApp(app.telefone_do_cliente,mensagem);
        
        var descricao = 'Foi feita a cobranca da Plataforma para os veiculos %0a%0a'+( app.ClienteComDivida.veiculos ? app.ClienteComDivida.veiculos : false )+
                    ' feita pelo operador '+app.operador;
         
        registarCobranca(descricao);
        
        if(app.telefone2_do_cliente){
            setTimeout( function (){
                if(confirm('Dezeja enviar a mensagem de cobrança para o outro numero do cliente ?')){
                    whatsApp(app.telefone2_do_cliente,mensagem);
                }
            },8000 );
        }
    }

}



function verServicos(id_do_cliente){
    
    if($("#resumoDosServicos").html().length > 20){       
        $("#resumoDosServicos").slideToggle();
    }else{
        aguarde(1); 
        $("#resumoDosServicos").slideUp("fast");
        $.ajax({
            url:"../../php/ficha/verServicos.php",
            data: { 'id':id_do_cliente, },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                if(navigator.onLine) { 
                        alerta('<b style="color:red">Houve um erro actualize a página</b>');
                }else{  
                        alerta('Não há Internet') ;
                }
            },
            success: function(data){
                aguarde();
               console.log(data);
                if(data.status){
                    setTimeout(function (){
                         $("#resumoDosServicos").html( data.sucesso );
                        $("#resumoDosServicos").slideDown();
                    },500)


                }else{ 
                    fecharBarra();

                }
            }
        });
    }
    stopDefaultEvent();
	
}



function getEsteDado(coluna,valor,tabela){
    stopDefaultEvent();

    var param = {'bd': 'netcoaos_cachv3', 'tabela': tabela,'valor':valor, 'coluna': coluna }
    
    aguarde(1);        
    $.ajax({
            url:"../../php/ficha/getEsteDado.php",
            data: { 'dados':JSON.stringify(param) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                    if(navigator.onLine) { 
                            alerta('<b style="color:red">Houve um erro actualize a página</b>');
                    }else{  
                            alerta('Não há Internet') ;
                    }
            },
            success: function(data){
                aguarde();
               console.log(data);
                    if(data.status){
                            $("#conteudoDiv01").slideUp();
                            setTimeout(function(){
                                    $("#conteudoDiv01").html(data.sucesso).fadeIn();
                            },500);

                    }else{ 
                            if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                    }
            }
    });


}



function alterarCadastroDeServico(tabela,id_do_servico){
    var htm = '<h4>Aqui,<br>Você vai atribuir para o serviço nº '+id_do_servico+'<br> outro Cliente</h4>'+
            '<p>para continura<br> insira o numero do Cliente receptor</p>'+
            '<div align="center"><input type="number" id="novoNumero"></div><br>'+
            '<div align="center"><button style="padding:10px;" onClick="alterarCadastroDeServico_exec(\''+tabela+'\',\''+id_do_servico+'\')" > MOVER<br>SERVIÇO </button></div><br>';
    alerta(htm);
}


function alterarCadastroDeServico_exec(tabela,id_do_servico){
    if($("#novoNumero").val()){
        stopDefaultEvent();

        var param = {'novoNumero':$("#novoNumero").val(), 'bd': 'netcoaos_cachv3','tabela': 'tabela', 'id_do_servico':id_do_servico, 'operador':app.operador, 'id_do_operador': app.id_do_operador }
        alerta();
        aguarde(1);        
        $.ajax({
            url:"../../php/ficha/alterarCadastroDeServico_exec.php",
            data: { 'dados':JSON.stringify(param) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                    if(navigator.onLine) { 
                            alerta('<b style="color:red">Houve um erro actualize a página</b>');
                    }else{  
                            alerta('Não há Internet') ;
                    }
            },
            success: function(data){
                aguarde();
               console.log(data);
                if(data.status){
                        alerta(data.sucesso);

                }else{ 
                        if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                }
            }
        });

    }else{
        document.getElementById('novoNumero').style.border = "red 1px solid";
    }
}


function apagarCadastroDeServico(tabela,id_do_servico){
    var htm = '<h4>Aqui,<br>Você vai eliminar  o serviço nº '+id_do_servico+'<br> Da base de dados para sempre</h4>'+
            '<p>para continur<br> Click no botão</p>'+
            '<div align="center"><button style="padding:10px;background-color:red;" onClick="apagarCadastroDeServico_exec(\''+tabela+'\',\''+id_do_servico+'\')" > <img  src="../../img/lixo.png"> </button></div><br>';
    alerta(htm);
}



function apagarCadastroDeServico_exec(tabela,id_do_servico){
    
    stopDefaultEvent();

    var param = {'novoNumero':'999999999', 'bd': 'netcoaos_cachv3','tabela': 'tabela', 'id_do_servico':id_do_servico, 'operador':app.operador, 'id_do_operador': app.id_do_operador }
    alerta();
    aguarde(1);        
    $.ajax({
        url:"../../php/ficha/alterarCadastroDeServico_exec.php",
        data: { 'dados':JSON.stringify(param) },
        dataType:"json",
        async:true,
        type:"POST",
        error: function (data){
                if(navigator.onLine) { 
                        alerta('<b style="color:red">Houve um erro actualize a página</b>');
                }else{  
                        alerta('Não há Internet') ;
                }
        },
        success: function(data){
            aguarde();
           console.log(data);
            if(data.status){
                    alerta(data.sucesso);

            }else{ 
                    if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
            }
        }
    });
  
}



function getServicosExecutadosNesteMovel(id_do_movel){
    stopDefaultEvent();
//alert(12);
    var param = {'bd': 'netcoaos_cachv3', 'valor':id_do_movel }

    aguarde(1);        
    $.ajax({
            url:"../../php/ficha/getServicosExecutadosNesteMovel.php",
            data: { 'dados':JSON.stringify(param) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                    if(navigator.onLine) { 
                            alerta('<b style="color:red">Houve um erro actualize a página</b>');
                    }else{  
                            alerta('Não há Internet') ;
                    }
            },
            success: function(data){
                aguarde();
               console.log(data);
                    if(data.status){
                            $("#conteudoDiv01").slideUp();
                            setTimeout(function(){
                                    $("#conteudoDiv01").html(data.sucesso).fadeIn();
                            },500);

                    }else{ 
                            if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                    }
            }
    });


}




function getServicosExecutadosNesteImovel(id_do_imovel){
    stopDefaultEvent();

    var param = {'bd': 'netcoaos_cachv3', 'valor':id_do_imovel }

    aguarde(1);        
    $.ajax({
            url:"../../php/ficha/getServicosExecutadosNesteImovel.php",
            data: { 'dados':JSON.stringify(param) },
            dataType:"json",
            async:true,
            type:"POST",
            error: function (data){
                    if(navigator.onLine) { 
                            alerta('<b style="color:red">Houve um erro actualize a página</b>');
                    }else{  
                            alerta('Não há Internet') ;
                    }
            },
            success: function(data){
                aguarde();
               console.log(data);
                    if(data.status){
                            $("#conteudoDiv01").slideUp();
                            setTimeout(function(){
                                    $("#conteudoDiv01").html(data.sucesso).fadeIn();
                            },500);

                    }else{ 
                            if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
                    }
            }
    });


}



/*


function getServicos(id_do_cliente,id_do_servico){

	//console.log(param);
	aguarde(1);        
        $.ajax({
		url:"../../php/ficha/getServicos.php",
		data: { 'id':id_do_cliente,id_do_servico:id_do_servico },
		dataType:"json",
		async:true,
		type:"POST",
		error: function (data){
			if(navigator.onLine) { 
				alerta('<b style="color:red">Houve um erro actualize a página</b>');
			}else{  
				alerta('Não há Internet') ;
			}
		},
		success: function(data){
                    aguarde();
		   console.log(data);
			if(data.status){
				$("#barraDiv02").fadeOut("fast",function(){
					$("#barraDiv02").html("<div class=\"firstSearchResult\">" + data.sucesso + "</div>");
					$("#barraDiv02").fadeIn("slow",function(){
						abrirBarra();
					});
				});

			}else{ 
				fecharBarra();

			}
		}
	});

	stopDefaultEvent();
	
}

/*

function abrirNovaFolha(){
	
	$("#conteudoDiv01").load("novaFicha.html", function(){
		$("#selectOrigemDoCliente").html( preencherLista( 'Selecione', app.origemDeClientes,false));
	});
	
}

*/	


function novoAgendamento(){
	
	$("#conteudoDiv01").load("novaFicha.html",function(){
            if(app.id_do_cliente){
		$("#telefoneNovaFicha").val(app.telefone_do_cliente);
		$("#telefone_2NovaFicha").val(app.telefone2_do_cliente);
		$("#id_do_cliente_NovaFicha").val(app.id_do_cliente);
		$("#nomeNovaFicha").val(app.nome_do_cliente);
            }
		
            $("#selectOrigemDoCliente").html( preencherLista( 'Selecione', app.origemDeClientes,false));
	});
	
	
}



	
function getUser(){
	
	aguarde(1);        
        $.ajax({
		url:"../../php/ficha/getUser.php",
		data: { 'url':window.location.href },
		dataType:"json",
		async:true,
		type:"POST",
		error: function (data){
			if(navigator.onLine) { 
				alerta('<b style="color:red">Houve um erro actualize a página</b>');
			}else{  
				alerta('Não há Internet') ;
			}
		},
		success: function(data){
                    aguarde();
		   console.log(data);
			if(data.status){
				app.operador = data.operador ? data.operador : false
				app.email = data.email ? data.email : false
				app.telefone = data.telefone ? data.telefone : false;				
				app.foto = data.foto ? data.foto : false
				app.id_do_operador = data.id ? data.id : false
				app.estado = data.estado ? data.estado : false

				app.imagem = data.imagem ? data.imagem : false
				if(app.imagem)$("#fotoDoOperador").attr('src','../../'+app.imagem);			
				if(app.operador)$("#nomeDoOperador").text(app.operador);
				$("#dadosDoOperador").fadeIn();
				
				if(data.id_do_cliente){
                                    firstSearchResultClicked ( false,{ 'bd':'netcoaos_cachv3' ,'id_do_cliente':data.id_do_cliente } )
				}
                                
                                getNotificacoesNaoRespondidas();

			}else{ 
				if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');

			}
		}
	});

	stopDefaultEvent();
	
}

	
	
	
function fecharBarra(){
	$('#barra').slideUp(500,function(){
		//$('#conteudo').css("width","100%");
		$('#conteudo').animate("width","100%");
	});
}
	
	
function abrirBarra(){
	//$('#conteudo').css("width","80%");
	$('#conteudo').animate("width","80%");
	$('#barra').slideDown();
}
	
	