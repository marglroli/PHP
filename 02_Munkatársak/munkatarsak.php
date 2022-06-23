<?php
declare(strict_types=1);

function munkatars(array $seged, array $tablazat) {
    echo <<<MNKTRS
        <details class="munkatars" open="open">
            <summary class="fent">

MNKTRS;
    echo "                ".$seged["nev"]."\n";
    echo <<<MNKTRS
            </summary>
            <div class="lent">
                <div class="bal">
                    <picture>

MNKTRS;
    echo "                        <source media=\"(min-width: 400px)\" srcset=\"".$seged["nagy"]."\" />\n".
         "                        <img src=\"".$seged["kicsi"]."\" alt=\"".$seged["nev"]."\" />\n";
    echo <<<MNKTRS
                    </picture>
                </div>
                <div class="jobb">
                    <table class="adatok">

MNKTRS;
    foreach($tablazat as $kulcs => $ertek) {
        echo "                        <tr>\n".
             "                            <td>$kulcs</td>\n".
             "                            <td>$ertek</td>\n".
             "                        </tr>\n";
    }
    echo <<<MNKTRS
                    </table>
                </div>
            </div>
        </details>

MNKTRS;
}

function beolvas(string $fajlnev) {
    define("SEGED", 0);
    define("TABLAZAT", 1);
    if(($fajl = fopen($fajlnev, "r")) !== FALSE) {
        $tomb = SEGED;
        $seged = [];
        $tablazat = [];
        while(($sor = fgetcsv($fajl, 0, ',')) !== FALSE) {
            if($tomb == SEGED) {
                if(empty($sor[0])) {
                    $tomb = TABLAZAT;
                } else {
                    $seged[$sor[0]] = $sor[1];
                }
            } else {
                if(empty($sor[0])) {
                    munkatars($seged, $tablazat);
                    $tomb = SEGED;
                    $seged = [];
                    $tablazat = [];
                } else {
                    $tablazat[$sor[0]] = $sor[1];
                }
            }
            
        }
        munkatars($seged, $tablazat);
        fclose($fajl);
    }
}

echo <<<FEJLEC
<!DOCTYPE html>
<html lang="hu_HU">
    <head>
        <title>Munkatársak</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="munkatarsak.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Munkatársak</h1>

FEJLEC;

/*
$hfm_seged = [
    "nev" => "Dr. Hatwagner F. Miklós",
    "nagy" => "hfm.jpg",
    "kicsi" => "hfm_tablet.jpg"
];
$hfm_tablazat = [
    "Beosztás" => "egyetemi docens<br />tanszékvezető",
    "Szobaszám" => "Győr Egyetem tér 1. tanulmányi ép. B-601",
    "E-mail cím" => "<a href=\"mailto:miklos.hatwagner@sze.hu\">miklos.hatwagner@sze.hu</a>",
    "Telefonszám" => "+36 (96) 503-463<br />3463"
];

$pg_seged = [
    "nev" => "Pusztai Gabriella",
    "nagy" => "pg.jpg",
    "kicsi" => "pg_tablet.jpg"
];
$pg_tablazat = [
    "Beosztás" => "igazgatási ügyintéző",
    "Szobaszám" => "Győr Egyetem tér 1. tanulmányi ép. B-602",
    "E-mail cím" => "<a href=\"mailto:pusztai.gabriella@sze.hu\">pusztai.gabriella@sze.hu</a>",
    "Telefonszám" => "3581<br />+36 (96) 613-581",
    "Fax" => "+36 (96) 613-543"
];

munkatars($hfm_seged, $hfm_tablazat);
munkatars($pg_seged, $pg_tablazat);
*/

beolvas("munkatarsak.csv");

echo <<<LABLEC
    </body>
</html>
LABLEC;
