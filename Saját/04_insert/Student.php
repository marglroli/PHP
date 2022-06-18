<?php
declare(strict_types=1);

class Student {
    private $name;
    private $neptun;
    private $birthDate;

    public function __construct(string $name=NULL, string $neptun=NULL, DateTime $birthDate=NULL) {
        if($name !== NULL && $neptun !== NULL) {
            $this->name = $name;
            $this->neptun = $neptun;
            $this->birthDate = $birthDate;
        }
    }

    public function getName() : string {
        return $this->name;
    }

    public function getNeptun() : string {
        return $this->neptun;
    }

    public function getBirthDate() : DateTime {
        return $this->birthDate;
    }

    public function __toString() : string {
        return "{$this->name} ({$this->neptun}) was born: ".
          strftime("%Y. %B %e.", $this->birthDate->getTimestamp());
    }
}