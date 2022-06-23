<?php
  use Egyetem\Hallgato;
  spl_autoload_register(function ($osztaly) {
    require_once(substr($osztaly, strrpos($osztaly, '\\')+1).".php");
  });
  define('FAJL', '/home/feltoltes/www/hallgato.dat');
  
  $hg = NULL;
  if(file_exists(FAJL)) {
    echo "<p>Fájl létezik, betöltés...</p>\n";
    $hg = unserialize(file_get_contents(FAJL));
  } else {
    echo "<p>Fájl nem létezik, létrehozás...</p>\n";
    $hg = new Hallgato('Bekő Tóni', 'QWERTZ');
    file_put_contents(FAJL, serialize($hg));
  }
  echo "<p>Hallgató adatai: ", $hg, "</p>\n";
