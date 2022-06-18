<?php
declare(strict_types=1);

class UI{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function basicQuery(){
        $this->db->getAll();
    }
}
