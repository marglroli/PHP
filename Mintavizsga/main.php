<?php
declare(strict_types=1);

spl_autoload_register(function ($name) {
    require_once("$name.php");
});

$ui = new UI(new DataBase());
$page = "";
if(filter_has_var(INPUT_GET, "page")) {
    $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);
}
$pageList = ["studentList", "testTimes", "apply", "clear", "teacher", "points"];
if(in_array($page, $pageList)) {
    $ui->$page();
} else {
    $ui->studentList();
}
