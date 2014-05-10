<?php
require_once(dirname(__FILE__).'/../fridge.class.php');
require_once(dirname(__FILE__).'/../recipe.class.php');

class FridgeUnitTest extends PHPUnit_Framework_TestCase
{
	private static $items = array(
		array(
			'bread',
			'10',
			'slices',
			'25/12/2014'
		),
		array(
			'cheese',
			'10',
			'slices',
			'25/12/2014'
	));

	private static $recipe = array(
		'name' => 'grilled cheese on toast',
		'ingredients' => array(
			array(
				'item' => 'bread',
				'amount' => '2',
				'unit' => 'slices'
			),
			array(
				'item' => 'cheese',
				'amount' => '2',
				'unit' => 'slices'
	)));

	public function testInitlization() {
		$fridge = new Fridge(self::$items);

		$this->assertEquals(count(self::$items), count($fridge->getItems()));

		foreach ($fridge->getItems() as $item) {
			$this->assertTrue($item instanceof FridgeItem);
		}
	}

	public function testFindIngredient() {
		$fridge = new Fridge(self::$items);
		$recipe = new Recipe(self::$recipe);
		
		//found
		foreach ($recipe->getIngredients() as $ingredient) {
			$this->assertEquals('25/12/2014', $fridge->findIngredient($ingredient->getName(), $ingredient->getAmount(), $ingredient->getUnit()));
		}
		
		//not found
		$this->assertFalse($fridge->findIngredient('butter', 2, 'slices'));
		
		//not enough
		$this->assertFalse($fridge->findIngredient('bread', 11, 'slices'));
		
		//unit mismatch
		$this->assertFalse($fridge->findIngredient('bread', 2, 'grams'));
		
		//expired
		$items = $fridge->getItems();
		$items[0]->setUseBy(date('d/m/Y', strtotime('yesterday')));
		$this->assertFalse($fridge->findIngredient('bread', 2, 'slices'));
	}
}