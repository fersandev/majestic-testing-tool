<?php
/*
	Unit monitor creator
*/

require_once('iCrudMonitor.php'); 

class UnitMonitorStorage {
	public $mCrudInterface;

	function __construct(iCrudMonitor $iCrud) {
		$this->mCrudInterface = $iCrud;
	}

	public function saveUnitMonitor($unitMonitor) {
		$restultUnitMonitorCreation = $this->mCrudInterface->saveNewMonitor($unitMonitor);
		return $restultUnitMonitorCreation;
	}

	public function updateUnitMonitor($unitMonitor) {
		$restultUnitMonitorUpdate = $this->mCrudInterface->updateMonitor($unitMonitor);
		return $restultUnitMonitorUpdate;
	}

	public function resetAllUnitMonitors($unitMonitorStatus) {
		$restultResetMonitors = $this->mCrudInterface->resetAllUnitMonitors($unitMonitorStatus);
		return $restultResetMonitors;
	}
}
?>