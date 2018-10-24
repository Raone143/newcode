<?php
//copyright Lawrence Truett and FluffyCat.com 2005, all rights reserved


  include_once('BookSingleton.php');


  Class BookBorrower {


    private $borrowedBook;
    private $haveBook = FALSE;


    function __construct() {
    }


    function getAuthorAndTitle() {
      if (TRUE == $this->haveBook) {
        return $this->borrowedBook->getAuthorAndTitle();
      } else {
        return "I don't have the book";
      }
    }


    function borrowBook() {
      $this->borrowedBook = BookSingleton::borrowBook();
      if ($this->borrowedBook == NULL) {
        $this->haveBook = FALSE;
      } else {
        $this->haveBook = TRUE;
      }
    }


    function returnBook() {
      $this->borrowedBook->returnBook($this->borrowedBook);
    }
	
	function kevvukeka() {

		return BookSingleton::borrowBook();
	}

  }
?>