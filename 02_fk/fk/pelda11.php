<?php
  $sor = 3;
  $oszlop = 2;
  
  echo "<table>\n";
  for($s=0; $s<$sor; $s++) {
    echo "  <tr>\n";
    $o=0;
    while($o < $oszlop) {
      echo "    <td>", chr($s+ord('A')).$o, "</td>\n";
      $o++;
    }
    echo "  </tr>\n";
  }
  echo "</table>\n";
  
  $tartalom = [
    ['Beosztás', 'Fizetés'],
    ['Főnök', 1000000],
    ['Beosztott', 100000],
    ['Feketemunkás', 10000]
  ];
  
  echo "<table>\n";
  foreach($tartalom as $sor) {
    echo "  <tr>\n";
    foreach($sor as $cella) {
      echo "    <td>", 
      gettype($cella)==='integer'?number_format($cella, 0, ',', ' '):$cella, 
      "</td>\n";
    }
    echo "  </tr>\n";
  }
  echo "</table>\n";
  