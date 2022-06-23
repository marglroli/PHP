<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Űrlapok kezelése</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <?php $szamlalo = isset($_POST["szamlalo"])?$_POST["szamlalo"]+1:1; ?>
    <input type="hidden" name="szamlalo" value="<?php echo $szamlalo ?>">
    <div><label>Szöveg: <input type="text" name="szoveg"></label></div>
    <div><label>Jelszó: <input type="password" name="jelszo"></label></div>
    <fieldset>
      <legend>Rádiógombok</legend>
	<div><label>
	  <input type="radio" name="radio" value="r1" checked>Választás1
	</label></div>
	<div><label>
	  <input type="radio" name="radio" value="r2">Választás2
	</label></div>
      </fieldset>
      <fieldset>
	<legend>Jelölőnégyzetek</legend>
	<div><label>
	  <!-- A név lehetne jelolo[] is, hasonlóan a select-hez! -->
	  <input type="checkbox" name="jelolo1" value="jA" checked>VálasztásA
	</label></div>
	<div><label>
	  <input type="checkbox" name="jelolo2" value="jB">VálasztásB
	</label></div>
      </fieldset>
      <div><label>Legördülő lista<select name="legordulo">
	<option value="l1">1</option>
	<option value="l2">2</option>
      </select></label></div>
      <div><label>Többszörös választás
	<select name="tobbszoros[]" multiple size="2">
	<option value="t1">1</option>
	<option value="t2">2</option>
      </select></label></div>
      <div><label>
	Szerkesztő<textarea name="szerkeszto"></textarea>
      </label></div>
      <div><label>
	<input type="submit" name="kuldes" value="Küldés">
      </label></div>
      <fieldset>
	<legend>Korábban küldött adatok:</legend>
	<pre><?php print_r($_POST); ?></pre>
      </fieldset>
    </form>
  </body>
</html>