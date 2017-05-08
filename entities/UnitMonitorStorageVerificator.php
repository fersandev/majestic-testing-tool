<?php
/*
	This class has the responsability of to verify if the json monitor file persistence exist
*/


class UnitMonitorStorageVerificator {
	protected $persistenceFileName = 'persistence/monitors.json';

	/*
		true if file exist, false in otherwise
	*/
	protected function verifyPersistenceExistence() {
		try {
			$str = @file_get_contents($this->persistenceFileName);
			if($str === false) {
				if(@fopen($this->persistenceFileName, "w+")) {
					return true;
				}else {
					return false;
				}
			}else {
				return true;
			}
		}catch(Exception $e) {
			return false;
		}
	}


	/*
		true if is available, false in otherwise
	*/
	protected function isKeywordAvailable($keyword) {
		try {
			$str = @file_get_contents($this->persistenceFileName);
			if($str !== false) {
				$jsonContent = json_decode($str, true);
				foreach ($jsonContent as $key => $value) {
					if($value['keyword'] == $keyword) {
						return false;
					}
				}

				return true;
			}else {
				return false;
			}
		}catch(Exception $e) {
			return false;
		}
	}
}
?>