<?php
/*
	CRUD implementation for JSON file "persistence/monitor.json"
*/

require_once('iCrudMonitor.php'); 

class CrudMonitorImp implements iCrudMonitor {

	private $persistenceFileName = 'persistence/monitors.json';
	private $contentPersistenceFile = '';

	public function getMonitors() {
		$this->contentPersistenceFile = $this->readCreatePersistenceFile();
		if(!empty($this->contentPersistenceFile)) {
			$jsonList = json_decode($this->contentPersistenceFile, true);
			return $jsonList;
		}else {
			return null;
		}
	}

	public function getMonitorById($_id) {
		$jsonList = $this->getMonitors();
		if($jsonList != null) {
			$unitMonitorArray = null;
			foreach ($jsonList as $key => $value) {
				if($value['_id'] == (int)$_id) {
					$unitMonitorArray = $value;
					break;
				}
			}
			return $unitMonitorArray;
		}else {
			return null;
		}
	}

	public function getMonitorByKeyword($keyword) {
		$jsonList = $this->getMonitors();
		if($jsonList != null) {
			$unitMonitorArray = null;
			foreach ($jsonList as $key => $value) {
				if($value['keyword'] == $keyword) {
					$unitMonitorArray = $value;
					break;
				}
			}
			return $unitMonitorArray;
		}else {
			return null;
		}
	}

	public function saveNewMonitor($monitor) {
		$this->contentPersistenceFile = $this->readCreatePersistenceFile();
		$expectValue = $this->deleteSpacesInExpectedValue($monitor);

		if(empty($this->contentPersistenceFile)) {
			$_id = 1;
		}else {
			if($this->isKeywordAvailable($monitor->keyword)) {
				$jsonList = json_decode($this->contentPersistenceFile, true);
				$lastMonitorRegistered = $jsonList[count($jsonList) - 1];
				$_id = ((int)$lastMonitorRegistered['_id']) + 1;
			}else {
				return false;
			}
		}

		$newMonitorArray = array(
						'_id'=>$_id,
						'keyword'=>$monitor->keyword,
						'assertType'=>$monitor->assertType,
						'expectValue'=>$this->castVariableToIndicated($expectValue,$monitor->typeValueExpected),
						'description'=>$monitor->description,
						'status'=>'red',
						'domainProject'=>$_SERVER['SERVER_NAME'],
						'isShared'=>false,
						'createAt'=>date('Y-m-d H:i:s'),
						'pathFile'=>'',
						'implementingType'=>$monitor->implementingType, 
						'typeValueExpected'=>$monitor->typeValueExpected
						);
		$resultWriteNewMonitor = $this->writeArrayMonitorInPersistence($newMonitorArray);
		return $resultWriteNewMonitor;
	}

	public function updateMonitor($monitor) {
		$this->contentPersistenceFile = $this->readCreatePersistenceFile();
		if(empty($this->contentPersistenceFile)) {
			return false;
		}else {
			$jsonList = json_decode($this->contentPersistenceFile, true);
			foreach ($jsonList as $key => $value) {
				if($monitor->_id == $value['_id']) {
					$valueToUpdate = array(
						'_id'=>$monitor->_id,
						'keyword'=>$monitor->keyword,
						'assertType'=>$monitor->assertType,
						'expectValue'=>$monitor->expectValue,
						'description'=>$monitor->description,
						'status'=>$monitor->status,
						'domainProject'=>$monitor->domainProject,
						'isShared'=>$monitor->isShared,
						'createAt'=>$monitor->createAt,
						'pathFile'=>$monitor->pathFile,
						'implementingType'=>$monitor->implementingType, 
						'typeValueExpected'=>$monitor->typeValueExpected
						);
					$jsonUpdate[] = $valueToUpdate;
				}else {
					$jsonUpdate[] = $value;
				}
			}
			$updatedJsonList = json_encode($jsonUpdate);
			$resultUpdate = $this->updateMonitorsList($updatedJsonList);

			return $resultUpdate;
		}
	}

