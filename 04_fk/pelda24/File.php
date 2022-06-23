<?php
  declare(strict_types=1);
  
  class File {
    private $fp = false;
    private static $functions = [
      "fgets", "gfetc", "feof"
    ];
    
    public function __construct(string $filename, string $mode) {
      $this->fp = fopen($filename, $mode);
    }
    
    public function __call(string $name, array $arguments) {
      if(in_array($name, self::$functions)) {
	return $name($this->fp);
      }
    }
    
    public function __set(string $name, $value) {}
    
    public function __get(string $name) {
      return $this->$name;
    }
    
    public function __destruct() {
      if($this->fp != false) {
	fclose($this->fp);
      }
    }
  }