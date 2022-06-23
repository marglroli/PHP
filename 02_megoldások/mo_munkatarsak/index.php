<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<head>
    <title>Munkatársak</title>
    <link rel="stylesheet" type="text/css" href="stilus.css">
    <meta charset="utf-8" />
</head>
<body>
    <h1>Munkatársak</h1>
<?php
    function tablazat(array $mnktrs) {
        if(isset($mnktrs["Kép"])) {
            $kep = $mnktrs["Kép"];
            unset($mnktrs["Kép"]);
        }
        echo "<table>\n";
        foreach($mnktrs as $kulcs => $ertek) {
            echo "<tr><td class=\"bal\">$kulcs</td><td class=\"jobb\">";
            if(gettype($ertek)=="string") {
                echo $ertek;
            } else {
                echo "<ul>";
                foreach($ertek as $elem) {
                    echo "<li>$elem</li>";
                }
                echo "</ul>";
            }
            echo "</td>";
            if(isset($kep)) {
                echo "<td rowspan=\"".count($mnktrs)."\"><img src=\"$kep\" /></td>";
                unset($kep);
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
    
    function beolvas($fajlnev) {
        if(($fajl = fopen($fajlnev, "r")) !== FALSE) {
            $tomb = [];
            while(($sor = fgetcsv($fajl, 0, ';')) !== FALSE) {
                if(empty($sor[0])) {
                    tablazat($tomb);
                    $tomb = [];
                } else {
                    $tomb[$sor[0]] = $sor[1];
                }
                //echo "<pre>"; print_r($sor); echo "</pre>";
            }
            tablazat($tomb);
            fclose($fajl);
        }
    }
    
    beolvas("it.csv");
?>
</body>
</html>
