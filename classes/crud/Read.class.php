<?php
//include 'Conn.class.php';
/*
Classe reponsavel pela Leitura
*/

class Read extends Conn {
/*Dados Relativos a criacao do Cadastro*/

	// Outra Base de dados
	private $newBD;
    //Armazena as Querys
	private $Select;
	
	//Guarda os BindValues
	//Recebe as Parce_str
	private $Places;
	//Armazena os resultados das Buscas
	private $Result;
	
/*PDO Statment(prepare)*/
    private $Read;
/*Armazena a conexao com a classe mae (Ligacao PDO)*/
     private $Conn;
	 
	 // PASSO 1
	 //Metodo facilitador
	 //Insercao do nome da tabela($Tabela)
	 //$Termos ->sao as condicoes de leitura(WHERE...)
	 //$ParceString ->Recebe os dados da busca por forma de link (indice=Valor&...)
	 public function ExeRead($Tabela, $Termos = null, $ParseString = null, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		 if(!empty($ParseString)):
		 
	     //funcao parce_str-> Insere os dados na $Places
		 parse_str( $ParseString, $this->Places);
		 endif;
		 $this->Select = " SELECT * FROM {$Tabela} {$Termos}";
		 $this->Execute();
	 }
	 //Retora se houve sussesso
	 public function getResult(){
		 return($this->Result);
	 }
	 //Retornar o numero de linhas
	 public function getRowCount(){
		 return($this->Read->rowCount());
	 }
	 //************************************************************************//
	 //Inserir Querys manuais
	 public function FullRead( $Query, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		 (string)$this->Select = "{$Query}";
		 
		 $this->Execute();
	 }
	
	 public function setPlaces($ParseString){
		    parse_str($ParseString,$this->Places);
			$this->Execute(); 
	 }
	 
	 /****************************************
	  ************ PRIVATE METHODS ***********
	  ****************************************/
	 
	 
	 //PASSO 2
	 //Funcao que trata de preparar a query para ser executada
	 private function Connect(){
		 $this->Conn = parent::getConn($this->newBD);
		 //Envia a query para o banco
		 $this->Read = $this->Conn->prepare($this->Select);
		 //Receba a resposta do banco tipo array bidirecional
		 $this->Read->setFetchMode(PDO::FETCH_ASSOC);
	 }
	 
	 //PASSO 3
	 //Prepara a bandValue automatica apartir da $this->Places
	 private function getSyntax(){
		 //$this->Places = parse_str
		 if($this->Places):
		 //Cada indice deve formar um bind com este foreach
		    foreach($this->Places as $Viculos => $Valor ):
			   /*Separa os indices dos valores que serao inseridos 
			   como bandvalue auto maticamente porque quando o indice 
			   e identico ao (:valor) a substituicao e automatica sem 
			   necessidade de introdizir o famoso bindValue
			   - Monta os limites e offsets como int 
			   (pois nao podem ser tratados como strings)
			   - Numero de linhas que serao apresentados*/
		       if($Viculos == 'limit' || $Viculos == 'offset'):
		          $Valor = (int)$Valor;
		       endif;
			   //Formando a bindValue
		       $this->Read->bindValue(":{$Viculos}",$Valor,(is_int($Valor)? PDO::PARAM_INT : PDO::PARAM_STR));
		    endforeach;
		 endif;
	 }
	 
	 //PASSO 4
	 //coordena a execucao os metodos de leitura passo passo
	 private function Execute(){
		 //conexao com o banco
		 $this->Connect();
		 try{
			 //preparando Statement
			 $this->getSyntax();
			 //Executando o statment
			 $this->Read->execute();
			 //Armazenando o valor resultado da busca
			 $this->Result = $this->Read->fetchAll();
		 }catch(PDOException $e){
			 //Mensagem de erro
			echo "<p align='left' font style='background-color:f0f'><b>Erro ao Ler os Dados ;</b> <br><i> {$e->getFile()} ; Na Linha numero {$e->getLine()};</i><br> {$e->getMessage()};<br> Erro Numero: {$e->getCode()}</p>"; 
		 }
	}
}
?>
