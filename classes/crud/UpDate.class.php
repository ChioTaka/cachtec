<?php
//include_once 'Conn.class.php';
/*
Classe reponsavel pela Retificacao dos dados na tabela
*/
class UpDate extends Conn {
	private $Tabela;
	private $Dados;
	private $Termos;
	private $Places;
	private $Result;
	private $UpDate;
	private $Conn;

	// Outra Base de dados
	private $newBD;
 	 
	 
	 
	 public function ExeUpDate($Tabela, array $Dados, $Termos, $ParseString, $outraBD = null){
		if(!empty($outraBD)) $this->newBD = $outraBD;
		$this->Tabela = (string) $Tabela; 
		$this->Dados  = $Dados ; 
		$this->Termos = (string) $Termos; 
		parse_str($ParseString,$this->Places);
		$this->getSyntax();
		$this->Execute();
				
	 }
	 public function getResult(){
		 if( $this->UpDate->rowcount() > 0 ){
			 return TRUE;
		 }else{ return FALSE; }
	 }
	 public function getRowCount(){
		 return($this->UpDate->rowcount());
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
		$this->UpDate = $this->Conn->prepare($this->UpDate); 
	 }
	 private function getSyntax(){
		 foreach($this->Dados as $key => $value):
		    $Places[] = $key.' = :'.$key ;
		 endforeach;
		 $Places = implode(', ' ,$Places);
		 $this->UpDate = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
	 


	 }
	 private function Execute(){
		$this->Connect(); 
		try{
			$this->UpDate->execute(array_merge($this->Dados, $this->Places));
			
			$this->Result =true;
			
		}catch(PDOException $e){
			$this->Result = null;
			 //Mensagem de erro
			echo "<p align='left' font style='background-color:f0f'><b>Erro ao Ler os Dados ;</b> <br><i> {$e->getFile()} ; Na Linha numero {$e->getLine()};</i><br> {$e->getMessage()};<br> Erro Numero: {$e->getCode()}</p>"; 
		}
	 }
	 
}
?>