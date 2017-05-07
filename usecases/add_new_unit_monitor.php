<?php
/*
Add a new unit monitor to persistention
*/
require_once('entities/UnitMonitor.php'); 
require_once('entities/UnitMonitorStorage.php'); 

function addNewUnitMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType) {
	$unitMonitor = new UnitMonitor;
	$unitMonitor->instantiateUnityMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType);
	$unitMonitorStorage = new UnitMonitorStorage();
	if($unitMonitorStorage->saveUnitMonitor($unitMonitor)) {
		return '<p>the unit monitor has been successfully created</p>';
	}else {
		return '<p>some error has occurs with te unit monitor creation or the keyword is already used</p>';
	}
}
?>