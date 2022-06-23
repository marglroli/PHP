<?php
  require_once("File.php");
  
  $f = new File("File.php", "r");
  echo "<pre>\n";
  while(!$f->feof()) {
    echo $f->fgets();
  }
  echo "</pre>\n";
  echo "<p>A fájlleíró értéke: ", $f->fp, "</p>\n";