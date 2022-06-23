<?php
  define("FELHASZNALO", "Andi"); // függvényben is deklarálható
  echo "<p>Üdvözlöm, kedves ", FELHASZNALO, "!</p>\n";
  echo "<p>A PHP értelmező verziószáma: ", PHP_VERSION, "</p>\n";
  echo "<p>Ez a sor áll értelmezés alatt: ", __LINE__, "</p>\n";
  
  const ELET_ERTELME = 42; // csak globális szinten deklarálható
  echo "<p>Az élet értelme még mindig ", ELET_ERTELME, "</p>\n";