<?php

//class to save a new user
class users_save extends basic_save{

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$userName = $request['user_name'];
		//password will be recieved from user in plain text for now.
		$userPassword = $request['user_password'];
		$saveQuery = 'INSERT INTO users values (?,?)';
		$params = array($categoryId,$userName,$userPassword);
		$result = $dbObject->pquery($saveQuery,$params);
		if(!$result){
			return false;
		}
		return true;
	}
	
	//to be used if encryption is going to be used
	private function decript($encryptedPassword){
		
	}

}
