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

	function instantiateUnityMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType) {
		$this->keyword = $monitorKeyword;
		$this->assertType = $monitorAssertType;
		$this->expectValue = $monitorExpectValue;
		$this->description = $monitorDescription;
		$this->implementingType = $monitorImplementingType;
	}
}
?>