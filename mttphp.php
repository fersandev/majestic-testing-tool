<?php
/*
	Access point for the calls of monitorDev function, all the request come to this file
*/

require_once('/usecases/verify_expected.php'); 

function monitorDev($resultToTest, $keyword, $pathFile) {
	verifyExpected($resultToTest, $keyword, $pathFile);
}


if(isset($_GET['flag']) and !empty($_GET['flag'])) {
	$resultToTest = $_GET['resultToTest'];
	$keyword = $_GET['keyword'];
	$pathFile = $_GET['pathFile'];
	monitorDev($resultToTest, $keyword, $pathFile);
}

?>