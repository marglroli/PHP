<?php
    declare(strict_types=1);
    
    namespace lib;

    class Library {
        private $books = [];
        
        public function addBook(Book $book) {
            $this->books[] = $book;
        }
        
        public function getByTitle(string $title) : array {
            $list = [];
            foreach ($this->books as $b) {
                if($b->getTitle() == $title) {
                    $list[] = $b;
                }
            }
            return $list;
        }
        
        public function getByAuthor(string $author) : array {
            $list = [];
            foreach ($this->books as $b) {
                if(stripos($b->getAuthor(), $author) !== FALSE) {
                    $list[] = $b;
                }
            }
            return $list;
        }
        
        public function getByIsbn(string $isbn) {
            foreach ($this->books as $b) {
                if($b->getIsbn() == $isbn) {
                    return $b;
                }
            }
            return NULL;
        }
        
        public function getByKeywords(array $keywords) : array {
            $pairs = [];
            foreach ($this->books as $b) {
                if(($cnt = $b->getKeywordsNum($keywords)) > 0) {
                    $pairs[] = ["book" => $b, "count" => $cnt];
                }
            }
            usort($pairs, function($a, $b) {
                return $b["count"] <=> $a["count"];
            });
            $booklist = [];
            foreach ($pairs as $p) {
                $booklist[] = $p["book"];
            }
            return $booklist;
        }
        
        public function save(string $file) {
            file_put_contents($file, serialize($this));
        }
        
        public static function load(string $file) : Library {
            return unserialize(file_get_contents($file));
        }
    }
