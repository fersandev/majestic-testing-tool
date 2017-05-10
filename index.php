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
				$monitorTypeValueExpected = $_POST['monitorTypeValueExpected'];
				$unitModuleCreationResult = addNewUnitMonitor($monitorKeyword, $monitorAssertType, $monitorExpectValue, $monitorDescription, $monitorImplementingType, $monitorTypeValueExpected);
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

		case 'deleteUnitMonitorsSelected':
				$chainWithSelectedUnitMonitorsIds = $_POST['unitMonitorsIdsToDelete'];
				$resultDeletion = deleteSelectedUnitMonitors($chainWithSelectedUnitMonitorsIds);
				$deletionMonitorMessage = $resultDeletion['msg'];
			break;

		case 'loadFormEdit':
				$_id = (int)$_GET['_id'];
				$resultDeletion = deleteUnitMonitor($_id);
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
		<link href="//fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
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

			<div class="form-row">
				<div class="form-control left">
					<label for="monitorKeyword">Keyword</label>
					<input type="text" id="monitorKeyword" name="monitorKeyword" placeholder="Unique keyword for the unit monitor" required>
				</div>
				
				<div class="form-control right">
					<label for="monitorAssertType">Assert Type</label>
					<select id="monitorAssertType" name="monitorAssertType" required onChange="isVariableType(this.value)">
						<option value="equal">Equal</option>
						<option value="greaterThan">Greater than <small>(will be used to campare if result is greater than expected value)</small></option>
						<option value="lessThan">Less than <small>(will be used to campare if result is less than expected value)</small></option>
						<option value="inequality">Inequality <small>(the expected value will be compare with the result)</small></option>
						<option value="inList">In list <small>(will be verify if the result is in a list of values)</small></option>
						<option value="variableType">Variable Type <small>(will be verify if the result is of variable type</small></option>
						<option value="notNull">Not null <small>(will be verify if the result is not null</small></option>
						<option value="notUndefined">Not undefined <small>(will be verify if the result is not undefined</small></option>
					</select>
				</div>
			</div>

			<div class="form-row">
				<div class="form-control left">
					<label for="monitorExpectValue">Expect Value</label>
					<input id="monitorExpectValue" type="text" name="monitorExpectValue" placeholder="Indicate the expect value for the functional requirement" required>
					<small>(if the assert type choosed is "In list", please separate the values with comma(,))</small>
				</div>
				
				<div class="form-control right">
					<label for="monitorTypeValueExpected">Type Value</label>
					<select id="monitorTypeValueExpected" name="monitorTypeValueExpected" required>
						<option value="boolean">Boolean</option>
						<option value="string">String</option>
						<option value="numeric">Numeric</option>
					</select>
				</div>
			</div>

			<div class="form-row">
				<div class="form-control left">
					<label for="monitorDescription">Description</label>
					<input type="text" id="monitorDescription" name="monitorDescription" placeholder="Monitor description" required>
				</div>

				<div class="form-control right">
					<label for="monitorImplementingType">Select Implementing Type</label>
					<select id="monitorImplementingType" name="monitorImplementingType" required>
						<option value="js">JavaScript</option>
						<option value="php">PHP</option>
					</select>
				</div>
			</div>
			<br>
			<?php if(isset($creationMonitorMessage) and !empty($creationMonitorMessage)) echo($creationMonitorMessage); ?>
			<input type="submit" value="Add Unit Monitor">
		</form>
	</section>

	<!-- Unit Monitor Listing -->
	<br>
	<section>
		<div>
			<a href="?flag=delete_all" onClick="if(!confirm('sure?')) return false;">Delete all unit monitors</a>
			<br>
			<br>
			<form action="index.php" method="post">
				<input type="hidden" name="flag" value="deleteUnitMonitorsSelected">
				<input type="hidden" name="unitMonitorsIdsToDelete" id="unitMonitorsIdsToDelete">
				<input type="submit" value="Delete selected unit monitors">
			</form>
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
					$editOption = '';//'<a href="?_id='.$value['_id'].'&flag=edit"><img src="images/edit_icon.png" style="max-height:15px;"></a>';

					if($value['isShared']) {
						$isShared = 'yes';
					}else {
						$isShared = 'no';
					}

					if(is_bool($value['expectValue'])) {
						if($value['expectValue'])
							$expectedValueInList = 'true';
						else {
							$expectedValueInList = 'false';
						}
					}else {
						$expectedValueInList = $value['expectValue'];
					}
					
					echo('
						<li>
							<input type="checkbox" value="'.$value['_id'].'" onChange="markToDelete(this.value, this.checked)"> &nbsp;
							'.$statusImg.' '.$value['keyword'].' ('.$value['implementingType'].') <br> '.$editOption.' ' .$shareStatusMonitor.' '.$deleteOption.' '.$monitoringCode.' 
							<br>
							<p><small>
								Assert type: '.$value['assertType'].'<br>
								Expect value: '.$expectedValueInList.'<br>
								Value type: '.$value['typeValueExpected'].'<br>
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
		<center>Unit Test (in construction)</center>
	</section>

	<!-- Unit Test Listing -->
	<section>

	</section>
</div>


<script>
	function isVariableType(assertType) {
		// all fields available
		document.getElementById("monitorExpectValue").value = "";
		document.getElementById("monitorExpectValue").type = "text";
		document.getElementById("monitorTypeValueExpected").innerHTML = '<option value="boolean">Boolean</option><option value="string">String</option><option value="numeric">Numeric</option>';
		document.getElementById("monitorTypeValueExpected").style.visibility = "visible";
		document.getElementById("monitorImplementingType").style.visibility = "visible";

		if(assertType == "variableType") {
			document.getElementById("monitorExpectValue").value = " -- ";
			document.getElementById("monitorExpectValue").type = "hidden";
		}else {
			if(assertType == "inList") {
				document.getElementById("monitorExpectValue").value = "";
				document.getElementById("monitorExpectValue").type = "text";
				document.getElementById("monitorTypeValueExpected").innerHTML = '<option value="string">String</option>';
			}else {
				if(assertType == "greaterThan" || assertType == "lessThan") {
					document.getElementById("monitorExpectValue").value = "";
					document.getElementById("monitorExpectValue").type = "text";
					document.getElementById("monitorTypeValueExpected").innerHTML = '<option value="numeric">Numeric</option>';
				}else {
					if(assertType == "notNull") {
						document.getElementById("monitorExpectValue").value = " -- ";
						document.getElementById("monitorExpectValue").type = "hidden";
						document.getElementById("monitorTypeValueExpected").style.visibility = "hidden";
					}else {
						if(assertType == "notUndefined") {
							document.getElementById("monitorExpectValue").value = " -- ";
							document.getElementById("monitorExpectValue").type = "hidden";
							document.getElementById("monitorTypeValueExpected").style.visibility = "hidden";
							document.getElementById("monitorImplementingType").style.visibility = "hidden";
						}
					}
				}
			}
		}
	}
	

	function markToDelete(idUnitMonitor, isChecked) {
		if(isChecked) {
			var unitMonitorsIdsToDeleteContent = document.getElementById("unitMonitorsIdsToDelete").value;
			if(unitMonitorsIdsToDeleteContent.length > 0) {
				var arrayWithIds = unitMonitorsIdsToDeleteContent.split("-");
				arrayWithIds.push(idUnitMonitor);
				document.getElementById("unitMonitorsIdsToDelete").value = arrayWithIds.join("-");
			}else {
				document.getElementById("unitMonitorsIdsToDelete").value = idUnitMonitor;
			}
		}else {
			var unitMonitorsIdsToDeleteContent = document.getElementById("unitMonitorsIdsToDelete").value;
			var arrayWithIds = unitMonitorsIdsToDeleteContent.split("-");
			var i;
			var newContentOfIdsToDelete = "";
			for (i = 0; i < arrayWithIds.length; i++) {
				if(arrayWithIds[i] != idUnitMonitor) {
					newContentOfIdsToDelete += arrayWithIds[i];
					if(i <= arrayWithIds.length) {
						newContentOfIdsToDelete += "-";
					}
				}
			}
			document.getElementById("unitMonitorsIdsToDelete").value = newContentOfIdsToDelete;
		}
	}
</script>
</body>
</html>