<?php
  $dal = 'Az én kedvesem egy olyan lány, akit
farkasok neveltek és
táncolt egy délibábbal,
majd elillant csendesen
az én kedvesem.
Ő az én kedvesem.';
  $szo = 'kedvesem';
  echo "<p>Teljes dalszöveg:</p>\n<pre>$dal</pre>\n
        <p>'$szo' előfordulásainak indexei:</p>\n
        <ul>\n";
  $kezd = -1;
  while(($kezd = strpos($dal, $szo, $kezd+1)) !== FALSE) {
    echo "<li>$kezd</li>\n";
  }
  echo "</ul>\n";

  $t = explode(',', 'Opel,Volkswagen,Ford,Suzuki,Honda,Toyota');
  echo "<p>A fellelt márkák:</p>\n<ul>\n";
  foreach($t as $m) {
    echo "<li>$m</li>\n";
  }
  echo "</ul>\n<p>Összefűzve: ", $s=implode(', ', $t), ".</p>\n";
  
  echo "<p>md5: ", md5($s), ", sha1: ", sha1($s), ", password_hash: ", 
    password_hash($s, PASSWORD_DEFAULT), "</p>\n";
