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
			if(empty($str)) {
				$newList[0] = array(
					'_id'=>1,
					'keyword'=>$unitMonitor->keyword,
					'assertType'=>$unitMonitor->assertType,
					'expectValue'=>$unitMonitor->expectValue,
					'description'=>$unitMonitor->description,
					'status'=>'red',
					'domainProject'=>$_SERVER['SERVER_NAME'],
					'isShared'=>false,
					'createAt'=>date('Y-m-d H:i:s'),
					'pathFile'=>'',
					'implementingType'=>$unitMonitor->implementingType
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
						'expectValue'=>$unitMonitor->expectValue,
						'description'=>$unitMonitor->description,
						'status'=>'red',
						'domainProject'=>$_SERVER['SERVER_NAME'],
						'isShared'=>false,
						'createAt'=>date('Y-m-d H:i:s'),
						'pathFile'=>'',
						'implementingType'=>$unitMonitor->implementingType
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
							'implementingType'=>$unitMonitor->implementingType
							);
						$jsonUpdate[] = $valueToUpdate;
					}else {
						$jsonUpdate[] = $value;
					}
				}

				$updatedJsonList = json_encode($jsonUpdate);
				$existingFile = @fopen($this->persistenceFileName, "w");
				fwrite($existingFile, $updatedJsonList);
				fclose($existingFile);
				return true;
			}
		}else {
			return false;
		}
	}
}
?>