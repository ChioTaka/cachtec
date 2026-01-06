<?php
//include 'Conn.class.php';
/*
Classe reponsavel pela Leitura
*/
class Funcoes {
    
    /*********************TODAS AS TABELAS DA BASE DE DADOS CACHV3****************/
    
    public function tabelasDaBdCachv3(){
        return(array('renumeracao_adicional','validacao','tecnico','renumeracao_por_servico',
            'renumeracao_desconto','renumeracao_bonus','pagamento','operador','notificacao','movel_intervencao','movel_instalacao','movel','imovel_intervencao',
            'imovel_instalacao','imovel','imagem','gestao_de_acesso','funcionarios_contactos','funcao','despesas_outro','despesas_deslocacao','despesas_comunicacao',
            'despesas_alimentacao','consumiveis_de_servicos','cobranca','clientes','agendamento'));
    }

    /*
float
$num
The number being formatted.
 
int
$decimals
Sets the number of decimal digits. If 0, the decimal_separator is omitted from the return value.
 
string | null
$decimal_separator
Sets the separator for the decimal point.
 
string | null
$thousands_separator
Sets the thousands separator.
    /*********************TODAS AS TABELAS DA BASE DE DADOS CACHV3****************/
    
    public function kwanza($num){
        
        $decimals = 2;
        $decimal_separator = '.';
        $thousands_separator = ' ';
        if(is_float($num) || is_numeric($num)){
            return number_format($num, $decimals, $decimal_separator, $thousands_separator).' kz'; 
        }else{
            return $num;
        }
    }


    /******************** ADICIONAR DATAS *********************/
    
    public function adicionarDatas($ad_Dias,$ad_Mes,$dataInicial){
    
        $res = false;
        $dataInicial = empty($dataInicial) ? date("Y-m-d") : $dataInicial;
        $dat = explode('-', explode(' ',$dataInicial)[0]);
        if($ad_Dias){

            $ad_Dias += $dat[2];
            if($ad_Dias > 30){
                $ad_Dias -= 30;
                $dat[1] ++;             
            }else if($ad_Dias < 1){
                $ad_Dias = -1 * ($ad_Dias);
                if($ad_Dias == 0) $ad_Dias = 30;
                $dat[1] --; 
            }

            if($dat[1] == 0){
                $ad_Dias = $ad_Dias > 9 ? $ad_Dias : '0'.(int)$ad_Dias;                
                $res = ($dat[0]-1)."-12-".$ad_Dias;
            }else if($dat[1] == 12){
                $ad_Dias = $ad_Dias > 9 ? $ad_Dias : '0'.(int)$ad_Dias;                
                $res = ($dat[0]+1)."-01-".$ad_Dias;
            }else{
                $dat[1] = $dat[1] > 9 ? $dat[1] : '0'.(int)$dat[1];                
                $ad_Dias = $ad_Dias > 9 ? $ad_Dias : '0'.(int)$ad_Dias;
                $res = $dat[0]."-".$dat[1]."-".$ad_Dias;
            } 

        }else if($ad_Mes){

            $ad_Mes += $dat[1];
            if($ad_Mes > 12){
                $ad_Mes -= 12;
                $dat[0] ++;             
            }
            if($ad_Mes == 12){
                $dat[2] = $dat[2] > 9 ? $dat[2] : '0'.(int)$dat[2];
                $res = ($dat[0]+1)."-01-".$dat[2];            
            }else{
                $dat[2] = $dat[2] > 9 ? $dat[2] : '0'.(int)$dat[2];
                $ad_Mes = $ad_Mes > 9 ? $ad_Mes : '0'.(int)$ad_Mes;   
                $res = $dat[0]."-".$ad_Mes."-".$dat[2];
            }        
        }
        return $res;
    }


    
	
    /*
     * NOTIFICAÇÕES
     */
    
