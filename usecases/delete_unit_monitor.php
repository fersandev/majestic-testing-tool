<?php
/*
Delete an unit monitor from json monitors file
*/

require_once('entities/UnitMonitorEraser.php'); 
require_once('entities/CrudMonitorImp.php'); 

function deleteUnitMonitor($_id) {
	$crudMonitorImp = new CrudMonitorImp();
	$unitMonitorsEraser = new UnitMonitorEraser($crudMonitorImp);
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