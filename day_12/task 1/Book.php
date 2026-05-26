<?php

class Book {

    private $title;
    private $author;
    private $isbn;
    private $status;

    public function __construct($title, $author, $isbn, $status = "Available") {

        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->status = $status;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getStatus() {
        return $this->status;
    }

    public function borrowBook() {

        if($this->status == "Available") {

            $this->status = "Borrowed";
            return true;
        }

        return false;
    }

    public function returnBook() {

        if($this->status == "Borrowed") {

            $this->status = "Available";
            return true;
        }

        return false;
    }

    public function isAvailable() {

        return $this->status == "Available";
    }
}

?>