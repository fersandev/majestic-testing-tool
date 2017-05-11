<?php
/*
	Unit monitor creator
*/

require_once('UnitMonitorStorageVerificator.php'); 

class UnitMonitorStorage extends UnitMonitorStorageVerificator {

	/*
		true if is success, false in otherwise
	*/
	public function saveUnitMonitor($unitMonitor) {
		if($this->verifyPersistenceExistence()) {
			$str = file_get_contents($this->persistenceFileName);

			// verify that the expected value does not contain spaces
			$expectValue = $this->deleteSpacesInExpectedValue($unitMonitor);

			if(empty($str)) {
				$newList[0] = array(
					'_id'=>1,
					'keyword'=>$unitMonitor->keyword,
					'assertType'=>$unitMonitor->assertType,
					'expectValue'=>$expectValue,
					'description'=>$unitMonitor->description,
					'status'=>'red',
					'domainProject'=>$_SERVER['SERVER_NAME'],
					'isShared'=>false,
					'createAt'=>date('Y-m-d H:i:s'),
					'pathFile'=>'',
					'implementingType'=>$unitMonitor->implementingType, 
					'typeValueExpected'=>$unitMonitor->typeValueExpected
					);
				$newJsonList = json_encode($newList);
				$newFile = @fopen($this->persistenceFileName, "w");
				fwrite($newFile, $newJsonList);
				fclose($newFile);
				return true;
			}else {
				$jsonList = json_decode($str, true);

				if($this->isKeywordAvailable($unitMonitor->keyword)) {
					$lastMonitorRegistered = $jsonList[count($jsonList) - 1];
					$newId = ((int)$lastMonitorRegistered['_id']) + 1;
					$newMonitorArray = array(
						'_id'=>$newId,
						'keyword'=>$unitMonitor->keyword,
						'assertType'=>$unitMonitor->assertType,
						'expectValue'=>$this->castVariableToIndicated($expectValue,$unitMonitor->typeValueExpected),
						'description'=>$unitMonitor->description,
						'status'=>'red',
						'domainProject'=>$_SERVER['SERVER_NAME'],
						'isShared'=>false,
						'createAt'=>date('Y-m-d H:i:s'),
						'pathFile'=>'',
						'implementingType'=>$unitMonitor->implementingType, 
						'typeValueExpected'=>$unitMonitor->typeValueExpected
						);

					array_push($jsonList,$newMonitorArray);

					$updatedJsonList = json_encode($jsonList);
					$existingFile = @fopen($this->persistenceFileName, "w");
					fwrite($existingFile, $updatedJsonList);
					fclose($existingFile);
					return true;
				}else {
					return false;
				}
			}
		}else {
			return false;
		}
	}


	/*
		true if is success, false in otherwise
	*/
	public function updateUnitMonitor($unitMonitor) {

		if($this->verifyPersistenceExistence()) {
			$str = file_get_contents($this->persistenceFileName);
			if(empty($str)) {
				return false;
			}else {
				$jsonList = json_decode($str, true);
				foreach ($jsonList as $key => $value) {
					
					if($unitMonitor->_id == $value['_id']) {
						$valueToUpdate = array(
							'_id'=>$unitMonitor->_id,
							'keyword'=>$unitMonitor->keyword,
							'assertType'=>$unitMonitor->assertType,
							'expectValue'=>$unitMonitor->expectValue,
							'description'=>$unitMonitor->description,
							'status'=>$unitMonitor->status,
							'domainProject'=>$unitMonitor->domainProject,
							'isShared'=>$unitMonitor->isShared,
							'createAt'=>$unitMonitor->createAt,
							'pathFile'=>$unitMonitor->pathFile,
							'implementingType'=>$unitMonitor->implementingType, 
							'typeValueExpected'=>$unitMonitor->typeValueExpected
							);
						$jsonUpdate[] = $valueToUpdate;
					}else {
						$jsonUpdate[] = $value;
					}
				}

				$updatedJsonList = json_encode($jsonUpdate);
				$existingFile = @fopen($this->persistenceFileName, "w");
				if($existingFile) {
					fwrite($existingFile, $updatedJsonList);
					fclose($existingFile);
				}
				return true;
			}
		}else {
			return false;
		}
	}


	/*
		Delete all the extra spaces in the expected value
	*/
	public function deleteSpacesInExpectedValue($unitMonitor) {
		if($unitMonitor->typeValueExpected != 'boolean') {
			$expectValue = trim($unitMonitor->expectValue);
			if($unitMonitor->assertType == 'inList') {
				$expectValueArray = explode(',', $expectValue);
				foreach ($expectValueArray as $key => $value) {
					$expectValueArrayNew[] = trim($value);
				}
				$expectValue = implode(",", $expectValueArrayNew);
			}
			$expectValueWithoutSpaces = $expectValue;

			return $expectValueWithoutSpaces;			
		}else {
			return $unitMonitor->expectValue;
		}
	}	


	private function castVariableToIndicated($expectValue, $typeValueExpected) {
		switch ($typeValueExpected) {
			case 'string':
					return (string)$expectValue;
				break;
			
			case 'boolean':
					return (boolean)$expectValue;
				break;

			case 'numeric':
					return (float)$expectValue;
				break;
		}
	}


	public function resetAllUnitMonitors($unitMonitorStatus) {
		if($this->verifyPersistenceExistence()) {
			$str = file_get_contents($this->persistenceFileName);
			if(empty($str)) {
				return false;
			}else {
				$jsonList = json_decode($str, true);
				foreach ($jsonList as $key => $value) {
						$valueToUpdate = array(
							'_id'=>$value['_id'],
							'keyword'=>$value['keyword'],
							'assertType'=>$value['assertType'],
							'expectValue'=>$value['expectValue'],
							'description'=>$value['description'],
							'status'=>$unitMonitorStatus,
							'domainProject'=>$value['domainProject'],
							'isShared'=>$value['isShared'],
							'createAt'=>$value['createAt'],
							'pathFile'=>$value['pathFile'],
							'implementingType'=>$value['implementingType'], 
							'typeValueExpected'=>$value['typeValueExpected']
							);
						$jsonUpdate[] = $valueToUpdate;
				}

				$updatedJsonList = json_encode($jsonUpdate);
				$existingFile = @fopen($this->persistenceFileName, "w");
				if($existingFile) {
					fwrite($existingFile, $updatedJsonList);
					fclose($existingFile);
				}
				return true;
			}
		}else {
			return false;
		}
	}
}
?>