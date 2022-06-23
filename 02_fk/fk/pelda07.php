<?php
  // Logikai operátorok
  echo "true && false == ", var_dump(true&&false), "<br>\n";
  echo "true || false == ", var_dump(true||false), "<br>\n";
  echo "!true == ", var_dump(!true), "<br>\n";
  // Karakterláncok összefűzése
  echo 'Nagyon '.'hosszú '.'szöveg.'."<br>\n";
  // Értékadás és összetett operátorok
  $v = 42; echo "\$v == $v<br>\n";
  $v += 2; echo "\$v == $v<br>\n";
  $v -= 3; echo "\$v == $v<br>\n";
  $v *= 2; echo "\$v == $v<br>\n";
  $v /= 3; echo "\$v == $v<br>\n";
  $v .= ' ló'; echo "\$v == $v<br>\n";
  // Növelés és csökkentés
  $v = 5;
  $v++; ++$v; echo "\$v == $v<br>\n";
  $v--; --$v; echo "\$v == $v<br>\n";
  