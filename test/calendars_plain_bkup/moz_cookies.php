<?php
// Connect to SQLite database
$db = new SQLite3('D:/xampp/htdocs/test/cookies.sqlite');
    //$tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
$tablesquery = $db->query("SELECT * FROM moz_cookies");
    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        $a[] = $table['baseDomain'];
    	echo "<pre>";print_r($table)  . '<br />';
    }
    //echo "<pre>";print_r($a);