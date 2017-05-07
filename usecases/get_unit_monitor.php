<?php
/*
Retrieve n unit monitor information regitered in json monitors file
*/

require_once('entities/UnitMonitorListing.php'); 

function getUnitMonitorById($_id) {
	$unitMonitorsListing = new UnitMonitorListing();
	$unitMonitorList = $unitMonitorsListing->getUnitMonitors();
	$unitMonitorListSorted = $unitMonitorsListing->getUnitMonitorById($unitMonitorList, $_id);
	if($unitMonitorListSorted != null) {
		return array('status'=>'ok', 'msg'=>'', 'result'=>$unitMonitorListSorted);
	}else {
		return array('status'=>'error', 'msg'=>'the unit monitor has returned null', 'result'=>'');
	}
}
?>