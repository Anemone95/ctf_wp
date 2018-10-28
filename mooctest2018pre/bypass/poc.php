<?php
$sql = "select * from user where username = '%\' and 1=1#';";
$args = "admin";
echo sprintf( $sql, $args ) ;
  ?>
