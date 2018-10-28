<?php
highlight_file(__FILE__);
ini_set("display_error", false);
error_reporting(0);
$str = isset($_GET['A_A'])?$_GET['A_A']:'A_A';
if (strpos($_SERVER['QUERY_STRING'], "A_A") !==false) {
    echo 'A_A,have fun';
}
elseif ($str<99999999) {
    echo 'A_A,too small';
}
elseif ((string)$str>0) {
    echo 'A_A,too big';
}
else{
    echo "flag";

}
// http://114.55.36.69:8022/?A.A[]=1
