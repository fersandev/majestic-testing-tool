<?php

$varToTest = "c";

/*Params
*	resultToMonitor: the functionality result that you wish to monitor
* keyword: not touch this parameter *	pathFile: indicate the absolute path for the file, include the filename and line where you will add the function
*/
require_once(dirname(__FILE__).'/mttphp.php'); 
monitorDev($varToTest,'monitor 5',$_SERVER['REQUEST_URI']);
?>


<script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/majestic%20testing%20tool/mttphp.js"></script>
<script>
	var varToTest = "h";
	monitorDev(varToTest,'monitor 6',<?php echo $_SERVER['REQUEST_URI'] ?>);
</script>





Testing Page<br>