    public function enviarNotificacao($dados){

        //echo var_dump($dados);
        
        $gravou = false;

        if(empty($dados['data_final'])){
            $m = date("m");
            if($m == 12){
                $dados['data_final'] = (date("Y")+1)."-01-".date("d");
            }else{
                $dados['data_final'] = date("Y")."-".(date("m")+1)."-".date("d");
            }    
        }


        $arrNew = array(
            'operador' => empty($dados['operador']) ? false : $dados['operador'],
            'id_do_cliente' => empty($dados['id_do_cliente']) ? false : $dados['id_do_cliente'],	
            'id_do_servico'	=> empty($dados['id_do_servico']) ? false : $dados['id_do_servico'],
            'id_do_movel' => empty($dados['id_do_movel']) ? false : $dados['id_do_movel'],
            'id_do_imovel' => empty($dados['id_do_imovel']) ? false : $dados['id_do_imovel'],
            'id_de_origem' => empty($dados['id_de_origem']) ? false : $dados['id_de_origem'],
            'nome_de_origem' => empty($dados['operador']) ? false : $dados['operador'],
            'data_inicial' => empty($dados['data_inicial']) ? date("Y-m-d") : $dados['data_inicial'],
            'data_final' => empty($dados['data_final']) ? ((date("Y")+1).'-'.date("m").'-'.date("d")) : $dados['data_final'],
            'data_de_envio' => empty($dados['data_de_envio']) ? false : $dados['data_de_envio'],
            'notificacao' => empty($dados['notificacao']) ? false : $dados['notificacao'],        
        );

        $i = 0;

        if(!empty($dados['departamento'])){

            while (!empty($dados['departamento'][$i])){

                $Checar = new Read ;
                $Checar->ExeRead('funcao', "WHERE funcao = :blo ",
                        "blo={$dados['departamento'][$i]}", $dados['bd']);            
                if( $Checar->getResult() ){ 
                    foreach( $Checar->getResult() as $fun ){

                        $departamento = (empty($fun['funcao'])? false : $fun['funcao']);
                        $nome_de_distino = (empty($fun['nome_do_funcionario'])? false : $fun['nome_do_funcionario']);

                         $arrNew['nome_de_distino'] = $nome_de_distino;
                         $arrNew['departamento'] = $departamento;

                        $reg = $this->getPrimeiroRegisto($dados['tabela'], array('nome_de_distino', 'nome_de_origem', 'data_inicial', 'data_final', 'notificacao'), 
                                array($arrNew['nome_de_distino'], $arrNew['nome_de_origem'], $arrNew['data_inicial'], $arrNew['data_final'], $arrNew['notificacao']),$dados['bd'] );

                        if(!$reg){
                            if($this->GravarNaBd_ComVerificacaoDeColunas($dados['tabela'],$arrNew,$dados['bd'])){

                                $this->RegistarOperacao(
                                    $dados['operador'], 
                                    false, 
                                    false,  
                                    'Foi Criada uma notificação aos '.date("Y-m-d H:i:s").' de '.(empty($dados['operador']) ? false : $dados['operador'] ).
                                        '<br>para '.$departamento.' <br>dizendo '.
                                        (empty($dados['notificacao']) ? false : $dados['notificacao']) );

                                $gravou = true;

                            }
                        }
                    }
                }
                $i++;
            }
        }


        $i = 0;
        if(!empty($dados['nome_de_distino'])){

            while (!empty($dados['nome_de_distino'][$i])){

                $arrNew['nome_de_distino'] = $dados['nome_de_distino'][$i];

                $reg = $this->getPrimeiroRegisto($dados['tabela'], array('nome_de_distino', 'nome_de_origem', 'data_inicial', 'data_final', 'notificacao'), 
                        array($arrNew['nome_de_distino'], $arrNew['nome_de_origem'], $arrNew['data_inicial'], $arrNew['data_final'], $arrNew['notificacao']),$dados['bd'] );

                if(!$reg){
                    if($this->GravarNaBd_ComVerificacaoDeColunas($dados['tabela'],$arrNew,$dados['bd'])){

                        $this->RegistarOperacao(
                            $dados['operador'], 
                            false, 
                            false,  
                            'Foi Criada uma notificação aos '.date("Y-m-d H:i:s").' de '.(empty($dados['operador']) ? false : $dados['operador'] ).
                                '<br>para '.$dados['nome_de_distino'][$i].' <br>dizendo '.
                                (empty($dados['notificacao']) ? false : $dados['notificacao']) );


                        $gravou = true;

                    }
                }                    

                $i++;
            }
        }



        if($gravou){
             return true;
        }else{
            return false;        
        }

    }

	
    /****************************************************************************/
    
    
	public function getItensDoStock($dados,$tabela, $arrColunasIlegiveis, $titulo, $bd){

		$k = 0;
		$id = empty($dados['id'])?FALSE:$dados['id'];
		$bd = empty($bd)?FALSE:$bd;

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;
		$thead = '';

		if(empty($titulo))	{
			$tboby = "<tbody>";
		}else{
			$thead = '<thead><tr><th colspan="2" > '.$titulo.' </th></tr></thead>';
			$tboby = "<tbody>";
		}

		while(!empty($index[$k])){

			$nome = $index[$k];	
			$valor = empty( $dados[$nome] ) ? false :  $dados[$nome] ;
			$c = 0;

			if(!empty($valor)){

				while(!empty($arrColunasIlegiveis[$c])){
					$col = $arrColunasIlegiveis[$c];
					if( $nome == $col ){
						$colunaIlegivel = true;
						break;
					}
					$c++;
				}

				if($nome == 'id_do_movimento' && $valor ){
					$mov = $this->getPrimeiroRegisto('movimento',array('id'),array($valor),$bd);
					if($mov){
						if(!empty($mov['tabela_de_distino']) && !empty($mov['id_de_distino'])){
							if( $mov['tabela_de_distino'] != $tabela ){
								$tboby .= '<tr><td class="tdNome">Distino</td>
									<td class="tdValor"> 
										<button onClick="fastViewInStock(\''.$mov['tabela_de_distino'].'\',\''.$mov['id_de_distino'].'\')"> 
											'.$mov['tabela_de_distino'].' 
										</button> 
									</td></tr>';
							}

						}

						if(!empty($mov['tabela_de_origem']) && !empty($mov['id_de_origem'])){
							if( $mov['tabela_de_origem'] != $tabela ){
								$tboby .= '<tr><td class="tdNome">Orígem</td>
									<td class="tdValor"> 
										<button onClick="fastViewInStock(\''.$mov['tabela_de_origem'].'\',\''.$mov['id_de_origem'].'\')"> 
											'.$mov['tabela_de_origem'].' 
										</button> 
									</td></tr>';
							}
						}
					}
				}


				if(!$colunaIlegivel){

					if( (strpos($nome, 'data') !== false) ){ $valor = $this->fncFormatarData($valor,false); }

					$tboby .= '<tr><td class="tdNome">'.$this->cleanCol($nome).'</td><td class="tdValor"><div>'.$valor.'</div></td></tr>';

				}else{	$colunaIlegivel = false;	}
			}
			$k ++;
		}

		return($thead.$tboby."</tbody>");

}

	
	
	

