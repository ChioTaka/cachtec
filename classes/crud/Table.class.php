<?php
/*
Classe reponsavel pelo cadastro
*/
class Create extends Conn {
/*Dados Relativos a criacao do Cadastro*/
	private $Tabela;
	private $Colunas;
	private $Result;

// Outra Base de Colunas
	private $newBD;
	
/*PDO Statment(prepare)*/
    private $Create;
/*Colunas Relativos a conexao com o Banco
atraves do PDO*/
     private $Conn;
	 
	 // PASSO 1
	 //Insercao do nome da tabela($Tabela)
	 //Inserir a Coluna e seu valor (coluna => Valor)
	 public function ExeTabela($Tabela, array $Colunas, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		 $this->Colunas = $Colunas;
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
		 //$this->Create = $this->Conn->prepare($this->Create);
		  
	 }
	 
	 //PASSO 2
	 //automatizar a query
	 private function getSyntax(){
		  $a = 0;
  		// sql to create table
  		$sql = "CREATE TABLE {$this->Tabela} ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
		 
		 while(!empty($this->Colunas[$a])){
			 if( strpos( $this->Colunas[$a] , " " ) === false ){
				$sql .= " {$this->Colunas[$a]} VARCHAR(250) NOT NULL,"; 
			 }else{
				$sql .= " {$this->Colunas[$a]}  ,"; 
			 }
			
			 $a ++;
		 }
		 
		 $sql .= "operador VARCHAR(250) NOT NULL,"; 
		 $sql .= "data_de_alteracao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )"; 

		 $this->Create = $sql;
		 
	 }
	 
	 //PASSO 5
	 //executar o cadastro
	 private function Execute(){
		 $this->Connect();
		 try{
			 $this->Conn->exec($this->Create);
		 	//$this->Create->execute($this->Colunas);
			 //$this->Result = $this->Conn->lastInsertId();
			 if( empty ($this->Result) ) $this->Result = TRUE;
		 }catch(PDOException $e){
			 $this->Result = null;
			echo "<p align='left' font style='background-color:f0f'><b>Erro ao criar a tabela ;</b> <br><i> {$e->getFile()} ; Na Linha numero {$e->getLine()};</i><br> {$e->getMessage()};<br> Erro Numero: {$e->getCode()}</p>"; 
		 }
	 }
}
?>