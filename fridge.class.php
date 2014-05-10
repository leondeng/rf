<?php
require_once('fridgeItem.class.php');

class Fridge {
	private $_items = array();
	
	public function __construct($filename = '') {
		if(empty($filename)) {
			echo 'Please input a csv file name: ';
			$handle = fopen ("php://stdin","r");
			$line = fgets($handle);
			$filename = trim($line);
		}
		$this->load($filename);
	}

	public function load($filename) {
		if(!file_exists($filename) || !is_readable($filename))
			throw new Exception('Please make sure csv file existing and readable.');
		
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
			{
				$this->_items[] = new FridgeItem($row);
			}
			fclose($handle);
		}
	}
}