	public function getLinhaDaBd_ComDuasColuna($dados,$tabela, $arrColunasIlegiveis, $titulo, $bd){

		$k = 0;
		$id = empty($dados['id'])?FALSE:$dados['id'];
		$bd = empty($bd)?FALSE:$bd;

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;
		$thead = '';
		
		if(empty($titulo))	{
			$tboby = "<tbody>";
		}else{
			$thead = '<thead><tr><th colspan="2" > '.$titulo.' </th></tr></thead>';
			$tboby = "<tbody>";
		}

		while(!empty($index[$k])){

			$nome = $index[$k];	
			$valor = empty( $dados[$nome] ) ? "---" :  $dados[$nome] ;
			$c = 0;

			while(!empty($arrColunasIlegiveis[$c])){
				$col = $arrColunasIlegiveis[$c];
				if( $nome == $col ){
					$colunaIlegivel = true;
					break;
				}
				$c++;
			}

			if(!$colunaIlegivel){
					
				$onChange =  ' onChange=\'alterar("'.$id.'", "'.$tabela.'", "3", this, "'.$bd.'") \' ';
				$input = '<input  style="display: none;" '.$this->setInputType($nome).' name="'.$nome.'" '.$onChange.' placeholder="'.$nome.'" value="'.($valor == "---"?"":$valor).'" >';
				
				if( (strpos($nome, 'data') !== false) ){ $valor = $this->fncFormatarData($valor,false); }

				$tboby .= '<tr><td class="tdNome">'.$this->cleanCol($nome).'</td><td class="tdValor"><div onDblClick="alterarValor(this)">'.$valor.'</div>'.$input.'</td></tr>';
				
			}else{	$colunaIlegivel = false;	}
			$k ++;
		}
		return($thead.$tboby."</tbody>");
		
	}
		
	
	
	
	
	
	
	
	
