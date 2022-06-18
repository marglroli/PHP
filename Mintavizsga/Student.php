<?php
declare(strict_types=1);

class Student {
    private $name;
    private $neptun;

    public function __construct(string $name=NULL, string $neptun=NULL) {
        if($name !== NULL && $neptun !== NULL) {
            $this->name = $name;
            $this->neptun = $neptun;
        }
    }

    public function getName() : string {
        return $this->name;
    }

    public function getNeptun() : string {
        return $this->neptun;
    }

    public function __toString() : string {
        return "{$this->name} [{$this->neptun}]";
    }
}