<?php
  interface Logger
  {
    public function log($message, $level);    
  }

  class DemoLogger implements Logger
  {
    public function log($message, $level)
    {
      echo "Logged message: $message with level $level", PHP_EOL; 
    }
  }

  trait Loggable // implements Logger
  {
    protected $logger;
    public function setLogger(Logger $logger)
    {
      $this->logger = $logger;
    }
    public function log($message, $level)
    {
      $this->logger->log($message, $level);
    }
  }

  class Foo implements Logger
  {
    use Loggable;
  }
  
  $foo = new Foo;
  $foo->setLogger(new DemoLogger);
  $foo->log('It works', 1);