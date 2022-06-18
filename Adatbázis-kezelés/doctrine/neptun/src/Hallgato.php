<?php
  declare(strict_types = 1);

  /**
    * @Entity
    * @Table(name="hallgatok")
    */
  class Hallgato {
    /** @Id
      * @Column(type="string", length=6)
      * @var string
      */
    private $neptun;
    
    /**
      * @Column(type="string")
      * @var string
      */
    private $nev;
    
    /**
      * @Column(type="datetime")
      * @var DateTime
      */
    private $szuldatum;

    public function __construct(string $neptun, string $nev, DateTime $szuldatum) {
      $this->neptun = $neptun;
      $this->nev = $nev;
      $this->szuldatum = $szuldatum;
    }
    
    public function getNeptun() :string {
      return $this->neptun;
    }

    public function getNev() : string {
      return $this->nev;
    }
    
    public function setNev(string $nev) {
      $this->nev = $nev;
    }

    public function getSzuldatum() : DateTime {
      return $this->szuldatum;
    }
    
    public function setSzulDatum(DateTime $datum) {
      $this->szuldatum = $datum;
    }

    public function __toString() : string {
      return "Hallgató neve: {$this->nev}, neptun kódja: {$this->neptun}, születési dátuma: ".strftime("%Y. %B %e.", $this->szuldatum->getTimestamp());
    }
  }
?>