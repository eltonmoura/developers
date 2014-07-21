<?php
include_once('GroupSorter.php');

class GroupSorterTest extends PHPUnit_Framework_TestCase {

	public function testIsSortedGroups() {

		$groupSorter = new GroupSorter();

		$this->assertEquals( array() , $groupSorter->sortGroup( array() , null ) );

		$this->assertEquals(
			array( array(-20) , array(1, 10), array(14, 19, 20), array(22), array(93, 99), array(117, 120), array(131, 136) ) ,
			$groupSorter->sortGroup( array( 10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131 ) , 10 ) );


		$this->assertEquals(
			array( array(-20) , array(1, 10, 14), array(19, 20, 22), array(93, 99), array(117, 120), array(131), array(136) ) ,
			$groupSorter->sortGroup( array( 10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131 ) , 15 ) );
		



	}


	public function testInvalidArgument() {
		
		$groupSorter = new GroupSorter();

		$this->setExpectedException('\InvalidArgumentException');
		$groupSorter->sortGroup( array( 10, 1, 'A',  14, 99, 136, 19, 20, 117, 22, 93,  120, 131 ) , 15 );

	}

}