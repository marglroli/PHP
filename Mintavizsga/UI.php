<?php
declare(strict_types=1);

class UI {
    private $db;

    public function __construct(DataBase $db) {
        $this->db = $db;
    }

    private function head() {
        echo <<<END
<!DOCTYPE html>
<html lang="en_US">
    <head>
        <title>Application for classroom test</title>
        <meta charset="utf-8" />
    </head>
    <body>

END;
    }

    private function foot() {
        echo <<<END
    </body>
</html>

END;
    }

    public function studentList() {
        $this->head();
        echo "<p>Select student</p>\n".
             "<form action=\"".$_SERVER["PHP_SELF"]."?page=testTimes\" method=\"post\">\n".
             "<select name=\"neptun\">\n";
        foreach($this->db->getStudents() as $student) {
            echo "<option value=\"{$student->getNeptun()}\">$student</option>\n";
        }
        echo "</select>\n".
             "<input type=\"submit\" value=\"Next\" />\n".
             "</form>\n";
        $this->foot();
    }

    public function testTimes() {
        $this->head();
        $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
        $app = $this->db->getApplication($neptun);
        if($app === false) {
            echo "<p>Select test time</p>\n".
                 "<form action=\"".$_SERVER["PHP_SELF"]."?page=apply\" method=\"post\">\n".
                 "<select name=\"test\">\n";
            foreach($this->db->getTestTimes() as $test) {
                echo "<option value=\"{$test->getId()}\">{$test->getTime()}</option>\n";
            }
            echo "</select>\n".
                 "<input type=\"hidden\" name=\"neptun\" value=\"$neptun\" />\n".
                 "<input type=\"submit\" value=\"Apply\" />\n".
                 "</form>\n";
        } else {
            echo "<p>You've already registered for a test: {$app->getTime()}.</p>\n";
            if($app->getPoint() == -1) {
                echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=clear\" method=\"post\">\n".
                     "<input type=\"hidden\" name=\"neptun\" value=\"$neptun\" />\n".
                     "<input type=\"submit\" value=\"Clear\" />\n".
                     "</form>\n";
            } else {
                echo "<p>You achieved {$app->getPoint()} points.</p>\n";
            }
            echo "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        }
        $this->foot();
    }

    public function apply() {
        $this->head();
        $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
        $time = filter_input(INPUT_POST, "test", FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
        if($this->db->addApplication($neptun, $time)) {
            echo "<p>Success :)</p>\n";
        } else {
            echo "<p>Error</p>\n";
        }
        echo "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        $this->foot();
    }

    public function clear() {
        $this->head();
        $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
        if($this->db->clearApplication($neptun)) {
            echo "<p>Application cleared.</p>\n";
        } else {
            echo "<p>You've already earned points.</p>\n";
        }
        echo "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        $this->foot();
    }

    public function teacher() {
        $this->head();
        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=points\" method=\"post\">\n";
        foreach($this->db->getAllTestTimes() as $test) {
            echo "<table>\n".
                 "<caption>$test</caption>\n".
                 "<tr><th>Student</th><th>Points</th></tr>\n";
            foreach($this->db->getApplications($test->getId()) as $app) {
                $points = $app->getPoint()==-1 ? "" : $app->getPoint();
                echo "<tr><td>{$app->getStudent()}</td><td><input type=\"number\" min=\"0\" name=\"{$app->getStudent()->getNeptun()}\" value=\"$points\" /></td></tr>\n";
            }
            echo "</table>\n";
        }
        echo "<input type=\"submit\" value=\"Save\" />\n".
             "</form>\n".
             "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        $this->foot();
    }

    public function points() {
        $this->head();
        foreach($this->db->getApplications() as $app) {
            $neptun = $app->getStudent()->getNeptun();
            $points = filter_input(INPUT_POST, $neptun, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
            if(gettype($points) == "integer") {
                $this->db->setPoints($neptun, $points);
            }
        }
        echo "<p>Points saved.</p>\n".
             "<p><a href=\"".$_SERVER["PHP_SELF"]."?page=teacher\">Back to teacher's page.</a></p>\n".
             "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        $this->foot();
    }
}