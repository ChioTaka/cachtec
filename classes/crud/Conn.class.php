<?php

/*
Conn.class [conexao]
Class abstrata de conexao padrao singleton
Retona um Objecto PDO pelo metodo estatico getConn()
*/

abstract class Conn{
	//Atributos da base de dados
	private static $Host = HOST;
	private static $User = USER;
	private static $Pass = PASS;
	private static $Db = DB;
	
	//Atributo PDO
	private static $Connect = null;
	
	//Funcao que conecta com o banco de dados e rtetorna um objecto PDO
	//Usando um Singleton
	private static function Conectar($newBD = null){
		try{
			if(self::$Connect==null):
			$Dsn = 'mysql:host='.self::$Host.';dbname='.( empty($newBD) ? self::$Db : $newBD ) ;
			$Opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
			self::$Connect = new PDO($Dsn,self::$User,self::$Pass,$Opt);
			endif;
		}catch(PDOException $e){
			echo " < < < Erro ao Conectar Com Banco {$e->getFile()} / Na Linha numero {$e->getLine()} -> {$e->getMessage()} / Erro Numero: {$e->getCode()} > > > "; 
			die;
		}
		self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$Connect;
	}
	
	//Retorna um objecto Singleton Patern
	 static function getConn($newBD = null){
		return (self::Conectar($newBD));
	}
}
?>