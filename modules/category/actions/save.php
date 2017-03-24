<?php

class category_save extends basic_action {

	public $tabelName = 'category';

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$inserValues = array();
		array_push($inserValues, $request['category_name']);
		array_push($inserValues, $request['category_desc']);
		$saveQueryAndParams = $this->queryBuilder($inserValues, 'insert', $this->tablename);
		$result = $dbObject->pquery($saveQueryAndParams[0], $saveQueryAndParams[1]);
		if (!$result) {
			return false;
		}
		return true;
	}

}
