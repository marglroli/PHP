<?php
  // jogosultságokra figyelni!
  define("FELHASZNALO", "feltoltes");
  define("KEP_MAPPA", "/home/".FELHASZNALO."/www/");
  
  if (!empty($_FILES["kepek"])) {
    for($i=0; $i<count($_FILES["kepek"]["type"]); $i++) {
      if(strpos($_FILES["kepek"]["type"][$i],"image/") === 0) {
	$nev = $_FILES["kepek"]["name"][$i];
	if(!move_uploaded_file($_FILES["kepek"]["tmp_name"][$i], 
	  KEP_MAPPA.$nev)) {
	  echo "<p>Nem sikerült felmásolni a $nev fájlt.";
	} } } }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Képek feltöltése</title>
  </head>
  <body>
    <h1>Eddig feltöltött képek</h1>
    <?php
      $kepek = array_filter(scandir(KEP_MAPPA), 
	function($fajl) { return is_file(KEP_MAPPA.$fajl); });
      if(empty($kepek)) {
	echo "<p>Nincsenek még képeink, töltsön fel párat!</p>\n";
      } else {
	foreach($kepek as $kep) {
	  $meret = getImageSize(KEP_MAPPA.$kep);
	  echo "<figure>\n
	    <img src=\"/~".FELHASZNALO."/$kep\" 
	      width=\"$meret[0]\" height=\"$meret[1]\">\n
	    <figcaption>$kep</figcaption>\n
	    </figure>\n";
	}
      }
    ?>
    <h1>Új kép feltöltése</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" 
	  method="post" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
      <div><label>
	Képek:<input type="file" name="kepek[]" multiple>
      </label></div>
      <div><input type="submit" value="Küldés"></div>
    </form>
  </body>
</html>