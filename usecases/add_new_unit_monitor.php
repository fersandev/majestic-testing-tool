<?php
/*
Add a new unit monitor to persistention
*/
require_once('entities/UnitMonitor.php'); 
require_once('entities/UnitMonitorStorage.php'); 
require_once('entities/CrudMonitorImp.php'); 

function addNewUnitMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType, $monitorTypeValueExpected) {
	
	$unitMonitor = new UnitMonitor;
	$unitMonitor->instantiateUnityMonitor($monitorKeyword, 
										  $monitorAssertType, 
										  $monitorExpectValue, 
										  $monitorDescription, 
										  $monitorImplementingType, 
										  $monitorTypeValueExpected);
	$isParseSuccess = $unitMonitor->parseExpectedValueToCorrectType();

	if($isParseSuccess) {
		$crudMonitorImp = new CrudMonitorImp();
		$unitMonitorStorage = new UnitMonitorStorage($crudMonitorImp);
		if($unitMonitorStorage->saveUnitMonitor($unitMonitor)) {
			return '<p style="color:green;">the unit monitor has been successfully created</p>';
		}else {
			return '<p style="color:red;">some error has occurs with the unit monitor creation or the keyword is already used</p>';
		}
	}else {
		return '<p style="color:red;">The expected value does not match with the indicated data type</p>';
	}	
}
?>