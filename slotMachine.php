<?php
class SlotMachine {
    
    public $ficha = false;
    public $roleta = null;
    public $premio = null;
    
    public function inserirFicha() {
        $this->ficha = true;
    }

    public function jogar() {
        if ($this->temFicha()) {
            $this->rodar();            
            $this->premio = $this->ganhou();
        }
    }

    public function temFicha() {
        return $this->ficha;    
    }
    
    public function rodar() {
        $this->roleta = array(rand(1, 3), rand(1, 3), rand(1, 3));
    }
    
    public function ganhou() {
        return ($this->roleta[0] == $this->roleta[1] && $this->roleta[0] == $this->roleta[2]);
    }
    
}  
?>
