<?php
/*
Delete all unit monitors from json monitors file
*/

require_once('entities/UnitMonitorEraser.php'); 

function deleteAllUnitMonitors() {
	$unitMonitorsEraser = new UnitMonitorEraser();
	$resultDeletion = $unitMonitorsEraser->deleteAllUnitMonitors();
	if($resultDeletion) {
		return array('status'=>'ok', 'msg'=>'<p style="color:orange;">all unit monitors deleted</p>', 'result'=>'');
	}else {
		return array('status'=>'error', 'msg'=>'<p style="color:red;">some error has occurs deleting unit monitors</p>', 'result'=>'');
	}
}
?>