<?php
include_once('CashMachine.php');
include_once('NoteUnavailableException.php');

class CashMachineTest extends PHPUnit_Framework_TestCase {

	public function testAvailableNotes() {

		$cashMachine = new CashMachine();
		$cashMachine->setAvailableNotes( array( 100 , 50 , 20 , 10 ) );

		$this->assertEquals( array() , $cashMachine->getNotesFromValue( null ) );
		$this->assertEquals( array( 20 , 10 ) , $cashMachine->getNotesFromValue( 30 ) );
		$this->assertEquals( array( 50 , 20 , 10 ) , $cashMachine->getNotesFromValue( 80 ) );
		
	}

	public function testUnavailableNotes() {

		$cashMachine = new CashMachine();
		$cashMachine->setAvailableNotes( array( 100 , 50 , 20 , 10 ) );

		$this->setExpectedException('\NoteUnavailableException');
		$cashMachine->getNotesFromValue( 125 );
	}

	public function testInvalidArgument() {
		
		$cashMachine = new CashMachine();
		$cashMachine->setAvailableNotes( array( 100 , 50 , 20 , 10 ) );

		$this->setExpectedException('\InvalidArgumentException');
		$cashMachine->getNotesFromValue( -135 );
	}

}