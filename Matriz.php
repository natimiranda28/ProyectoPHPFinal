<?php
class Matriz {
	
	private Guerrero $campo_batalla;
	private $cant_espartanos;
	
	
	public function _construct() {
		$this->carga_matriz_cero(99);
	}
        
	
	public function carga_matriz_cero($n) {
		for ($i= 0; $i<=$n; $i++) {
			for($j=0; $j<=$n;$j++) {
				$this->campo_batalla[$i][$j]= null;
			}
		}
	}
	
	public function carga_campo_batalla($n) {
		  $fila= 0; $col=0;
	
		#Espartanos
		
		for($i=0;$i<=$n-1;$i++) {
			$E = new Espartano(80); 
			do {
				$fila = rand(0,99);
				$col = rand(0,99);
				}while($this->isset(campo_batalla[$fila][$col]));#Es importante fijarse bien: si una variable tiene valor nulo, aunque haya sido declarada, isset() devolverá false. En todos los ejemplos anteriores para is_null(), isset() devolvería false mientras que is_null() devolvió true, por eso se consideran funciones opuestas
			$this->campo_batalla[$fila][$col] = $E; 
		}
	
		#Persas
		
		for($i=0;$i<($n*2)-1;$i++) {
			 $P = new Persa(60);
			do {
				$fila = $this->aleatorio(99);
				$col = $this->aleatorio(99);
			}while($this->isset(campo_batalla[$fila][$col]));
		$this->campo_batalla[$fila][$col] = $P; 
		}
	}
	
	public function pelea($a,$b){
		$resp = false;
		$r;
		while($a->getVida()!=0 || $b->getVida()!=0){
			$r=$this->aleatorio(2); #1 sig. comienza espartano, 2 sig. comienza persa
			if($r==2){
				$r=$this->aleatorio(3); # 1 es espada 2 es lanza 3 es escudo
				if($r==1) {
					$a->recibe_golpe($b->getEspada()->getDanio());
				}
				else
					if($r==2) {
						$a->recibe_golpe($b->getLanza()->getDanio());
					}
					else
						$a->recibe_golpe($b->getEscudo()->getDanio());
			}
			else {
				$r=$this->aleatorio(3); // 1 es espada 2 es lanza 3 es escudo
				if($r==1) {
					$b->recibe_golpe($a->getEspada()->getDanio());
				}
				else
					if($r==2) {
						$b->recibe_golpe($a->getLanza()->getDanio());
					}
					else
						$b->recibe_golpe($a->getEscudo()->getDanio());
        		}
		}       
		if($a->getVida()==0) {
			echo "El espartano ha muerto!!!, vida restante del Persa es " .$b->getVida();
			$resp=true;}
    		else
    			echo "El persa ha muerto, vida restante del Espartano es "  .$a->getVida();
		return $resp;
	}
		
	public function cuenta_Espartanos() {
		$s=0;
	
		for ($i= 0; $i<=99; $i++) {
			for($j=0; $j<=99;$j++) {
				if($this->campo_batalla[$i][$j] instanceof Espartano)
					$s++;
			}
		}
		return $s;
	}

	public function cuenta_Persas() {
		$s=0;
	
		for ($i= 0; $i<=99; $i++) {
			for($j=0; $j<=99;$j++) {
				if($this->campo_batalla[$i][$j] instanceof Persa)
					$s++;
			}
		}
		return $s;
	}
	
	public function verif_derrota() {
		$resp=0;
		
		if($this->cuenta_Espartanos()<(90*100/$this->cant_espartanos))
			$resp = 1;
		else {
			if($this->cuenta_Persas()<(90*100/$this->cant_espartanos*2))
				$resp=2;
		}
		return $resp;
	}
	
	public function rendicion() {
		$resp=0; # 0 es ningun ejercito se rinde 1 espartanos se rinden 2 persas se rinden
		$aux;
		
		if($this->verif_derrota()==1) {
			$aux = $this->aleatorio(2);
			if($aux == 1) {
				echo"El ejercito Espartano se rinde! ";
				$resp = 1;
			}
		}
		else {
			$aux = $this->aleatorio(2);
			if($aux == 1) {
				echo "El ejercito Persa se rinde! ";
				$resp = 2;
			}
		}
		return $resp;
	}
	
