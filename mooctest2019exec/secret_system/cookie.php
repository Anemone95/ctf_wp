<?php
$id=1;
$username="admin";
$sign = array(
                    'id'=>$id,
                    'name'=>$username,
                    'sign'=>md5($id.$username),
                );
echo serialize($sign);
echo "\n";
echo urlencode(serialize($sign));
echo "\n";
?>
