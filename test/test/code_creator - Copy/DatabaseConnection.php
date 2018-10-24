<?php
    $DB_HOST_NAME     = "localhost";
    $DATABASE_NAME    = "magento";
    $DB_USER_NAME     = "root";
    $DB_PASSWORD      = "";

    /**
     * Connect to database
     */
    try {
    	$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    	foreach ($dbh->query('SELECT * from FOO') as $row) {
    		print_r($row);
    	}
    	$dbh = null;
    } catch (PDOException $e) {
    	print "Error!: " . $e->getMessage() . "<br/>";
    	die();
    }
    
    $db_connect = pg_connect("mysql:host=".$DB_HOST_NAME." dbname=".$DATABASE_NAME." user=".$DB_USER_NAME." password=".$DB_PASSWORD);
    		
    if(!$db_connect) {
        echo "Unable to connect to database";
        exit;
    }