	public function getTr_FormularioDeUmaColuna(  $dados, $tabela, $arrColunasIlegiveis, $bd, $titulo,$select ){
	// retorna as tr de uma tabela em uma coluna
		
		$k = 0;
		$valor = false;
		$bd = empty($bd)?FALSE:$bd;

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;
		$thead = '';
		
		if(empty($titulo))	{
			$tboby = "<tbody>";
		}else{
			$thead = '<thead><tr><th colspan="2" > '.$titulo.' </th></tr></thead>';
			$tboby = "<tbody>";
		}
		
		if(!empty($dados)){ 
			$id = empty($dados['id'])?FALSE:$dados['id'];
			$tboby .= '<input type="hidden" name="id" value="'.$id.'" >';
		}

		while(!empty($index[$k])){

			$nome = $index[$k];	
			if(!empty($dados)){  $valor = empty( $dados[$nome] ) ? false :  $dados[$nome] ;  }			
			$c = 0;

			while(!empty($arrColunasIlegiveis[$c])){
				$col = $arrColunasIlegiveis[$c];
				if( $nome == $col ){
					$colunaIlegivel = true;
					break;
				}
				$c++;
			}

			if(!$colunaIlegivel){
				
				$opt = false;
				if(!empty($select)){
                                    $c = 0;
                                    while(!empty($select[$c])){
                                        $selNome = $select[$c]['nome'];
                                        if( $nome == $selNome ){

                                            $s = 0;
                                            $selVal = $select[$c]['valor'];
                                            $opt = "<option>".($valor?$valor:'')."</option>" ;
                                            while(!empty($selVal[$s])){
                                                $optionValue = isset($selVal[$s]['valor']) ? (' value="'.$selVal[$s]['valor'].'" ') : "" ;
                                                $opt .= "<option {$optionValue}>{$selVal[$s]['nome']}</option>" ;
                                                $s ++;
                                            }

                                            if(!empty($select[$c]['outro'])){
                                                $opt .= "<option value='OUTRO'>Outro(a)</option>" ;
                                            }

                                            break;
                                        }
                                        $c++;
                                    }
				}
				
					
				//$onChange =  ' onChange=\'alterar("'.$id.'", "'.$tabela.'", "5", this, '.$bd.') \' ';
				if($opt){
					$input = '<select onChange="selectOutro(this)" name="'.$nome.'" >'.$opt.'</select>';
				}else{
					$input = '<input '.$this->setInputType($nome).' name="'.$nome.'" placeholder="'.$this->cleanCol($nome).'" value="'.($valor?$valor:"").'" >';
				}
				
				//if( (strpos($nome, 'data') !== false) ){ $valor = $this->fncFormatarData($valor,false); }

				$tboby .= '<tr><td class="tdNome">'.$this->cleanCol($nome).'</td><td class="tdValor">'.$input.'</td></tr>';
				
			}else{	$colunaIlegivel = false;	}
			$k ++;
		}
		return($thead.$tboby."</tbody>");
		
	
		
	}


	
	
	
	

	
	 public function getTrDaBd($dados,$tabela, $arrColunasIlegiveis, $cabecalho, $bd){

		$k = 0;
		$id = empty($dados['id'])?FALSE:$dados['id'];
		$bd = empty($bd)?FALSE:$bd;
		$td = '';
		$cab = '';

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;

		while(!empty($index[$k])){

			$nome = $index[$k];	
			$valor = empty( $dados[$nome] ) ? FALSE :  $dados[$nome] ;
			$onChange =  ' onChange=\'alterar("'.$id.'", "'.$tabela.'", "5", this, '.null.') \' ';
			$c = 0;

			while(!empty($arrColunasIlegiveis[$c])){
				$col = $arrColunasIlegiveis[$c];
				if( $nome == $col ){
					$colunaIlegivel = true;
					break;
				}
				$c++;
			}

			if($colunaIlegivel === false){

				if($cabecalho){	$cab .= '<td>'.$nome.'</td>';	}
				$td .= '<td>'.$valor.'</td>';

			}
		}
		if($cabecalho){	$td = $cab; }
		return($td);

	}






	public function getTrDaBd_Alteraveis($dados,$tabela, $arrColunasIlegiveis, $arrColunasInalteraveis,$cabecalho, $bd){

		$k = 0;
		$id = empty($dados['id'])?FALSE:$dados['id'];
		$bd = empty($bd)?FALSE:$bd;
		$td = '';
		$cab = '';

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;
		$colunaInalteravel = false;

		while(!empty($index[$k])){

			$nome = $index[$k];	
			$valor = empty( $dados[$nome] ) ? FALSE :  $dados[$nome] ;
			$onChange =  ' onChange=\'alterar("'.$id.'", "'.$tabela.'", "5", this, '.null.') \' ';
			$c = 0;

			while(!empty($arrColunasIlegiveis[$c])){
				$col = $arrColunasIlegiveis[$c];
				if( $nome == $col ){
					$colunaIlegivel = true;
					break;
				}
				$c++;
			}

			$c = 0;
			while(!empty($arrColunasInalteraveis[$c])){
				$col = $arrColunasInalteraveis[$c];
				if( $nome == $col ){
					$colunaInalteravel = true;
					break;
				}
				$c++;
			}

			if($colunaIlegivel === false){

				if($cabecalho){	$cab .= '<td>'.$nome.'</td>';	}
				if($colunaInalteravel){
					$td .= '<td><input placeholder="'.$nome.'" value="'.$valor.'" ></td>';
				}else{
					$td .= '<td><input '.setInputType($nome).' name="'.$nome.'" '.$onChange.' placeholder="'.$nome.'" value="'.$valor.'" ></td>';		
				}

			}
		}
		if($cabecalho){	$td = $cab; }
		return($td);

	}





