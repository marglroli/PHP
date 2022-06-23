<?php
  require_once("Hallgato.php");
  
  $istvan = new Hallgato("Trap Pista");
  $virag = new Hallgato("Cserepes Virág", "XYZ123");
  
  echo "<p>", $istvan->getNev(), " : ", $istvan->getNeptun(), "</p>\n";
  $istvan->setNeptun("QWERTZ");
  echo "<p>István új kódja: ", $istvan->getNeptun(), "</p>\n";
  echo "<p>", $virag, "</p>\n";
  
  $buta = new Hallgato(1.2, true); //implicit típuskonverziók
  echo "<pre>";
  var_dump($buta);
  echo "</pre>\n";