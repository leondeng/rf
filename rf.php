#!/usr/bin/php -q

<?php
require_once('recipefinder.class.php');

const RF_VERSION_NUMBER = '0.9.1';

if ($argc != 3 || in_array($argv[1], array('--help', '-help', '-h', '-?'))) {
?>

RecipeFinder <?php echo RF_VERSION_NUMBER; ?>

Help you find the most suitable recipe with items in your fridge.

Usage:
  php rf fridgeitems_filename recipes_filename
Please put data files under data folder.
Or
  php rf --help | -help | -h | -?
to get this help description.  

<?php
} else {
	try {
	  $rf = new RecipeFinder($argv[1], $argv[2]);
	
	  if($recipe = $rf->run())
	  	echo $recipe;
	  else
	  	echo 'Order TakeOut';
	} catch (Exception $e) {
		echo $e->getMessage();
    }
}
echo "\n";
?>
