<?php
    define("FORUM_FAJL", "/home/feltoltes/www/forum_hfm.json");
    header("Content-type: application/json; charset=utf-8");

    if(file_exists(FORUM_FAJL)) {
        $adatok = json_decode(file_get_contents(FORUM_FAJL), true);
    } else {
        $adatok = [];
    }
    if(filter_has_var(INPUT_POST, "nev") && filter_has_var(INPUT_POST, "hsz")) {
        $nev = filter_input(INPUT_POST, "nev", FILTER_SANITIZE_STRING);
        $hsz = filter_input(INPUT_POST, "hsz", FILTER_SANITIZE_STRING);
        $adatok[] = ["nev" => $nev, "hsz" => $hsz, "ido" => time()];
        file_put_contents(FORUM_FAJL, json_encode($adatok));
    } 
    if(filter_has_var(INPUT_GET, "utolso")) {
        $utolso = filter_input(INPUT_GET, "utolso", FILTER_SANITIZE_NUMBER_INT);
    } else {
        $utolso = 0;
    }
    $ujak = [];
    foreach ($adatok as $hsz) {
        if($hsz["ido"] > $utolso) {
            $ujak[] = $hsz;
        }
    }
    echo json_encode($ujak);
