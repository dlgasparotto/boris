<?php

include 'sys/mutil.php';
include 'sys/mbd.php';
include 'sys/mreuter.php';

spl_autoload_register('modelPadrao');

function modelPadrao($className) {

  $class = strtolower($className);
  
  if ($class == "aplicacao") {
  	$path = "sys/maplicacao.php";
  } else {
    $path = "models/m".$class.".php";
  }

  include $path;
  
}

?>