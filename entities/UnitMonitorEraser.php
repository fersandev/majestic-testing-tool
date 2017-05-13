<?php
/*
	This class has the responsability of getting the unit monitors registered
*/

class UnitMonitorEraser {

	public $mCrudInterface;

	function __construct(iCrudMonitor $iCrud) {
		$this->mCrudInterface = $iCrud;
	}

	/*
		delete an unit monitor identify by _id
	*/
	public function deleteUnitMonitor($_id) {
		$resultMonitorDeletion = $this->mCrudInterface->deleteMonitor($_id);
		return $resultMonitorDeletion;
	}


	/*
		delete all unit monitors registered, this method truncate the persistence file
	*/
	public function deleteAllUnitMonitors() {
		$resultAllDeletion = $this->mCrudInterface->deleteMonitors();
		return $resultAllDeletion;
	}
}
?>