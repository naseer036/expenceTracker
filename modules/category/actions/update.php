<?php

class category_update extends basic_action {

	public $tableName = 'category';

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$categoryId = $request['categordId'];
		$setValues = $request['update_fields'];
		$updateQueryAndParams = $this->queryBuilder($setValues, 'update', $this->tableName, $categoryId);
		$result = $dbObject->pquery($updateQueryAndParams[0], $updateQueryAndParams[1]);
		if (!$result) {
			return false;
		}
		return true;
	}

}
