<?php
  declare(strict_types=1);
  
  class IDgenerator {
    private $szamlalo;
    private static $peldany = NULL;
  
    public static function getInstance() : IDgenerator {
      if(self::$peldany === NULL) {
	self::$peldany = new IDgenerator();
      }
      return self::$peldany;
    }
  
    private function __construct() {
      $this->szamlalo = -1;
    }
    
    public function getID() : string {
      return 'ID'.++$this->szamlalo;
    }
  }
  
  // $id0 = new IDgenerator();
  $id1 = IDgenerator::getInstance();
  echo "<p>", $id1->getID(), "</p>\n";
  echo "<p>", $id1->getID(), "</p>\n";
  echo "<p>", $id1->getID(), "</p>\n";
  $id2 = IDgenerator::getInstance();
  echo "<p>", $id2->getID(), "</p>\n";
  echo "<p>", $id1->getID(), "</p>\n";