<?php
header("Content-type: text/plain; charset=UTF-8");
if(isset($_GET["szam"]) && is_numeric($_GET["szam"])) {
  $szam = $_GET["szam"];
  echo $szam * $szam;
} else {
  echo "Hibás adat.";
}
?>