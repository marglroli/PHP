<!DOCTYPE html>
<html lang="hu-HU">
  <head>
    <title>Másodfokú egyenlet</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <form action="http://xenia.sze.hu/~wajzy/fk/masodfoku/mf2.php">
      <fieldset>
        <legend>Adja meg a másodfokú egyenlet (<var>ax</var><sup>2</sup>+<var>bx</var>+<var>c</var>=0, ahol <var>a</var>&ne;0) együtthatóit!</legend>
        <div><label>a=<input name="a" type="number" step="any" required="required" /></label></div>
        <div><label>b=<input name="b" type="number" step="any" required="required" /></label></div>
        <div><label>c=<input name="c" type="number" step="any" required="required" /></label></div>
        <div><input type="submit" value="Számolás" /></div>
      </fieldset>
    </form>
<?php
if(filter_has_var(INPUT_GET, "a") && filter_has_var(INPUT_GET, "b") && filter_has_var(INPUT_GET, "c")) {
  $a = filter_input(INPUT_GET, "a", FILTER_VALIDATE_FLOAT);
  $b = filter_input(INPUT_GET, "b", FILTER_VALIDATE_FLOAT);
  $c = filter_input(INPUT_GET, "c", FILTER_VALIDATE_FLOAT);
  if(gettype($a)=="double" && gettype($b)=="double" && gettype($c)=="double") {
    if($a != 0) {
      $d = $b*$b - 4*$a*$c;
      if($d < 0) {
        echo "<p>A megadott adatokkal az egyenletnek nincs valós gyöke.</p>";
      } elseif($d == 0) {
        echo "<p>Az egyenlet egyetlen gyöke: ".(-$b)/(2*$a)."</p>";
      } else {
        echo "<p>Az egyenlet gyökei:</p><ul>";
        echo "<li>".(-$b+sqrt($d))/(2*$a)."</li>";
        echo "<li>".(-$b-sqrt($d))/(2*$a)."</li>";
        echo "</ul>\n";
      }
    } else {
      echo "<p>Ez az egyenlet nem másodfokú.</p>";
    }
  } else {
    echo "<p>Hibás bemenet.</p>";
  }
}
?>
  </body>
</html>
