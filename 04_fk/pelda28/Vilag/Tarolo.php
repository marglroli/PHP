<?php
  declare(strict_types = 1);
  namespace Vilag;

  class Tarolo {
    private $dolgok = [];
    
    public function addDolog(iID $uj) {
      $this->dolgok[] = $uj;
    }
    
    public function __toString() : string {
      $str = "<ul>";
      foreach($this->dolgok as $dolog) {
	$str .= "<li>".$dolog->getID()."</li>";
      }
      return $str."</ul>";
    }
  }