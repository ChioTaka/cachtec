<?php
include_once 'Conn.class.php';
/*
Classe reponsavel por apagar Dados da tabela
*/
class Delete extends Conn {
	private $Tabela;
	private $Termos;
	private $Places;
	private $Result;
	private $Delete;
	private $Conn;
	
	// Outra Base de dados
	private $newBD;
	 
	 
	 public function ExeDelete($Tabela, $Termos, $ParseString, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		$this->Tabela = (string) $Tabela; 
		$this->Termos = (string) $Termos; 
		parse_str($ParseString,$this->Places);
		$this->getSyntax();
		$this->Execute();
				
	 }
         
         
         public function ExeTruncate($Tabela, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		$this->Tabela = (string) $Tabela; 
                $this->Places = array();
		$this->Delete = "TRUNCATE TABLE {$this->Tabela} ";
		$this->Execute();				
	 }
         
         
	 public function getResult(){
		 return($this->Result);
	 }
	 public function getRowCount(){
		 return($this->Delete->rowcount());
	 }
	 public function setPlaces($ParseString){
		 parse_str($ParseString,$this->Places);
		 $this->getSyntax();
		 $this->Execute();
	 }
	 
	 /***********METODOS PRIVADOS**********/
	 
	 private function Connect(){
		$this->Conn = parent::getConn($this->newBD);
		//Armazena os vaolres da base de dados PDO para a statment
		$this->Delete = $this->Conn->prepare($this->Delete); 
	 }
	 private function getSyntax(){
		 $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
	 


	 }
	 private function Execute(){
		$this->Connect(); 
		try{
			$this->Delete->execute($this->Places);
			$this->Result = true;
		}catch(PDOException $e){
			$this->Result = null;
			 //Mensagem de erro
			echo "<p align='left' font style='background-color:f0f'><b>Erro ao Ler os Dados ;</b> <br><i> {$e->getFile()} ; Na Linha numero {$e->getLine()};</i><br> {$e->getMessage()};<br> Erro Numero: {$e->getCode()}</p>"; 
		}
	 }
}
?>