	public function getTr_FormularioHorizontal( $tabela, $arrColunasIlegiveis, $bd ){
	// retorna as tds de uma tabela	
		$td = "";

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;
		$bd = empty($bd)?FALSE:$bd;

		while(!empty($index[$k])){

			$nome = $index[$k];		
			$c = 0;

			while(!empty($arrColunasIlegiveis[$c])){
				$col = $arrColunasIlegiveis[$c];
				if( $nome == $col ){
					$colunaIlegivel = true;
					break;
				}
				$c++;
			}

			if($colunaIlegivel === false){
				$td .= '<td><input '.setInputType($nome).' name="'.$nome.'"  placeholder="'.cleanCol($nome).'" ></td>';
			}

			$k++;
		}


		$td .= '<td align="center"><div id="erroDoFormulario"></div> <button type="submit" > Enviar </button></td>';
		return($td);

	}


	
	
	
	
	public function limparAssentos_e_EspacosNaString($string) {
        $Format = array();
        $Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $Data = strtr(utf8_decode($string), utf8_decode($Format['a']), $Format['b']);
        $Data = strip_tags(trim($Data));
        $Data = str_replace(' ', '-', $Data);
        $Data = str_replace(array('-----', '----', '---', '--'), '-', $Data);

        return strtolower(utf8_encode($Data));
    }







	public function getTr_FormularioDeDuasColunas( $tabela, $arrColunasIlegiveis, $bd, $titulo ){
	// retorna as tr de uma tabela de duas colunas	
		if(empty($titulo))	{
			$tr = "";
		}else{
			$tr = '<tr><th align="center" colspan="2"> '.$titulo.' </th></tr>';
		}

		$index = $this->index_($tabela,$bd);
		$k = 0;
		$colunaIlegivel = false;

		while(!empty($index[$k])){

			$nome = $index[$k];		
			$c = 0;

			while(!empty($arrColunasIlegiveis[$c])){
				$col = $arrColunasIlegiveis[$c];
				if( $nome == $col ){
					$colunaIlegivel = true;
					break;
				}
				$c++;
			}

			if($colunaIlegivel == false){
				$tr .= '<tr><td> '.cleanCol($nome).'</td><td><input '.setInputType($nome).' name="'.$nome.'"  placeholder="'.cleanCol($nome).'" ></td></tr>';			
			}
			$colunaIlegivel = false;

			$k++;
		}


		$tr .= '<tr><td colspan="2" align="center"><div id="erroDoFormulario"></div> <button type="submit" > Enviar </button></td></tr>';
		return($tr);

	}




	public function getPrimeiroRegisto($tabela,$arrColuna,$arrValores,$bd){
		// Esta função retorna o primeiro registo encontrado
		if( !empty($arrColuna) || !empty($arrValores) || !empty($tabela) ){
			$i = 0;
			$query = "WHERE ";
			$valores = "";
			while( isset($arrColuna[$i]) && isset($arrValores[$i]) ){
				$index = "val".$i;

				if($valores == ""){
					$valores .= $index. "=" .$arrValores[$i];
					$query .= " ".$arrColuna[$i]." = :".$index;
				}else{
					$valores .= "&" .$index. "=" .$arrValores[$i]; 
					$query .= " AND ".$arrColuna[$i]." = :".$index;
				}
				$i++;
			}

			$Checar = new Read ;
			$Checar->ExeRead($tabela, $query, $valores, $bd);
			if( $Checar->getResult() ){ 
				foreach( $Checar->getResult() as $result ){ break; }
				return($result);
			}else {  return(false);  }
		}else{  return(false);}
	}


	
	public function getUltimoRegisto($tabela,$arrColuna,$arrValores,$bd){
		// Esta função retorna o primeiro registo encontrado
		if( !empty($arrColuna) || !empty($arrValores) || !empty($tabela) ){
			$i = 0;
			$query = "WHERE ";
			$valores = "";
			while( isset($arrColuna[$i]) && isset($arrValores[$i]) ){
				$index = "val".$i;

				if($valores == ""){
					$valores .= $index. "=" .$arrValores[$i];
					$query .= " ".$arrColuna[$i]." = :".$index;
				}else{
					$valores .= "&" .$index. "=" .$arrValores[$i]; 
					$query .= " AND ".$arrColuna[$i]." = :".$index;
				}
				$i++;
			}
			
			$query .= " ORDER BY id DESC ";

			$Checar = new Read ;
			$Checar->ExeRead($tabela, $query, $valores, $bd);
			if( $Checar->getResult() ){ 
				foreach( $Checar->getResult() as $result ){ break; }
				return($result);
			}else {  return(false);  }
		}else{  return(false);}
	}


	
	
