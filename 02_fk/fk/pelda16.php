<?php
  $globA = 1; $globB = 2;
  
  function fv() {
    global $globB;
    $lokalA = 3; $lokalB = 4;
    echo "<p>Fv-en belül: \$globA == $globA, \$globB == $globB, ",
      "\$lokalA == $lokalA, \$lokalB == $lokalB</p>\n";
  }
  fv();
  echo "<p>Fv-en kívül: \$globA == $globA, \$globB == $globB, ",
    "\$lokalA == $lokalA, \$lokalB == $lokalB</p>\n";