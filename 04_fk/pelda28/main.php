<?php
  use Vilag\Ember;
  use Vilag\Merevlemez;
  use Vilag\Tarolo;
  
  spl_autoload_register(function ($osztaly) {
    require_once(str_replace('\\', '/', $osztaly).".php");
  });
  
  $giziElso = '123456AB';
  $gizi = new Ember($giziElso);
  $gizi->addSzigszam('654321BA');
  echo "<p>Gizi személyi igazolvány száma: ", $gizi->getID(), "</p>\n";
  echo "<p>Gizi használta már a $giziElso számú személyi igazolványt? ",
    $gizi->hasID($giziElso)?"Igen":"Nem", "</p>\n";
  
  $seagateSN = 'xyz123asd';
  $seagate = new Merevlemez($seagateSN);
  echo "<p>Merevlemez gyártási száma: ", $seagate->getID(), "</p>\n";
  echo "<p>Merevlemez rendelkezik a $seagateSN sorozatszámmal? ",
    $seagate->hasID($seagateSN)?"Igen":"Nem", "</p>\n";
    
  $kamra = new Tarolo();
  $kamra->addDolog($gizi);
  $kamra->addDolog($seagate);
  echo "<p>Kamrában tárolt dolgok azonosítói: ", $kamra, "</p>\n";