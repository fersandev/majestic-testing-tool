<?php
/*
	Dashboard
	Responsability: List the tests with its status.
	Access: The entrance is /mtt for all projects.
*/

require_once('/usecases/add_new_unit_monitor.php'); 
require_once('/usecases/delete_unit_monitor.php'); 
require_once('/usecases/delete_all_unit_monitors.php'); 

$creationMonitorMessage = '';
$deletionMonitorMessage = '';
if(isset($_REQUEST['flag']) and !empty($_REQUEST['flag'])) {
	switch ($_REQUEST['flag']) {
		case 'unitModuleCreation':
				$monitorKeyword = $_POST['monitorKeyword'];
				$monitorAssertType = $_POST['monitorAssertType'];
				$monitorExpectValue = $_POST['monitorExpectValue'];
				$monitorDescription = $_POST['monitorDescription'];
				$monitorImplementingType = $_POST['monitorImplementingType'];
				$unitModuleCreationResult = addNewUnitMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType);
				$creationMonitorMessage = $unitModuleCreationResult;
			break;

		case 'delete':
				$_id = (int)$_GET['_id'];
				$resultDeletion = deleteUnitMonitor($_id);
				$deletionMonitorMessage = $resultDeletion['msg'];
			break;

		case 'delete_all':
				$resultDeletion = deleteAllUnitMonitors();
				$deletionMonitorMessage = $resultDeletion['msg'];
			break;
		
		default:
			exit('INVALID ACCESS');
			break;
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard - Majestic Testing Tool</title>
		<style type="text/css">
			.column {
			  display: inline;
			  float: left;
			  padding: 0 2%;
			  width: 46%;
			}

			#column-1 {
			  background: white;
			}

			#column-2 {
			  background: white;
			}
		</style>
	</head>
<body>

<h1>Majestic Testing Tool</h1>

<!-- Left Column -->
<div class="column" id="column-1">
	<h2>Monitoring Module</h2>
	<!-- Unit Monitor Creation -->
	<section>
		<label><strong>Define the requirements to monitor</strong></label>
		<form action="index.php" method="post">
			<input type="hidden" name="flag" value="unitModuleCreation">
			Keyword 
			<input type="text" name="monitorKeyword" placeholder="Unique keyword for the unit monitor" required> <br>
			Assert Type 
			<select name="monitorAssertType" required>
				<option value="equal">Equal <small>(the expected value will be compare with the result)</small></option>
				<option value="greaterThan">Greater than <small>(will be used to campare if result is greater than expected value)</small></option>
				<option value="lessThan">Less than <small>(will be used to campare if result is less than expected value)</small></option>
				<option value="inequality">Inequality <small>(the expected value will be compare with the result)</small></option>
				<option value="inList">In list <small>(will be verify if the result is in a list of values)</small></option>
			</select><br>
			Expect Value <small>(if the assert type choosed is "In list", please separate the values with comma(,))</small> <br>
			<input type="text" name="monitorExpectValue" placeholder="Indicate the expect value for the functional requirement" required> <br>
			Description 
			<input type="text" name="monitorDescription" placeholder="Monitor description" required> <br>
			Select Implementing Type 
			<select name="monitorImplementingType" required>
				<option value="php">PHP</option>
				<option value="js">JavaScript</option>
			</select><br>
			<br>
			<?php if(isset($creationMonitorMessage) and !empty($creationMonitorMessage)) echo($creationMonitorMessage); ?>
			<input type="submit" value="Add Unit Monitor"> <br>
		</form>
	</section>

	<!-- Unit Monitor Listing -->
	<br>
	<section>
		<div>
			<a href="?flag=delete_all" onClick="if(!confirm('sure?')) return false;">Delete all unit monitors</a>
		</div>
		<br>

		<?php if(isset($deletionMonitorMessage) and !empty($deletionMonitorMessage)) echo($deletionMonitorMessage); ?>
		<?php
			require_once('/usecases/list_unit_monitors.php');
			$listUnitMonitors = getListUnitMonitors();
			if($listUnitMonitors['status'] == 'ok') {
				$listUnitMonitorsArray = $listUnitMonitors['result'];
				echo('<ol>');
				foreach ($listUnitMonitorsArray as $key => $value) {
					if($value['status'] == 'red') {
						$statusImg = '<img src="images/red_point.jpg" style="max-height:10px;">';
					}elseif ($value['status'] == 'green') {
						$statusImg = '<img src="images/green_point.jpg" style="max-height:10px;">';
					}
					$deleteOption = '<a onClick="if(!confirm(\'sure?\')) return false;" href="?_id='.$value['_id'].'&flag=delete"><img src="images/delete_icon.png" style="max-height:15px;"></a>';
					$monitoringCode = '<small><a target="_blank" href="monitoring_code.php?_id='.$value['_id'].'">monitoring code</a></small>';
					$shareStatusMonitor = '<img src="images/share_icon.png" style="max-height:15px;">';

					if($value['isShared']) {
						$isShared = 'yes';
					}else {
						$isShared = 'no';
					}
					
					echo('
						<li>
							'.$statusImg.' '.$value['keyword'].' ('.$value['implementingType'].') '.$shareStatusMonitor.' '.$deleteOption.' '.$monitoringCode.'
							<br>
							<p><small>
								Assert type: '.$value['assertType'].'<br>
								Expect value: '.$value['expectValue'].'<br>
								Description: '.$value['description'].'<br>
								Is shared: '.$isShared.'<br>
								Created at: '.$value['createAt'].'<br>
								Path file: '.$value['pathFile'].'<br>
							</small></p>
						</li>
						');
				}
				echo('</ol>');
			}else {
				echo($listUnitMonitors['msg']);
			}
		?>

	</section>
</div>

<!-- Right Column -->
<div class="column" id="column-2">
	<h2>Unit Testing Module</h2>
	<!-- Unit Test Creation -->
	<section>
		Unit Test (in construction)
	</section>

	<!-- Unit Test Listing -->
	<section>

	</section>
</div>

</body>
</html>