<?php

include "config.php";
include 'requestSorter.php';
$requestSorter = new RequestSorter();
$requestSorter->process($_REQUEST);