	public function resetAllUnitMonitors($unitMonitorStatus) {
		$this->contentPersistenceFile = $this->readCreatePersistenceFile();

		if(empty($this->contentPersistenceFile)) {
			return true;
		}else {
			$jsonList = json_decode($this->contentPersistenceFile, true);
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
			$resultUpdate = $this->updateMonitorsList($updatedJsonList);

			return $resultUpdate;
		}
	}

	public function deleteMonitor($_id) {
		$this->contentPersistenceFile = $this->readCreatePersistenceFile();

		if(!empty($this->contentPersistenceFile)) {
			$jsonList = json_decode($this->contentPersistenceFile, true);
			$newJsonList = array();
			foreach ($jsonList as $key => $value) {
				if($value['_id'] != $_id) {
						$newJsonList[] = $value;
				}
			}
			$updatedJsonList = json_encode($newJsonList);
			if($updatedJsonList == '[]') {
				$resultUpdate = $this->deleteMonitors();
			}else {
				$resultUpdate = $this->updateMonitorsList($updatedJsonList);
			}
			
			return $resultUpdate;
		}else {
			return false;
		}
	}

	public function deleteMonitors() {
		$this->contentPersistenceFile = $this->readCreatePersistenceFile();
		if(!empty($this->contentPersistenceFile)) {
			$resourceFile = $this->openResourceFile('w+');
			if($resourceFile) {
				$this->closeResourceFile($resourceFile);
				return true;
			}else {
				$this->closeResourceFile($resourceFile);
				return false;
			}
		}
	}

	public function isKeywordAvailable($keyword) {
		if(empty($this->contentPersistenceFile)) {
			return true;
		}else {
			$jsonContent = json_decode($this->contentPersistenceFile, true);
			foreach ($jsonContent as $key => $value) {
				if($value['keyword'] == $keyword) {
					return false;
				}
			}
			return true;
		}
	}

	private function openResourceFile($mode = 'w') {
		try {
			// use @ asside of fopen to suppress the warning
			$resourceFile = fopen($this->persistenceFileName, $mode);
			if($resourceFile) {
				return $resourceFile;
			}else {
				return false;
			}
		}catch(Exception $e) {
			return false;
		}
	}

	private function closeResourceFile($resourceFile) {
		fclose($resourceFile);
	}

	private function readCreatePersistenceFile() {
		try {
			// use @ asside of file_get_contents and fopen to suppress the warning
			$str = file_get_contents($this->persistenceFileName);
			if($str === false) {
				$resourceFile = $this->openResourceFile('w+');
				if($resourceFile) {
					$this->closeResourceFile($resourceFile);
					return "";
				}else {
					$this->closeResourceFile($resourceFile);
					return false;
				}
			}else {
				return $str;
			}
		}catch(Exception $e) {
			return false;
		}
	}

	private function deleteSpacesInExpectedValue($unitMonitor) {
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

	private function writeArrayMonitorInPersistence($arrayMonitor) {
		if(empty($this->contentPersistenceFile)) {
			$jsonList = array();
		}else {
			$jsonList = json_decode($this->contentPersistenceFile, true);
		}
		array_push($jsonList, $arrayMonitor);

		$updatedJsonList = json_encode($jsonList);

		$resourceFile = $this->openResourceFile('w');
		if($resourceFile) {
			if(fwrite($resourceFile, $updatedJsonList)) {
				$this->closeResourceFile($resourceFile);
				return true;
			}else {
				$this->closeResourceFile($resourceFile);
				return false;
			}
		}else {
			return false;
		}
	}

	private function updateMonitorsList($updatedJsonList) {
		$resourceFile = $this->openResourceFile('w');
		if($resourceFile) {
			if(fwrite($resourceFile, $updatedJsonList)) {
				$this->closeResourceFile($resourceFile);
				return true;
			}else {
				$this->closeResourceFile($resourceFile);
				return false;
			}
		}else {
			return false;
		}	
	}

}

?>