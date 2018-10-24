<?php
/**
 * @class MySqlDatabase
 * @methods 
 * @author K SuryaNarayanaMurthy 
 * @copyright 2013 - 2020
 * @var $host_name, $database_username, $database_password, $database_name 
 */
class MySqlDatabase
{
	/**
	 * @var $host_name, $database_username, $database_password, $database_name
	 */
	var $host_name;
	var $database_username;
	var $database_password;
	var $database_name;
	
	/**
	 * @method __construct
	 * @param $host_name, $database_username, $database_password, $database_name
	 */
	function __construct($host, $user, $password, $databse) {

		//Set host_name, database_username, database_password, database_name
		$this->host_name = $host;
		$this->database_username = $user;
		$this->database_password = $password;
		$this->database_name = $database;
		
		
	}
	
	/**
	 * @method connect_to_database
	 */
	function connect_to_database() {
		$connect_to_host = mysql_connect($this->host_name, $this->database_username, $this->database_password);
		$select_database = mysql_select_db($this->database_name, $connect_to_host);  		
	}
	
	/**
	 * @method get_tables
	 * 
	 */
	function get_tables($database) {
		
	}
	
	/**
	 * @method get_columns
	 * 
	 */
	
}