	public function AtualizarNaBd_ComVerificacaoDeColunas($tabela,$arr,$idPrincipal,$bd){
		$Actualizar = new UpDate ;
		if(!empty($idPrincipal)){
			$index = $this->index_($tabela,$bd);
			$k = 0;
			$checkColunaDtaDeAlteracao = FALSE;
			$newArr = array();
			while(!empty($index[$k])){
				$nome = $index[$k];
				if( !( $nome == 'id' || $nome == 'data_de_alteracao' ) ){
					if(isset($arr[$nome])){ $newArr[$nome] = $arr[$nome];}
				}
				if($nome == 'data_de_alteracao') $checkColunaDtaDeAlteracao = TRUE;
				$k++;
			}

			$newArr['data_de_alteracao'] = date("Y-m-d H:i:s"); 

			$Actualizar->ExeUpDate($tabela,$newArr, "WHERE id = :mat ","mat={$idPrincipal}" );
		}
		
		if(empty($Actualizar->getResult())){
			return(false);
		}else{
			return(true);
		}

	}

	
	


	public function GravarNaBd_ComVerificacaoDeColunas($tabela,$arr,$bd){
		
		$goOn = true;
		$Cadastrar = new Create ;
		$index = $this->index_($tabela,$bd);
		
		//Criar o primeiro registo
		
		
		if($goOn){
		
			$k = 0;
			$checkColunaDtaDeAlteracao = FALSE;
			$newArr = array();
			while(!empty($index[$k])){
				$nome = $index[$k];
				if( !( $nome == 'id' || $nome == 'data_de_alteracao' ) ){
					if(!empty($arr[$nome])){ $newArr[$nome] = $arr[$nome];}
				}
				if($nome == 'data_de_alteracao') $checkColunaDtaDeAlteracao = TRUE;
				$k++;
			}

			if( $checkColunaDtaDeAlteracao ){ $newArr['data_de_alteracao'] = date("Y-m-d H:i:s"); }

			$Cadastrar->ExeCreate( $tabela,$newArr, $bd );
			if(empty($Cadastrar->getResult())){

				$Cadastrar->ExeCreate( $tabela,$newArr, $bd );
			}
			return($Cadastrar->getResult());
		}else{
			return(false);
		}
	}



	public function GravarNaBd_SemVerificacaoDeColunas($tabela,$arr,$bd){
		$arr['data_de_alteracao'] = date("Y-m-d H:i:s"); 	
		$Cadastrar = new Create ;
		$Cadastrar->ExeCreate( $tabela,$newArr, $bd );
		return($Cadastrar->getResult());	
	}



	public function index_($tabela,$bd){
		if(empty($bd)) $bd = false;
		$Checar = new Read ;
		$Checar->FullRead('SELECT * FROM `'.$tabela.'`',$bd);
		if( $Checar->getResult() ){ 
			foreach( $Checar->getResult() as $arrCabecalho ){ break; }
			return(array_keys($arrCabecalho));
		}else {
			
			$Cadastrar = new Create ;
			$Cadastrar->ExeCreate( $tabela,array('data_de_alteracao'=>date("Y-m-d")), $bd );
			if(empty($Cadastrar->getResult())){
				return(false);
			}else{ 
				$Checar->FullRead('SELECT * FROM `'.$tabela.'`',$bd);
				if( $Checar->getResult() ){ 
					foreach( $Checar->getResult() as $arrCabecalho ){ break; }
					return(array_keys($arrCabecalho));
				}else { return(false); }
			}
		}
	}

	

