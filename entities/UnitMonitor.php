<?php
/*
	Represent an Unit monitor
*/

class UnitMonitor {
	public $_id;
	public $keyword;
	public $assertType;
	public $expectValue;
	public $description;
	public $status;
	public $domainProject;
	public $isShared;
	public $createAt;
	public $pathFile;
	public $implementingType;
	public $typeValueExpected;

	function instantiateUnityMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType, $monitorTypeValueExpected) {
		$this->setKeyword($monitorKeyword);
		$this->assertType = $monitorAssertType;
		$this->expectValue = $monitorExpectValue;
		$this->description = $monitorDescription;
		$this->implementingType = $monitorImplementingType;
		$this->typeValueExpected = $monitorTypeValueExpected;
	}

	public function setKeyword($keyword) {
		$this->keyword = str_replace(' ', '_', $keyword);
	}

	/*
		Return true if parse was success or false in otherwise
	*/
	function parseExpectedValueToCorrectType() {
		if(
			($this->assertType != 'variableType') and 
			($this->assertType != 'inList') and 
			($this->assertType != 'notUndefined') and 
			($this->assertType != 'notNull')
			) {
			if($this->typeValueExpected == 'boolean') {
				if(($this->expectValue == 'true') or ($this->expectValue == 'false')) {
					if($this->expectValue == 'true')
						$this->expectValue = true;
					else 
						$this->expectValue = false;
					return true;
				}else {
					return false;
				}
			}elseif ($this->typeValueExpected == 'numeric') {
				if(is_numeric($this->expectValue)) {
					$this->expectValue = (float)$this->expectValue;
					return true;
				}else {
					return false;
				}
			}elseif ($this->typeValueExpected == 'string') {
				$this->expectValue = (string)$this->expectValue;
				return true;
			}
		}else {
			return true;
		}
	}
}
?>