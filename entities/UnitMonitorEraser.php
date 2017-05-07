<?php
/*
	This class has the responsability of getting the unit monitors registered
*/

require_once('UnitMonitorStorageVerificator.php'); 

class UnitMonitorEraser extends UnitMonitorStorageVerificator {

	/*
		delete an unit monitor identify by _id
	*/
	public function deleteUnitMonitor($_id) {
		if($this->verifyPersistenceExistence()) {
			$str = file_get_contents($this->persistenceFileName);
			if(!empty($str)) {
				$jsonList = json_decode($str, true);
				foreach ($jsonList as $key => $value) {
					if($value['_id'] != $_id) {
						$newJsonList[] = $value;
					}
				}
				$existingFile = @fopen($this->persistenceFileName, "w");
				if(isset($newJsonList) and ($newJsonList != null)) {
					$updatedJsonList = json_encode($newJsonList);
					fwrite($existingFile, $updatedJsonList);
				}
				fclose($existingFile);
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}


	/*
		delete all unit monitors registered, this method truncate the persistence file
	*/
	public function deleteAllUnitMonitors() {
		if($this->verifyPersistenceExistence()) {
			$existingFile = @fopen($this->persistenceFileName, "w");
			fclose($existingFile);
			return true;
		}else {
			return false;
		}
	}
}
?>