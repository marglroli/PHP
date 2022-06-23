<?php
  $v = '42';
  settype($v, 'integer');
  var_dump($v);
  
  $d = (double)$v;
  echo '<br>$d típusa: ', gettype($d);