<?php
require_once('slotMachine.php');

class slotMachineTest extends PHPUnit_Framework_TestCase {
    
    public function testSlotMachineExiste() {
        $slotMachine = new SlotMachine();
        $this->assertTrue(is_a($slotMachine, 'SlotMachine'));
    }
    
    public function testSlotMachineNaoTemFicha() {
        $slotMachine = new SlotMachine();
        $this->assertFalse($slotMachine->temFicha());
    }

    public function testSlotMachineInserirFicha() {
        $slotMachine = new SlotMachine();
        $slotMachine->inserirFicha();
        $this->assertTrue($slotMachine->temFicha());
    }
    
    public function testRodar() {
        $slotMachine = new SlotMachine();
        $slotMachine->rodar();
        $this->assertNotEmpty($slotMachine->roleta);
        $this->assertEquals(3, sizeof($slotMachine->roleta));
    }
    
    public function testSlotsValidos() {
        $slotMachine = new SlotMachine();
        $slotMachine->rodar();
        $valoresSlotValido = array(1, 2, 3);
        $this->assertTrue(in_array($slotMachine->roleta[0], $valoresSlotValido));        
        $this->assertTrue(in_array($slotMachine->roleta[1], $valoresSlotValido));        
        $this->assertTrue(in_array($slotMachine->roleta[2], $valoresSlotValido));        
    }
    
    public function testExibirNaoGanhouComTresDiderentes() {
        $slotMachine = new SlotMachine();
        $slotMachine->roleta = array(1, 3, 2);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(3, 2, 1);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(2, 3, 1);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(2, 1, 3);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(3, 1, 2);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(1, 2, 3);
        $this->assertFalse($slotMachine->ganhou());        
    }

    public function testExibirNaoGanhouComDoisIguais() {
        $slotMachine = new SlotMachine();
        $slotMachine->roleta = array(1, 1, 2);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(1, 1, 3);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(1, 2, 1);
        $this->assertFalse($slotMachine->ganhou());        

        $slotMachine->roleta = array(1, 3, 1);
        $this->assertFalse($slotMachine->ganhou());        
    }
    
    public function testExibirGanhou() {
        $slotMachine = new SlotMachine();
        $slotMachine->roleta = array(1, 1, 1);
        $this->assertTrue($slotMachine->ganhou());        

        $slotMachine->roleta = array(2, 2, 2);
        $this->assertTrue($slotMachine->ganhou());        

        $slotMachine->roleta = array(3, 3, 3);
        $this->assertTrue($slotMachine->ganhou());        
    }
    
    public function testJogarSemFicha() {
        $slotMachine = new SlotMachine();
        $slotMachine->jogar();
        $this->assertEmpty($slotMachine->roleta);
    }

    public function testJogarComFicha() {
        $slotMachine = new SlotMachine();
        $slotMachine->inserirFicha();
        $slotMachine->jogar();
        $this->assertNotEmpty($slotMachine->roleta);
        $this->assertTrue($slotMachine->premio !== null);
    }
    
}  
?>
