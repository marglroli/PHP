<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Doctrine2 ORM</title>
  </head>
  <body>
    <?php
      setlocale(LC_ALL, "hu_HU.UTF-8");
    
      require_once "bootstrap.php";
      spl_autoload_register(function ($name) {
        require_once "src/$name.php";
      });
    
      $ef = new Evfolyam($entityManager);
      $ef->feldolgozas();
      $ef->lista();
      $ef->urlap();
    ?>
  </body>
</html>
