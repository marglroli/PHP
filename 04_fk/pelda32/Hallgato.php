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
      if(strlen($neptun) != Hallgato::neptunHossz) {
	throw new NeptunException("A neptun kód hossza nem megfelelő.");
      }
      if(in_array($neptun, Hallgato::$lista)) {
	throw new NeptunException('Ilyen neptun kód már létezik.');
      }
      $this->neptun = $neptun;
      Hallgato::$lista[] = $neptun;
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
      if(strlen($neptun) != Hallgato::neptunHossz) {
	throw new NeptunException("A neptun kód hossza nem megfelelő.");
      }
      $idx = array_search($this->neptun, self::$lista);
      unset(self::$lista[$idx]);
      if(in_array($neptun, self::$lista)) {
	self::$lista[] = $this->neptun;
	throw new NeptunException('Ilyen neptun kód már létezik.');
      }
      $this->neptun = $neptun;
      self::$lista[] = $neptun;
    }
    
    public function __toString() : string {
      return "Név: {$this->nev}, Neptun kód: {$this->neptun}";
    }
  }
  