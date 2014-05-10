<?php
require_once(dirname(__FILE__) . '/../fridgeItem.class.php');

class FridgeItemUnitTest extends PHPUnit_Framework_TestCase
{
	private static $values = array(
			'bread',
			'10',
			'slices',
			'25/12/2014'
	);

	public function testInitlization() {
		$item = new FridgeItem(self::$values);

		$this->assertEquals(self::$values[0], $item->getName());
		$this->assertEquals(self::$values[1], $item->getAmount());
		$this->assertEquals(self::$values[2], $item->getUnit());
		$this->assertEquals(self::$values[3], $item->getUseBy());
	}

	public function testExpiration() {
		$item = new FridgeItem(self::$values);

		$item->setUseBy(date('d/m/Y', strtotime('yesterday')));
		$this->assertTrue($item->isExpired());

		$item->setUseBy(date('d/m/Y', strtotime('tomorrow')));
		$this->assertFalse($item->isExpired());		
	}
}