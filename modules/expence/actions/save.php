<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class expence_save extends basic_save{

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$expenceName = $request['expence_name'];
		$expenceDescription = $request['expence_desc'];
		$expenceSubject = $request['expence_subject'];
		$expenceCategoryId = $request['catagory_id'];
		$expenceUserId = $request['user_id'];
		$expenceValue = $request['value'];
		$saveQuery = 'INSERT INTO expence values (?,?,?,?,?,?)';
		$params = array($expenceName,$expenceDescription,$expenceSubject,$expenceCategoryId,$expenceUserId,$expenceUserId,$expenceValue);
		$result = $dbObject->pquery($saveQuery,$params);
		if(!$result){
			return false;
		}
		return true;
	}

}
