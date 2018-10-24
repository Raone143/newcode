<?php
/*
 * Mysql Database Connection
 */
$link = mysql_connect("localhost", "root", "");
$db  = mysql_select_db("test", $link);

/*
 * Mysql Database Connection With Object Notation
 */
$link = new mysql();

/*
 * Mysqli Database Connection
 */

$link = mysqli_connect("localhost", "root", "", "test");

/*
 *
 */