<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'lib/adodb5/adodb.inc.php';

class DataBase {

	var $database = null;
	var $dbType = null;
	var $dbHostName = null;
	var $userName = null;
	var $userPassword = null;
	var $dbName = null;

	function __construct() {
		global $dbconfig, $dbconfigoption;

		if ($host == '') {
			$this->disconnect();
			$this->setDatabaseType($dbconfig['db_type']);
			$this->setUserName($dbconfig['db_username']);
			$this->setUserPassword($dbconfig['db_password']);
			$this->setDatabaseHost($dbconfig['db_hostname']);
			$this->setDatabaseName($dbconfig['db_name']);
		} else {
			$this->disconnect();
			$this->setDatabaseType($dbtype);
			$this->setDatabaseName($dbname);
			$this->setUserName($username);
			$this->setUserPassword($passwd);
			$this->setDatabaseHost($host);
		}
	}

	function disconnect() {
		if (isset($this->database)) {
			if ($this->dbType == "mysql") {
				mysql_close($this->database);
			} else {
				$this->database->disconnect();
			}
			unset($this->database);
		}
	}

	function setDatabaseType($type) {
		$this->dbType = $type;
	}

	function setUserName($name) {
		$this->userName = $name;
	}

	function setUserPassword($pass) {
		$this->userPassword = $pass;
	}

	function setDatabaseName($db) {
		$this->dbName = $db;
	}

	function setDatabaseHost($host) {
		$this->dbHostName = $host;
	}

	static function &getInstance() {
		global $dbObject;

		if (!isset($dbObject)) {
			$dbObject = new self();
		}
		return $dbObject;
	}

	function checkConnection() {

		if (!isset($this->database)) {
			$this->connect(false);
		} else {
			//$this->println("checkconnect using old connection");
		}
	}

	function connect($dieOnError = false) {

		$this->database = ADONewConnection($this->dbType);
		$result = $this->database->PConnect($this->dbHostName, $this->userName, $this->userPassword, $this->dbName);
		if ($result) {
			//log success 
		}
	}

	function getRowCount(&$result) {
		if (isset($result) && !empty($result))
			$rows = $result->RecordCount();
		return $rows;
	}

	// Function to get particular row from the query result
	function query_result_rowdata(&$result, $row = 0) {
		if (!is_object($result))
			throw new Exception("result is not an object");
		$result->Move($row);
		$rowdata = $this->change_key_case($result->FetchRow());
		return $rowdata;
	}

	//function to change the array key values to lower case
	function change_key_case($arr) {
		return is_array($arr) ? array_change_key_case($arr) : $arr;
	}

	function checkError($msg = '', $dieOnError = false) {
		if ($this->dieOnError || $dieOnError) {
			$bt = debug_backtrace();
			$ut = array();
			foreach ($bt as $t) {
				$ut[] = array('file' => $t['file'], 'line' => $t['line'], 'function' => $t['function']);
			}
			echo '<pre>';
			var_export($ut);
			echo '</pre>';
			die($msg . "ADODB error " . $msg . "->" . $this->database->ErrorMsg());
		}
		return false;
	}

	/* pquery function checks for connection, executes the query and logs every request
	 * @param $sql -- Prepared sql statement
	 * @param $params -- Parameters for the prepared statement
	 * @param $dieOnError -- Set to true, when query execution fails
	 * @param $msg -- Error message on query execution failure
	 */

	function pquery($sql, $params = array(), $dieOnError = false, $msg = '') {
		$this->checkConnection();
		$date = getdate();
		$sql_start_time = microtime(true);
		$result = &$this->database->Execute($sql, $params);
		$sql_end_time = microtime(true);
		file_put_contents('databaseExecutedLog.log', print_r('query executed = '.$sql .' date = '.$date. ' startTime = ' . $sql_start_time . ' endTime = ' . $sql_end_time, true), FILE_APPEND);
		if (!$result)
			$this->checkError($msg . ' Query Failed:' . $sql . '::', $dieOnError);

		return $result;
	}
	

}
