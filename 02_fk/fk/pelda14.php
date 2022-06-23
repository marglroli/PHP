<?php
  // Nem szükséges a hívás előtt deklarálni
  function fejlec($info, $meret=1) {
    echo "<h$meret>$info</h$meret>\n";
  }
  
  fejlec('Üdvözöllek dicső lovag');
  fejlec('Szép a ruhád, szép vagy magad', 3);
  
  function osszead() {
    $db = func_num_args();
    $osszeg = 0;
    for($i=0; $i<$db; $i++) {
      $osszeg += func_get_arg($i);
    }
    return $osszeg;
  }
  
  echo "<p>1+2+3=", osszead(1, 2, 3), "</p>\n";
  
  
  function kiir($a, $b) {
    echo "<p>\$a értéke: $a, \$b értéke: $b</p>\n";
  }
  // érték szerinti paraméter-átadás
  function csereErtek($a, $b) {
    $csere = $a;
    $a = $b;
    $b = $csere;
  }
  // referencia szerinti paraméter-átadás
  function csereRef(&$a, &$b) {
    $csere = $a;
    $a = $b;
    $b = $csere;
  }
  
  $szam1 = 3;
  $szam2 = 5;
  
  kiir($szam1, $szam2);
  csereErtek($szam1, $szam2);
  kiir($szam1, $szam2);
  csereRef($szam1, $szam2);
  kiir($szam1, $szam2);