<?php
declare(strict_types=1);
define("ADATFAJL", "munkatarsak.json");

function bovit(array &$tablazat, string $kulcs, array $ertek) {
    if(filter_has_var(INPUT_POST, $kulcs)) {
        $adat = filter_input(INPUT_POST, $kulcs, $ertek[1]);
        if(!empty($adat)) {
            $tablazat[$ertek[0]] = $adat;
        }
    }
}

function felvitel() {
    if(filter_has_var(INPUT_POST, "nev") && array_key_exists("kicsi", $_FILES) && array_key_exists("nagy", $_FILES) &&
       $_FILES["kicsi"]["error"]==UPLOAD_ERR_OK && $_FILES["nagy"]["error"]==UPLOAD_ERR_OK &&
       strpos($_FILES["kicsi"]["type"], "image/")===0 && strpos($_FILES["nagy"]["type"], "image/")===0) {
        $nev = filter_input(INPUT_POST, "nev", FILTER_SANITIZE_STRING);
        move_uploaded_file($_FILES["kicsi"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/".$_FILES["kicsi"]["name"]);
        move_uploaded_file($_FILES["nagy"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/".$_FILES["nagy"]["name"]);
        $uj = [
            "seged" => [
                "nev" => $nev,
                "kicsi" => $_FILES["kicsi"]["name"],
                "nagy" => $_FILES["nagy"]["name"]
            ],
            "tablazat" => []
        ];
        $cimkek = [
            "beosztas" => ["Beosztás:", FILTER_SANITIZE_STRING],
            "szoba" => ["Szobaszám:", FILTER_SANITIZE_STRING],
            "email" => ["E-mail:", FILTER_SANITIZE_EMAIL],
            "tel" => ["Telefonszám:", FILTER_SANITIZE_STRING],
            "fax" => ["Fax:", FILTER_SANITIZE_STRING]
        ];
        foreach($cimkek as $kulcs => $ertek) {
            bovit($uj["tablazat"], $kulcs, $ertek);
        }
        $adatok = json_decode(($json = file_get_contents(ADATFAJL))===false ? "[]" : $json, true);
        $adatok[] = $uj;
        file_put_contents(ADATFAJL, json_encode($adatok));
    }
}

function vazlat() {
    $adatok = json_decode(($json = file_get_contents(ADATFAJL))===false ? "[]" : $json, true);
    foreach($adatok as $id => $mnktrs) {
        echo "        <details class=\"munkatars hianyos\" id=\"m_$id\">\n".
             "            <summary class=\"fent\">\n".
             "                ".$mnktrs["seged"]["nev"]."\n".
             "            </summary>\n".
             "        </details>\n";             
    }
}

function reszletes() {
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
    if($id !== false) {
        $adatok = json_decode(($json = file_get_contents(ADATFAJL))===false ? "[]" : $json, true);
        if(array_key_exists($id, $adatok)) {
            header("Content-type: application/json; charset=UTF-8");
            $adatok[$id]["id"] = $id;
            echo json_encode($adatok[$id]);
        }
    }
}

felvitel();
if(filter_has_var(INPUT_GET, "id")) {
    reszletes();
} else {
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
    vazlat();
    echo <<<LABLEC
    <p><a href="felvitel.html">Új munkatárs felvitele</a></p>
    <script src="munkatarsak.js"></script>
</body>
</html>
LABLEC;
}
