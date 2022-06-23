<!DOCTYPE html>
<html lang="hu-HU">
  <head>
    <title>Másodfokú egyenlet</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <form action="http://xenia.sze.hu/~wajzy/fk/masodfoku/mf1.php">
      <fieldset>
        <legend>Adja meg a másodfokú egyenlet (<var>ax</var><sup>2</sup>+<var>bx</var>+<var>c</var>=0, ahol <var>a</var>&ne;0) együtthatóit!</legend>
        <div><label>a=<input name="a" type="number" step="any" required="required" /></label></div>
        <div><label>b=<input name="b" type="number" step="any" required="required" /></label></div>
        <div><label>c=<input name="c" type="number" step="any" required="required" /></label></div>
        <div><input type="submit" value="Számolás" /></div>
      </fieldset>
    </form>
<?php
if(isset($_GET["a"]) && isset($_GET["b"]) && isset($_GET["c"])) {
  $a = $_GET["a"]; $b=$_GET["b"]; $c=$_GET["c"];
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
}
?>
  </body>
</html>
