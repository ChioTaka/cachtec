<?php

include_once("classes/autoload.php");
$func = new Funcoes;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*


$cont = 0;
$ultimoSim = '123123123123123';
$bd = 'netcoaos_stockv3';
$id_do_servico_anterior = 'asdasd';
$ultimoMovel = 'asdasdsss;';
 $id_do_cliente = false;
$id_do_servico = false;
$id_do_movel  = false;
$id_do_imovel = false;
$kit = false;

 $Checar = new Read ;
 $Actualizar = new UpDate ;
 $ta = 0;
 $tabelas = array('stock_tecnicos','stock_lojas','stock_escritorio','stock_central','stock_cozinha');
 while(!empty($tabelas[$ta])){
    $Checar->ExeRead( $tabelas[$ta], "WHERE codigo > :tel ORDER BY depositario , codigo ASC ","tel=0",$bd);
    //$Checar->ExeRead( 'movimento', "WHERE tabela_de_distino = :tel ORDER BY nome_do_receptor , data_do_movimento ASC ","tel=stock_tecnicos");

    if( $Checar->getResult() ){ 

       // $truncate = new Delete;
        //$truncate->ExeTruncate('renovacao',$bd);

        foreach( $Checar->getResult() as $ddss ):


            //echo $cont.' ______________________ ';
            //if($cont == 2) {            exit();}
            //$cont ++;
            //$num = ( empty($ddss['cartao_sim']) ? FALSE : ($ddss['cartao_sim']) );
            $id_ = ( empty($ddss['id']) ? FALSE : ($ddss['id']) );
            $id_do_movimento_de_entrada = ( empty($ddss['id_do_movimento_de_entrada']) ? FALSE : ($ddss['id_do_movimento_de_entrada']) );
            $id_do_movimento_de_saida = ( empty($ddss['id_do_movimento_de_saida']) ? FALSE : ($ddss['id_do_movimento_de_saida']) );
            //$id_do_servico = ( empty($ddss['id_do_servico']) ? FALSE : ($ddss['id_do_servico']) );

            if($id_do_movimento_de_entrada){
                 $movi = $func->getUltimoRegisto('movimento',array('id'),array($id_do_movimento_de_entrada),$bd);
                 if($movi){
                     $depositario =( empty($movi['nome_do_receptor']) ? FALSE : ($movi['nome_do_receptor']) ); 
                 }
            }else if($id_do_movimento_de_saida){
                 $movi = $func->getUltimoRegisto('movimento',array('id'),array($id_do_movimento_de_saida),$bd);
                 if($movi){
                     $depositario =( empty($movi['nome_do_receptor']) ? FALSE : ($movi['nome_do_receptor']) ); 
                 }
            }

            if($depositario){
                $arr = array(                    	
                    'depositario' => $depositario,	                               
                );

                echo $depositario.'<br>';
                //echo var_dump($arr);

        //$cont ++;
                $Actualizar->ExeUpDate($tabelas[$ta],$arr, "WHERE id = :mat ","mat={$id_}" );
            }

            $depositario = false;

        endforeach;

    }
    $ta ++;
 }
        
  /*      if( $ultimoSim != $num){
            
           
            
            
             $imo = $func->getUltimoRegisto('movel_intervencao',array('id_do_servico'),array($id_do_servico),$bd);
             if($imo){
                  $id_do_movel = ( empty($imo['id_do_movel']) ? FALSE : ($imo['id_do_movel']) );
                  $id_do_cliente = ( empty($imo['id_do_cliente']) ? FALSE : ($imo['id_do_cliente']) );
                  $kit = ( empty($imo['kit']) ? FALSE : ($imo['kit']) );
                  $ultimoSim = $num;
                  
                  $arr = array(                    	
                        'id_do_cliente' => $id_do_cliente,	
                        'id_do_servico' => $id_do_servico,	
                        'id_do_movel'  => $id_do_movel,
                        'id_do_imovel' => $id_do_imovel,
                        'kit'  => $kit,                
                        'estado' => 1,               
                    );

                    echo var_dump($arr);

//$cont ++;
                    $Actualizar->ExeUpDate('recarga',$arr, "WHERE cartao_sim = :mat ","mat={$num}" );
            
            }else {
                
                $imo = $func->getUltimoRegisto('movel_instalacao',array('id_do_servico'),array($id_do_servico),$bd);
                if($imo){
                     $id_do_movel = ( empty($imo['id_do_movel']) ? FALSE : ($imo['id_do_movel']) );
                    $id_do_cliente = ( empty($imo['id_do_cliente']) ? FALSE : ($imo['id_do_cliente']) );
                     $kit = ( empty($imo['kit']) ? FALSE : ($imo['kit']) );
                     $ultimoSim = $num;

                     $arr = array(                    	
                           'id_do_cliente' => $id_do_cliente,	
                           'id_do_servico' => $id_do_servico,	
                           'id_do_movel'  => $id_do_movel,
                           'id_do_imovel' => $id_do_imovel,
                           'kit'  => $kit,                
                           'estado' => 1,               
                       );

                       echo var_dump($arr);
//$cont ++;

                       $Actualizar->ExeUpDate('recarga',$arr, "WHERE cartao_sim = :mat ","mat={$num}" );
                }
            }
            
        }
    
   
    endforeach;
}

function getIdDoCliente($id_do_servico){
    $func = new Funcoes;
$cont = 0;
$ultimoSim = '123123123123123';
$bd = 'netcoaos_cachv3';
$id_do_servico_anterior = 'asdasd';
$ultimoMovel = 'asdasdsss;';
 $id_do_cliente = false;
$id_do_servico = false;
$id_do_movel  = false;
$id_do_imovel = false;
$kit = false;

    $res = $func->getPrimeiroRegisto('movel_intervencao', array('id_do_servico'), array($id_do_servico),$bd);
    if(!empty($res['id_do_movel'])) {
        $arr = array(                    	
            'id_do_cliente' => ( empty($res['id_do_cliente']) ? FALSE : ($res['id_do_cliente']) ),	
            'id_do_servico' => ( empty($res['id_do_servico']) ? FALSE : ($res['id_do_servico']) ),
            'id_do_movel'  => ( empty($res['id_do_movel']) ? FALSE : ($res['id_do_movel']) ),
            'id_do_imovel' => ( empty($res['id_do_imovel']) ? FALSE : ($res['id_do_imovel']) ),
            'kit'  => ( empty($res['kit']) ? FALSE : ($res['kit']) ),           
            'estado' => 1,               
        );   
        return $arr;
    }else{

  
        $res = $func->getPrimeiroRegisto('movel_instalacao', array('id_do_servico'), array($id_do_servico),$bd);
        if(!empty($res['id_do_movel'])) {
            $arr = array(                    	
                'id_do_cliente' => ( empty($res['id_do_cliente']) ? FALSE : ($res['id_do_cliente']) ),	
                'id_do_servico' => ( empty($res['id_do_servico']) ? FALSE : ($res['id_do_servico']) ),
                'id_do_movel'  => ( empty($res['id_do_movel']) ? FALSE : ($res['id_do_movel']) ),
                'id_do_imovel' => ( empty($res['id_do_imovel']) ? FALSE : ($res['id_do_imovel']) ),
                'kit'  => ( empty($res['kit']) ? FALSE : ($res['kit']) ),           
                'estado' => 1,               
            );   
            return $arr;           
        } else{
            return false;
        }           
    }

}

/*
        $id_do_servico = ( empty($ddss['id_do_servico']) ? FALSE : ($ddss['id_do_servico']) );
        $operacao = ( empty($ddss['operacao']) ? FALSE : ($ddss['operacao']) );
        $feito = false; 
        $id_do_movel = false;
        $id_do_imovel = false;
        
         echo (empty($ddss['rv_']) ? false : $ddss['rv_']) .' RV<br>';
         
         if($id_do_servico_anterior != $id_do_servico){
             
        
             $id_do_servico_anterior = $id_do_servico;
             
            $reg = $func->getPrimeiroRegisto('movel_intervencao', array('id_do_servico'), array($id_do_servico),$bd);
            if(!empty($reg['id_do_movel'])) {
                $id_do_movel = $reg['id_do_movel'];
                $reg['ultimo_servico'] = 'INSTALAÇÃO '.(empty($reg['descricao_tecnica']) ? false : $reg['descricao_tecnica']);
                $feito = true;           
            }

            if(empty($feito)){
                $reg = $func->getPrimeiroRegisto('movel_instalacao', array('id_do_servico'), array($id_do_servico),$bd);
                if(!empty($reg['id_do_movel'])) {
                    $id_do_movel = $reg['id_do_movel'];
                    $reg['ultimo_servico'] = 'INSTALAÇÃO '.(empty($reg['descricao_tecnica']) ? false : $reg['descricao_tecnica']);
                    $feito = true;           
                }            
            }

            if(empty($feito)){
                $reg = $func->getPrimeiroRegisto('imovel_intervencao', array('id_do_servico'), array($id_do_servico),$bd);
                if(!empty($reg['id_do_imovel'])) {
                    $id_do_imovel = $reg['id_do_imovel'];
                    $reg['ultimo_servico'] = 'INSTALAÇÃO '.(empty($reg['descricao_tecnica']) ? false : $reg['descricao_tecnica']);
                    $feito = true;           
                }            
            }

            if(empty($feito)){
                $reg = $func->getPrimeiroRegisto('imovel_instalacao', array('id_do_servico'), array($id_do_servico),$bd);
                if(!empty($reg['id_do_imovel'])) {
                    $id_do_imovel = $reg['id_do_imovel'];
                    $reg['ultimo_servico'] = 'INSTALAÇÃO '.(empty($reg['descricao_tecnica']) ? false : $reg['descricao_tecnica']);
                    $feito = true;           
                }            
            }
//echo ' \\\ $id_do_movel = '.$id_do_movel.' || $ultimoMovel = '.$ultimoMovel.' /// <br>';
            if($feito && (!empty($ddss['operacao']) && $ultimoMovel != $id_do_movel && $ultimoMovel != $id_do_imovel  )){
                if($ddss['operacao'] == 'PAGOU A PLATAFORMA'){

                    //echo $reg['ultimo_servico'];
                    $ultimoMovel = empty($id_do_imovel)? ( empty($id_do_movel) ? false : $id_do_movel ) :$id_do_imovel;

                    $dt =  explode('-', $ddss['data']);
                    if($dt[0]>2000){
                        $data_final = ($dt[0] - 1).'-'.$dt[1].'-'.$dt[2];
                    }else{
                      $data_final = false;  
                    }
                    //echo var_dump($dt);
                    $descri = (empty($ddss['operacao']) ? false : $ddss['operacao']) .' até '.
                            (empty( $func->fncFormatarData($ddss['data'],'-' )) ? false : (' até '.$func->fncFormatarData($ddss['data'],'-' )) ).
                                ' '. (empty($ddss['kit']) ? false : $ddss['kit']) .' Rv:'. (empty($ddss['rv_']) ? false : $ddss['rv_']) . ' Sim:'.(empty($ddss['sim_']) ? false : $ddss['sim_']);
                       

                    $pagamen = array(                    	
                        'id_do_cliente' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],	
                        'id_do_servico' => $id_do_servico,	
                        'origem_do_pagamento'  => empty($ddss['operador']) ? false : $ddss['operador'],
                        'valor_unitario' => 10000,
                        'valor_pago'  => empty($ddss['valor_pago']) ? false : $ddss['valor_pago'],	
                        'valor_a_pagar' => 15000,	                    
                        'forma_de_pagamento' => empty($ddss['tipo_de_pagamento']) ? false : $ddss['tipo_de_pagamento'],                    
                        'carencia'  => empty($ddss['data']) ? false : $ddss['data'],
                        'descricao_do_pagamento' => $descri,
                        'estado' => empty($ddss['estado']) ? false : $ddss['estado'],
                        'operador' => empty($ddss['operador']) ? false : $ddss['operador'],
                        'data_de_alteracao' => empty($ddss['data_de_alteracao']) ? date("Y-m-d H:i:s") : $ddss['data_de_alteracao'],
                    );

                    $plata = array(                    
                        'id_do_cliente' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
                        'id_do_movel' => $id_do_movel,
                        'id_do_imovel' => $id_do_imovel,
                        'ultimo_servico' => $reg['ultimo_servico'],
                        'codigo' => empty($ddss['rv_']) ? false : $ddss['rv_'],                    
                        'valor_pago' => empty($ddss['valor_pago']) ? false : $ddss['valor_pago'],                    
                        'data_inicial'=> $data_final, 
                        'data_final' => empty($ddss['data']) ? false : $ddss['data'],
                        'descricao' => $descri,
                        'estado' => empty($ddss['estado']) ? false : $ddss['estado'],
                        'operador' => empty($ddss['operador']) ? false : $ddss['operador'],
                        'data_de_alteracao' => empty($ddss['data_de_alteracao']) ? date("Y-m-d H:i:s") : $ddss['data_de_alteracao'],

                    );

                    $func->GravarNaBd_ComVerificacaoDeColunas('pagamento',$pagamen,$bd);
                    $func->GravarNaBd_ComVerificacaoDeColunas('renovacao',$plata,$bd);
                    //echo var_dump($plata);
                    //echo var_dump($pagamen);
                }
            }
        }
    endforeach;            
}
        /*
        
        $id_do_imovel = $func->getPrimeiroRegisto('imovel', array('id_do_ultimo_servico'), array($id_do_servico),$bd); 
        $id_do_imovel = $func->getPrimeiroRegisto('imovel', array('id_do_ultimo_servico'), array($id_do_servico),$bd); 
        
        $t = 0;
        $tabelas = array('movel_instalacao','movel_intervencao','imovel_instalacao','imovel_intervencao');
        
        
        while (!empty($tabelas[$t]) ){
            
            $reg = $func->getPrimeiroRegisto($tabelas[$t], array('id_do_servico'), array($id_do_servico),$bd);
            if(!empty($reg['id_do_imovel'])) {
                $id_do_imovel = $reg['id_do_imovel'];
                $feito = true;
                break;
            }
            $t++;
        }
            
            $Checar2->ExeRead( 'plataformas_', "WHERE id_do_servico > :tel ORDER BY data ASC ","tel=0");
            if( $Checar2->getResult() ){
                
                foreach( $Checar->getResult() as $Fun ):  
                    
                endforeach ;                
            }            
            $t++;
        }
        
        
      

'id_do_cliente' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'id_do_movel' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'id_do_imovel' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'ultimo_servico' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'codigo' => empty($reg['rv_']) ? false : $reg['rv_'],
//'valor' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'valor_pago' => empty($ddss['valor_pago']) ? false : $ddss['valor_pago'],
//'valor_a_pagar' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'data_inicial'=> $data_final, 
'data_final' => empty($reg['data']) ? false : $reg['data'],
'descricao' => (empty($reg['operacao']) ? false : $reg['operacao']) .' até '.(empty($reg['data']) ? false : $reg['data']).
        ' KIT:'. (empty($reg['kit']) ? false : $reg['kit']) .' Rv:'. (empty($reg['rv_']) ? false : $reg['rv_']) . ' Sim:'.(empty($reg['sim_']) ? false : $reg['sim_']),
//'visto' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],
'estado' => empty($ddss['estado']) ? false : $ddss['estado'],
'operador' => empty($ddss['operador']) ? false : $ddss['operador'],
'data_de_alteracao' => empty($ddss['data_de_alteracao']) ? date("Y-m-d H:i:s") : $ddss['data_de_alteracao'],

	
'id_do_cliente' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],	
'id_do_servico' => $id_do_servico,	
origem_do_pagamento  => empty($ddss['operador']) ? false : $ddss['operador'],
valor_unitario	=> 10000,
valor_pago  => empty($ddss['valor_pago']) ? false : $ddss['valor_pago'],	
valor_a_pagar => 15000,	
//tipo_de_pagamento => empty($ddss['tipo_de_pagamento']) ? false : $ddss['tipo_de_pagamento'],	
forma_de_pagamento => empty($ddss['tipo_de_pagamento']) ? false : $ddss['tipo_de_pagamento'],	
//numero_do_movimento	
carencia  => empty($reg['data']) ? false : $reg['data'],	
	
descricao_do_pagamento => (empty($reg['operacao']) ? false : $reg['operacao']) .' até '.(empty($reg['data']) ? false : $reg['data']).
        ' KIT:'. (empty($reg['kit']) ? false : $reg['kit']) .' Rv:'. (empty($reg['rv_']) ? false : $reg['rv_']) . ' Sim:'.(empty($reg['sim_']) ? false : $reg['sim_']),
//'visto' => empty($reg['id_do_cliente']) ? false : $reg['id_do_cliente'],	
	
'estado' => empty($ddss['estado']) ? false : $ddss['estado'],
'operador' => empty($ddss['operador']) ? false : $ddss['operador'],
'data_de_alteracao' => empty($ddss['data_de_alteracao']) ? date("Y-m-d H:i:s") : $ddss['data_de_alteracao'],	
	
        
        
$data_final = (explode('-', $reg['data'])[0]) - 1)
idPrincipal 
id_do_servico 
operacao 
rv_ 
sim_ 
kit 
valor_pago 
factura 
data 
tipo_de_pagamento 
estado 
data_de_alteracao 
operador 

        
   endforeach;            
}
//De plataforma para renovações
 /*     $Checar = new Read ;
    $Checar->ExeRead( 'plataformas_', "WHERE id_do_servico = :tel ORDER BY data ASC ","tel={$id_do_servico}");

    if( $Checar->getResult() ){ 
        foreach( $Checar->getResult() as $Func ):
               $data = ( empty($Func['data']) ? FALSE : ($Func['data']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
       endforeach;            
    }
 


/*
$truncate = new Delete;

 $paraLimpar = array('agendamento','cobranca', 'consumiveis_de_servicos','despesas_alimentacao','despesas_comunicacao','despesas_deslocacao','despesas_outro',
    'funcao','funcionarios_contactos','gestao_de_acesso','imagem','imovel','imovel_instalacao','imovel_intervencao','movel','movel_instalacao','movel_intervencao',
    'notificacao','operador','pagamento','renumeracao_adicional','renumeracao_bonus','renumeracao_desconto','renumeracao_por_servico','tecnico','validacao',);

/*
$paraLimpar = array('consumiveis_de_servicos','imovel','imovel_instalacao','imovel_intervencao','movel','movel_instalacao','movel_intervencao','pagamento',
    'renumeracao_por_servico','tecnico',);
 * 
 
$l = 0;
while (!empty($paraLimpar[$l])){
    $truncate->ExeTruncate($paraLimpar[$l],$bd);
    $l++;
}
/*
$Checar = new Read ;
$Checar->ExeRead( 'funcionarios', "WHERE id > :tel ","tel={0}");
	
if( $Checar->getResult() ){ 

    foreach( $Checar->getResult() as $arrS ){
        
        $func->AtualizarNaBd_ComVerificacaoDeColunas('funcionarios',array('codigo' => '123456','imagem' => '') ,$arrS['id'],$bd);
        
    }
}

//$start = date("s");
$ini = (empty($_GET["data"])?('2021-08-01'): ( $_GET["data"] == '0000-00-00 00:00:00' ? ('2021-08-01') : $_GET["data"] ) );
$Checar = new Read ;
$Checar->ExeRead( 'servicos', "WHERE data_de_alteracao = :sr AND  data_de_alteracao_ <= :ini ORDER BY data_de_alteracao_ DESC ", "sr=0000-00-00 00:00:00&ini={$ini}",$bd);
//$Checar->ExeRead( 'servicos', "WHERE id > :tel ORDER BY data DESC ", "tel=0",$bd);
echo 'Hello ' . $ini . '!<br><br>';

if( $Checar->getResult() ){ 
  
   // echo 'Hello ' .  . '!<br><br>';
    
    
    //echo '<button onclick="alert()" >proximo2</button><br>';
        
    
    

    foreach( $Checar->getResult() as $arrS ){
        
                
        $idDoServico = (empty( $arrS['id'] ) ? FALSE : $arrS['id']);
        $id_do_servico = (empty( $arrS['id'] ) ? FALSE : $arrS['id']);
        $id_do_cliente = (empty( $arrS['id_do_cliente'] ) ? FALSE : $arrS['id_do_cliente']);
        $bdDoObjecto = (empty( $arrS['bd_do_objecto'] ) ? FALSE : $arrS['bd_do_objecto']);
        $nome = (empty( $arrS['nome'] ) ? FALSE : str_replace(' DE GPS', '', $arrS['nome']) );
        $modalidadeDePagamento = (empty( $arrS['modalidade_de_pagamento'] ) ? FALSE : $arrS['modalidade_de_pagamento']);
        $motivo_do_desconto = (empty( $arrS['motivo_do_desconto'] ) ? FALSE : $arrS['motivo_do_desconto']);       
        $preco = (empty( $arrS['preco'] ) ? FALSE : $arrS['preco']);
        $desconto = (empty( $arrS['desconto'] ) ? FALSE : $arrS['desconto']);
        $valor_pago = (empty( $arrS['valor_pago'] ) ? FALSE : $arrS['valor_pago']);
        $visto = (empty( $arrS['visto'] ) ? FALSE : ( $arrS['visto'] ==  "0000-00-00 00:00:00" ? false : $arrS['visto'] ) );       
        $data = (empty( $arrS['data'] ) ? FALSE : $arrS['data']);
        $estado = (empty( $arrS['estado'] ) ? FALSE : $arrS['estado']);
        $operador = (empty( $arrS['operador'] ) ? FALSE : $arrS['operador']);
        $data_de_alteracao = (empty( $arrS['data_de_alteracao_'] ) ? FALSE : $arrS['data_de_alteracao_']);
        
        if($cont == 0) {
           echo 'data inicial '.$data_de_alteracao.'<br><br>';
          // exit();
        }
     
        echo '<button onclick="window.location =\'trans.php?data='.$data_de_alteracao.'\'" >proximo</button>';         

       if($cont == 1) {
           echo 'data inicial '.$data_de_alteracao.'<br><br>';
          // exit();
        }
        $cont++;
        
        
        
        if( (strpos($nome, 'Troca') !== false) ){
            $tipo_de_servico = 'MANUTENÇÃO';
            $servico = str_replace('_', ' ' ,strtoupper($bdDoObjecto));
        }else{
            $serv___ = (empty( $arrS['nome'] ) ? FALSE : explode(' DE ', $arrS['nome']));
            if(empty($serv___[1])) $serv___ = (empty( $arrS['nome'] ) ? FALSE : explode(' DO ', $arrS['nome']));             
            $tipo_de_servico = (empty( $serv___[0] ) ? FALSE : str_replace('CA', 'ÇÃ' ,strtoupper($serv___[0]))); 
            $servico = (empty( $serv___[1] ) ? FALSE : $serv___[1]);
        }
        
        if($bdDoObjecto == 'gps_'){
           $servico_para = 'MÓVEL';
           $servico = 'GPS';
           
        }else if($bdDoObjecto == 'viaturas'){
           $servico_para = 'MÓVEL'; 
           
        }else if($bdDoObjecto == 'alarmes_'){
            $servico_para = 'MÓVEL';
             $servico = 'ALARME VEICULAR';
            
        }else if($bdDoObjecto == 'cameras_' ){
            $servico_para = 'IMÓVEL';
             $servico = 'CAMERAS';
            
        }else if($bdDoObjecto == 'outro_servico_'){
            
        }
        
        //echo $nome.' = 1 = = = = = ';
        
        if(!(empty($servico) || empty($id_do_cliente) || empty($tipo_de_servico) || empty($id_do_servico) )){

            $pagamento = array( 
                'id_do_cliente'	=>  $id_do_cliente,
                'id_do_servico' =>  $id_do_servico,
                'servico'=> $servico,
                //'origem_do_pagamento'=> $servico,
                'valor_unitario'=>  $preco,
                'valor_pago'=>  $valor_pago,
                //'valor_a_pagar'	=>  $modelo,	
                //'tipo_de_pagamento'	=>  $matricula,	
                'forma_de_pagamento'=>  $modalidadeDePagamento,	
                //'numero_do_movimento'=>  $data_de_conclusao,	
               // 'carencia'=>  $local_do_servico,	
                'descontos'=>  $desconto,	
                'motivo_do_desconto'=>  $motivo_do_desconto ,               	
                'descricao_do_pagamento'=>  (empty( $arrS['nome'] ) ? FALSE : $arrS['nome']) .' / '.$servico.' / '. $tipo_de_servico.' / '.$servico_para ,               	
                'visto'	=>  $visto ,	
                'estado'=>  $estado ,		
                'operador'=>  $operador ,	
                'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
            );


            $id_do_pagamento = $func->GravarNaBd_ComVerificacaoDeColunas('pagamento',$pagamento,$bd);



            if($bdDoObjecto == 'gps_' || $bdDoObjecto == 'viaturas' ){


    //echo $bdDoObjecto.' / / / ';

                if($bdDoObjecto == 'gps_'){

                     $dadosDaViatura = $func->getPrimeiroRegisto('gps_', array('id_do_servico'), array($idDoServico),$bd);               

                    if (!empty( $dadosDaViatura )) {

                        $servico = 'GPS';
                        if(!empty( $dadosDaViatura['servico'] )){                        
                            $serv___ = explode(' DE ', $dadosDaViatura['servico']);                    
                           if(empty($serv___[1])) $serv___ = (empty( $dadosDaViatura['servico'] ) ? FALSE : explode(' DO ', $dadosDaViatura['servico']));
                           if(empty($serv___[1])) {
                               $tipo_de_servico = $dadosDaViatura['servico'] ;
                           }else{
                               $tipo_de_servico = $serv___[1];
                           }
                        }

                        //echo $tipo_de_servico.' = 2 = = = = = ';

                        $marca = (empty( $dadosDaViatura['marca'] ) ? FALSE : $dadosDaViatura['marca']);
                        $modelo = (empty( $dadosDaViatura['modelo'] ) ? FALSE : $dadosDaViatura['modelo']);
                        $matricula = (empty( $dadosDaViatura['matricula'] ) ? FALSE : $dadosDaViatura['matricula']);
                        $data_de_inicio = (empty( $dadosDaViatura['data_de_inicio'] ) ? FALSE : $dadosDaViatura['data_de_inicio']);
                        $data_de_conclusao = (empty( $dadosDaViatura['data_de_conclusao'] ) ? FALSE : $dadosDaViatura['data_de_conclusao']);
                        $local_do_servico = (empty( $dadosDaViatura['endereco'] ) ? FALSE : $dadosDaViatura['endereco']);
                        $tecnicos = (empty( $dadosDaViatura['tecnicos'] ) ? FALSE : $dadosDaViatura['tecnicos']);
                        $operador = (empty( $dadosDaViatura['operador'] ) ? FALSE : $dadosDaViatura['operador']);
                        $data_de_alteracao = (empty( $dadosDaViatura['data_de_alteracao'] ) ? FALSE : $dadosDaViatura['data_de_alteracao']);
                        //$visto = (empty( $dadosDaViatura['visto'] ) ? FALSE : $dadosDaViatura['visto']);
                        $visto = (empty( $dadosDaViatura['visto'] ) ? FALSE : ( $dadosDaViatura['visto'] ==  "0000-00-00 00:00:00" ? false : $dadosDaViatura['visto'] ) );
                        $estado = (empty( $dadosDaViatura['estado'] ) ? FALSE : $dadosDaViatura['estado']);
                        $imei = (empty( $dadosDaViatura['rv_'] ) ? FALSE : $dadosDaViatura['rv_']);
                        $cartao_sim = (empty( $dadosDaViatura['sim_'] ) ? FALSE : $dadosDaViatura['sim_']);

                        $descricao_tecnica = (empty( $dadosDaViatura['servico'] ) ? FALSE : ('servico: '.$dadosDaViatura['servico'].' / ') ).                            
                                (empty( $dadosDaViatura['sim_'] ) ? FALSE : ('Cartão sim: ' .$dadosDaViatura['sim_']. ' / ' ) ).
                                (empty( $dadosDaViatura['descricao'] ) ? FALSE : ('descrição: ' .$dadosDaViatura['descricao']. ' / ' ) );

                    }

                }else if($bdDoObjecto == 'viaturas'){

                     $dadosDaViatura = $func->getPrimeiroRegisto('viaturas', array('idDoServico'), array($idDoServico),$bd);               

                    if (!empty( $dadosDaViatura )) {
                        
                        //echo $tipo_de_servico.' = 3 = = = = = ';

                        $marca = (empty( $dadosDaViatura['marcaDaViaturaDoCliente'] ) ? FALSE : $dadosDaViatura['marcaDaViaturaDoCliente']);
                        $modelo = (empty( $dadosDaViatura['modeloDaViaturaDoCliente'] ) ? FALSE : $dadosDaViatura['modeloDaViaturaDoCliente']);
                        $matricula = (empty( $dadosDaViatura['matriculaDaViaturaDoCliente'] ) ? FALSE : $dadosDaViatura['matriculaDaViaturaDoCliente']);
                        $data_de_inicio = (empty( $dadosDaViatura['dataDaMontagemDoGps'] ) ? FALSE : $dadosDaViatura['dataDaMontagemDoGps']);
                        $data_de_conclusao = (empty( $dadosDaViatura['dataDaMontagemDoGps'] ) ? FALSE : $dadosDaViatura['dataDaMontagemDoGps']);
                        $local_do_servico = (empty( $dadosDaViatura['localDaMontagemDoGps'] ) ? FALSE : $dadosDaViatura['localDaMontagemDoGps']);
                        $tecnicos = (empty( $dadosDaViatura['nomeDoMontador'] ) ? FALSE : $dadosDaViatura['nomeDoMontador']);
                        $operador = (empty( $dadosDaViatura['nomeDoOperador'] ) ? FALSE : $dadosDaViatura['nomeDoOperador']);
                        $data_de_alteracao = (empty( $dadosDaViatura['dataDeAlteracao'] ) ? FALSE : $dadosDaViatura['dataDeAlteracao']);
                        $visto = (empty( $dadosDaViatura['visto'] ) ? FALSE : ( $dadosDaViatura['visto'] ==  "0000-00-00 00:00:00" ? false : $dadosDaViatura['visto'] ) );
                        $estado = (empty( $dadosDaViatura['estado'] ) ? FALSE : $dadosDaViatura['estado']);
                        $imei = (empty( $dadosDaViatura['imeiDoGps'] ) ? FALSE : $dadosDaViatura['imeiDoGps']);
                        $cartao_sim = (empty( $dadosDaViatura['numeroDoGpsDoCliente'] ) ? FALSE : $dadosDaViatura['numeroDoGpsDoCliente']);

                        $descricao_tecnica = (empty( $dadosDaViatura['servico'] ) ? FALSE : ('servico '.$dadosDaViatura['servico'].' / ') ).
                                (empty( $dadosDaViatura['dispositivo'] ) ? FALSE : ('Dispositivo ' .$dadosDaViatura['dispositivo']. ' / ') ).
                                (empty( $dadosDaViatura['numeroDoGpsDoCliente'] ) ? FALSE : ('numero Do Gps ' .$dadosDaViatura['numeroDoGpsDoCliente']. ' / ' ) ).
                                (empty( $dadosDaViatura['imeiDoGps'] ) ? FALSE : ('imei ' .$dadosDaViatura['imeiDoGps']. ' / ' ) );


                        $tecs = explode(',', $tecnicos);
                        $t = 0;
                        $tecnicos_ = false;
                        while (!empty($tecs[$t])){
                            $res = $func->getPrimeiroRegisto('funcionarios_', array('telefone'), array($tecs[$t]),$bd);
                            $tecnicos_ = empty($tecnicos) ? $res['nome'] : (','.$res['nome']) ;
                            $t++;
                        }
                        if(!empty($tecnicos_)){
                            $tecnicos = $tecnicos_;
                        }
                    }

                }


                if (!empty( $dadosDaViatura )) {

    
                    $servico_para = 'MÓVEL';

                      $movel = array( 
                        'id_do_cliente'	=>  $id_do_cliente,
                        'id_do_ultimo_servico' =>  $id_do_servico,
                        'servico'=> $servico,
                        'kit'=>  (empty( $dadosDaViatura['kit'] ) ? FALSE : $dadosDaViatura['kit']),
                        'marca'		=>  $marca,
                        'modelo'	=>  $modelo,	
                        'matricula'	=>  $matricula,	
                        'data_de_inicio'=>  $data_de_inicio,	
                        'data_de_conclusao'=>  $data_de_conclusao,	
                        'local_do_servico'=>  $local_do_servico,	
                        //'descricao_do_movel'=>  $matricula,	
                        'tecnicos'=>  $tecnicos ,               	
                        'visto'	=>  $visto ,	
                        'estado'=>  $estado ,		
                        'operador'=>  $operador ,	
                        'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                    );

                    $check = $func->getPrimeiroRegisto('movel', array('matricula'), array($matricula),$bd);
                    if($check){
                        $func->AtualizarNaBd_ComVerificacaoDeColunas('movel',$movel ,$check['id'],$bd);
                        $id_do_movel = $check['id'];
                    }else{
                       $id_do_movel = $func->GravarNaBd_ComVerificacaoDeColunas('movel',$movel,$bd); 
                    }

                    $t_d_s = str_split($tipo_de_servico);
                    if($t_d_s[0] == 'i' AND $t_d_s[1] == 'n' || $t_d_s[2] == 's' || $t_d_s[3] == 't'  ){

                        $tipo_de_servico = 'INSTALAÇÃO';

                        //echo $tipo_de_servico.' = 4 = = = = = ';

                        $movel_instalacao = array( 
                            'id_do_movel'	=>  $id_do_movel,
                            'id_do_servico' =>  $id_do_servico,
                            'id_do_cliente' =>  $id_do_cliente,
                            'servico'=> $servico,
                            'kit'=>  (empty( $dadosDaViatura['kit'] ) ? FALSE : $dadosDaViatura['kit']),                
                            'data_de_inicio'=>  $data_de_inicio,	
                            'data_de_conclusao'=>  $data_de_conclusao,	
                            'local_do_servico'=>  $local_do_servico,	
                            'descricao_tecnica'=>  $descricao_tecnica,	
                            'tecnicos'=>  $tecnicos ,               	
                            'visto' =>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $id_movel_instalacao = $func->GravarNaBd_ComVerificacaoDeColunas('movel_instalacao',$movel_instalacao,$bd);

                        renumeracaoPorServico_Instalacao($movel_instalacao);


                    }else{

                        //echo var_dump($dadosDaViatura);

                        $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper($tipo_de_servico));;

                        //echo $tipo_de_servico.' = 5 = = = = = ';

                        $movel_intervencao = array( 
                            'id_do_movel'	=>  $id_do_movel,
                            'id_do_servico' =>  $id_do_servico,
                            'id_do_cliente' =>  $id_do_cliente,
                            'servico'=> $servico,
                            'kit'=>  (empty( $dadosDaViatura['kit'] ) ? FALSE : $dadosDaViatura['kit']),                
                            'data_de_inicio'=>  $data_de_inicio,	
                            'data_de_conclusao'=>  $data_de_conclusao,	
                            'local_do_servico'=>  $local_do_servico,	
                            'descricao_tecnica'=>  $descricao_tecnica,	
                            'tecnicos'=>  $tecnicos ,               	
                            'visto' =>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $id_movel_intervencao = $func->GravarNaBd_ComVerificacaoDeColunas('movel_intervencao',$movel_intervencao,$bd);

                        renumeracaoPorServico_Manutencao($movel_intervencao);

                    }

                    $consumiveis_de_servicos = array(                    
                        'id_do_servico' =>  $id_do_servico, 
                        'id_do_cliente' =>  $id_do_cliente,
                        'servico'=> $servico,
                        'id_do_cliente' =>  $id_do_cliente,  
                        'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,      
                        //'id_do_movimento_de_entrada' =>  $id_do_movimento_de_entrada,               
                        'nome_do_produto' =>  'Rv',               
                        'codigo'=>  $imei,	
                        'quantidade'=>  1,	
                        //'origem'=>  $local_do_servico,                                  	
                        'visto' =>  $visto ,	
                        'estado'=>  $estado ,		
                        'operador'=>  $operador ,	
                        'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd, 
                    );

                    $id_consumiveis_de_servicos = $func->GravarNaBd_ComVerificacaoDeColunas('consumiveis_de_servicos',$consumiveis_de_servicos,$bd);

                    $consumiveis_de_servicos = array(                    
                        'id_do_servico' =>  $id_do_servico,
                        'servico'=> $servico,
                        'id_do_cliente' =>  $id_do_cliente,  
                        'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,      
                        //'id_do_movimento_de_entrada' =>  $id_do_movimento_de_entrada,               
                        'nome_do_produto' =>  'Cartão sim',               
                        'codigo'=>  $cartao_sim,	
                        'quantidade'=>  1,	
                        //'origem'=>  $local_do_servico,                                  	
                        'visto' =>  $visto ,	
                        'estado'=>  $estado ,		
                        'operador'=>  $operador ,	
                        'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd, 
                    );

                    $id_consumiveis_de_servicos = $func->GravarNaBd_ComVerificacaoDeColunas('consumiveis_de_servicos',$consumiveis_de_servicos,$bd);

                    //echo var_dump($consumiveis_de_servicos);
                }

            }else if($bdDoObjecto == 'cameras_'){
    
                $servico = 'CAMERAS';
                $dadosDasCameras = $func->getPrimeiroRegisto('cameras_', array('id_do_servico'), array($idDoServico),$bd);   

                if (!empty( $dadosDasCameras )) {

                    $identificadores = (empty( $dadosDasCameras['identificadores'] ) ? FALSE : $dadosDasCameras['identificadores']);
                    $comudos = (empty( $dadosDasCameras['comudos'] ) ? FALSE : $dadosDasCameras['comudos']);

                    $qtd = (empty( $dadosDasCameras['qtd'] ) ? FALSE : $dadosDasCameras['qtd']);                
                    $tipo_de_camera = (empty( $dadosDasCameras['tipo_de_camera'] ) ? FALSE : $dadosDasCameras['tipo_de_camera']);
                    $app = (empty( $dadosDasCameras['app'] ) ? FALSE : $dadosDasCameras['app']);
                    $backup = (empty( $dadosDasCameras['backup'] ) ? FALSE : $dadosDasCameras['backup']);
                    $visualizacao = (empty( $dadosDasCameras['visualizacao'] ) ? FALSE : $dadosDasCameras['visualizacao']);
                    $marca = (empty( $dadosDasCameras['marca'] ) ? FALSE : $dadosDasCameras['marca']);               
                    $modelo = (empty( $dadosDasCameras['modelo'] ) ? FALSE : $dadosDasCameras['modelo']);
                    $matricula = (empty( $dadosDasCameras['matricula'] ) ? FALSE : $dadosDasCameras['matricula']);
                    $data_de_inicio = (empty( $dadosDasCameras['data_de_inicio'] ) ? FALSE : $dadosDasCameras['data_de_inicio']);
                    $data_de_conclusao = (empty( $dadosDasCameras['data_de_conclusao'] ) ? FALSE : $dadosDasCameras['data_de_conclusao']);
                    $local_do_servico = (empty( $dadosDasCameras['endereco'] ) ? FALSE : $dadosDasCameras['endereco']);
                    $tecnicos = (empty( $dadosDasCameras['tecnicos'] ) ? FALSE : $dadosDasCameras['tecnicos']);
                    $operador = (empty( $dadosDasCameras['operador'] ) ? FALSE : $dadosDasCameras['operador']);
                    $data_de_alteracao = (empty( $dadosDasCameras['data_de_alteracao'] ) ? FALSE : $dadosDasCameras['data_de_alteracao']);                
                    $visto = (empty( $dadosDasCameras['visto'] ) ? FALSE : ( $dadosDasCameras['visto'] ==  "0000-00-00 00:00:00" ? false : $dadosDasCameras['visto'] ) );
                    $estado = (empty( $dadosDasCameras['estado'] ) ? FALSE : $dadosDasCameras['estado']);

                    $descricao_tecnica = (empty( $dadosDasCameras['servico'] ) ? FALSE : ('serviço: '.$dadosDasCameras['servico'].' / ') ).                            
                            (empty( $identificadores_ ) ? FALSE : ('UIDs: ' .$identificadores_. ' / ' ) ).
                            (empty( $comudos ) ? FALSE : ('Comudos: ' .$comudos. ' / ' ) ).
                            (empty( $dadosDasCameras['descricao'] ) ? FALSE : ('descrição: ' .$dadosDasCameras['descricao']. ' / ' ) );


                     $imovel = array( 
                        'id_do_cliente'	=>  $id_do_cliente,
                        'id_do_ultimo_servico' =>  $id_do_servico,
                        'servico'=> $servico,
                        'kit' =>  (empty( $dadosDasCameras['tipo_de_camera'] ) ? FALSE : $dadosDasCameras['tipo_de_camera']),
                        'data_de_inicio'=>  $data_de_inicio,	
                        'data_de_conclusao'=>  $data_de_conclusao,	
                        'local_do_servico'=>  $local_do_servico,                     
                        'tecnicos'=>  $tecnicos ,               	
                        'visto'	=>  $visto ,	
                        'estado'=>  $estado ,		
                        'operador'=>  $operador ,	
                        'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                    );

                    $check = $func->getPrimeiroRegisto('imovel', array('local_do_servico','id_do_cliente'), array($local_do_servico,$id_do_cliente),$bd);
                    if($check){
                        $func->AtualizarNaBd_ComVerificacaoDeColunas('imovel',$imovel ,$check['id'],$bd);
                        $id_do_imovel = $check['id'];
                    }else{
                       $id_do_imovel = $func->GravarNaBd_ComVerificacaoDeColunas('imovel',$imovel,$bd);
                    }
                    


                    $t_d_s = str_split($tipo_de_servico);
                    if($t_d_s[0] == 'i' AND $t_d_s[1] == 'n' || $t_d_s[2] == 's' || $t_d_s[3] == 't'  ){

                        $tipo_de_servico = 'INSTALAÇÃO';

                        //echo $tipo_de_servico.' = 6 = = = = = ';

                        $imovel_instalacao = array( 
                            'id_do_cliente'	=>  $id_do_cliente,
                            //'id_do_movel'	=>  $id_do_movel,                        
                            'id_do_imovel'	=>  $id_do_imovel,
                            'id_do_servico' =>  $id_do_servico,
                            'servico'=> $servico,
                            'kit'=>   (empty( $dadosDasCameras['tipo_de_camera'] ) ? FALSE : $dadosDasCameras['tipo_de_camera']),               
                            'visualizacao'=>  $visualizacao,                       	
                            'data_de_inicio'=>  $data_de_inicio,	
                            'data_de_conclusao'=>  $data_de_conclusao,	
                            //'local_do_servico'=>  $local_do_servico,	
                            'descricao_tecnica'=>  $descricao_tecnica,	
                            'tecnicos'=>  $tecnicos ,               	
                            'visto' =>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $id_imovel_instalacao = $func->GravarNaBd_ComVerificacaoDeColunas('imovel_instalacao',$imovel_instalacao,$bd);

                        renumeracaoPorServico_Instalacao($imovel_instalacao);


                    }else{

                        $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper($tipo_de_servico));

                        //echo $tipo_de_servico.' = 7 = = = = = ';

                        $imovel_intervencao = array( 
                            'id_do_cliente'	=>  $id_do_cliente,
                            'id_do_movel'	=>  $id_do_movel,                        
                            'id_do_imovel'	=>  $id_do_imovel,
                            'id_do_servico' =>  $id_do_servico, 
                            'servico'=> $servico,
                            'kit'=>   (empty( $dadosDasCameras['tipo_de_camera'] ) ? FALSE : $dadosDasCameras['tipo_de_camera']),               
                            'visualizacao'=>  $visualizacao,                       	
                            'data_de_inicio'=>  $data_de_inicio,	
                            'data_de_conclusao'=>  $data_de_conclusao,	
                            //'local_do_servico'=>  $local_do_servico,	
                            'descricao_tecnica'=>  $descricao_tecnica,	
                            'tecnicos'=>  $tecnicos ,               	
                            'visto' =>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $id_imovel_intervencao = $func->GravarNaBd_ComVerificacaoDeColunas('imovel_intervencao',$imovel_intervencao,$bd);

                        renumeracaoPorServico_Manutencao($imovel_intervencao);

                    }



                    $ident = explode(',', $identificadores);
                    $comu = explode(',', $comudos);
                    $t = 0;
                    while ($qtd > $t ){
                        //$res = $func->getPrimeiroRegisto('funcionarios_', array('telefone'), array($tecs[$t]),$bd);
                        $identificador = (empty( $ident[$t] ) ? FALSE : $ident[$t]);  
                        $comudo = (empty( $comu[$t] ) ? FALSE : $comu[$t]); 

                        $imovel_instalacao['comudo'] = $comudo;
                        $imovel_intervencao['comudo'] = $comudo;

                        $consumiveis_de_servicos = array(                    
                            'id_do_servico' =>  $id_do_servico, 
                            'servico'=> $servico,
                            'id_do_cliente' =>  $id_do_cliente,  
                            'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,      
                            //'id_do_movimento_de_entrada' =>  $id_do_movimento_de_entrada,               
                            'nome_do_produto' =>  'Camera',               
                            'codigo'=>  $identificador,	
                            'quantidade'=>  1,	
                            //'origem'=>  $local_do_servico,                                  	
                            'visto' =>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd, 
                        );

                        $id_consumiveis_de_servicos = $func->GravarNaBd_ComVerificacaoDeColunas('consumiveis_de_servicos',$consumiveis_de_servicos,$bd);

                        $t++;
                    }




                    $t = 0; 
                    $prods =  array( 'condutores_','calhas_','caxas_de_derivacao_','juncoes_','fita_cola_','parafusos_','memorias_','bracadeiras_','caixas_de_dervacao_','fontes_','conectores_','rele_', );           
                    while ( !empty( $prods[$t]  ) ){
                        if(!empty($dadosDasCameras[ ($prods[$t]) ])){                        
                            $consumiveis_de_servicos = array(                    
                                'id_do_servico' =>  $id_do_servico, 
                                'servico'=> $servico,
                                'id_do_cliente' =>  $id_do_cliente,  
                                'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,      
                                            
                                //'id_do_movimento_de_entrada' =>  $id_do_movimento_de_entrada,               
                                'nome_do_produto' => str_replace('_', ' ', $prods[$t]),               
                                //'codigo'=>  $cartao_sim,	
                                'quantidade'=>  $dadosDasCameras[ ($prods[$t]) ],	
                                //'origem'=>  $local_do_servico,                                  	
                                'visto' =>  $visto ,	
                                'estado'=>  $estado ,		
                                'operador'=>  $operador ,	
                                'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd, 
                            );
                            $id_consumiveis_de_servicos = $func->GravarNaBd_ComVerificacaoDeColunas('consumiveis_de_servicos',$consumiveis_de_servicos,$bd);

                        }
                        $t ++;
                    }


                }

            }else if($bdDoObjecto == 'alarmes_'){
    
                $dadosDaViatura = $func->getPrimeiroRegisto('alarmes_', array('id_do_servico'), array($idDoServico),$bd);   

                if (!empty( $dadosDaViatura )) {  

                    $servico = 'ALARME VEICULAR';
                    
                    //echo $tipo_de_servico.' = 8 = = = = = ';

                    $marca = (empty( $dadosDaViatura['marca'] ) ? FALSE : $dadosDaViatura['marca']);
                    $modelo = (empty( $dadosDaViatura['modelo'] ) ? FALSE : $dadosDaViatura['modelo']);
                    $matricula = (empty( $dadosDaViatura['matricula'] ) ? FALSE : $dadosDaViatura['matricula']);
                    $data_de_inicio = (empty( $dadosDaViatura['data_de_inicio'] ) ? FALSE : $dadosDaViatura['data_de_inicio']);
                    $data_de_conclusao = (empty( $dadosDaViatura['data_de_conclusao'] ) ? FALSE : $dadosDaViatura['data_de_conclusao']);
                    $local_do_servico = (empty( $dadosDaViatura['endereco'] ) ? FALSE : $dadosDaViatura['endereco']);
                    $tecnicos = (empty( $dadosDaViatura['tecnicos'] ) ? FALSE : $dadosDaViatura['tecnicos']);
                    $operador = (empty( $dadosDaViatura['operador'] ) ? FALSE : $dadosDaViatura['operador']);
                    $data_de_alteracao = (empty( $dadosDaViatura['data_de_alteracao'] ) ? FALSE : $dadosDaViatura['data_de_alteracao']);
                    $visto = (empty( $dadosDaViatura['visto'] ) ? FALSE : ( $dadosDaViatura['visto'] ==  "0000-00-00 00:00:00" ? false : $dadosDaViatura['visto'] ) );
                    $estado = (empty( $dadosDaViatura['estado'] ) ? FALSE : $dadosDaViatura['estado']);
                    $imei = (empty( $dadosDaViatura['imei'] ) ? FALSE : $dadosDaViatura['imei']);

                    $descricao_tecnica = (empty( $dadosDaViatura['servico'] ) ? FALSE : ('serviço: '.$dadosDaViatura['servico'].' / ') ).                            
                            (empty( $dadosDaViatura['sim_'] ) ? FALSE : ('Cartão sim: ' .$dadosDaViatura['sim_']. ' / ' ) ).
                            (empty( $dadosDaViatura['descricao'] ) ? FALSE : ('descrição: ' .$dadosDaViatura['descricao']. ' / ' ) );


                    $servico_para = 'MÓVEL';

                    $movel = array( 
                      'id_do_cliente'	=>  $id_do_cliente,
                      'id_do_ultimo_servico' =>  $id_do_servico,
                      'servico'=> $servico,
                      'kit'=>  (empty( $dadosDaViatura['kit'] ) ? FALSE : $dadosDaViatura['kit']),
                      'marca'=>  $marca,
                      'modelo'=>  $modelo,	
                      'matricula'=>  $matricula,	
                      'data_de_inicio'=>  $data_de_inicio,	
                      'data_de_conclusao'=>  $data_de_conclusao,	
                      'local_do_servico'=>  $local_do_servico,	
                      //'descricao_do_movel'=>  $matricula,	
                      'tecnicos'=>  $tecnicos ,               	
                      'visto'=>  $visto ,	
                      'estado'=>  $estado ,		
                      'operador'=>  $operador ,	
                      'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                    );

                    $check = $func->getPrimeiroRegisto('movel', array('matricula'), array($matricula),$bd);
                    if($check){
                        $func->AtualizarNaBd_ComVerificacaoDeColunas('movel',$movel ,$check['id'],$bd);
                        $id_do_movel = $check['id'];
                    }else{
                       $id_do_movel = $func->GravarNaBd_ComVerificacaoDeColunas('movel',$movel,$bd); 
                    }
                    

                    $t_d_s = str_split($tipo_de_servico);
                    if($t_d_s[0] == 'i' AND $t_d_s[1] == 'n' || $t_d_s[2] == 's' || $t_d_s[3] == 't'  ){

                        $tipo_de_servico = 'INSTALAÇÃO';

                        //echo $tipo_de_servico.' = 9 = = = = = ';

                        $movel_instalacao = array( 
                          'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,      
                          'id_do_servico' =>  $id_do_servico, 
                          'id_do_cliente' =>  $id_do_cliente,
                          'servico'=> $servico,
                          'kit'=>  (empty( $dadosDaViatura['kit'] ) ? FALSE : $dadosDaViatura['kit']),                
                          'data_de_inicio'=>  $data_de_inicio,	
                          'data_de_conclusao'=>  $data_de_conclusao,	
                          'local_do_servico'=>  $local_do_servico,	
                          'descricao_tecnica'=>  $descricao_tecnica,	
                          'tecnicos'=>  $tecnicos ,               	
                          'visto' =>  $visto ,	
                          'estado'=>  $estado ,		
                          'operador'=>  $operador ,	
                          'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $id_movel_instalacao = $func->GravarNaBd_ComVerificacaoDeColunas('movel_instalacao',$movel_instalacao,$bd);

                        renumeracaoPorServico_Instalacao($movel_instalacao);

                    }else{

                        $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper($tipo_de_servico));;

                        //echo $tipo_de_servico.' = 10 = = = = = ';

                        $movel_intervencao = array( 
                          'id_do_movel'	=>  $id_do_movel,
                          'id_do_servico' =>  $id_do_servico,
                            'id_do_cliente' =>  $id_do_cliente,
                            'servico'=> $servico,
                          'kit'=>  (empty( $dadosDaViatura['kit'] ) ? FALSE : $dadosDaViatura['kit']),                
                          'data_de_inicio'=>  $data_de_inicio,	
                          'data_de_conclusao'=>  $data_de_conclusao,	
                          'local_do_servico'=>  $local_do_servico,	
                          'descricao_tecnica'=>  $descricao_tecnica,	
                          'tecnicos'=>  $tecnicos ,               	
                          'visto' =>  $visto ,	
                          'estado'=>  $estado ,		
                          'operador'=>  $operador ,	
                          'data_de_alteracao'=>  $data_de_alteracao ,                        
                          'bd' => $bd,
                        );


                        $id_movel_intervencao = $func->GravarNaBd_ComVerificacaoDeColunas('movel_intervencao',$movel_intervencao,$bd);

                        renumeracaoPorServico_Manutencao($movel_intervencao);

                    }                

                    $consumiveis_de_servicos = array(                    
                        'id_do_servico' =>  $id_do_servico, 
                        'id_do_cliente' =>  $id_do_cliente, 
                        'servico'=> $servico,
                        'id_do_cliente' =>  $id_do_cliente,  
                        'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,            
                        //'id_do_movimento_de_entrada' =>  $id_do_movimento_de_entrada,               
                        'nome_do_produto' =>  'MODULO DE ALARME',               
                        'codigo'=>  $imei,	
                        'quantidade'=>  1,	
                        //'origem'=>  $local_do_servico,                                  	
                        'visto' =>  $visto ,	
                        'estado'=>  $estado ,		
                        'operador'=>  $operador ,	
                        'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd, 
                    );

                    $id_consumiveis_de_servicos = $func->GravarNaBd_ComVerificacaoDeColunas('consumiveis_de_servicos',$consumiveis_de_servicos,$bd);


                    //$func->AtualizarNaBd_ComVerificacaoDeColunas('servicos_',$serv ,$dadosDaViatura['id'],$bd);



                }




            }else if($bdDoObjecto == 'outro_servico_'){

                $outros = $func->getPrimeiroRegisto('outro_servico_', array('id_do_servico'), array($idDoServico),$bd);   

                if (!empty( $outros )) {

   
                    
                    //echo $tipo_de_servico.' = 8 = = = = = ';
                    $identificadores = (empty( $dadosDasCameras['identificadores'] ) ? FALSE : $dadosDasCameras['identificadores']);
                    $comudos = (empty( $dadosDasCameras['comudos'] ) ? FALSE : $dadosDasCameras['comudos']);
                    $objecto_do_servico = (empty( $outros['objecto_do_servico'] ) ? FALSE : $outros['objecto_do_servico']);
                    $nome_do_dispositivo = (empty( $outros['nome_do_dispositivo'] ) ? FALSE : $outros['nome_do_dispositivo']);
                    $visualizacao = (empty( $dadosDasCameras['visualizacao'] ) ? FALSE : $dadosDasCameras['visualizacao']);
                    $marca = (empty( $dadosDasCameras['marca_do_dispositivo'] ) ? FALSE : $dadosDasCameras['marca_do_dispositivo']);               
                    $modelo = (empty( $dadosDasCameras['modelo_do_dispositivo'] ) ? FALSE : $dadosDasCameras['modelo_do_dispositivo']);
                    $data_de_inicio = (empty( $dadosDasCameras['data_de_inicio'] ) ? FALSE : $dadosDasCameras['data_de_inicio']);
                    $data_de_conclusao = (empty( $dadosDasCameras['data_de_conclusao'] ) ? FALSE : $dadosDasCameras['data_de_conclusao']);
                    $data_de_alteracao = (empty( $outros['data_de_alteracao'] ) ? FALSE : $outros['data_de_alteracao']);
                    $local_do_servico = (empty( $dadosDasCameras['endereco'] ) ? FALSE : $dadosDasCameras['endereco']);                 
                    $tecnicos = (empty( $outros['tecnicos'] ) ? FALSE : $outros['tecnicos']);
                    $operador = (empty( $outros['operador'] ) ? FALSE : $outros['operador']);
                    $imagem = (empty( $outros['imagem'] ) ? FALSE : $outros['imagem']);
                    $origem = (empty( $outros['origem'] ) ? FALSE : $outros['origem']);
                    $servico = (empty( $outros['servico'] ) ? FALSE : $outros['servico']);                  
                    $descricao = (empty( $dadosDasCameras['descricao'] ) ? FALSE : $dadosDasCameras['descricao']);
                    $visto = (empty( $outros['visto'] ) ? FALSE : ( $outros['visto'] ==  "0000-00-00 00:00:00" ? false : $outros['visto'] ) );
                    $estado = (empty( $outros['estado'] ) ? FALSE : $outros['estado']);
                    $descricao_tecnica = (empty( $dadosDasCameras['servico'] ) ? FALSE : ('serviço: '.$dadosDasCameras['servico'].' / ') ).                            
                            (empty( $objecto_do_servico ) ? FALSE : ('Objecto do servico ' .$objecto_do_servico. ' / ' ) ).
                            (empty( $marca ) ? FALSE : ('Marca: ' .$marca. ' / ' ) ).
                            (empty( $modelo ) ? FALSE : ('modelo: ' .$modelo. ' / ' ) ).
                            (empty( $dadosDasCameras['descricao'] ) ? FALSE : ('descrição: ' .$dadosDasCameras['descricao']. ' / ' ) );

                    
                    if($objecto_do_servico == 'automóvel' || $objecto_do_servico == 'carro'){
                        $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper(explode(' ',$servico)[0]));
                         $servico_para = 'MÓVEL';
                         $servico = strtoupper($nome_do_dispositivo);
                         
                         $movel = array( 
                            'id_do_cliente'	=>  $id_do_cliente,
                            'id_do_ultimo_servico' =>  $id_do_servico,
                            'servico'=> $servico,
                            'kit'=>  'S/N',
                            'marca'=>  $marca,
                            'modelo'=>  $modelo,	
                            'matricula'=>  $matricula,	
                            'data_de_inicio'=>  $data_de_inicio,	
                            'data_de_conclusao'=>  $data_de_conclusao,	
                            'local_do_servico'=>  $local_do_servico,	
                            //'descricao_do_movel'=>  $matricula,	
                            'tecnicos'=>  $tecnicos ,               	
                            'visto'=>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $check = $func->getPrimeiroRegisto('movel', array('matricula'), array($matricula),$bd);
                        if($check){
                            $func->AtualizarNaBd_ComVerificacaoDeColunas('movel',$movel ,$check['id'],$bd);
                            $id_do_movel = $check['id'];
                        }else{
                           $id_do_movel = $func->GravarNaBd_ComVerificacaoDeColunas('movel',$movel,$bd); 
                        }

                        
                        $t_d_s = str_split($tipo_de_servico);
                        if($t_d_s[0] == 'i' AND $t_d_s[1] == 'n' || $t_d_s[2] == 's' || $t_d_s[3] == 't'  ){

                            $tipo_de_servico = 'INSTALAÇÃO';

                            //echo $tipo_de_servico.' = 9 = = = = = ';

                            $movel_instalacao = array( 
                              'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                    'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,      
                              'id_do_servico' =>  $id_do_servico, 
                              'id_do_cliente' =>  $id_do_cliente,
                              'servico'=> $servico,
                              'kit'=>  'S/N',           
                              'data_de_inicio'=>  $data_de_inicio,	
                              'data_de_conclusao'=>  $data_de_conclusao,	
                              'local_do_servico'=>  $local_do_servico,	
                              'descricao_tecnica'=>  $descricao_tecnica,	
                              'tecnicos'=>  $tecnicos ,               	
                              'visto' =>  $visto ,	
                              'estado'=>  $estado ,		
                              'operador'=>  $operador ,	
                              'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                            );

                            $id_movel_instalacao = $func->GravarNaBd_ComVerificacaoDeColunas('movel_instalacao',$movel_instalacao,$bd);

                            renumeracaoPorServico_Instalacao($movel_instalacao);

                        }else{

                            $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper($tipo_de_servico));;

                            //echo $tipo_de_servico.' = 10 = = = = = ';

                            $movel_intervencao = array( 
                              'id_do_movel'	=>  $id_do_movel,
                              'id_do_servico' =>  $id_do_servico,
                                'id_do_cliente' =>  $id_do_cliente,
                                'servico'=> $servico,
                              'kit'=>  'S/N',            
                              'data_de_inicio'=>  $data_de_inicio,	
                              'data_de_conclusao'=>  $data_de_conclusao,	
                              'local_do_servico'=>  $local_do_servico,	
                              'descricao_tecnica'=>  $descricao_tecnica,	
                              'tecnicos'=>  $tecnicos ,               	
                              'visto' =>  $visto ,	
                              'estado'=>  $estado ,		
                              'operador'=>  $operador ,	
                              'data_de_alteracao'=>  $data_de_alteracao ,                        
                              'bd' => $bd,
                            );


                            $id_movel_intervencao = $func->GravarNaBd_ComVerificacaoDeColunas('movel_intervencao',$movel_intervencao,$bd);

                            renumeracaoPorServico_Manutencao($movel_intervencao);

                        }

                         
                    }else{
                        $servico_para = 'IMÓVEL';
                        $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper(explode(' ',$servico)[0]));                        
                         $servico = strtoupper($nome_do_dispositivo);
                        if(empty($comudos)) $comudos = $objecto_do_servico;
                        
                        $imovel = array( 
                            'id_do_cliente'	=>  $id_do_cliente,
                            'id_do_ultimo_servico' =>  $id_do_servico,
                            'servico'=> $servico,
                            'kit' =>  'S/N',
                            'data_de_inicio'=>  $data_de_inicio,	
                            'data_de_conclusao'=>  $data_de_conclusao,	
                            'local_do_servico'=>  $local_do_servico,                     
                            'tecnicos'=>  $tecnicos ,               	
                            'visto'	=>  $visto ,	
                            'estado'=>  $estado ,		
                            'operador'=>  $operador ,	
                            'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                        );

                        $check = $func->getPrimeiroRegisto('imovel', array('local_do_servico','id_do_cliente'), array($local_do_servico,$id_do_cliente),$bd);
                        if($check){
                            $func->AtualizarNaBd_ComVerificacaoDeColunas('imovel',$imovel ,$check['id'],$bd);
                            $id_do_imovel = $check['id'];
                        }else{
                           $id_do_imovel = $func->GravarNaBd_ComVerificacaoDeColunas('imovel',$imovel,$bd);
                        }



                        $t_d_s = str_split($tipo_de_servico);
                        if($t_d_s[0] == 'i' AND $t_d_s[1] == 'n' || $t_d_s[2] == 's' || $t_d_s[3] == 't'  ){

                            $tipo_de_servico = 'INSTALAÇÃO';

                            //echo $tipo_de_servico.' = 6 = = = = = ';

                            $imovel_instalacao = array( 
                                'id_do_cliente'	=>  $id_do_cliente,
                                //'id_do_movel'	=>  $id_do_movel,                        
                                'id_do_imovel'	=>  $id_do_imovel,
                                'id_do_servico' =>  $id_do_servico,
                                'servico'=> $servico,
                                'kit'=>    'S/N',              
                                'visualizacao'=>  $visualizacao,                       	
                                'data_de_inicio'=>  $data_de_inicio,	
                                'data_de_conclusao'=>  $data_de_conclusao,	
                                //'local_do_servico'=>  $local_do_servico,	
                                'descricao_tecnica'=>  $descricao_tecnica,	
                                'tecnicos'=>  $tecnicos ,               	
                                'visto' =>  $visto ,	
                                'estado'=>  $estado ,		
                                'operador'=>  $operador ,	
                                'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                            );

                            $id_imovel_instalacao = $func->GravarNaBd_ComVerificacaoDeColunas('imovel_instalacao',$imovel_instalacao,$bd);

                            renumeracaoPorServico_Instalacao($imovel_instalacao);


                        }else{

                            $tipo_de_servico = str_replace('CA','ÇÃ', strtoupper($tipo_de_servico));

                            //echo $tipo_de_servico.' = 7 = = = = = ';

                            $imovel_intervencao = array( 
                                'id_do_cliente'	=>  $id_do_cliente,
                                'id_do_movel'	=>  $id_do_movel,                        
                                'id_do_imovel'	=>  $id_do_imovel,
                                'id_do_servico' =>  $id_do_servico, 
                                'servico'=> $servico,
                                'kit'=>    'S/N',           
                                'visualizacao'=>  $visualizacao,                       	
                                'data_de_inicio'=>  $data_de_inicio,	
                                'data_de_conclusao'=>  $data_de_conclusao,	
                                //'local_do_servico'=>  $local_do_servico,	
                                'descricao_tecnica'=>  $descricao_tecnica,	
                                'tecnicos'=>  $tecnicos ,               	
                                'visto' =>  $visto ,	
                                'estado'=>  $estado ,		
                                'operador'=>  $operador ,	
                                'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd,		
                            );

                            $id_imovel_intervencao = $func->GravarNaBd_ComVerificacaoDeColunas('imovel_intervencao',$imovel_intervencao,$bd);

                            renumeracaoPorServico_Manutencao($imovel_intervencao);

                        }

                    }
                       

                    $t = 0; 
                    $prods =  array( 'condutores_','calhas_','caxas_de_derivacao_','juncoes_','fita_cola_','parafusos_','memorias_','bracadeiras_','caixas_de_dervacao_','fontes_','conectores_','rele_', );           
                    while ( !empty( $prods[$t]  ) ){
                        if(!empty($dadosDasCameras[ ($prods[$t]) ])){                        
                            $consumiveis_de_servicos = array(                    
                                'id_do_servico' =>  $id_do_servico, 
                                'servico'=> $servico,
                                'id_do_cliente' =>  $id_do_cliente,  
                                'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel ,
                                'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel ,               
                                //'id_do_movimento_de_entrada' =>  $id_do_movimento_de_entrada,               
                                'nome_do_produto' => str_replace('_', ' ', $prods[$t]),               
                                //'codigo'=>  $cartao_sim,	
                                'quantidade'=>  $dadosDasCameras[ ($prods[$t]) ],	
                                //'origem'=>  $local_do_servico,                                  	
                                'visto' =>  $visto ,	
                                'estado'=>  $estado ,		
                                'operador'=>  $operador ,	
                                'data_de_alteracao'=>  $data_de_alteracao ,                      'bd' => $bd, 
                            );
                            $id_consumiveis_de_servicos = $func->GravarNaBd_ComVerificacaoDeColunas('consumiveis_de_servicos',$consumiveis_de_servicos,$bd);

                        }
                        $t ++;
                    }
                    	
                }

            }



            //getConsumiveis($id_do_servico);
        }
        
        
        $servico_ = array( 
            'id_do_movel' => empty($id_do_movel) ? false : $id_do_movel,
            'id_do_imovel' => empty($id_do_imovel) ? false : $id_do_imovel, 
            'servico' =>  empty($servico) ? false : $servico,
            'tipo_de_servico' => empty($tipo_de_servico) ? false : $tipo_de_servico,
            'servico_para'=>  empty($servico_para) ? false : $servico_para,                
            		
        );
        
        $func->AtualizarNaBd_ComVerificacaoDeColunas('servicos',$servico_ ,$id_do_servico,$bd);
        
        
         echo '$id_do_movel '. (empty($id_do_movel) ? false : $id_do_movel).' / '.
         
                '$id_do_imovel '. (empty($id_do_imovel) ? false : $id_do_imovel).' / '.
                '$servico '. (empty($servico) ? false : $servico).' / '.
                '$servico_para '. (empty($servico_para) ? false : $servico_para).' / '.
                '$tipo_de_servico '. (empty($tipo_de_servico) ? false : $tipo_de_servico).' /<br> ';
        
         
         
    
    
        $id_do_movel = false;
        $id_do_imovel = false;
        $servico = false;
        $servico_para = false;
        $tipo_de_servico = false;
        $tecnicos = false;
        $identificadores = false;
        $comudos = false;
        $objecto_do_servico = false;
        $nome_do_dispositivo = false;
        $visualizacao = false;
        $marca = false; 
        $modelo = false;
        $data_de_inicio = false;
        $data_de_conclusao= false;
        $data_de_alteracao= false;
        $local_do_servico= false;        
        $tecnicos = false;
        $operador= false;
        $imagem= false;
        $origem= false;
        //$servico= false;
        $descricao= false;
        $visto= false;
        $estado= false;
        $descricao_tecnica = false;
        
 
    }
    
}




function renumeracaoPorServico_Instalacao($dds){
	
	$func = new Funcoes;
	$tec = explode( ",", $dds['tecnicos']);
	$numeroDeTecnicos = count($tec);
	
	$renuPorServ = 3000;
	$valor = $renuPorServ / $numeroDeTecnicos;


	if($dds['servico'] == 'CAMERAS' || $dds['servico'] == 'CAMPAHINHA' || $dds['servico'] == 'ROTROVISOR COM CAMERA' ){
		$renuPorServ = 3000;
		$valor = $renuPorServ / $numeroDeTecnicos;

	}else if($dds['servico'] == 'ALARME RESIDÊNCIAL' ){
		$renuPorServ = 6000;
		$valor = $renuPorServ / $numeroDeTecnicos;

	}else if($dds['servico'] == 'OUTRO MOVEL' || $dds['servico'] == 'OUTRO IMOVEL' ){
		$valor = 0;

	}else if($dds['kit']== 'KIT BOSS' || $dds['kit']== 'KIT SALDO' || $dds['kit']== 'KIT BILINDADO' || $dds['kit']== 'KIT SMART' ){
		$renuPorServ = 4000;
		$valor = $renuPorServ / $numeroDeTecnicos;

	}else if($dds['kit']== 'KIT + BOSS' || $dds['kit']== 'KIT + SALDO' || $dds['kit']== 'KIT + BILINDADO' ){
		$renuPorServ = 5000;
		$valor = $renuPorServ / $numeroDeTecnicos;

	}else if($dds['kit']== 'KIT SUPER BOSS' || $dds['kit']== 'KIT SUPER SALDO' || $dds['kit']== 'KIT SUPER BILINDADO' || $dds['kit']== 'KIT PREMIUM' || $dds['kit']== 'KIT VERY SMART' || $dds['kit']== 'KIT ULTRA SMART' || $dds['kit']== 'ALARME RESIDÊNCIAL'    ){
		$renuPorServ = 6000;
		$valor = $renuPorServ / $numeroDeTecnicos;

	}else {
		$renuPorServ = 3000;
		$valor = $renuPorServ / $numeroDeTecnicos;

	}
	
	$dds['valor_por_servico'] = $valor;
        
        $i = 0;
        while ($numeroDeTecnicos > 0){
            
            $funcio = $func->getPrimeiroRegisto('funcionarios', array('nome'), array( $tec[$i]),$dds['bd']);
            $dds['id_do_funcionario'] = empty($funcio['id'])?false:$funcio['id'];
            $dds['nome_do_funcionario'] = empty($funcio['nome'])?$tec[$i]:$funcio['nome'];
            $dds['nome_do_tecnico'] = empty($funcio['nome'])?$tec[$i]:$funcio['nome'];
            $func->GravarNaBd_ComVerificacaoDeColunas('renumeracao_por_servico',$dds,$dds['bd']);
            $func->GravarNaBd_ComVerificacaoDeColunas('tecnico',$dds,$dds['bd']);
            $numeroDeTecnicos --;
            $i++;
        }
        
	
}




function renumeracaoPorServico_Manutencao($dds){
	
	$func = new Funcoes;
	$tec = explode( ",", $dds['tecnicos']);
	$numeroDeTecnicos = count($tec);
	$valor = 0;
		
	$renuPorServ = 3000;
	$valor = $renuPorServ / $numeroDeTecnicos;
	
	//verificar se a instalação tem mais de 2 meses
	
	// verificar se a manuten

	$Checar = new Read ;
	
	if(!empty($dds['id_do_movel']))
		$reg = $func->getPrimeiroRegisto('movel_instalacao', array('id_do_cliente', 'id_do_movel', 'kit'), array( $dds['id_do_cliente'], $dds['id_do_movel'], $dds['kit']),$dds['bd']);
	
	if(!empty($dds['id_do_imovel'])) 
		$reg = $func->getPrimeiroRegisto('imovel_instalacao', array('id_do_cliente', 'id_do_imovel', 'kit'), array( $dds['id_do_cliente'], $dds['id_do_imovel'], $dds['kit']),$dds['bd']);

	if($reg){
		
		$data1 = empty($reg['data_de_conclusao'])?false:$reg['data_de_conclusao'];
		$data2 = empty($dds['data_de_inicio'])?false:$dds['data_de_inicio'];
		
		if($data1 && $data2 && $data2 > $data1){
			
			$data1 = explode("-",$data1);
			$data2 = explode("-",$data2);

			if($data2[0] == $data1[0]){ // mesmo ano
				if($data2[1] - $data1[1] < 2){
					$renuPorServ = 1500;
					$valor = $renuPorServ / $numeroDeTecnicos;
					//decontoPorTrabalhoMalExecutado($reg, $dds, $dds['bd']);

				}else if( ($data2[1] - $data1[1] == 2) && ($data2[2] - $data1[2] < 0) ){
						$renuPorServ = 1500;
						$valor = $renuPorServ / $numeroDeTecnicos;
						//decontoPorTrabalhoMalExecutado($reg, $dds, $dds['bd']);
				}
				
			}else{ // anos diferentes
				if($data2[1] - $data1[1] < 2){
					$renuPorServ = 1500;
					$valor = $renuPorServ / $numeroDeTecnicos;
					//decontoPorTrabalhoMalExecutado($reg, $dds, $dds['bd']);

				}else if( ($data2[1] - $data1[1] == 2) && ($data2[2] - $data1[2] < 0) ){
						$renuPorServ = 1500;
						$valor = $renuPorServ / $numeroDeTecnicos;
						//decontoPorTrabalhoMalExecutado($reg, $dds, $dds['bd']);
				}
			}
		}
	}
	
	$dds['valor_por_servico'] = $valor;
        
        $i = 0;
        while ($numeroDeTecnicos > 0){
            
            $funcio = $func->getPrimeiroRegisto('funcionarios', array('nome'), array( $tec[$i]),$dds['bd']);
            $dds['id_do_funcionario'] = empty($funcio['id'])?false:$funcio['id'];
            $dds['nome_do_funcionario'] = empty($funcio['nome'])?$tec[$i]:$funcio['nome'];
            $dds['nome_do_tecnico'] = empty($funcio['nome'])?$tec[$i]:$funcio['nome'];
            $func->GravarNaBd_ComVerificacaoDeColunas('renumeracao_por_servico',$dds,$dds['bd']);
            $func->GravarNaBd_ComVerificacaoDeColunas('tecnico',$dds,$dds['bd']);
            $numeroDeTecnicos --;
            $i++;
        }
        
                    
}



	


/*
 * De plataforma para renovações
 *     $Checar = new Read ;
    $Checar->ExeRead( 'plataformas_', "WHERE id_do_servico = :tel ORDER BY data ASC ","tel={$id_do_servico}");

    if( $Checar->getResult() ){ 
        foreach( $Checar->getResult() as $Func ):
               $data = ( empty($Func['data']) ? FALSE : ($Func['data']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
       endforeach;            
    }
 

function getConsumiveis($id_do_servico){

    $Checar = new Read ;
    $Checar->ExeRead( 'consumiveis_', "WHERE id_do_servico = :tel ","tel={$id_do_servico}");

    if( $Checar->getResult() ){ 
        foreach( $Checar->getResult() as $Func ):
               $data = ( empty($Func['data']) ? FALSE : ($Func['data']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               $operacao = ( empty($Func['operacao']) ? FALSE : ($Func['operacao']) );
               
               
               bracadeiras_	
bd_bracadeiras_	
calhas_	
bd_calhas_	
condutores_	
bd_condutores_	
caixas_de_dervacao_	
bd_caixas_de_dervacao_	
fita_cola_	
bd_fita_cola_	
parafusos_	
bd_parafusos_	
fontes_	
bd_fontes_	
sim_	
bd_sim_	
conectores_	
bd_conectores_	
juncoes_	
bd_juncoes_	
rele_	
bd_rele_	
memorias_	
bd_memorias_	
data_de_alteracao	
estado	
operador	

       endforeach;            
    }
}


/*




function getOutro($idDoServico, $idDoClick ){
    $nome_do_dispositivo = (empty( $arrS['nome_do_dispositivo'] ) ? FALSE : $arrS['nome_do_dispositivo']);
    $endereco = (empty( $arrS['endereco'] ) ? FALSE : $arrS['endereco']);
    $estado = (empty( $arrS['estado'] ) ? FALSE : $arrS['estado']);
}


function getCamera($idDoServico, $idDoClick ){ 
    $endereco = (empty( $arrS['endereco'] ) ? FALSE : $arrS['endereco']);
    $estado = (empty( $arrS['estado'] ) ? FALSE : $arrS['estado']);

}


function getViatura($idDoServico, $idDoClick ){

    $marca = (empty( $arrS['marca'] ) ? FALSE : $arrS['marca']);
    $modelo = (empty( $arrS['modelo'] ) ? FALSE : $arrS['modelo']);
    $sim_ = (empty( $arrS['sim_'] ) ? FALSE : $arrS['sim_']);
    $estado = (empty( $arrS['estado'] ) ? FALSE : $arrS['estado']);

}


function getAlarme($idDoServico, $idDoClick ){
    $marca = (empty( $arrS['marca'] ) ? FALSE : $arrS['marca']);
    $modelo = (empty( $arrS['modelo'] ) ? FALSE : $arrS['modelo']);

}

*/

?>
