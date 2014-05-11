<?php

require_once('fridge.class.php');
require_once('recipe.class.php');

class RecipeFinder {
	private $fridge = NULL;
	private $recipes = array();
	
	public function __construct($fridge_filename, $recipes_filename) {
		$fridge_filename = dirname(__FILE__) . '/data/' . $fridge_filename;
		if(!file_exists($fridge_filename) || !is_readable($fridge_filename))
			throw new Exception('Invalid fridge items data file!');

		$recipes_filename = dirname(__FILE__) . '/data/' . $recipes_filename;
		if(!file_exists($recipes_filename) || !is_readable($recipes_filename))
			throw new Exception('Invalid recipes data file!');
		
		$this->initialize($fridge_filename, $recipes_filename);
	}
	
	public function initialize($fridge_filename, $recipes_filename) {
		$this->initFridge($fridge_filename);
		$this->initRecipes($recipes_filename);
	}
	
	public function initFridge($filename) {
		$items = array();
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) 	{
				$items[] = $row;
			}
			fclose($handle);
		}
		
		$this->fridge = new Fridge($items);
	}
	
	public function initRecipes($filename) {
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			$content = fread($handle, filesize($filename));
			fclose($handle);
			
			$recipes = json_decode($content, TRUE);
			foreach ($recipes as $recipe) {
				$this->recipes[] = new Recipe($recipe)	;
			}			
		}
	}
	
	public function run() {
		$found = false;
		$recipe_ts = 0;

		foreach ($this->recipes as $recipe) {
			$ts = 0;
			foreach ($recipe->getIngredients() as $ingredient) {
				$useby = $this->fridge->findIngredient($ingredient->getName(), $ingredient->getAmount(), $ingredient->getUnit());
				if (!$useby) continue 2; //once one ingredient not found, try next recipe

				list($d, $m, $y) = explode('/', $useby);
				$_ts = strtotime(sprintf('%d-%d-%d', $y, $m, $d));
				if (!$ts || $_ts < $ts) $ts = $_ts; //get closer use-by timestamp
			}
			
			if (!$recipe_ts || $ts < $recipe_ts) {
				$recipe_ts = $ts;
				$found = $recipe;
			}
		}
		
		return $found;
	}
}