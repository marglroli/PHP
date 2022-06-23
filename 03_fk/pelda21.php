<?php
  $ujraTolt = false;
  if(!empty($_POST["nev"]) && // létrehozás
     !empty($_POST["ertek"])) {
    setcookie($_POST["nev"], $_POST["ertek"], time()+60*60*24);
    $ujraTolt = true;
  }
  foreach($_POST as $k => $v) { // törlés
    if(substr($k, 0, 2) === "t_") {
      $nev = substr($k, 2);
      $ertek = $_COOKIE[$nev];
      setcookie($nev, $ertek, time()-1);
      $ujraTolt = true;
    }
  }
  if($ujraTolt) { // oldal újratöltése
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sütik kezelése</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
      <h1>Jelenlegi sütik és tartalmuk</h1>
      <?php
	if(empty($_COOKIE)) {
	  echo "<p>Nincsenek sütik.</p>";
	} else {
	  echo "<p>Törléshez jelölje a sütiket.</p>\n";
	  echo "<ol>\n";
	  foreach($_COOKIE as $k => $v) {
	    echo "  <li><input type=\"checkbox\" 
	         name=\"t_$k\">$k : $v</li>\n";
	  }
	  echo "</ol>\n";
	}
      ?>
      <h1>Új süti felvétele</h1>
      <div><label>Név:<input type="text" name="nev"></label></div>
      <div><label>Érték:<input type="text" name="ertek"></label></div>
      <div><input type="submit" name="kuldes" value="Küldés"></div>
    </form>
  </body>
</html>