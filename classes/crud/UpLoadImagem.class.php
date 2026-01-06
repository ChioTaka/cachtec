
<?php
	
	class UpLoadImagem{
		private $Diretorio;	
		private $Imagem;
		private $ResizeImagem;	// Modelo de imagem redimensionado
		private $NewResizeImagem; // Nova Imagem apartir do madelo crido	
		private $ImageName;	
		private $ImageWith;	
		private $CaminhoDaImagem;
		private $Mensagem;
		
		/*
		Verificar se a imagem é válida
		Renomear a Imagem
		Redimensionara imagem
		Prepara o directório de destino
		Verificar se o direitorio existe
		Armazernar a imagem
		Receber o caminho armazenado
		*/	
		
		function __construct($Diretorio = null) {
			$this->Diretorio = ( (string) $Diretorio ? '../' . $Diretorio : '../uploads');
		}
		
		public function InserirImagem(array $Imagem, $Nome = null, $Width = null, $TamanhoMaximo = null) {
			$this->Imagem = $Imagem;
			$this->ImageName = ( (string) $Nome ? $Nome : substr($Imagem['name'], 0, strrpos($Imagem['name'], '.')) );
			$this->ImageWith = ( (int) $Width ? $Width : 1024 );
			$this->VerificarExtensao($TamanhoMaximo);

			if($this->CaminhoDaImagem !== false):
				$this->PrepararDirectorio();
				$this->VerificarNome();
				$this->Redimensionar();
				$this->Exec();
			endif;
		}

		

		public function getCaminhoDaImagem(){
			return($this->CaminhoDaImagem);	
		}
		public function getMensagem(){
			return($this->Mensagem);	
		}
		
    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
		private function PrepararDirectorio() {
			list($y, $m) = explode('/', date('Y/m'));
			//Ir criand um aum se não existem
			$this->CriarDirectorio("{$this->Diretorio}/");
			$this->CriarDirectorio("{$this->Diretorio}/{$y}/");
			$this->CriarDirectorio("{$this->Diretorio}/{$y}/{$m}/");
			
			if (file_exists("{$this->Diretorio}/{$y}/{$m}/") or is_dir("{$this->Diretorio}/{$y}/{$m}/")):
				$this->Diretorio = "{$this->Diretorio}/{$y}/{$m}/" ;
			endif;
		}
		
		private function CriarDirectorio($Folder) {
			if (!file_exists($Folder) && !is_dir($Folder)):
				mkdir($Folder, 0777);
			endif;
		}
		
		
	//	Verificando a extensao e o tamanho do arquivo das fotos
		private function VerificarExtensao($TamanhoMaximo){
			$TamanhoMaximo = ((int)$TamanhoMaximo ? $TamanhoMaximo : 2000000 );
			$Verificacao = false;

			switch($this->Imagem['type']):
				case 'image/jpg';
				case 'image/jpeg';
				case 'image/pjpeg';
				$Verificacao = true;
				//Preparar as condições para redimensionar as imagens
				$this->ResizeImagem = imagecreatefromjpeg($this->Imagem['tmp_name']);
				break;
				
				case 'image/gif';
				$Verificacao = true;
				$this->ResizeImagem =  imagecreatefromgif($this->Imagem['tmp_name']);
				break;
				
				case 'image/png';
				case 'image/x-png';
				$Verificacao = true;                                
				$this->ResizeImagem = imagecreatefrompng($this->Imagem['tmp_name']);
				break;
				
				/*
				case 'image/bmp';
				$Verificacao = true;
				$this->ResizeImagem = imagecreatefromwbmp($this->Imagem['tmp_name']);
				break;
				*/
				
			endswitch;
			if($Verificacao == false):
				$this->CaminhoDaImagem = false;
				$this->Mensagem = 'Este tipo de ficheiro não é aceito use JPEG,PNG ou GIF';
			elseif($this->Imagem['size'] > ($TamanhoMaximo )):
				$this->CaminhoDaImagem = false;
				$this->Mensagem = "<b>Arquivo muito grande</b> Tamanho máximo {$TamanhoMaximo } b";
			endif;
		}
		
	//	Atribuicao do nome do ficheiro 
		private function VerificarNome(){
			
			$func = new Funcoes;
			
			if($this->ImageName ):
				$ImageName = $func->limparAssentos_e_EspacosNaString( $this->ImageName )  . strrchr($this->Imagem['name'],'.');
			else:
				$explode = explode('.',$this->Imagem['name']); 
				$ImageName = $func->limparAssentos_e_EspacosNaString( (string)$Name ? $Name : $explode[0] )  . strrchr($this->Imagem['name'],'.');
			endif;
			// Modificar o nome se já existe
			if (( file_exists(  $this->Diretorio .  $ImageName ) or is_file(  $this->Diretorio .  $ImageName ) or is_dir(  $this->Diretorio .  $ImageName ) ) && ($this->ImageName ) ):
				$ImageName = $func->limparAssentos_e_EspacosNaString( $this->ImageName )  . '-' . time() . '-' . rand(0,999) . strrchr($this->Imagem['name'],'.');
			elseif ( file_exists(  $this->Diretorio .  $ImageName ) or is_file(  $this->Diretorio .  $ImageName ) or is_dir(  $this->Diretorio .  $ImageName ) ):
				$ImageName = $func->limparAssentos_e_EspacosNaString( (string)$Name ? $Name : $explode[0] ) . '-' . time(). '-' . rand(0,999). strrchr($this->Imagem['name'],'.');
			endif;
			
			$this->ImageName = $ImageName ;			
		}
		
		
		private function Redimensionar(){
			$x = imagesx($this->ResizeImagem);
			$y = imagesy($this->ResizeImagem);
			
            $ImageX = ( $this->ImageWith < $x ? $this->ImageWith : $x );
            $ImageH = ($ImageX * $y) / $x;
            $this->NewResizeImagem = imagecreatetruecolor($ImageX, $ImageH);
			
            imagealphablending($this->NewResizeImagem, false);
            imagesavealpha($this->NewResizeImagem, true);
            imagecopyresampled($this->NewResizeImagem, $this->ResizeImagem, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);
			
		}
			
			
		private function Exec(){
			
			switch($this->Imagem['type']):
				case 'image/jpg';
				case 'image/jpeg';
				case 'image/pjpeg';
				$this->Mensagem = imagejpeg($this->NewResizeImagem, $this->Diretorio .  $this->ImageName);
				break;
				
				case 'image/gif';
				$this->Mensagem = imagegif($this->NewResizeImagem, $this->Diretorio .  $this->ImageName);
				break;
				
				case 'image/png';
				case 'image/x-png';
				$this->Mensagem = imagepng($this->NewResizeImagem, $this->Diretorio .  $this->ImageName);
				break;
				
				/*
				case 'image/bmp';
				imagewbmp($this->NewResizeImagem, $this->Diretorio .  $this->ImageName);
				break;
				*/
				
			endswitch;
			
            if ($this->Mensagem == true):
				$this->CaminhoDaImagem = $this->Diretorio .  $this->ImageName ;
				imagedestroy($this->ResizeImagem);
				imagedestroy($this->NewResizeImagem);
			else:
				$this->Mensagem = 'Não foi Possível, faça Novamente o Envio' ;
				$this->CaminhoDaImagem = NULL ;
			endif;

		}
		
	}

?>