<?php
declare(strict_types=1);

class UI {
    private $app;

    public function __construct(Applications &$app) {
        $this->app = $app;
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
        foreach($this->app->getStudents() as $student) {
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
        //$neptun = $_POST["neptun"];
        $test = $this->app->getApplication($neptun);
        if($test === false) {
            echo "<p>Select test time</p>\n".
                 "<form action=\"".$_SERVER["PHP_SELF"]."?page=apply\" method=\"post\">\n".
                 "<select name=\"test\">\n";
            foreach($this->app->getTestTimes() as &$test) {
                if($this->app->isChoosable($test)) {
                    echo "<option value=\"{$test->getUnixTime()}\">{$test->getFormattedTime()}</option>\n";
                }
            }
            echo "</select>\n".
                 "<input type=\"hidden\" name=\"neptun\" value=\"$neptun\" />\n".
                 "<input type=\"submit\" value=\"Apply\" />\n".
                 "</form>\n";
        } else {
            echo "<p>You've already registered for a test: {$test['test']->getFormattedTime()}.</p>\n";
            if($test["point"] == -1) {
                echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=clear\" method=\"post\">\n".
                     "<input type=\"hidden\" name=\"neptun\" value=\"$neptun\" />\n".
                     "<input type=\"submit\" value=\"Clear\" />\n".
                     "</form>\n";
            } else {
                echo "<p>You achieved {$test['point']} points.</p>\n";
            }
            echo "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        }
        $this->foot();
    }

    public function apply() {
        $this->head();
        $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
        $time = filter_input(INPUT_POST, "test", FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
        if(($msg = $this->app->addApplication($neptun, $time)) === true) {
            echo "<p>Success :)</p>\n";
        } else {
            echo "<p>Error: $msg</p>\n";
        }
        echo "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        $this->foot();
    }

    public function clear() {
        $this->head();
        $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
        if($this->app->clearApplication($neptun)) {
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
        foreach($this->app->getTestTimes() as $test) {
            echo "<table>\n".
                 "<caption>$test</caption>\n".
                 "<tr><th>Student</th><th>Points</th></tr>\n";
            foreach($this->app->getApplications($test) as $app) {
                $points = $app["point"]==-1 ? "" : $app["point"];
                echo "<tr><td>{$app['student']}</td><td><input type=\"number\" min=\"0\" name=\"{$app['student']->getNeptun()}\" value=\"$points\" /></td></tr>\n";
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
        foreach($this->app->getApplications() as &$app) {
            $neptun = $app["student"]->getNeptun();
            $points = filter_input(INPUT_POST, $neptun, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
            if(gettype($points) == "integer") {
                $this->app->setPoints($neptun, $points);
            }
        }
        echo "<p>Points saved.</p>\n".
             "<p><a href=\"".$_SERVER["PHP_SELF"]."?page=teacher\">Back to teacher's page.</a></p>\n".
             "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Back to the main page.</a></p>\n";
        $this->foot();
    }
}