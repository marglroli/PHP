<?php
  declare(strict_types=1);

  namespace Egyetem;
  
  class Hallgato {
    private $nev;
    private $neptun;
    const neptunHossz = 6;
    private static $lista = array();
    
    public function __construct(string $nev = "[Gipsz Jakab]", 
				string $neptun = "[A1B2C3]") {
      $this->nev = $nev;
      // Osztály nevével minősítve
      $this->neptun = substr($neptun, 0, Hallgato::neptunHossz);
      if(in_array($this->neptun, Hallgato::$lista)) {
	die("Nem létezhet két azonos kódú hallgató.");
      } else {
	Hallgato::$lista[] = $this->neptun;
      }
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
      // self kulcsszó
      $idx = array_search($this->neptun, self::$lista);
      unset(self::$lista[$idx]);
      $this->neptun = substr($neptun, 0, self::neptunHossz);
      if(in_array($this->neptun, self::$lista)) {
	die("Nem létezhet két azonos kódú hallgató.");
      } else {
	self::$lista[] = $this->neptun;
      }
    }
    
    public function __toString() : string {
      return "Név: {$this->nev}, Neptun kód: {$this->neptun}";
    }
  }
  