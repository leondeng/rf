<?php
class FridgeItem {
	public static $unit_types = array(
		'of',
		'grams',
		'ml',
		'slices'
	);

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
		if (!is_array($values)) throw new Exception('FridgeItem only accept array for init!');
		
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

	protected function setName($name) {
		$this->_name = $name;
	}

	public function getAmount() {
		return $this->_amount;
	}

	protected function setAmount($amount) {
		$this->_amount = $amount;
	}

	public function getUnit() {
		return $this->_unit;
	}

	protected function setUnit($unit) {
		if (!in_array($unit, self::$unit_types)) throw new Exception('Invalid FridgeItem unit type!');
		$this->_unit = $unit;
	}

	public function getUseBy() {
		return $this->_useby;
	}

	protected function setUseBy($useby) {
		$this->_useby = $useby;
	}

	public function isExpired() {
		return $this->_useby > date('d/m/Y');
	}
}