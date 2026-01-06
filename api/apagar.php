<?php



require_once("../conn/DBConfiguracao.php");

// Alterar os dados das tabelas referentes a renumeração


$jSon =( filter_input( INPUT_POST , 'Cliente', FILTER_DEFAULT) ?  filter_input( INPUT_POST , 'Cliente', FILTER_DEFAULT)  : '' );
$usuario = json_decode($jSon,TRUE);
echo var_dump($usuario);

if( (!isset($usuario['id'])) || (!isset($usuario['valor'])) || empty($usuario['tabela']) || empty($usuario['coluna'])  ){
	echo json_encode(array(
		'erro' => ' ERRO, Dados Incompletos ', 
		'status'=>FALSE )); 
    exit();
}


if( $usuario['permissao']  < 4 ){ 
	echo json_encode(array(
		'erro' => ' Você não tem Permissão ', 
		'status'=>FALSE )); 
	exit();
}


$Checar = new Read ;
$Checar->ExeRead($usuario['tabela'], "WHERE id = :mat ","mat={$usuario['id']}", $usuario['bd']);
if( $Checar->getResult() ){
	foreach( $Checar->getResult() as $dadosAntigos ){ break; }
}else{
    echo json_encode(array(
        'erro' => ' Item Inexistente ', 
        'status'=>FALSE )); 
    exit();
}

$arrnovoDado = array(
    $usuario['coluna'] => $usuario['valor'],
    'operador' => empty( $usuario['operador'] ) ? FALSE : $usuario['operador'] , 
    'data_de_alteracao' =>  date('Y-m-d H:i:s')  
);


$Actualizar = new UpDate ;
$Actualizar->ExeUpDate($usuario['tabela'], $arrnovoDado, "WHERE id = :mat ","mat={$usuario['id']}", $usuario['bd']);

if( $Actualizar->getRowCount() > 0 ){
    $Actualizar = NULL ;	
    echo json_encode(array( 
        'status'=>TRUE ,
        'sucesso' => '<p align="center">'. $usuario['coluna'].' <br> Actualizada</p>' ));
    exit();
}else{ 

    echo json_encode( array( 
        'status'=>FALSE ,
        'erro' => ' Operação Cancelada, Repita !!! ' ) );
}







?>