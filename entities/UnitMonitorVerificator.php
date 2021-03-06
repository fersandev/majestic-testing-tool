<?php
/*
	This class has the responsability of getting the unit monitors registered
*/

require_once('UnitMonitor.php'); 

class UnitMonitorVerificator {
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
			case 'notNull':
					if($this->mResultToTest === null) {
						return false;
					}else {
						if($this->mResultToTest === 'undefined') {
							return false;
						}else {
							return true;
						}
					}
				break;

			case 'notUndefined':
					if($this->mResultToTest !== 'undefined') {
						return true;
					}else {
						return false;
					}
				break;

			case 'equal':
					if($this->mUnitMonitor->expectValue === $this->mResultToTest) {
						return true;
					}else {
						return false;
					}
				break;

			case 'greaterThan':
					if(is_numeric($this->mResultToTest)) {
						if($this->mResultToTest > $this->mUnitMonitor->expectValue) {
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
						if($this->mResultToTest < $this->mUnitMonitor->expectValue) {
							return true;
						}else {
							return false;
						}
					}else {
						return false;
					}
				break;

			case 'inequality':
					if($this->mUnitMonitor->expectValue !== $this->mResultToTest) {
						return true;
					}else {
						return false;
					}
				break;

			case 'inList':
					$expectValueArray = explode(',', $this->mUnitMonitor->expectValue);
					if (in_array($this->mResultToTest, $expectValueArray)) {
					    return true;
					}else {
						return false;
					}
				break;

			case 'variableType':

					switch ($this->mUnitMonitor->typeValueExpected) {
						case 'boolean':
								if(is_bool($this->mResultToTest)) {
									return true;
								}else {
									return false;
								}
							break;

						case 'numeric':
								if(is_numeric($this->mResultToTest)) {
									return true;
								}else {
									return false;
								}
							break;

						case 'string':
								if(is_string($this->mResultToTest) and ($this->mResultToTest != 'undefined')) {
									return true;
								}else {
									return false;
								}
							break;
						
						default:
								return false;
							break;
					}
				break;
			
			default:
				return false;
				break;
		}
	}

}
?>