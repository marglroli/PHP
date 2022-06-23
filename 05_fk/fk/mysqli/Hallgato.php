<?php
  declare(strict_types = 1);

  class Hallgato {
    private $nev;
    private $neptun;
    private $szuldatum;

    public function __construct(string $n=null, string $k=null, DateTime $d=null) {
      if($n !== null) {
        $this->nev = $n;
        $this->neptun = $k;
        $this->szuldatum = $d;
      } else {
        $this->szuldatum = new DateTime($this->szuldatum);
      }
    }

    public function getNev() : string {
      return $this->nev;
    }

    public function getNeptun() :string {
      return $this->neptun;
    }

    public function getSzuldatum() : DateTime {
      return $this->szuldatum;
    }

    public function __toString() :string {
      return "Hallgató neve: {$this->nev}, ".
             "neptun kódja: {$this->neptun}, ".
             "születési dátuma: ".strftime("%Y. %B %e.", $this->szuldatum->getTimestamp());
    }
  }
?>
