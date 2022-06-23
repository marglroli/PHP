<?php
header("Content-type: application/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>\n<negyzet>\n";
if(isset($_GET["szam"]) && is_numeric($_GET["szam"])) {
  $szam = $_GET["szam"];
  echo "\t<alap>$szam</alap>\n";
  echo "\t<kitevo>2</kitevo>\n";
  echo "\t<eredmeny>".$szam*$szam."</eredmeny>\n";
} else {
  echo "\t<hiba>Hibás adat.</hiba>\n";
}
echo "</negyzet>\n";
?>