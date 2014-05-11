<?php
require_once('unit_types.php');

class FridgeItem {
	private static $_headers = array(
		'item',
		'amount',
		'unit',
		'useby'
	);

	private $_name = '';
	private $_amount = 0;
	private $_unit = '';
	private $_useby = '';

	public function __construct($values) {
		if (!is_array($values) || count($values) != count(self::$_headers)) throw new Exception('Invalid parameters to FridgeItem class!');
		
		$_values = array_combine(self::$_headers, $values);
		$this->initialize($_values);
	}

	protected function initialize($default) {
		$this->setName($default['item']);
		$this->setAmount($default['amount']);
		$this->setUnit($default['unit']);
		$this->setUseBy($default['useby']);
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
		$this->_amount = $amount;
	}

	public function getUnit() {
		return $this->_unit;
	}

	public function setUnit($unit) {
		if (!in_array($unit, UnitType::$types)) throw new Exception('Invalid unit type!');
		$this->_unit = $unit;
	}

	public function getUseBy() {
		return $this->_useby;
	}

	public function setUseBy($useby) {
		$this->_useby = $useby;
	}

	public function isExpired() {
		list($d, $m, $y) = explode('/', $this->_useby);

		return strtotime(sprintf('%d-%d-%d', $y, $m, $d)) < time();
	}
}