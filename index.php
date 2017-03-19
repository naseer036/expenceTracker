<?php

include "config.php";
//should create a seperate controller that handles this for seperate modules
$type = $_REQUEST['type'];
$action = $_REQUEST['action'];
if ($action == 'save') {
	require 'modules/baseModule/actions/save.php';
	require 'modules/' . $type . '/actions/' . $action . '.php';
}

$handlerClass = $type . '_' . $action;
$handel = new $handlerClass();
$handel->process($_REQUEST);
