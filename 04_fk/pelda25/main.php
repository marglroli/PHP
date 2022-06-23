<?php
  require_once("Hallgato.php");
  
  $virag = new Hallgato("Cserepes Virág", "1234567890");
  echo "<p>Virág Neptun kódja: ", $virag->getNeptun(), "</p>\n";
  $virag->setNeptun("ABCDEFGHIJKLMNO");
  echo "<p>Virág Neptun kódja: ", $virag->getNeptun(), "</p>\n";

  // $pista = new Hallgato('Trap Pista', 'ABCDEF');
  $pista = new Hallgato('Trap Pista', 'ABCDE2');
  $pista->setNeptun('ABCDEF');