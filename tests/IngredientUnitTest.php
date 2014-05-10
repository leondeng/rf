<?php
require_once(dirname(__FILE__) . '/../ingredient.class.php');

class IngredientUnitTest extends PHPUnit_Framework_TestCase
{
	private static $values = array(
		'item' => 'bread',
		'amount' => '2',
		'unit' => 'slices',
	);

	private static $output = '\t\tItem: bread, Amount: 2, Unit: slices\n';

	public function testInitlization() {
		$ingredient = new Ingredient(self::$values);
		
		$this->assertEquals(self::$values['item'], $ingredient->getName());
		$this->assertEquals(self::$values['amount'], $ingredient->getAmount());
		$this->assertEquals(self::$values['unit'], $ingredient->getUnit());
	}
	
	public function testRender() {
		$ingredient = new Ingredient(self::$values);
		$this->assertEquals(self::$output, (string) $ingredient);
	}
}