<?php
  // Definíciók
  $a = 10;
  $b = 3;
  // Aritmetikai operátorok
  echo "$a + $b = ", $a+$b, "<br>\n";
  echo "$a - $b = ", $a-$b, "<br>\n";
  echo "$a * $b = ", $a*$b, "<br>\n";
  echo "$a / $b = ", $a/$b, "<br>\n";
  echo "$a % $b = ", $a%$b, "<br>\n";
  echo "$a ** $b = ", $a**$b, "<br>\n";
  echo "-$a = ", -$a, "<br>\n";
  // Implicit típuskonverzió (type juggling)
  $a = "10";
  echo "$a + $b = ", $a+$b, "<br>\n";