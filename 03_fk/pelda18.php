<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Szuperglobális változók</title>
  </head>
  <body>
  <?php
    $szgvalt = [
      '$_GET' => $_GET, '$_POST' => $_POST, 
      '$_COOKIE' => $_COOKIE, '$_REQUEST' => $_REQUEST, 
      '$_SERVER' => $_SERVER, '$_ENV' => $_ENV, 
      '$_FILES' => $_FILES
    ];
    foreach($szgvalt as $k=>$v) {
      echo "<h1>$k</h1>\n<pre>";
      print_r($v);
      echo "</pre>\n";
    }
  ?>
  </body>
</html>