<?php
/*
	public interface to do CRUD with de data
*/

interface iCrudMonitor {

	public function getMonitors();
	public function getMonitorById($_id);
	public function getMonitorByKeyword($keyword);
	public function saveNewMonitor($monitor);
	public function updateMonitor($monitor);
	public function deleteMonitor($_id);
	public function deleteMonitors();
	public function isKeywordAvailable($keyword);
	public function resetAllUnitMonitors($monitorStatus);

}

?>