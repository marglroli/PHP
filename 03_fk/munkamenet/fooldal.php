<?php
  function fej() {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
	<meta charset="utf-8">
	<title>Vállalati weboldal</title>
      </head>
      <body>
	<h1>Vállalati weboldal</h1>
    <?php
    $hiv = [
      "bejelentkezes" => "Bejelentkezés",
      "nyilvanos" => "Nyilvános oldal",
      "titkos" => "Titkos oldal",
      "kijelentkezes" => "Kijelentkezés"
    ];
  
    $menu = [];
    foreach($hiv as $k => $e) {
      $menu[] = "<a href=\"".$_SERVER['PHP_SELF'].
	"?o=".urlencode($k)."\">$e</a>";
    }
    echo "<p>", implode(" | ", $menu), "</p>\n";
  }
  
  function lab() {
    ?>
    </body>
    </html>
    <?php
  }
  
  function munkamenet() {
    if(!empty($_POST["nev"]) && !empty($_POST["jelszo"])) {
      if($_POST["nev"] === "a" && $_POST["jelszo"]==="b") {
	$_SESSION["bejelentkezett"] = true;
	echo "<p>Sikeres bejelentkezés.</p>\n";
      } else {
	echo "<p>A felhasználónév vagy a jelszó hibás.</p>\n";
      }
    }
  }

  session_start();
  fej();
  munkamenet();
  if(!empty($_GET["o"])) {
    include_once($_GET["o"].".php");
  }
  lab();