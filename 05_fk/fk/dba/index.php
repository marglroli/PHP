<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Database Abstraction Layer (DBA)</title>
  </head>
  <body>
    <?php
      setlocale(LC_ALL, "hu_HU.UTF-8");
      
      spl_autoload_register(function ($osztaly) {
	include_once($osztaly.".php");
      });

      $ef = new Evfolyam();
      $ef->feldolgozas();
      $ef->lista();
      $ef->urlap();
    ?>
  </body>
</html>
