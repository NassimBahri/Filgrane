<?php
/**
*****************************************************************    
*  _   _               _             ____        _          _ 
* | \ | |             (_)           |  _ \      | |        (_)
* |  \| | __ _ ___ ___ _ _ __ ___   | |_) | __ _| |__  _ __ _ 
* | . ` |/ _` / __/ __| | '_ ` _ \  |  _ < / _` | '_ \| '__| |
* | |\  | (_| \__ \__ \ | | | | | | | |_) | (_| | | | | |  | |
* |_| \_|\__,_|___/___/_|_| |_| |_| |____/ \__,_|_| |_|_|  |_|
*                                                               
*****************************************************************                                                             
*Créer un filigrane en PHP
*
*Cette classe vous permet créer aisament des filigrane 
*pour vos images en PHP afin de les protégés
*
*@filesource Filgrane.php
*@author Nassim Bahri <nassim.bahri@yahoo.fr>
*@version 1.0
*@copyright (c) Nassim Bahri
*@link http://fr.slideshare.net/BahriNassim
*@link https://remixcv.com/cv/Nassim-Bahri/50c640fae85c6
**/
class Filgrane{
	
	
	/**
	*Le font utiliser pour le texte
	*@var string
	**/
	public static $font='arial.ttf';
	
	/**
	*Le chemain de la nouvelle image
	*@var string
	**/
	public $new;
	
	/**
	*La signature de l'image (texte filgrane)
	*@var string
	**/
	public $legend;
	
	/**
	*Le chemain de l' image originale
	*@var string
	**/
	public $img;
	/**
	*Opacité du text
	*@var float
	**/
	public static $opacity=100;
	/**
	*Le couleur d'écriture en hexdec
	*@var string
	**/
	public static $color='#000';
	
	/**
	*Constructeur 
	*
	*Constrcuteur de la classe Filgrane et qui permet 
	*d'initialiser les attributs nécessaires
	*
	*@param string $old l'image d'origine
	*@param string $new le chemain de la nouvelle image généré
	*@param string $legend la signature de l'image
	*@return void
	**/
	public function __construct($old,$legend,$new=NULL){
		if($new==NULL){
			$this->new=$old;
		}
		else{
			$this->new=$new;
		}
		$this->img=$old;
		$this->legend=$legend;
		$this->init($old);
	}
	
	/**
	*Extraction des informations
	*
	*Méthode qui permet d'extraire 
	*les informations relative à l'image
	*
	*@return void
	**/
	public function init(){
		$imageInfo=pathinfo($this->img);
		switch($imageInfo['extension']):
			case 'png':
				$this->createFormPng();
				break;
			case 'gif':
				$this->createFromGif();
				break;
			default:
				$this->createFromJpg();
		endswitch;
	}
	
	/**
	*Initialiser la signature
	*
	*Méthode qui permet d'initialiser
	*les dimenstion de la signature aisni que le nombre de répitition
	*
	*@return array
	**/
	public function initLegend(){
		list($width,$height)=getimagesize($this->img);
		$repeat=10;
		$legend=$this->legend;
		for($i=0;$i<$repeat;$i++){
			$this->legend.=' '.$legend;
		}
		$tangente=$height/$width;
		$angle=(atan($tangente)*180)/pi();
		$x=20;
		$y=$height-20;
		return array($x,$y,$angle);
	}
	
	/**
	*Créer une image PNG
	*Méthode qui permet de créer une 
	*image à partir d'une image PNG
	*
	*@return void
	**/
	public function createFormPng(){
		list($x,$y,$angle)=$this->initLegend();
		$img = imagecreatefrompng($this->img);
		$noir = $noir =$this->getcolor($img);
		imagettftext($img, 20, $angle, $x, $y, $noir, self::$font, $this->legend);
		imagepng($img, $this->new);
	}
	
	/**
	*Créer une image JPG
	*Méthode qui permet de créer une 
	*image à partir d'une image JPG
	*
	*@return void
	**/
	public function createFromJpg(){
		list($x,$y,$angle)=$this->initLegend();
		$img = imagecreatefromjpeg($this->img);
		$noir =$this->getcolor($img);
		imagettftext($img, 20, $angle, $x, $y, $noir, self::$font, $this->legend);
		imagejpeg($img, $this->new);
	}
	
	/**
	*Créer une image GIF
	*Méthode qui permet de créer une 
	*image à partir d'une image GIF
	*
	*@return void
	**/
	public function createFromGif(){
		list($x,$y,$angle)=$this->initLegend();
		$img = imagecreatefromgif($this->img);
		$noir = $noir =$this->getcolor($img);
		imagettftext($img, 20, $angle, $x, $y, $noir, self::$font, $this->legend);
		imagegif($img, $this->new);
	}
	
	/**
	*Initialiser le couleur
	*
	*Méthode qui permet d'initialiser 
	*le couleur de l'écriture
	*
	*@param string $img l'image du fond
	*@param string $opacity l'opacité d'écriture
	*@return string
	**/
	public function getcolor($img){
		$color=imagecolorallocatealpha(
			$img,
			hexdec(substr(self::$color, 0, 2)),
			hexdec(substr(self::$color, 2, 2)),
			hexdec(substr(self::$color, 4, 2)),
			127 * (100 - self::$opacity) / 100
		);
		return $color;
	}

}
?>