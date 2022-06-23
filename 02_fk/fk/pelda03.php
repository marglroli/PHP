<?php
  // Hogyan jelenik meg a logikai érték?
  $v = true;
  var_dump($v);
  echo " Érték: $v, Típus: ", gettype($v), "<br>\n";
  
  $v = false;
  var_dump($v);
  echo " Érték: $v, Típus: ", gettype($v), "<br>\n";
  
  $v = 42;
  var_dump($v);
  echo " Érték: $v, Típus: ", gettype($v), "<br>\n";
  
  $v = 3.14;
  var_dump($v);
  echo " Érték: $v, Típus: ", gettype($v), "<br>\n";
  
  $v = "szöveg";
  var_dump($v);
  echo " Érték: $v, Típus: ", gettype($v), "<br>\n";
