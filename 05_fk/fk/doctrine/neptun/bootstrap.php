<?php
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__."/src");
$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration($paths, 
                                                       $isDevMode);

$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'hallgato',
    'password' => 'mysql',
    'dbname'   => 'hallgatok'
);
$entityManager = EntityManager::create($conn, $config);
