<?php
declare(strict_types=1);

class Application {
    private $student;
    private $time;
    private $point;

    public function __construct(Student $student, string $time, int $point) {
        $this->student = $student;
        $this->time = $time;
        $this->point = $point;
    }

    public function getStudent() : Student {
        return $this->student;
    }

    public function getTime() : string {
        return $this->time;
    }

    public function getPoint() : int {
        return $this->point;
    }
}