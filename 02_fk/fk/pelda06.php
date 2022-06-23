<?php
  // Relációs operátorok
  echo "1 < 2 --> ", var_dump(1 < 2), "<br>\n";
  echo "1 > 2 --> ", var_dump(1 > 2), "<br>\n";
  echo "1 <= 2 --> ", var_dump(1 <= 2), "<br>\n";
  echo "1 >= 2 --> ", var_dump(1 >= 2), "<br>\n";
  // Spaceship operator
  echo "1 <=> 2 --> ", var_dump(1 <=> 2), "<br>\n";
  echo "1 <=> 1 --> ", var_dump(1 <=> 1), "<br>\n";
  echo "2 <=> 1 --> ", var_dump(2 <=> 1), "<br>\n";
  // Egyezőségi operátorok
  echo "1 == '1' --> ", var_dump(1 == '1'), "<br>\n";
  // Nincs implicit típuskonverzió!
  echo "1 === '1' --> ", var_dump(1 === '1'), "<br>\n";
  echo "1 != '1' --> ", var_dump(1 != '1'), "<br>\n";
  echo "1 <> '1' --> ", var_dump(1 <> '1'), "<br>\n";
  // Nincs implicit típuskonverzió!
  echo "1 !== '1' --> ", var_dump(1 !== '1'), "<br>\n";