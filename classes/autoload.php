<?php 
date_default_timezone_set('Africa/Luanda');
spl_autoload_register('classesParaCarregar');

define('HOME','http://127.0.0.1/index.html');
define('HOST','127.0.0.1');
define('DB','netcoaos_cachv3');
//define('USER','netcoaos_cachv3');
define('USER','netcoaos_cachtec');
define('PASS','machao2606');


function classesParaCarregar($class){
	
	$path = "classes/crud/";//pasta das classes , neste caso é a atual
	$extension = ".class.php";
	$fullPath = $path . $class .$extension;
	
	// procurar nas subpastas
        
	for($a=0;$a < 3;$a++){
		
		if( ! file_exists($fullPath) ){
			$fullPath = "../".$fullPath;
		}else{
			break;
		}
               
	}
	

	
	if( ! file_exists($fullPath) ){
            
		return(false);
	}
        
	include_once($fullPath);
}

?>