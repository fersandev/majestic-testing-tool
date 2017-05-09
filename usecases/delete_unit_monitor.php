<?php
/*
Delete an unit monitor from json monitors file
*/

require_once('entities/UnitMonitorEraser.php'); 

function deleteUnitMonitor($_id) {
	$unitMonitorsEraser = new UnitMonitorEraser();
	$resultDeletion = $unitMonitorsEraser->deleteUnitMonitor($_id);
	if($resultDeletion) {
		return array('status'=>'ok', 'msg'=>'<p style="color:orange;">unit monitor deleted</p>', 'result'=>'');
	}else {
		return array('status'=>'error', 'msg'=>'<p style="color:red;">some error has occurs deleting the unit monitor</p>', 'result'=>'');
	}
}


function deleteSelectedUnitMonitors($chainWithSelectedUnitMonitorsIds) {
	$arrayWithUnitMonitorsIds = explode('-', $chainWithSelectedUnitMonitorsIds);
	$chainWithSelectedUnitMonitorsIds2 = '';
	foreach ($arrayWithUnitMonitorsIds as $key => $value) {
		if(!empty($value)) {
			deleteUnitMonitor($value);
		}
	}
	return array('status'=>'ok', 'msg'=>'<p style="color:green;">selected unit monitors deleted</p>', 'result'=>'');
}
?>