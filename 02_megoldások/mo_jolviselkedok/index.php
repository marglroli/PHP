<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<head>
    <title>Jólviselkedők</title>
    <!-- <link rel="stylesheet" type="text/css" href="stilus.css"> -->
    <meta charset="utf-8" />
</head>
<body>
    <h1>Jólviselkedők és ajándékaik listája</h1>
<?php
    function betolt($fajlnev):array {
        $t = [];
        if(($f = fopen($fajlnev, "r"))!==FALSE) {
            $paratlan = true;
            while(($sor=fgets($f))!==FALSE) {
                if($paratlan) {
                    $seged = [$sor];
                } else {
                    $seged[] = $sor;
                    $t[] = $seged;
                }
                $paratlan = !$paratlan;
            }
            fclose($f);
        }
        return $t;
    }
    
    function hasonlit($a, $b) {
        return (float)$b[1] - (float)$a[1];
    }
    
    $szemelyek = betolt("jolviselkedok.txt");
    usort($szemelyek, "hasonlit");
    
    $ajandekok = betolt("ajandekok.txt");
    usort($ajandekok, "hasonlit");
    
    echo "<ol>\n";
    $meddig = min([count($szemelyek), count($ajandekok)]);
    for($i=0; $i<$meddig; $i++) {
        echo "\t<li>", $szemelyek[$i][0], " - ", $ajandekok[$i][0], "</li>\n";
    }
    echo "</ol>\n";
?>
</body>
</html>
