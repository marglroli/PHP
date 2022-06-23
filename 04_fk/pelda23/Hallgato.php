<?php
  declare(strict_types=1);

  class Hallgato {
    private $nev;
    private $neptun;
    
    public function __construct(string $nev = "[Gipsz Jakab]", string $neptun = "[A1B2C3]") {
      $this->nev = $nev;
      $this->neptun = $neptun;
    }
    
    public function getNev() : string {
      return $this->nev;
    }
    
    public function getNeptun() : string {
      return $this->neptun;
    }
    
    public function setNev(string $nev) {
      $this->nev = $nev;
    }
    
    public function setNeptun(string $neptun) {
      $this->neptun = $neptun;
    }
    
    public function __toString() : string {
      return "Név: {$this->nev}, Neptun kód: {$this->neptun}";
    }
  }
  