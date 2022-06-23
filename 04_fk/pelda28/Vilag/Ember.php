<?php
  declare(strict_types = 1);
  namespace Vilag;

  class Ember implements iID {
    private $szigSzam = array();
    
    public function __construct(string $szigSzam) {
      $this->szigSzam[] = $szigSzam;
    }
    
    public function addSzigSzam(string $szigSzam) {
      $this->szigSzam[] = $szigSzam;
    }
    
    public function getID() : string {
      array_push($this->szigSzam, ($akt = array_pop($this->szigSzam)));
      return $akt;
    }
    
    public function hasID(string $id) : bool {
      return in_array($id, $this->szigSzam);
    }
  }