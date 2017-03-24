<?php

//class to save a new user
class users_save extends basic_action {

	private $tablename = 'users';

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$inserValues = array();
		array_push($inserValues, $request['user_name']);
		//password will be recieved from user in plain text for now.
		array_push($inserValues, $request['user_password']);
		$saveQueryAndParams = $this->queryBuilder($inserValues,'insert', $this->tablename);
		$result = $dbObject->pquery($saveQueryAndParams[0], $saveQueryAndParams[1]);
		if (!$result) {
			return false;
		}
		return true;
	}

	//to be used if encryption is going to be used
	private function decript($encryptedPassword) {
		
	}

	private function encript() {
		
	}

}
