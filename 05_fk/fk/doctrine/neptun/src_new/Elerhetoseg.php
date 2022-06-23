<?php
  declare(strict_types = 1);
  
  /**
    * @Entity
    * @Table(name="elerhetosegek")
    */
  class Elerhetoseg {
    /**
      * @Id
      * @GeneratedValue
      * @Column(type="integer")
      * @var int
      */
    protected $id;
    
    /**
      * @ManyToOne(targetEntity="Hallgato", inversedBy="neptun")
      * @JoinColumn(name="hallgato_neptun", referencedColumnName="neptun")
      */
    protected $hallgato_neptun;
    
    /**
      * @Column(type="string")
      * @var string
      */
    protected $elerhetoseg;
    
    /**
      * @return int
      */
    public function getId() : int {
      return $this->id;
    }
    
    /**
      * @return string
      */
    public function getElerhetoseg() : string {
      return $this->elerhetoseg;
    }
    
    /**
      * @param string $elerhetoseg
      */
    public function setElerhetoseg(string $elerhetoseg) {
      $this->elerhetoseg = $elerhetoseg;
    }
    
    public function setNeptun(Hallgato $hallgato) {
      $this->hallgato_neptun = $hallgato;
    }
    
    public function __toString() {
      return $this->elerhetoseg;
    }
  }