<?php
declare(strict_types=1);
define("FILENAME", "app.dat");

spl_autoload_register(function ($name) {
    require_once("$name.php");
});

$applications = null;
if(($file = file_get_contents(FILENAME)) === false) {
    $applications = new Applications();
    $applications->addStudent(new Student("John Doe", "ABC123"));
    $applications->addStudent(new Student("Jane Doe", "DEF456"));
    $applications->addStudent(new Student("Marilyn Monroe", "GHI789"));
    $applications->addTestTime(new TestTime(new DateTime("2021-04-10 12:00:00"), 2));
    $applications->addTestTime(new TestTime(new DateTime("2021-04-11 08:00:00"), 2));
} else {
    $applications = unserialize($file);
}

$ui = new UI($applications);
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

file_put_contents(FILENAME, serialize($applications));