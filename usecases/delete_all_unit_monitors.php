<?php
/*
Delete all unit monitors from json monitors file
*/

require_once('entities/UnitMonitorEraser.php'); 
require_once('entities/CrudMonitorImp.php'); 

function deleteAllUnitMonitors() {
	$crudMonitorImp = new CrudMonitorImp();
	$unitMonitorsEraser = new UnitMonitorEraser($crudMonitorImp);
	$resultDeletion = $unitMonitorsEraser->deleteAllUnitMonitors();
	if($resultDeletion) {
		return array('status'=>'ok', 'msg'=>'<p style="color:orange;">all unit monitors deleted</p>', 'result'=>'');
	}else {
		return array('status'=>'error', 'msg'=>'<p style="color:red;">some error has occurs deleting unit monitors</p>', 'result'=>'');
	}
}
?>