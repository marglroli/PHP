<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>03 - PDO</title>
  </head>
  <body>
    <?php
      setlocale(LC_ALL, "hu_HU.UTF-8");
    
      spl_autoload_register(function ($name) {
        require_once("$name.php");
      });

      $ui=new UI();
      $ui->processInput();
      $ui->basicQuery();
      $ui->userTextfields();
      $ui->deleteSelect();
    ?>
  </body>
</html>