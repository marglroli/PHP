<?php
  $homerseklet = 23;
  if($homerseklet < -10) {
    echo "<p>Farkasordító hideg.</p>\n";
  } else if($homerseklet < 0) {
    echo "<p>Zima van.</p>\n";
  } elseif($homerseklet < 10) {  // elseif!
    echo "<p>Friss az idő.</p>\n";
  } else if($homerseklet < 20) {
    echo "<p>Elkél egy pulóver.</p>\n";
  } else if($homerseklet < 30){
    echo "<p>Irány a természet!</p>\n";
  } else {
    echo "<p>Klímákat bekapcsolni!</p>\n";
  }
  
  $bejel = true;
  if($bejel) {
?>
  <p>Ön bejelentkezett a fiókjába.</p>
<?php
  } else {
?>
  <p>Ön vendégként használja az oldalunkat.</p>
<?php
  }
  
  if($bejel): ?>
  <p>Ön bejelentkezett a fiókjába.</p>
  <?php else: ?>
  <p>Ön vendégként használja az oldalunkat.</p>
  <?php endif; ?>
  