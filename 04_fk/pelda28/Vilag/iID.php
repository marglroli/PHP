<?php
  declare(strict_types = 1);
  namespace Vilag;
  
  interface iID {
    public function getID() : string;
    public function hasID(string $id) : bool;
  }