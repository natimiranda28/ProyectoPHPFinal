<?php
 class Guerrero {
    private $peso;
    private Arma $espada;
    private Arma $lanza;
    private Escudo $escudo;
    private $vida;
    #private $IdGuerrero;

public function _construct($peso) {
    $this->peso = peso;
    $this->lanza.setNom("Lanza");
    $this->espada.setNom("Espada");
}

public function getPeso() {
    return $peso;
}
public function setPeso($peso) {
    $this->peso = $peso;
}
public function getVida() {
    return $vida;
}
public function setVida($vida) {
    $this->vida = $vida;
}
public function getEspada() {
    return $espada;
}
public function setEspada($espada) {
    $this->espada = $espada;
}
public function getLanza() {
    return $lanza;
}
public function setLanza(Arma $lanza) {
    $this->lanza = $lanza;
}
public function getEscudo() {
    return $escudo;
}
public function setEscudo(Escudo $escudo) {
    $this->escudo = $escudo;
}
public function recibe_flecha($x,$y) {
    if($this->getVida()-5 <= 0 )
        echo "Oh no!!<br>";
    else {
        $this->setVida($this->getVida()-5);
    }
}
 }
    
    
    
    class Espartano extends Guerrero { ###############################################################################

        public function _construct($peso) {
            
            $this->getEscudo()->setAguante(50);
            $this->setPeso($peso*5);
            $a = $this->getEspada()->calcula_danio(10, $peso);
            $this->getEspada()->setDanio($a);
            $b = $this->getLanza()->calcula_danio(5, $peso);
            $this->getLanza()->setDanio($b);
            $c =$this->getEscudo()->calcula_danio(1, $peso);
            $this->getEscudo()->setDanio($c);
        }
        
        public function recibe_golpe($a){
            
            if($this->getEscudo()->escudo_roto()) {
                if($this->getVida()<a) {
                    $this->setVida(0);
                }
                else
                    $this->setVida($this->getVida() - a);
            }
            else
                $this->getEscudo()->impacto($a);
            if($this->getVida()==0)
                echo "<p>Muerto</p>";
            }
    }


    class Persa extends Guerrero { #####################################################################################
        private $tipo_persa; 
        
        
        
        public function _construct($peso) {
            
            $this->tipo_persa = rand(1,2);
            if($this->tipo_persa == 0) {
                $this->getEscudo()->setAguante(50);
                $this->setPeso($peso*3);
                $a = $this->getEspada()->calcula_danio(10, $peso);
                $this->getEspada()->setDanio($a);
                $b = $this->getLanza()->calcula_danio(5, $peso);
                $this->getLanza()->setDanio($b);
                $c = $this->getEscudo()->calcula_danio(3, $peso);
                $this->getEscudo()->setDanio($c);
                
                }
            
            else {
                    $this->getEscudo()->setAguante(0);
                    $this->setPeso($peso);
                    $a = $this->getEspada()->calcula_danio(5, $peso);
                    $this->getEspada()->setDanio($a);
                    $b = $this->getLanza()->calcula_danio(3, $peso);
                    $this->getLanza()->setDanio($b);
            }
        }
        
        
        
        public function getTipo_persa() {
            return $tipo_persa;
        }
        
        public function setTipo_persa($tipo_persa) {
            $this->tipo_persa = tipo_persa;
        }
    
        
        public function recibe_golpe($a) {
            if($this->getTipo_persa()==0) {
                if($this->getEscudo()->escudo_roto()) {
                    if($this->getVida()<a) {
                        $this->setVida(0);}
                    else
                        $this->setVida($this->getVida() - a);
                }
                else
                    $this->getEscudo()->impacto($a);
            }
            else {
                if($this->getVida()<a) {
                    $this->setVida(0);}
                else
                    $this->setVida($this->getVida() - a);
            }
        }
        
    }

?>