<?php
  if(empty($_SESSION["bejelentkezett"]) || 
    $_SESSION["bejelentkezett"]===false) {
    echo "<p>Előbb <a href=\"", $_SERVER["PHP_SELF"], 
      "?o=bejelentkezes\">jelentkezzen be</a>, hogy elolvashassa.</p>\n";
    return;
  }
?>
<p>Ez a tartalom szupertitkos, nagy szerencse, hogy bejelentkezett.</p>