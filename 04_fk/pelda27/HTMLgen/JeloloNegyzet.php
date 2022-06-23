<?php
  declare(strict_types = 1);
  
  namespace HTMLgen;

  class JeloloNegyzet extends Valasztok {
    public function __construct(string $name, 
				array $valueLabel, 
				array $checked) {
      parent::__construct($name, $valueLabel);
      $this->checked = array_unique($checked);
    }
    
    public function printHTML() {
      foreach($this->valueLabel as $value => $label) {
	echo "<div><label><input type=\"checkbox\"
	      name=\"{$this->name}[]\" value=\"$value\"";
	if(in_array($value, $this->checked)) {
	  echo " checked";
	}
	echo ">$label</label></div>\n";
      }
    }
  }