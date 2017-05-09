hello word mtt

<?php



// Unit Monitor
$resultToTest = "t"; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json=".json_encode(array('keyword'=>'e','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>$resultToTest)), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);


?>


<script>
// Unit Monitor
/*			var resultToTest = "8";
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json={\"keyword\":\"rrr\",\"pathFile\":\"\/mtt\/majestic-testing-tool\/testing_page.php\",\"resultToTest\":\""+resultToTest+"\"}");xhttp.send();*/
</script>




<script>
// Unit Monitor
/*
			var resultToTest = "54d";
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var requestUri="<?= $_SERVER['REQUEST_URI'] ?>";var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://"+serverName+"/vendor/fersandev/majestic-testing-tool/mttphp.php?flag=true&json={\"keyword\":\"rrr\",\"pathFile\":\""+requestUri+"\",\"resultToTest\":\""+resultToTest+"\"}");xhttp.send();
*/
</script>




<script>
/*
// Unit Monitor
			var resultToTest = true;
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var requestUri="<?= $_SERVER['REQUEST_URI'] ?>";var serverName="<?= $_SERVER['SERVER_NAME'] ?>";;xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json={\"keyword\":\"tyu\",\"pathFile\":\""+requestUri+"\",\"resultToTest\":\""+resultToTest+"\"}");xhttp.send();

		*/
</script>


<script>
// Unit Monitor
			var resultToTest = true;
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var requestUri="<?= $_SERVER['REQUEST_URI'] ?>";var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=true&json={\"keyword\":\"d\",\"pathFile\":\""+requestUri+"\",\"resultToTest\":"+resultToTest+"}");xhttp.send();
</script>
