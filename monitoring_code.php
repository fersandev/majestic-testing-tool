<?php
/*
	Monitoring Code
	Responsability: Show the monitoring code for a unit monitor.
	Access: The entrance is /mtt for all projects.
*/


// Verify if the unit monitor id is setted
if(!isset($_GET['_id']) or empty($_GET['_id'])) {
	exit("FATAL ERROR");
}


require_once('/usecases/get_unit_monitor.php'); 

$unitMonitor = getUnitMonitorById($_GET['_id']);
if($unitMonitor['status'] == 'ok') {
	$unitMonitorInfo = $unitMonitor['result'];

	if($unitMonitorInfo['implementingType'] == 'php') {
		echo('<div><p>Monitoring PHP code to be inyected in functionality that require to be monitored</p>');
		echo('
			/*Params<br>
			*	resultToMonitor: the functionality result that you wish to monitor<br>
			* 	keyword: not touch this parameter
			*	pathFile: indicate the absolute path for the file, include the filename and line where you will add the function<br>
			*/<br>
			require_once(dirname(__FILE__) . \'/mtt/mttphp.php\'); <br>
			monitorDev(\'RESULT_TO_MONITOR\',\''.$unitMonitorInfo['keyword'].'\',$_SERVER[\'REQUEST_URI\']);
			');
		echo('</div>');		
	}


	if($unitMonitorInfo['implementingType'] == 'js') {
		echo('<div><p>Monitoring JavaScript code to be inyected in functionality that require to be monitored</p>');
		echo('
			/*<br>
				Place this just before the body closure tag<br>
			*/<br>
			<xmp><script src="http://<?php echo $_SERVER[\'HTTP_HOST\'] ?>/mtt/mttphp.js"></script></xmp><br>


			/*
				Place this into script tags
			*/<br>
			/*Params<br>
			*	resultToMonitor: the functionality result that you wish to monitor<br>
			* 	keyword: not touch this parameter
			*	pathFile: indicate the absolute path for the file, include the filename and line where you will add the function<br>
			*/<br>
			<xmp>
			monitorDev(\'RESULT_TO_MONITOR\',\''.$unitMonitorInfo['keyword'].'\',<?= $_SERVER[\'REQUEST_URI\'] ?>);
			</xmp>
			');
		echo('</div>');		
	}

}else {
	exit($unitMonitor['msg']);
}

?>