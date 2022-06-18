<?php
  declare(strict_types = 1);

  use Doctrine\Common\Collections\ArrayCollection;
  
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
    
    /**
      * @OneToMany(targetEntity="Elerhetoseg", mappedBy="hallgato_neptun", cascade={"persist", "remove"})
      */
    private $elerhetosegek = null;

    public function __construct(string $neptun, string $nev, DateTime $szuldatum) {
      $this->neptun = $neptun;
      $this->nev = $nev;
      $this->szuldatum = $szuldatum;
      $this->elerhetosegek = new ArrayCollection();
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
      $s = "Hallgató neve: {$this->nev}, ".
           "neptun kódja: {$this->neptun}, ".
           "születési dátuma: ".
           strftime("%Y. %B %e.", $this->szuldatum->getTimestamp())."\n<ul>\n";
      foreach($this->elerhetosegek as $elerhetoseg) {
        $s .= "<li>$elerhetoseg</li>\n";
      }
      $s .= "</ul>\n";
      return $s;
    }
    
    public function clearElerhetosegek() {
      $this->elerhetosegek->clear();
    }
    
    public function addElerhetosegek(string $elerhetosegek) {
      $lista = explode(",", $elerhetosegek);
      foreach($lista as $elem) {
        $e = new Elerhetoseg();
        $e->setElerhetoseg(trim($elem));
        $e->setNeptun($this);
        $this->elerhetosegek[] = $e;
      }
    }
  }
?>