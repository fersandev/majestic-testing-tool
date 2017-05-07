<?php
/*
Delete an unit monitor from json monitors file
*/

require_once('entities/UnitMonitorEraser.php'); 

function deleteUnitMonitor($_id) {
	$unitMonitorsEraser = new UnitMonitorEraser();
	$resultDeletion = $unitMonitorsEraser->deleteUnitMonitor($_id);
	if($resultDeletion) {
		return array('status'=>'ok', 'msg'=>'<p>unit monitor deleted</p>', 'result'=>'');
	}else {
		return array('status'=>'error', 'msg'=>'<p>some error has occurs deleting the unit monitor</p>', 'result'=>'');
	}
}
?>