<?php
require_once(dirname(__FILE__).'/../recipe.class.php');

class RecipeUnitTest extends PHPUnit_Framework_TestCase
{
	private static $values = array(
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

	private static $output = '\tName: grilled cheese on toast\n\tIngredients:\n\t\tItem: bread, Amount: 2, Unit: slices\n\t\tItem: cheese, Amount: 2, Unit: slices\n';

	public function testInitlization() {
		$recipe = new Recipe(self::$values);
		
		$this->assertEquals(self::$values['name'], $recipe->getName());
		
		$this->assertEquals(count(self::$values['ingredients']), count($recipe->getIngredients()));
		
		foreach ($recipe->getIngredients() as $ingredient) {
			$this->assertEquals('Ingredient', get_class($ingredient));
		}
	}
	
	public function testRender() {
		$recipe = new Recipe(self::$values);
		$this->assertEquals(self::$output, (string) $recipe);
	}
}