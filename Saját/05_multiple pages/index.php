<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>05 - PDO with multiple pages</title>
  </head>
  <body>
    <?php
      setlocale(LC_ALL, "hu_HU.UTF-8");
    
      spl_autoload_register(function ($name) {
        require_once("$name.php");
      });

      $ui=new UI();

      $page = "";
      if(filter_has_var(INPUT_GET, "page")) {
        $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);
      }

      //"..." , "..." is important lol
      $pageList = ["select", "details"];
      if(in_array($page, $pageList)) {
        $ui->$page();
      } else {
        $ui->select();
      }
      
    ?>
  </body>
</html>