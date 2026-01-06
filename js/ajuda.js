function verHistorico(tabela,depositario,codigo){
    
    aguarde(1);
   stopDefaultEvent();

   $.ajax({
       url:"../../php/ficcha/ajuda.php",
       data: { 'tabela':tabela, 'depositario':depositario, 'operador':app.operador, 'codigo':codigo },
       dataType:"json",
       async:true,
       type:"POST",
       error: function (data){
           if(navigator.onLine) { 
                   alerta('<b style="color:red">Erro na pagina</b>');
           }else{  
                   alerta('Conecte-se a internet') ;
           }
       },
       success: function(data){
          console.log(data);
           if(data.status){
                   alerta(data.sucesso);

           }else{ 
                   if(data.erro) alerta('<b style="color:red"> '+data.erro+' </b>');
           }
       }
   });
}


