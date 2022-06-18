<?php
declare(strict_types=1);

class TestTime {
    private $id;
    private $time;
    private $capacity;

    public function __construct() {
        $this->id = (int)$this->id;
        $this->capacity = (int)$this->capacity;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getTime() : string {
        return $this->time;
    }

    public function getCapacity() : int {
        return $this->capacity;
    }

    public function __toString() : string {
        return "Date and time: {$this->time}, capacity: {$this->capacity} students";
    }
}