<?php
  // egészekkel indexelt tömbök
  $nemetBalna = ['Mercedes', 'BMW', 'Audi'];
  $egyebBalna = array('Jaguar', 'Lexus');
  $francia = [	// Az indexelés nem feltétlenül sorfolytonos
    1 => 'Peugeot',
    3 => 'Citroen',
    7 => 'Renault',
    -5 => 'DS'	// és lehet negatív is
  ];
  
  // karakterláncokkal indexelt tömbök
  $hallgatok = [
    'ABC123' => 'Nemoda Buda',
    'QWE456' => 'Remek Elek',
    'A1B2C3' => 'Trab Antal'
  ];
  
  // Több dimenziós tömb
  $tantargy = array(
    'NGB_IN023_1' => array( // Kulcsok/értékek típusainak nem
      'nev' => 'Web-technológia I.', // kell azonosnak lennie
      'kredit' => 4,
      'eloadas' => 3,
      'gyakorlat' => 0,
      'labor' => 0
    ),
    'NGB_IN023_2' => array(
      'nev' => 'Web-technológia II.',
      'kredit' => 4,
      'eloadas' => 0,
      'gyakorlat' => 3,
      'labor' => 0
    )
  );
  
  // Tömb megjelenítése
  echo '<pre>';
  var_dump($francia);
  echo "</pre>\n";
  
  echo '<pre>';
  print_r($tantargy);
  echo "</pre>\n";
  
  // Tömelemek utólag módosíthatók
  $nemetBalna[0] = 'Mercedes-Benz';
  // Tömbök utólag bővíthatők
  $francia[42] = 'Matra';
  $egyebBalna[] = 'Volvo'; // a sor végére teszi az új elemet
  $tantargy['NGB_IN001_1'] = array(
    'nev' => 'Programozás I.',
    'kredit' => 5,
    'eloadas' => 2,
    'gyakorlat' => 2,
    'labor' => 0
  );
  
  echo "<p>\$nemetBalna elemszáma: ", count($nemetBalna), "</p>\n";
  echo "<p>Van a \$francia tömbnek 42-es indexű eleme? ", isset($francia[42])?'Van.':'Nincs.', "</p>\n";
  unset($francia[42]);
  echo "<p>Még mindig van? ", isset($francia[42])?'Van.':'Nincs.', "</p>\n";
  echo "<p>Az \$egyebBalna üres? ", empty($egyebBalna)?'Igen.':'Nem.', "</p>\n";
  
  // Keresés
  echo "<p>A Volvo is bálna? ", in_array('Volvo', $egyebBalna)?'Igen.':'Nem.', "<br>\n";
  echo 'Mi a kulcsa? ', ($i=array_search('Volvo', $egyebBalna))===FALSE?'Nincs kulcsa.':$i, "</p>\n";
  echo "<p>A Trabant is bálna? ", in_array('Trabant', $egyebBalna)?'Igen.':'Nem.', "<br>\n";
  echo 'Mi a kulcsa? ', ($i=array_search('Trabant', $egyebBalna))===FALSE?'Nincs kulcsa.':$i, "</p>\n";
  
  // Rendezés
  $nevek = $nevek1 = $nevek2 = $nevek3 = $nevek4 = 
    ['Aladár', -3 => 'Zsuzsi', 'Álmos', 50 => 'Mihály', 'Béla', 'Réka'];
  echo "<p>Eredeti tartalom:</p>\n<pre>"; print_r($nevek); echo "</pre>\n";
  sort($nevek1);
  echo "<p>sort() hatása:</p>\n<pre>"; print_r($nevek1); echo "</pre>\n";
  asort($nevek2);
  echo "<p>asort() hatása:</p>\n<pre>"; print_r($nevek2); echo "</pre>\n";
  ksort($nevek3);
  echo "<p>ksort() hatása:</p>\n<pre>"; print_r($nevek3); echo "</pre>\n";
  setlocale(LC_ALL, "hu_HU.UTF-8");
  usort($nevek4, "strcoll");
  echo "<p>usort() hatása:</p>\n<pre>"; print_r($nevek4); echo "</pre>\n";
