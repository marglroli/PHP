<?php
  $nev = "Gabi"; // Változó definíció
  
  print 'Név: $nev<br>\n'; // Nincs helyettesítés
  print "Név: $nev<br>\n"; // Van helyettesítés
  print("Név: $nev<br>\n");// Fv.-szerű alak, bár nyelvi elem
  // Nowdoc
  print <<<'NOW'
    Név: $nev<br>\n
NOW;
  // Heredoc
  print <<<HERE
    Név: $nev<br>\n
HERE;
  echo "Név: $nev<br>\n";
  echo "Több sorba
    tördelt forrásszöveg.";
?>

HTML <?='PHP'?> HTML
