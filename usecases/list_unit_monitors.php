<?php
/*
Retrieve all unit monitors registered in json monitors file
*/

require_once('entities/UnitMonitorListing.php'); 
require_once('entities/CrudMonitorImp.php'); 

function getListUnitMonitors() {
	$crudMonitorImp = new CrudMonitorImp();
	$unitMonitorsListing = new UnitMonitorListing($crudMonitorImp);
	$unitMonitorList = $unitMonitorsListing->getUnitMonitors();
	if($unitMonitorList != null) {
		return array('status'=>'ok', 'msg'=>'', 'result'=>$unitMonitorList);
	}else {
		return array('status'=>'error', 'msg'=>'the listing has returning null', 'result'=>'');
	}
}
?>