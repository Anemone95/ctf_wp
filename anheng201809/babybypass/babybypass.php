<?php
// include 'flag.php';
// $code='[[]|@[['^'<>):,:<';
// echo $code.'()';
// @eval($code);
if(isset($_GET['code'])){
    $code = $_GET['code'];
    if(strlen($code)>35){
        die("Long.");
    }
    if(preg_match("/[A-Za-z0-9_$]+/",$code)){
        die("NO.");
    }
    @eval($code);
}else{
    highlight_file(__FILE__);
}
function getFlag()
{
    echo "Flag";
}
//$hint =  "php function getFlag() to get flag";
?>
