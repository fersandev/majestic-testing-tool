hello word mtt

<?php



// Unit Monitor
$resultToTest = true; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'aaaa','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>$resultToTest)), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);

// Unit Monitor
$resultToTest = 15; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'ccc','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>$resultToTest)), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);


// Unit Monitor
$resultToTest = 45; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'eee','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>$resultToTest)), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);


// Unit Monitor
$resultToTest = 'RESULT TO CHECK'; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'ggg','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>urlencode($resultToTest))), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);


// Unit Monitor
$resultToTest = 'a'; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'iii','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>$resultToTest)), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);


// Unit Monitor
$resultToTest = 'RESULT TO CHECK'; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'kkk','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>urlencode($resultToTest))), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);



// Unit Monitor
$resultToTest = "ss"; 
$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_URL => "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=php&json=".json_encode(array('keyword'=>'mmm','pathFile'=>$_SERVER['REQUEST_URI'],'resultToTest'=>urlencode($resultToTest))), CURLOPT_RETURNTRANSFER => true,CURLOPT_ENCODING => "",CURLOPT_MAXREDIRS => 10,CURLOPT_TIMEOUT => 30,CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,CURLOPT_CUSTOMREQUEST => "GET",CURLOPT_HTTPHEADER => array("cache-control: no-cache"),));$response = curl_exec($curl);curl_close($curl);


?>



<script>
// Unit Monitor
			var resultToTest = "yes yes";
			var json = {keyword:"bbb", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:encodeURIComponent(resultToTest)};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>


<script>
// Unit Monitor
			var resultToTest = 16;
			var json = {keyword:"ddd", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:encodeURIComponent(resultToTest)};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>

<script>
// Unit Monitor
			var resultToTest = "ss";
			var json = {keyword:"fff", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:resultToTest};

		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;/*alert(this.responseText);*/}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>

<script>
// Unit Monitor
			var resultToTest = 67;
			var json = {keyword:"hhh", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:resultToTest};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>

<script>
// Unit Monitor
			var resultToTest = false;
			var json = {keyword:"jjj", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:resultToTest};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>

<script>
// Unit Monitor
			var resultToTest = 123;
			var json = {keyword:"lll", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>

<script>
// Unit Monitor
			var resultToTest2 = 2;
			var json = {keyword:"nnn", pathFile:"<?= $_SERVER['REQUEST_URI'] ?>", resultToTest:encodeURIComponent(resultToTest2)};
		var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {var response = this.responseText;}};var serverName="<?= $_SERVER['SERVER_NAME'] ?>";xhttp.open("GET", "http://localhost/mtt/majestic-testing-tool/mttphp.php?flag=js&json="+JSON.stringify(json)+"");xhttp.send();
</script>