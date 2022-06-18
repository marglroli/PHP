<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>01 - PDO</title>
  </head>
  <body>
    <?php
      setlocale(LC_ALL, "hu_HU.UTF-8");
    
      spl_autoload_register(function ($name) {
        require_once("$name.php");
      });

      $ui=new UI();
      $ui->basicQuery();
      
    ?>
  </body>
</html>