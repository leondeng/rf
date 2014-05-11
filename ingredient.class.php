<?php
require_once('unit_types.php');

class Ingredient {
	private static $_keys = array(
		'item',
		'amount',
		'unit'
	);
	
	private $_name = '';
	private $_amount = 0;
	private $_unit = '';
	
	public function __construct($values) {
		if (!is_array($values)) throw new Exception('Invalid parameters for Ingredient class!');
		
		$_keys = array_keys($values);
		if ($_keys !== self::$_keys) throw new Exception('Invalid parameters to Ongredient class!');

		$this->initialize($values);
	}
	
	public function initialize($values) {
		$this->setName($values['item']);
		$this->setAmount($values['amount']);
		$this->setUnit($values['unit']);
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	
	public function getAmount() {
		return $this->_amount;
	}
	
	public function setAmount($amount) {
		$this->_amount = (int) $amount;
	}
	public function getUnit() {
		return $this->_unit;
	}
	
	public function setUnit($unit) {
		if (!in_array($unit, UnitType::$types)) throw new Exception('Invalid unit type!');
		
		$this->_unit = $unit;
	}
	
	public function __toString() {
		return sprintf("\t\tItem: %s, Amount: %d, Unit: %s\n", $this->getName(), $this->getAmount(), $this->getUnit());
	}
	
}