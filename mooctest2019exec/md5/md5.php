<?php
function  readmyfile($path){
    $fh = fopen($path, "rb");
    $data = fread($fh, filesize($path));
    fclose($fh);
    return $data;
}
// $text1=$_POST["data1"];
// $text2=$_POST["data2"];

$text1=readmyfile("1.txt");
$text2=readmyfile("2.txt");
echo 'MD51: '. md5($text1);
echo "\r\n";
echo  'URLENCODE '. urlencode($text1);
echo "\r\n";
echo 'URLENCODE hash '.md5(urlencode ($text1));
echo "\r\n";
echo 'MD52: '.md5($text2);
echo "\r\n";
echo  'URLENCODE '.  urlencode($text2);
echo "\r\n";
echo 'URLENCODE hash '.md5( urlencode($text2));
echo "\r\n";
?>
