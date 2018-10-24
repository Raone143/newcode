<?php
    $DB_HOST_NAME     = "localhost";
    $DATABASE_NAME    = "magento";
    $DB_USER_NAME     = "root";
    $DB_PASSWORD      = "";

    /**
     * Connect to database
     */
    try {
    	$dbh = new PDO('mysql:host=localhost;dbname='.$DATABASE_NAME, $DB_USER_NAME, $DB_PASSWORD);
    	$dbh = null;
    } catch (PDOException $e) {
    	print "Error!: " . $e->getMessage() . "<br/>";
    	die();
    }
    
    if(!$db_connect) {
        echo "Unable to connect to database";
        exit;
    }