<?php

class category_save extends basic_action{
	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$categoryName = $request['category_name'];
		$categoryDescription = $request['category_desc'];
		$saveQuery = 'INSERT INTO category values (?,?,?)';
		$params = array($categoryId,$categoryName,$categoryDescription);
		$result = $dbObject->pquery($saveQuery,$params);
		if(!$result){
			return false;
		}
		return true;
	}

}
