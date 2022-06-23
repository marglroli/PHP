<?php
declare(strict_types=1);

class Applications {
    private $students;
    private $testTimes;
    private $applications;

    public function __construct() {
        $this->students = [];
        $this->testTimes = [];
        $this->applications = [];
    }

    public function addStudent(Student &$student) {
        $this->students[] = $student;
    }

    public function getStudents() : array {
        return $this->students;
    }

    public function addTestTime(TestTime &$testTime) {
        $this->testTimes[] = $testTime;
    }

    public function getTestTimes() : array {
        return $this->testTimes;
    }

    public function isChoosable(TestTime $time) : bool {
        $applicants = 0;
        foreach($this->applications as $app) {
            if($app["test"] == $time) {
                $applicants++;
            }
        }
        return $applicants < $time->getCapacity();
    }

    public function addApplication(string $neptun, int $time) {
        $studentIdx = array_search($neptun, array_column($this->students, "neptun"));
        if($studentIdx === false) return "Student does not exist.";
        if(array_key_exists($neptun, $this->applications)) return "You've already applied for a test.";
        $timeIdx = array_search((new DateTime())->setTimestamp($time), array_column($this->testTimes, "time"));
        if($timeIdx === false) return "Test does not exist.";
        if($this->isChoosable($this->testTimes[$timeIdx])) {
            $this->applications[$neptun] = [
                "test" => &$this->testTimes[$timeIdx],
                "point" => -1
            ];
            return true;
        } else {
            return "Test time out of capacity.";
        }
    }

    public function getApplication(string $neptun) {
        if(array_key_exists($neptun, $this->applications)) {
            return $this->applications[$neptun];
        } else {
            return false;
        }
    }

    public function getApplications(TestTime $time = null) : array {
        $apps = [];
        foreach($this->applications as $neptun => $app) {
            if($time===null || $app["test"]==$time) {
                $app["student"] = $this->students[array_search($neptun, array_column($this->students, "neptun"))];
                $apps[] = $app;
            }
        }
        return $apps;
    }

    public function clearApplication(string $neptun) : bool {
        if($this->applications[$neptun]["point"] == -1) {
            unset($this->applications[$neptun]);
            return true;
        } else {
            return false;
        }
    }

    public function setPoints(string $neptun, int $point) {
        $this->applications[$neptun]["point"] = $point;
    }
}