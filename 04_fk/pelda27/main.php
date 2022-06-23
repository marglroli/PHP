<?php
  use HTMLgen\RadioGomb;
  use HTMLgen\JeloloNegyzet;
  
  spl_autoload_register(function ($osztaly) {
    require_once(str_replace('\\', '/', $osztaly).".php");
  });
  
  $nem = new RadioGomb('nem', [
    'ffi' => 'férfi',
    'no'  => 'nő'
  ], 'no');
  
  $hobby = new JeloloNegyzet('hobby', [
    'olv' => 'olvasás',
    'moz' => 'mozi és filmek',
    'gas' => 'gasztronómia, főzés',
    'spo' => 'sport'
  ], [
    'moz', 'spo'
  ]);
  $hobby->addValueLabel('tur', 'túrázás');
  
  if(!empty($_POST)) {
    echo "<pre>\n";
    var_dump($_POST);
    echo "</pre>\n";
  }
  
  echo "<form method=\"post\"",
    " action=\"{$_SERVER['PHP_SELF']}\">\n";
  $nem->printHTML();
  $hobby->printHTML();
  echo "<div><input type=\"submit\"",
    " value=\"Küldés\"></div>\n</form>\n";