	public function buscaPeleaEsp($x,$y, Espartano $aux) {
		$resp=false;
		
		if($this->campo_batalla[$x+1][$y+1] instanceof Persa) {
			$resp = $this->pelea($aux,$this->campo_batalla[$x+1][$y+1]);
			if($resp==false) {
				$this->campo_batalla[$x+1][$y+1]=$this->campo_batalla[$x][$y];
				$this->campo_batalla[$x][$y]=null;
			}
			else{
				if($this->campo_batalla[$x-1][$y-1] instanceof Persa) {
					$resp = $this->pelea($aux,$this->campo_batalla[$x-1][$y-1]);
					if($resp==false) {
						$this->campo_batalla[$x-1][$y-1]=$this->campo_batalla[$x][$y];
						$this->campo_batalla[$x][$y]=null;
					}
					else {
						if($this->campo_batalla[$x][$y+1] instanceof Persa) {
							$resp = $this->pelea($aux,$this->campo_batalla[$x][$y+1]);
							if($resp==false) {
								$this->campo_batalla[$x][$y+1]=$this->campo_batalla[$x][$y];
								$this->campo_batalla[$x][$y]=null;
								}
						}
						else {
							if($this->campo_batalla[$x][$y-1] instanceof Persa) {
								$resp = $this->pelea($aux,$this->campo_batalla[$x][$y-1]);
								if($resp==false) {
									$this->campo_batalla[$x][$y-1]=$this->campo_batalla[$x][$y];
									$this->campo_batalla[$x][$y]=null;
									}
							}
							else {
								if($this->campo_batalla[$x-1][$y+1] instanceof Persa) {
									$resp = $this->pelea($aux,$this->campo_batalla[$x-1][$y+1]);
									if($resp==false) {
										$this->campo_batalla[$x-1][$y+1]=$this->campo_batalla[$x][$y];
										$this->campo_batalla[$x][$y]=null;
										}
								}
								else {
									if($this->campo_batalla[$x-1][$y] instanceof Persa) {
										$resp = $this->pelea($aux,$this->campo_batalla[$x-1][$y]);
										if($resp==false) {
											$this->campo_batalla[$x-1][$y]=$this->campo_batalla[$x][$y];
											$this->campo_batalla[$x][$y]=null;
										}
									}
									else {
										if($this->campo_batalla[$x+1][$y] instanceof Persa) {
											$resp = $this->pelea($aux,$this->campo_batalla[$x+1][$y]);
											if($resp==false) {
												$this->campo_batalla[$x+1][$y]=$this->campo_batalla[$x][$y];
												$this->campo_batalla[$x][$y]=null;
											}
										}
										else {
											if($this->campo_batalla[$x+1][$y-1] instanceof Persa) {
												$resp = $this->pelea($aux,$this->campo_batalla[$x+1][$y-1]);
												if($resp==false) {
													$this->campo_batalla[$x+1][$y-1]=$this->campo_batalla[$x][$y];
													$this->campo_batalla[$x][$y]=null;
												}
											}	
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
        public function buscaPeleaPersa($x,$y, Persa $aux) {
			$resp=false;
		
		if($this->campo_batalla[$x+1][$y+1] instanceof Espartano) {
			$resp = $this->pelea($this->campo_batalla[$x+1][$y+1],$aux);
			if($resp==true) {
				$this->campo_batalla[$x+1][$y+1]=$this->campo_batalla[$x][$y];
				$this->campo_batalla[$x][$y]=null;
			}
			else{
				if($this->campo_batalla[$x-1][$y-1] instanceof Espartano) {
					$resp = $this->pelea($this->campo_batalla[$x-1][$y-1],$aux);
					if($resp==true) {
						$this->campo_batalla[$x-1][$y-1]=$this->campo_batalla[$x][$y];
						$this->campo_batalla[$x][$y]=null;
					}
					else {
						if($this->campo_batalla[$x][$y+1] instanceof Espartano) {
							$resp = $this->pelea($this->campo_batalla[$x][$y+1],$aux);
							if($resp==true) {
								$this->campo_batalla[$x][$y+1]=$this->campo_batalla[$x][$y];
								$this->campo_batalla[$x][$y]=null;
								}
						}
						else {
							if($this->campo_batalla[$x][$y-1] instanceof Espartano) {
								$resp = $this->pelea($this->campo_batalla[$x][$y-1],$aux);
								if($resp==true) {
									$this->campo_batalla[$x][$y-1]=$this->campo_batalla[$x][$y];
									$this->campo_batalla[$x][$y]=null;
									}
							}
							else {
								if($this->campo_batalla[$x-1][$y+1] instanceof Espartano) {
									$resp = $this->pelea($this->campo_batalla[$x-1][$y+1],$aux);
									if($resp==true) {
										$this->campo_batalla[$x-1][$y+1]=$this->campo_batalla[$x][$y];
										$this->campo_batalla[$x][$y]=null;
										}
								}
								else {
									if($this->campo_batalla[$x-1][$y] instanceof Espartano) {
										$resp = $this->pelea($this->campo_batalla[$x-1][$y],$aux);
										if($resp==true) {
											$this->campo_batalla[$x-1][$y]=$this->campo_batalla[$x][$y];
											$this->campo_batalla[$x][$y]=null;
										}
									}
									else {
										if($this->campo_batalla[$x+1][$y] instanceof Espartano) {
											$resp = $this->pelea($this->campo_batalla[$x+1][$y],$aux);
											if($resp==true) {
												$this->campo_batalla[$x+1][$y]=$this->campo_batalla[$x][$y];
												$this->campo_batalla[$x][$y]=null;
											}
										}
										else {
											if($this->campo_batalla[$x+1][$y-1] instanceof Espartano    ) {
												$resp = $this->pelea($this->campo_batalla[$x+1][$y-1],$aux);
												if($resp==true) {
													$this->campo_batalla[$x+1][$y-1]=$this->campo_batalla[$x][$y];
													$this->campo_batalla[$x][$y]=null;
												}
											}	
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
        
	public function flechazo_grupal() {
		for ($i= 0; $i<=99; $i++) {
			for($j=0;$j<=99;$j++) {
				if($this->campo_batalla[$i][$j] instanceof Espartano) {
					$this->campo_batalla[$i][$j]->recibe_flecha($i,$j);
					if($this->campo_batalla[$i][$j]->getVida()==0)
						echo "El espartano de la posicion " + $i + " " + $j + "ha muerto de un flechazo masivo";
						$this->campo_batalla[$i][$j]=null;
				}
				else {
					if($this->campo_batalla[$i][$j] instanceof Persa) {
						$this->campo_batalla[$i][$j]->recibe_flecha($i,$j);
						if($this->campo_batalla[$i][$j]->getVida()==0)
							echo"El persa de la posicion " + $i + " " + $j + "ha muerto de un flechazo masivo";
							$this->campo_batalla[$i][$j]=null;
					}
				}
			}
		}
	}
        
        public function simulacion(){
            $a;$b;
          while($this->rendicion()==0){  
            do{
                $a= $this->aleatorio(100)-1;
                $b= $this->aleatorio(100)-1; 
            }while($this->campo_batalla[$a][$b]!=null);
            
            if($this->campo_batalla[$a][$b]instanceof Espartano){
                $this->buscaPeleaEsp($a, $b,$this->campo_batalla[$a][$b]);
            }
            else{
                $this->buscaPeleaPersa($a, $b,$this->campo_batalla[$a][$b]);
            }
        }
          $a=$this->aleatorio(5);
          if($a==2){
              $this->flechazo_grupal();
          }
    }
}

class home{
    private Matriz $tablero;
	
	public function _construct(){
		$this->$tablero->carga_campo_batalla(33);
    	$this->$tablero->simulacion();
	}

}



?>