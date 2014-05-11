<?php
require_once('fridgeItem.class.php');

class Fridge {
	private $_items = array();

	public function __construct($values) {
		if (!is_array($values)) throw new Exception('Invalid parameters to Fridge class!');
		
		$this->initialize($values);
	}
	
	public function initialize($values) {
		foreach ($values as $value) {
			$this->_items[] = new FridgeItem($value);
		}
	}
	
	/*
	 * Fridge::findIngredient()
	 * Desc: search Fridge items for given ingredient name, amount and unit
	 * Para: ingredient name, amount and unit
	 * Return: a date string when hit, stands for useBy of hit item; false if miss or hit item unacceptable
	 */
	public function findIngredient($name, $amount, $unit) {
		foreach ($this->_items as $item) {
			if ($item->getName() != $name) continue;
			if ($item->getAmount() < $amount) continue;
			if ($item->getUnit() != $unit) continue;
			if ($item->isExpired()) continue;
			
			return $item->getUseBy();
		}
		return false;
	}
	
	public function getItems() {
		return $this->_items;
	}
}