<?php

class expence_update extends basic_action {

	public $tabelName = 'expence';

	function __construct() {
		parent::__construct();
	}

	public function process($request) {
		global $dbObject;
		$setValues = array($request['updateFeilds']);
		$expenceId = $request['expenceId'];
		$updateResultWithParam = $this->queryBuilder($setValues, 'update', $this->tabelName, $expenceId);
		$result = $dbObject->pquery($updateResultWithParam[0], $updateResultWithParam[1]);
		if (!$result) {
			return false;
		}
		return true;
	}

}
