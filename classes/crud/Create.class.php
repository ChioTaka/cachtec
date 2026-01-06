<?php
/*
Classe reponsavel pelo cadastro
*/
class Create extends Conn {
/*Dados Relativos a criacao do Cadastro*/
	private $Tabela;
	private $Dados;
	private $Result;

// Outra Base de dados
	private $newBD;
	
/*PDO Statment(prepare)*/
    private $Create;
/*Dados Relativos a conexao com o Banco
atraves do PDO*/
     private $Conn;
	 
	 // PASSO 1
	 //Insercao do nome da tabela($Tabela)
	 //Inserir a Coluna e seu valor (coluna => Valor)
	 public function ExeCreate($Tabela, array $Dados, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		 $this->Dados = $Dados;
		 $this->Tabela = (string)$Tabela;
		 $this->getSyntax();
		 $this->Execute();
	 }
	 //Retora se houve sussesso
	 public function getResult(){
		 return($this->Result);
	 }
	 
	 /*
	 ****************************************
	 ************ PRIVATE METHODS ***********
	 ****************************************
	 */
	 
	 
	 //PASSO 3
	 //Funcao que trata de preparar a query para ser executada
	 private function Connect(){
		 $this->Conn = parent::getConn($this->newBD);
		 $this->Create = $this->Conn->prepare($this->Create);
		  
	 }
	 
	 //PASSO 2
	 //automatizar a query
	 private function getSyntax(){
		 $Fileds = implode(',',array_keys($this->Dados));
		 $Places = ':'.implode(',:',array_keys($this->Dados));
		 $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) values ({$Places})";
		 
	 }
	 
	 //PASSO 5
	 //executar o cadastro
	 private function Execute(){
		 $this->Connect();
		 try{
		 $this->Create->execute($this->Dados);
		 $this->Result = $this->Conn->lastInsertId();
		 if( empty ($this->Result) ) $this->Result = TRUE;
		 }catch(PDOException $e){
			 $this->Result = null;
			echo "<p align='left' font style='background-color:f0f'><b>Erro ao Inserir os Dados ;</b> <br><i> {$e->getFile()} ; Na Linha numero {$e->getLine()};</i><br> {$e->getMessage()};<br> Erro Numero: {$e->getCode()}</p>"; 
		 }
	 }
}
?>