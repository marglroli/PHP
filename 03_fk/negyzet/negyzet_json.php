<?php
header("Content-type: application/json; charset=UTF-8");
if(isset($_GET["szam"]) && is_numeric($_GET["szam"])) {
  $szam = (int)$_GET["szam"];
  echo json_encode(array("alap" => $szam, "kitevo" => 2, "eredmeny" => $szam*$szam));
} else {
  echo json_encode(array("hiba" => "Hibás adat."));
}
?>