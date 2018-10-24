<?php
//copyright Lawrence Truett and FluffyCat.com 2006, all rights reserved


  include_once('BookSingleton.php');

  include_once('BookBorrower.php');
  
  $borrow = new BookSingleton;
  print_r($borrow);


/*  writeln('BEGIN TESTING SINGLETON PATTERN');
  writeln('');


  $bookBorrower1 = new BookBorrower();
  $bookBorrower2 = new BookBorrower();


  $bookBorrower1->borrowBook();
  writeln('BookBorrower1 asked to borrow the book');
  writeln('BookBorrower1 Author and Title: ');
  writeln($bookBorrower1->getAuthorAndTitle());
  writeln('');


  $bookBorrower2->borrowBook();
  writeln('BookBorrower2 asked to borrow the book');
  writeln('BookBorrower2 Author and Title: ');
  writeln($bookBorrower2->getAuthorAndTitle());
  writeln('');


  $bookBorrower1->returnBook();
  writeln('BookBorrower1 returned the book');
  writeln('');


  $bookBorrower2->borrowBook();
  writeln('BookBorrower2 Author and Title: ');
  writeln($bookBorrower1->getAuthorAndTitle());
  writeln('');


  writeln('END TESTING SINGLETON PATTERN');

  $book_obj = new BookBorrower;	
  $o = $book_obj->kevvukeka();
  $o->getAuthorAndTitle();
  function writeln($line_in) {
    echo $line_in.'<'.'BR'.'>';
  } */
?>