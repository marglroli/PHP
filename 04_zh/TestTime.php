<?php
declare(strict_types=1);

class TestTime {
    private $time;
    private $capacity;

    public function __construct(DateTime $time, int $capacity) {
        if($capacity < 1) {
            throw new Exception("Capacity must be positive.");
        }
        $this->time = $time;
        $this->capacity = $capacity;
    }

    public function getUnixTime() : int {
        return $this->time->getTimestamp();
    }

    public function getFormattedTime() : string {
        return $this->time->format("Y.m.d H:i");
    }

    public function getCapacity() : int {
        return $this->capacity;
    }

    public function __get(string $prop) {
        return $this->$prop;
    }

    public function __isset(string $prop) {
        return isset($this->$prop);
    }

    public function __toString() : string {
        return "Date and time: {$this->getFormattedTime()}, capacity: {$this->capacity} students";
    }
}