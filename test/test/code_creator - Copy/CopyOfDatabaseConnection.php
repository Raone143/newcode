<?php
    define("DB_HOST_NAME",     "localhost");
    define("DATABASE_NAME",    "magento");
    define("DB_USER_NAME",     "root");
    define("DB_PASSWORD",      "");

    /**
     * Connect to database
     */

    $mysql_connect = mysql_connect(DB_HOST_NAME, DB_USER_NAME, DB_PASSWORD);
    $mysql_dbname  = mysql_select_db(DATABASE_NAME, $mysql_connect);

    if(!$mysql_connect) {
        echo mysql_error($mysql_connect);
        exit;
    }