	public function fncFormatarData($data,$separador){
		// Data no formato sql
		// Separador final de ano mes e dia
		$sep = empty($separador)?'-':$separador;
		$repartir = explode(' ',$data);
		if( empty($repartir[0]) ){
			return(FALSE);
		}else if($repartir[0]> '1900-01-01'){
			$expData = explode('-',$repartir[0]);
			$novaData = 
				(empty($expData[2]) ? '00'.$sep : $expData[2].$sep ). 
				(empty($expData[1]) ? '00'.$sep : $expData[1].$sep ).
				(empty($expData[0]) ? '00'.$sep : $expData[0] ).
				(empty($repartir[1]) ? '' : ( $repartir[1] > '00:00:00' ? ('<span style="padding-left:10px;" >'.$repartir[1].'</span>') : '' ) );
			return($novaData);
		}else{return(FALSE);}
	}

	
	
	public function setInputType($nome){
		if($nome == 'telefone' ||$nome == 'whatsapp' || $nome == 'telefone_2' || $nome == 'estado' || $nome == "quantidade" || $nome == "qtd" || $nome == 'valor' || $nome == 'descontos' || $nome == 'valor_a_pagar' || $nome == 'valor_pago' || $nome == 'valor_unitario'  ){
			return(" type='number' ");

		}else if($nome == 'senha' ||$nome == 'pass'||$nome == 'password' ){
			return(" type='password' ");

		}else if($nome == 'email' ||$nome == 'mail' ){
			return(" type='email' ");

		}else if( (strpos($nome, 'data') !== false)  ){
			return(" type='date' ");

		}else if( (strpos($nome, 'imagem') !== false)  ){
			return(" id='idFile' type='file' ");

		}else if( (strpos($nome, 'foto') !== false)  ){
			return(" id='idFile' type='file' ");
                        
                }else if( $nome == 'carencia'){
                        return(" type='date' ");
                        
                }else if( (strpos($nome, 'telefone') !== false)  ){
			return(" type='number' ");

                        
		}else{
			return(" type='text' ");
		}

	}						

	
	
	public function getVariaveisDaUrl($url){
		
		$expl = explode("?",$url);
		if(empty($expl[1])){
			return(array('status'=> false,'erro'=>'url inexistente'));
			exit();
		}
		
		$arr = explode("&", $expl[1]);	
		if(empty($arr[1])){
			return(array('status'=> false,'erro'=>'url ilegal'));
			exit();
		}
		
		$i = 0;
		$user = array();

		while(!empty($arr[$i])){
			$var = explode("=", $arr[$i]);
			if(!empty($var[0])){ $user[$var[0]] = (empty($var[1]) ? false : $var[1]); }		
			$i++;
		}
		return($user);
	}
	
	
	
