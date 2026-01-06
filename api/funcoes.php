<?php

	
function getTrDaBd($dados,$tabela, $arrColunasIlegiveis, $cabecalho, $bd){
	
	$k = 0;
	$id = empty($dados['id'])?FALSE:$dados['id'];
	$bd = empty($bd)?FALSE:$bd;
	$td = '';
	$cab = '';
	
	$index = index_($tabela,$bd);
	$k = 0;
	$colunaIlegivel = false;
	
	while(!empty($index[$k])){

		$nome = $index[$k];	
		$valor = empty( $dados[$index] ) ? FALSE :  $dados[$index] ;
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




	
	
function getTrDaBd_Alteraveis($dados,$tabela, $arrColunasIlegiveis, $arrColunasInalteraveis,$cabecalho, $bd){
	
	$k = 0;
	$id = empty($dados['id'])?FALSE:$dados['id'];
	$bd = empty($bd)?FALSE:$bd;
	$td = '';
	$cab = '';
	
	$index = index_($tabela,$bd);
	$k = 0;
	$colunaIlegivel = false;
	$colunaInalteravel = false;
	
	while(!empty($index[$k])){

		$nome = $index[$k];	
		$valor = empty( $dados[$index] ) ? FALSE :  $dados[$index] ;
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





function getTr_FormularioHorizontal( $tabela, $arrColunasIlegiveis, $bd ){
// retorna as tds de uma tabela	
	$td = "";

	$index = index_($tabela,$bd);
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






function getTr_FormularioDeUmaColuna( $tabela, $arrColunasIlegiveis, $bd, $titulo ){
// retorna as tr de uma tabela em uma coluna	
	if(empty($titulo))	{
		$tr = "";
	}else{
		$tr = '<tr><th > '.$titulo.' </th></tr>';
	}

	$index = index_($tabela,$bd);
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

		if($colunaIlegivel === false){
			$tr .= '<tr><td><input '.setInputType($nome).' name="'.$nome.'"  placeholder="'.cleanCol($nome).'" ></td></tr>';
		}
		$colunaIlegivel = false;

		$k++;
	}


	$tr .= '<tr><td align="center"><div id="erroDoFormulario"></div> <button type="submit" > Enviar </button></td></tr>';
	return($tr);
	
}





function getTr_FormularioDeDuasColunas( $tabela, $arrColunasIlegiveis, $bd, $titulo ){
// retorna as tr de uma tabela de duas colunas	
	if(empty($titulo))	{
		$tr = "";
	}else{
		$tr = '<tr><th align="center" colspan="2"> '.$titulo.' </th></tr>';
	}

	$index = index_($tabela,$bd);
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




function getPrimeiroRegisto($tabela,$arrColuna,$arrValores,$bd){
	// Esta função retorna o primeiro registo encontrado
	if( !empty($arrColuna) || !empty($arrValores) || !empty($tabela) ){
		$i = 0;
		$query = "WHERE ";
		$valores = "";
		while( !empty($arrColuna[$i]) && !empty($arrValores[$i]) ){
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
		//$Checar->ExeRead($tabela, "WHERE telefone = :blo ","blo={$usuario['telefone']}", $bd);
		$Checar->ExeRead($tabela, $query, $valores, $bd);
		if( $Checar->getResult() ){ 
			foreach( $Checar->getResult() as $result ){ break; }
			return($result);
		}else {  return(false);  }
	}else{  return(false);}
}




function GravarNaBd_ComVerificacaoDeColunas($tabela,$arr,$bd){
	$index = index_($tabela,$bd);
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
	
	$Cadastrar = new Create ;
	$Cadastrar->ExeCreate( $tabela,$newArr, $bd );
	return($Cadastrar->getResult());	
}



function GravarNaBd_SemVerificacaoDeColunas($tabela,$arr,$bd){
	$arr['data_de_alteracao'] = date("Y-m-d H:i:s"); 	
	$Cadastrar = new Create ;
	$Cadastrar->ExeCreate( $tabela,$newArr, $bd );
	return($Cadastrar->getResult());	
}



function index_($tabela,$bd){
	if(empty($bd)) $bd = false;
    $Checar = new Read ;
	$Checar->FullRead('SELECT * FROM `'.$tabela.'`',$bd);
    if( $Checar->getResult() ){ 
        foreach( $Checar->getResult() as $arrCabecalho ){ break; }
        return(array_keys($arrCabecalho));
    }else {  return(false);  }

}


function fncFormatarData($data,$separador){
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
			(empty($expData[0]) ? '00'.$sep : $expData[0].$sep ).
			(empty($repartir[1]) ? '' : ( $repartir[1] > '00:00:00' ? $repartir[1] : '' ) );
		return($novaData);
	}else{return(FALSE);}
}

function setInputType($nome){
	if($nome == 'telefone' ||$nome == 'whatsapp' || $nome == 'telefone_2' || $nome == 'estado' || $nome == "quantidade" || $nome == "qtd"  ){
		return(" type='number' ");
		
	}else if($nome == 'senha' ||$nome == 'pass'||$nome == 'password' ){
		return(" type='password' ");
	
	}else if($nome == 'email' ||$nome == 'mail' ){
		return(" type='email' ");
		
	}else if( (strpos($nome, 'data') !== false) ){
		return(" type='date' ");
		
	}else{
		return(" type='text' ");
	}
	
}						


function cleanCol($nome){
	return str_replace('_',' ',$nome);
}



?>