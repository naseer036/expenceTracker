<?php

class RequestSorter {

	public function process($request) {
		$type = $request['type'];
		$action = $request['action'];

		require 'modules/Controller/actions/basic_action.php';
		require 'modules/' . $type . '/actions/' . $action . '.php';

		$handlerClass = $type . '_' . $action;
		$handel = new $handlerClass();
		$handel->process($request);
	}

}
