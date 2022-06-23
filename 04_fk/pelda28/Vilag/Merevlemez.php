<?php
  declare(strict_types = 1);
  namespace Vilag;

  class Merevlemez implements iID {
    private $serialNo;
    
    public function __construct(string $serialNo) {
      $this->serialNo = $serialNo;
    }
    
    public function getID() : string {
      return $this->serialNo;
    }
    
    public function hasID(string $id) : bool {
      return $id === $this->serialNo;
    }
  }
