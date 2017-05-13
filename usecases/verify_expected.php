<?php
/*
Delete an unit monitor from json monitors file
*/

require_once('entities/UnitMonitor.php'); 
require_once('entities/UnitMonitorListing.php'); 
require_once('entities/UnitMonitorVerificator.php'); 
require_once('entities/UnitMonitorStorage.php'); 
require_once('entities/CrudMonitorImp.php');

function verifyExpected($resultToTest, $keyword, $pathFile) {

	$crudMonitorImp = new CrudMonitorImp();
	$unitMonitorListing = new UnitMonitorListing($crudMonitorImp);
	$unitMonitor = $unitMonitorListing->getUnitMonitorObjectByKeyword($keyword);

	if($unitMonitor != null) {
		$unitMonitor->pathFile = $pathFile;

		$unitMonitorVerificator = new UnitMonitorVerificator();
		$resultVerification = $unitMonitorVerificator->checkIfResultArrivedIsTheExpected($unitMonitor, $resultToTest);
		
		if($resultVerification) {
			$unitMonitor->status = "green";
		}else {
			$unitMonitor->status = "red";
		}

		$unitMonitorStorage = new UnitMonitorStorage($crudMonitorImp);
		$updateResult = $unitMonitorStorage->updateUnitMonitor($unitMonitor);
	}
}
?>