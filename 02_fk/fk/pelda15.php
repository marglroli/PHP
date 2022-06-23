<?php
  declare(strict_types=1); // A fájl első utasítása legyen!
  
  function szorzas(int $a, int $b) : int {
    return $a * $b;
  }
  
  echo "<p>1*2*3*4=", szorzas(szorzas(szorzas(1, 2), 3), 4), "</p>\n";
  
  function osszead(int $a) : int {
    static $osszeg;
    return $osszeg += $a;
  }
  
  osszead(1); osszead(2); osszead(3);
  echo "<p>1+2+3+4=", osszead(4), "</p>\n";