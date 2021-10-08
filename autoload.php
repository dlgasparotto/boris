<?php

spl_autoload_register('autoload');

function autoload($className) {

	$path = 'mvc/models/m' . strtolower($className) . '.php';
  include $path . $model;
  
}

?>