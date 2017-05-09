<?php
/*
	Access point for the calls of monitorDev function, all the request come to this file
*/

require_once('/usecases/verify_expected.php'); 

function monitorDev($resultToTest, $keyword, $pathFile) {

	verifyExpected($resultToTest, $keyword, $pathFile);
}


if(isset($_GET['flag']) and !empty($_GET['flag'])) {
	if(isset($_GET['json']) and !empty($_GET['json'])) {
		$jsonWithParamsToEvaluate = json_decode($_GET['json'], true);
		$resultToTest = $jsonWithParamsToEvaluate['resultToTest'];
		$keyword = $jsonWithParamsToEvaluate['keyword'];
		$pathFile = $jsonWithParamsToEvaluate['pathFile'];
		monitorDev($resultToTest, $keyword, $pathFile);
	}
}

?>