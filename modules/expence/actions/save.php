<?php

class expence_save extends basic_action {

	public $tabelName = 'expence';

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$inserValues = array();
		array_push($inserValues, $request['expence_name']);
		array_push($inserValues, $request['expence_desc']);
		array_push($inserValues, $request['expence_subject']);
		array_push($inserValues, $request['catagory_id']);
		array_push($inserValues, $request['user_id']);
		array_push($inserValues, $request['value']);
		$saveQueryAndParams = $this->queryBuilder($inserValues, 'insert', $this->tablename);
		$result = $dbObject->pquery($saveQueryAndParams[0], $saveQueryAndParams[1]);
		if (!$result) {
			return false;
		}
		return true;
	}

}
