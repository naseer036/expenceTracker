<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'resource/Database.php';

class basic_action {

	protected $recordId = null;

	function __construct() {
		if (!isset($dbObject)) {
			global $dbObject;
			$dbObject = DataBase::getInstance();
			$dbObject->connect();
		}
	}

	function queryBuilder($values, $type, $tablename,$condition = false) {

		if (count($values)) {
			$query = ($type == 'update') ? 'UPDATE ' . $tablename . ' SET ' : ($type == 'insert') ? 'INSERT INTO ' . $tablename . ' values' : ($type == 'update') ? '' : '';
			$whereQuery = 'where ' . $condition . ' = ?';
			switch ($type) {
				case 'update':
					$setValues = array();
					$setQuery = '';
					foreach ($values as $fieldname => $fieldValue) {
						$setQuery .= $fieldname . ' = ?,';
						array_push($setValues, $fieldname);
					}
					$setQuery = rtrim($setQuery, ',');
					$updateQuery = $query . $setQuery . $whereQuery;
					return array($query, $setValues);
				case 'insert':
					$insertValues = array();
					$insertQuery='';
					$insertQuestionMakrs = implode(',', array_fill(0, count($values), '?'));
					$query = $query.$insertQuery.$whereQuery;
					return array($query,$values);
				case 'delete':
				case 'retrieve':
					return $query;
				default :
					return 'not valid type';
			}
		}
	}

}
