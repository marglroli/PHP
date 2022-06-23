<?php
  echo setlocale(LC_ALL, 'hu_HU.UTF-8')===FALSE ? 
    "Hiba a hely beállítása során!<br>\n" : 
    "Magyar hely beállítva.<br>\n";

  $s = 'Micimackó'; // Mennyi az annyi? Miért?
  echo "'$s' karaktereinek száma: ", strlen($s), "<br>\n";
  
  $s = trim('   Tartalom   ');
  echo "'$s' karaktereinek száma: ", strlen($s), "<br>\n";
  
  $s = 'Árvíztűrő Tükörfúrógép';
  echo 'Eredeti karakterlánc: ', $s, 
       ', kisbetűkkel: ', strtolower($s), 
       ', nagybetűkkel: ', strtoupper($s), "<br>\n";
  
  $s = 'Életem egyetlen szerelme, Lujza';
  $mit = 'Lujza';
  $mire = 'Ilonka';
  echo str_replace($mit, $mire, $s), "<br>\n";
  
  $s = 'abcdef';
  echo 'Első három betű: ', substr($s, 0, 3),
       ', utolsó három: ', substr($s, -3),
       ', középső kettő: ', substr($s, 2, 2), "<br>\n";