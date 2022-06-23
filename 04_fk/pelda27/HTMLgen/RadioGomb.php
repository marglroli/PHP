<?php
  declare(strict_types = 1);
  
  namespace HTMLgen;

  class RadioGomb extends Valasztok {
    public function __construct(string $name, 
				array $valueLabel, 
				bool $checked=false) {
      parent::__construct($name, $valueLabel);
      $this->checked = $checked;
    }
    
    public function printHTML() {
      foreach($this->valueLabel as $value => $label) {
	echo "<div><label><input type=\"radio\" 
	      name=\"{$this->name}\" value=\"$value\"";
	if($value == $this->checked) {
	  echo " checked";
	}
	echo ">$label</label></div>\n";
      }
    }
  }