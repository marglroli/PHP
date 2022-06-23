<?php
  declare(strict_types=1);
  
  interface iUser {
    public static function getUser() : string;
  }
  
  class UserOldPHP implements iUser {
    public static function getUser() : string {
      return isset($_GET['user']) ? $_GET['user'] : 'senki';
    }
  }
  
  class UserPHP7 implements iUser {
    public static function getUser() : string {
      return $_GET['user'] ?? 'senki';
    }
  }
  
  class UserFactory {
    public static function getInstance() : iUser {
      if(phpversion() < '7.0.0') {
	return new UserOldPHP();
      } else {
	return new UserPHP7();
      }
    }
  }
  
  $felh = UserFactory::getInstance();
  echo "<p>Felhasználónév: ", $felh->getUser(), "</p>\n";