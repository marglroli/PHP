<?php
header("Content-type: text/plain; charset=UTF-8");
if(isset($_POST["szam"]) && is_numeric($_POST["szam"])) {
  $szam = $_POST["szam"];
  echo $szam * $szam;
} else {
  echo "Hibás adat.";
}
?>