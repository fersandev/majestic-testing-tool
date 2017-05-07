<?php
/*
	This class has the responsability of getting the unit monitors registered
*/

require_once('entities/UnitMonitor.php'); 
require_once('UnitMonitorStorageVerificator.php'); 

class UnitMonitorVerificator extends UnitMonitorStorageVerificator {
	private $mUnitMonitor;
	private $mResultToTest;

	/*
		Return true if the logic is correct, false in otherwise
	*/
	public function checkIfResultArrivedIsTheExpected($unitMonitor, $resultToTest) {
		$this->mUnitMonitor = $unitMonitor;
		$this->mResultToTest = $resultToTest;

		if($this->isValidAccordingItSpecification()) {
			return true;
		}else {
			return false;
		}
	}

	private function isValidAccordingItSpecification() {
		switch ($this->mUnitMonitor->assertType) {
			case 'equal':
					if($this->mUnitMonitor->expectValue == (string)$this->mResultToTest) {
						return true;
					}else {
						return false;
					}
				break;

			case 'greaterThan':
					if(is_numeric($this->mResultToTest)) {
						if((int)$this->mResultToTest > (int)$this->mUnitMonitor->expectValue) {
							return true;
						}else {
							return false;
						}
					}else {
						return false;
					}
				break;

			case 'lessThan':
					if(is_numeric($this->mResultToTest)) {
						if((int)$this->mResultToTest < (int)$this->mUnitMonitor->expectValue) {
							return true;
						}else {
							return false;
						}
					}else {
						return false;
					}
				break;

			case 'inequality':
					if($this->mUnitMonitor->expectValue != (string)$this->mResultToTest) {
						return true;
					}else {
						return false;
					}
				break;

			case 'inList':
					$expectValueArray = explode(',', $this->mUnitMonitor->expectValue);
					if (in_array((string)$this->mResultToTest, $expectValueArray)) {
					    return true;
					}else {
						return false;
					}
				break;
			
			default:
				return false;
				break;
		}
	}

}
?>