<?php

class Custom extends Controller{
  public static function Test($string){
      $root = simplexml_load_string($string,'SimpleXMLElement',LIBXML_NOENT);
      $test = $root->name;
      echo $test;
  }

}

 ?>
