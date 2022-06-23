<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Szűrők használata</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <?php
	$validSzuro = [ FILTER_VALIDATE_EMAIL, FILTER_VALIDATE_FLOAT, 
	                FILTER_VALIDATE_IP, FILTER_VALIDATE_URL];
	$tisztitoSzuro = [ FILTER_SANITIZE_EMAIL, FILTER_SANITIZE_NUMBER_FLOAT,
	                   FILTER_SANITIZE_STRING, FILTER_SANITIZE_URL ];
	if(filter_has_var(INPUT_POST, "szoveg")) {
	  if(($szurt=filter_var($_POST["szoveg"], 
	      $validSzuro[$_POST["validalas"]]))===FALSE) {
	    echo "<p>A tartalom nem érvényes.</p>\n";
	  } else {
	    echo "<p>A szűrt tartalom: $szurt</p>\n";
	  }
	  if(($tiszta=filter_input(INPUT_POST, "szoveg", 
	      $tisztitoSzuro[$_POST["tisztitas"]]))===FALSE) {
	    echo "<p>Tisztítási hiba.</p>\n";
	  } else {
	    echo "<p>A tisztított tartalom: $tiszta</p>\n";
	  }
	}
      ?>
      <div><label>Szöveg: <input type="text" name="szoveg"></label></div>
      <div><label>Validálás: <select name="validalas">
	<option value="0">E-Mail</option>
	<option value="1">Szám</option>
	<option value="2">IP-cím</option>
	<option value="3">URL</option>
      </select></label></div>
      <div><label>Tisztítás: <select name="tisztitas">
	<option value="0">E-Mail</option>
	<option value="1">Szám</option>
	<option value="2">Karakterlánc</option>
	<option value="3">URL</option>
      </select></label></div>
      <div><input type="submit" name="kuldes" value="Küldés"></div>
    </form>
  </body>
</html>