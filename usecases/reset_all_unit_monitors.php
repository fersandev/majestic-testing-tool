<?php
/*
Reset all unit monitors from json monitors file
*/

require_once('entities/UnitMonitorStorage.php'); 

function resetAllUnitMonitors($unitMonitorStatus) {
	$unitMonitorStorage = new UnitMonitorStorage();
	$resultReset = $unitMonitorStorage->resetAllUnitMonitors($unitMonitorStatus);
	if($resultReset) {
		return array('status'=>'ok', 'msg'=>'<p style="color:green;">all unit monitors reseted to ( '.$unitMonitorStatus.' )</p>', 'result'=>'');
	}else {
		return array('status'=>'error', 'msg'=>'<p style="color:red;">some error has occurs reseting unit monitors</p>', 'result'=>'');
	}
}
?>