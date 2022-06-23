<?php
declare(strict_types=1);

class Student {
    private $name;
    private $neptun;

    public function __construct(string $name, string $neptun) {
        if(strlen($neptun)!=6 || !ctype_alnum($neptun)) {
            throw new Exception("Neptun code is malformed.");
        }
        $this->name = $name;
        $this->neptun = $neptun;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getNeptun() : string {
        return $this->neptun;
    }

    public function __get(string $prop) {
        return $this->$prop;
    }

    public function __isset(string $prop) {
        return isset($this->$prop);
    }

    public function __toString() : string {
        return "{$this->name} [{$this->neptun}]";
    }
}