	public function checkIdDoUsuarioNaUrl($url){
		if(empty($url)){
			return(array('status'=> false,'erro'=>'url inexistente'));
			exit();
		}
		
		$user = $this->getVariaveisDaUrl($url);
		
		
		if( empty($user['di']) || empty($user['op']) ){
			return(array('status'=> false,'erro'=>'Id inexistente'));
			exit();
		}
	

		if( $user['di'] == 'undefined' || $user['op'] == 'undefined' ){
			return(array(
				'erro' => ' Id invalido ', 
				'status' => FALSE )); 
			exit();
		}else{
			

			$id =  $this->getIdPricipal($user['di']);
			$tabela = 'funcionarios';
			$arrColuna = array( 'id','nome');
			$arrValores = array( $id,$user['op'] );
			$bd = 'netcoaos_cachv3';

			$Fun = $this->getPrimeiroRegisto($tabela,$arrColuna,$arrValores,$bd);

			if($Fun){

				$estado = ( empty($Fun['estado']) ? FALSE : ($Fun['estado']) );

				if($estado){

					$operador = ( empty($Fun['nome']) ? FALSE : ($Fun['nome']) );
					$telefone = ( empty($Fun['telefone']) ? FALSE : ($Fun['telefone']) );
					$telefone_2 = ( empty($Fun['telefone_2']) ? FALSE : ($Fun['telefone_2']) );
					$email = ( empty($Fun['email']) ? FALSE : ($Fun['email']) );
					$funcao = ( empty($Fun['funcao']) ? FALSE : ($Fun['funcao']) );
					$categoria = ( empty($Fun['$categoria']) ? FALSE : ($Fun['$categoria']) );
					$imagem = ( empty($Fun['imagem']) ? FALSE : ($Fun['imagem']) );
					$id = ( empty($Fun['id']) ? FALSE : ($Fun['id']) );

					return( array_filter( array(

						'estado' => $estado , 
						'email' => $email , 
						'telefone' => $telefone , 
						'telefone_2' => $telefone_2 , 
						'funcao' => $funcao , 
						'categoria' => $categoria , 
						'operador' => $operador ,
						'imagem' => $imagem ,
						'idPrincipal' => $id ,
						'id_do_cliente' => (empty($user['id_do_cliente']) ? false : $user['id_do_cliente']),
						'numero_da_guia' => (empty($user['numero_da_guia']) ? false : $user['numero_da_guia']),
						'id' => $this->setIdPricipal($id), 
						'status'=>TRUE ) ) ); 

					exit();

				}else{

					return(array(
						'erro' => ' Voçê não esta autorizado ', 
						'status'=>FALSE )); 
					exit();

				}

			}else{

				return(array(
					'erro' => ' Usuario inexistente ', 
					'status'=>FALSE )); 
				exit();

			}	
		}
	}
	
	
	public function RegistarOperacao($operador, $id_do_cliente, $id_do_servico, $operacao){
		
		$arrColuna = array( 'nome');
		$arrValores = array( $operador );
		$bd = 'netcoaos_cachv3';
		
		if(!empty($id_do_servico)){
			$serv = $this->getPrimeiroRegisto( 'servicos', array('id'), array($id_do_servico), $bd );
			$id_do_movel = empty( $serv['id_do_movel']) ? false : $serv['id_do_movel'] ;
			$id_do_imovel = empty( $serv['id_do_imovel']) ? false : $serv['id_do_imovel'] ;
		}
		   
		$Fun = $this->getPrimeiroRegisto('funcionarios',$arrColuna,$arrValores,$bd);
		$id_do_funcionario = ( empty($Fun['id']) ? FALSE : ($Fun['id']) );
		
		$op = array(
			'id_do_funcionario'=> empty($id_do_funcionario) ? false : $id_do_funcionario , 
			'operador'=> empty($operador) ? false : $operador , 
			'id_do_cliente'=> empty($id_do_cliente) ? false : $id_do_cliente , 
			'id_do_servico'=> empty($id_do_servico) ? false : $id_do_servico , 
			'id_do_movel'=> empty($id_do_movel) ? false : $id_do_movel , 
			'id_do_imovel'=> empty($id_do_imovel) ? false : $id_do_imovel , 
			'operacao'=> empty($operacao) ? false : $operacao , 
		);
		
		return($this->GravarNaBd_ComVerificacaoDeColunas('operador',$op,$bd));
	}
		
	
	
	
	public function RegistarOperacaoNoStock($operador,$id_do_Operador, $id_do_movimento, $id_do_guia, $operacao){
		
		$arrColuna = array('nome');
		$arrValores = array( $operador );
		$bd = 'netcoaos_stockv3';
		   
		$op = array(
			'id_do_Operador'=> empty($id_do_Operador) ? false : $id_do_Operador , 
			'operador'=> empty($operador) ? false : $operador , 
			'id_do_movimento'=> empty($id_do_movimento) ? false : $id_do_movimento , 
			'id_do_guia'=> empty($id_do_guia) ? false : $id_do_guia , 
			'operacao'=> empty($operacao) ? false : $operacao , 
		);
		
		return($this->GravarNaBd_ComVerificacaoDeColunas('operador',$op,$bd));
	}
	
	
	
	//set id na url
	public function setIdPricipal( $id){
		if($id > 99){
			$id = "".$id;
		}else if($id > 9){
			$id = "0".$id;
		}else{
			$id = "00".$id;
		}

		$e = '3';
		for($i = 0 ; $i < 34 ; $i ++){			
			if($i == 6)  { $e = $e .( empty($id[0]) ? "0" : $id[0]); }		
			if($i == 11) { $e = $e . (empty($id[2]) ? "0" : $id[2]); }			
			if($i == 23) { $e = $e . (empty($id[1]) ? "0" : $id[1]); }
			else{ $e = $e.''. rand(0,9); }
		}
		return $e;	
	}
	
	
	//get id da url
	public function getIdPricipal($id){
		if(isset($id[25])){
			$id = $id." ";
			return ( $id[7] ).($id[26]).($id[13]);
		}else{
			return(false);
		}
			
	}

	

	public function cleanCol($nome){
		return str_replace('_',' ',$nome);
	}




}
?>
