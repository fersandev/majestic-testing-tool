<?php
/*
Retrieve all unit monitors regitered in json monitors file
*/

require_once('entities/UnitMonitorListing.php'); 

function getListUnitMonitors() {
	$unitMonitorsListing = new UnitMonitorListing();
	$unitMonitorList = $unitMonitorsListing->getUnitMonitors();
	if($unitMonitorList != null) {
		return array('status'=>'ok', 'msg'=>'', 'result'=>$unitMonitorList);
	}else {
		return array('status'=>'error', 'msg'=>'the listing has returning null', 'result'=>'');
	}
}
?>