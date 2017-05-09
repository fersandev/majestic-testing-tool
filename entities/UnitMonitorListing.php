<?php
/*
	This class has the responsability of getting the unit monitors registered
*/

require_once('UnitMonitorStorageVerificator.php'); 
require_once('UnitMonitor.php'); 

class UnitMonitorListing extends UnitMonitorStorageVerificator {

	/*
		an array if the proccess is success, null in otherwise
	*/
	public function getUnitMonitors() {
		if($this->verifyPersistenceExistence()) {
			$str = file_get_contents($this->persistenceFileName);
			if(!empty($str)) {
				$jsonList = json_decode($str, true);
				return $jsonList;
			}else {
				return null;
			}
		}else {
			return null;
		}
	}


	public function getUnitMonitorById($arrayListUnitMonitors, $idUnitMonitor) {
		foreach ($arrayListUnitMonitors as $key => $value) {
			if($value['_id'] == $idUnitMonitor) {
				$unitMonitorSearched = $value;
				break;
			}
		}
		return $unitMonitorSearched;
	}


	/*
		Try to get a unit monitor object by keyword
	*/
	public function getUnitMonitorObjectByKeyword($keyword) {
		if($this->verifyPersistenceExistence()) {
			$str = file_get_contents($this->persistenceFileName);
			if(!empty($str)) {
				$jsonList = json_decode($str, true);
				foreach ($jsonList as $key => $value) {
					if($value['keyword'] == $keyword) {
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
						break;
					}
				}
			}else {
				return null;
			}
		}else {
			return null;
		}
	}
}
?>