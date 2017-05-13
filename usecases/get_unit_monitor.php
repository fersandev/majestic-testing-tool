<?php
/*
Retrieve n unit monitor information regitered in json monitors file
*/

require_once('entities/UnitMonitorListing.php');
require_once('entities/CrudMonitorImp.php'); 

function getUnitMonitorById($_id) {
	$crudMonitorImp = new CrudMonitorImp();
	$unitMonitorsListing = new UnitMonitorListing($crudMonitorImp);
	$unitMonitor = $unitMonitorsListing->getUnitMonitorById($_id);
	if($unitMonitor != null) {
		return array('status'=>'ok', 'msg'=>'', 'result'=>$unitMonitor);
	}else {
		return array('status'=>'error', 'msg'=>'the unit monitor has returned null', 'result'=>'');
	}
}
?>