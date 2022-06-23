<?php
  declare(strict_types = 1);
  
  namespace HTMLgen;

  abstract class Valasztok {
    protected $name;
    protected $valueLabel;
    protected $checked;
    
    public function __construct(string $name, 
				array $valueLabel) {
      $this->name = $name;
      $this->valueLabel = $valueLabel;
    }
    
    public function addValueLabel(string $value, 
				  string $label) {
      $this->valueLabel[$value] = $label;
    }

    public abstract function printHTML();
  }