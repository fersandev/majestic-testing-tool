<?php
/*
	This class has the responsability of getting the unit monitors registered
*/

require_once('UnitMonitor.php'); 

class UnitMonitorListing {

	public $mCrudInterface;

	function __construct(iCrudMonitor $iCrud) {
		$this->mCrudInterface = $iCrud;
	}

	/*
		an array if the proccess is success, null in otherwise
	*/
	public function getUnitMonitors() {
		$unitMonitorsArray = $this->mCrudInterface->getMonitors();
		return $unitMonitorsArray;
	}


	/*
		return an array with the unit monitor information if success, or null in otherwise
	*/
	public function getUnitMonitorById($idUnitMonitor) {
		$unitMonitorArray = $this->mCrudInterface->getMonitorById($idUnitMonitor);
		return $unitMonitorArray;
	}


	/*
		return an object with the unit monitor information if success, or null in otherwise
	*/
	public function getUnitMonitorObjectByKeyword($keyword) {
		$unitMonitorArray = $this->mCrudInterface->getMonitorByKeyword($keyword);
		if($unitMonitorArray != null) {
			$value = $unitMonitorArray;
			$unitMonitor = new UnitMonitor();
			$unitMonitor->_id = $value['_id'];
			$unitMonitor->keyword = $value['keyword'];
			$unitMonitor->assertType = $value['assertType'];
			$unitMonitor->expectValue = $value['expectValue'];
			$unitMonitor->description = $value['description'];
			$unitMonitor->status = $value['status'];
			$unitMonitor->domainProject = $value['domainProject'];
			$unitMonitor->isShared = $value['isShared'];
			$unitMonitor->createAt = $value['createAt'];
			$unitMonitor->pathFile = $value['pathFile'];
			$unitMonitor->implementingType = $value['implementingType'];
			$unitMonitor->typeValueExpected = $value['typeValueExpected'];

			return $unitMonitor;
		}else {
			return null;
		}
	}
}
?>