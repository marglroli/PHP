<?php
    declare(strict_types=1);
    
    namespace lib;
    
    class Book {
        private $title;
        private $author;
        private $isbn;
        private $keywords = [];
        
        public function getTitle() : string {
            return $this->title;
        }

        public function getAuthor() : string {
            return $this->author;
        }

        public function getIsbn() : string {
            return $this->isbn;
        }

        public function getKeywords() : array {
            return $this->keywords;
        }

        public function setTitle(string $title) {
            $this->title = $title;
        }

        public function setAuthor(string $author) {
            $this->author = $author;
        }

        public function setIsbn(string $isbn) {
            if (strlen($isbn) != 13) {
                throw new Exception("Erronuous ISBN identifier!");
            }
            $this->isbn = $isbn;
        }
        
        public function __construct(string $title, string $author, 
                string $isbn) {
            $this->title = $title;
            $this->author = $author;
            $this->setIsbn($isbn);
        }

        public function addKeyword(string $keyword) {
            $this->keywords[] = $keyword;
        }
        
        public function removeKeyword(string $keyword) {
            if(($idx=array_search($keyword, $this->keywords))!==false) {
                unset($this->keywords[$idx]);
            }
        }
        
        public function getKeywordsNum(array $keywords) : int {
            $cnt = 0;
            foreach ($keywords as $kulcs) {
                if(in_array($kulcs, $this->keywords)) {
                    $cnt++;
                }
            }
            return $cnt;
        }
        
        public function __toString() : string {
            $str = "<pre>Title: ".$this->title.
                   "\nAuthor: ".$this->author.
                   "\nISBN: ".$this->isbn.
                   "\nKeywords: ";
            $str .= implode(", ", $this->keywords);
            $str .= "</pre>\n";
            return $str;
        }

    }