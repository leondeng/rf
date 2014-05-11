<?php
require_once('ingredient.class.php');

class Recipe {
	private static $_keys = array(
		'name',
		'ingredients'
	);

	private $_name = '';
	private $_ingredients = array();
	
	public function __construct($values) {
		if (!is_array($values)) throw new Exception('Invalid parameters to Recipe class!');
		
		$_keys = array_keys($values);
		if ($_keys !== self::$_keys) throw new Exception('Invalid parameters to Recipe class!');
		
		$this->initialize($values);
	}
	
	public function initialize($values) {
		$this->setName($values['name']);
		$this->setIngredients($values['ingredients']);
	}
	
	public function getName() {
		return $this->_name;
	}
	
	private function setName($name) {
		$this->_name = $name;
	}
	
	public function getIngredients() {
		return $this->_ingredients;
	}
	
	private function setIngredients($values) {
		foreach($values as $value) {
			$this->_ingredients[] = new Ingredient($value);
		}
	}

	public function __toString() {
		$string = sprintf("\tName: %s\n\tIngredients:\n", $this->getName());
		
		foreach ($this->getIngredients() as $ingredient) {
			$string .= (string) $ingredient;
		}
		
		return $string;
	}
}