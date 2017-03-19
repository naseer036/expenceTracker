<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class category_save extends basic_save{
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
