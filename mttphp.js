	function monitorDev(resultToTest, keyword, pathFile) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var response = this.responseText;
			}
		};
		xhttp.open("GET", "mttphp.php?flag=js&resultToTest="+resultToTest+"&keyword="+keyword+"&pathFile="+pathFile+"", true);
		xhttp.send();
	}

