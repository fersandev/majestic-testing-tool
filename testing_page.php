hello word mtt

<?php




// Unit Monitor
$resultToTest = 'some diferently'; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json=".json_encode(array('keyword'=>'last_to','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>urlencode($resultToTest))), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);
?>


<script>
// Unit Monitor
			var resultToTest = "to compare";
			var json = {keyword:"last_to_2", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:encodeURIComponent(resultToTest)};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json="+JSON.stringify(json)+"");xhttp.send();
</script>




<script>
// Unit Monitor
/*
			var resultToTest = "w";
			var json = {keyword:"test2", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:resultToTest};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json="+JSON.stringify(json)+"");xhttp.send();
		*/
</script>


<script>
// Unit Monitor
			/*var resultToTest = 5;
			var json = {keyword:"test_3", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:resultToTest};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json="+JSON.stringify(json)+"");xhttp.send();*/
</script>
