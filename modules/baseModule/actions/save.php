<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'resource/Database.php';
class basic_save {

	protected $recordId = null;

	function __construct() {
		if (!isset($dbObject)) {
			global $dbObject;
			$dbObject = new DataBase();
			$dbObject->connect();
		}
	}

}
