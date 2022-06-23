<?php
header("Content-type: text/plain; charset=utf-8");
if(filter_has_var(INPUT_GET, "a") && filter_has_var(INPUT_GET, "b") && filter_has_var(INPUT_GET, "c")) {
  $a = filter_input(INPUT_GET, "a", FILTER_VALIDATE_FLOAT);
  $b = filter_input(INPUT_GET, "b", FILTER_VALIDATE_FLOAT);
  $c = filter_input(INPUT_GET, "c", FILTER_VALIDATE_FLOAT);
  if(gettype($a)=="double" && gettype($b)=="double" && gettype($c)=="double") {
    if($a != 0) {
      $d = $b*$b - 4*$a*$c;
      if($d < 0) {
        echo "A megadott adatokkal az egyenletnek nincs valós gyöke.";
      } elseif($d == 0) {
        echo "Az egyenlet egyetlen gyöke: ".(-$b)/(2*$a);
      } else {
        echo "Az egyenlet gyökei:<ul>";
        echo "<li>".(-$b+sqrt($d))/(2*$a)."</li>";
        echo "<li>".(-$b-sqrt($d))/(2*$a)."</li>";
        echo "</ul>\n";
      }
    } else {
      echo "Ez az egyenlet nem másodfokú.";
    }
  } else {
    echo "Hibás bemenet.";
  }
}
