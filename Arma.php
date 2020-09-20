<?php
 class Arma {
   	private $nom;
	private $danio;
	
	public function _construct($n) {
		$this->nom = $n;
		$this->danio = 0;
	}
	
	public function getNom() {
		return $nom;
	}
	public function setNom($nom) {
		$this->nom = $nom;
	}
	
	public function getDanio() {
		return $danio;
	}

	public function setDanio($danio) {
		$this->danio = $danio;
	}
	
	public function calcula_danio($num,$peso) {
		 $i;
		$i=(($peso*$num)/100);
		return $i;
	}
	 
}


class Escudo extends Arma {
	private $aguante;
	 
	 public function _construct($n) {
		
		 $this->aguante = 0;
	 }
 
	 public function getAguante() {
		 return $aguante;
	 }
 
	 public function setAguante($aguante) {
		 $this->aguante = $aguante;
	 }
		 
		 public function impacto($golpe){
			 if($this->golpethis->getAguante()){
				 $this->setAguante(0);
			 }
			 else{
				 $this->setAguante($this->getAguante()-$golpe);
			 }
		 }
		 
		 public function escudo_roto(){
			 return $this->getAguante()==0;
		 }        
 }

?>