<?php
  $ho = 'Február';
  
  switch($ho) {
    case 'Január':
    case 'Február':
    case 'December':
      echo "<p>Tél</p>\n";
      break;
    case 'Március':
    case 'Április':
    case 'Május':
      echo "<p>Tavasz</p>\n";
      break;
    case 'Június':
    case 'Július':
    case 'Augusztus':
      echo "<p>Nyár</p>\n";
      break;
    case 'Szeptember':
    case 'Október':
    case 'November':
      echo "<p>Ősz</p>\n";
      break;
    default:
      echo "<p>Ismeretlen hónap</p>\n";
      break;
  }