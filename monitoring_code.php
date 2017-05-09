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
// Unit Monitor<br>
$resultToTest = \'RESULT TO CHECK\'; 
<br>
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => $_SERVER[\'SERVER_NAME\']."/vendor/fersandev/majestic-testing-tool/mttphp.php?flag=true&json=".json_encode(array(\'keyword\'=>\''.$unitMonitorInfo['keyword'].'\',\'pathFile\'=>$_SERVER[\'REQUEST_URI\'],\'resultToTest\'=>$resultToTest)), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);
			');
		echo('</div>');		
	}


	if($unitMonitorInfo['implementingType'] == 'js') {
		echo('<div><p>Monitoring JavaScript code to be inyected in functionality that require to be monitored</p>');
		echo('
			<xmp>
<script>
// Unit Monitor
			var resultToTest = "RESULT TO CHECK";
			var json = {keyword:"'.$unitMonitorInfo['keyword'].'", pathFile:"<?= $_SERVER[\'REQUEST_URI\'] ?>", resultToTest:resultToTest};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER[\'SERVER_NAME\'] ?>";xhttp.open("GET", "http://"+serverName+"/vendor/fersandev/majestic-testing-tool/mttphp.php?flag=true&json="+JSON.stringify(json)+"");xhttp.send();
</script>
			</xmp>
			');
		echo('</div>');		
	}

}else {
	exit($unitMonitor['msg']);
}

?>