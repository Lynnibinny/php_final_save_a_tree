<?php
		error_reporting(E_ALL);
		$servername = "127.0.0.1";
		$username = "satree_user";
		$password = "Uk$12?HB7";
		$dbname = "Save_A_Tree";
		$table = "TUser";
		$action = $_POST['action'];

    	$conn = new mysqli($servername, $username, $password, $dbname);
    
    	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
    	}
		error_log("got action:$action\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp3.log");
    
		readfile('header.html'); // enthält auch das <body>-tag
		
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			if (!isset($_POST['UseUserName'], $_POST['UsePassword'])) {
				die ('Benutzen sie nur Formulare von der Homepage.');
			}
			if (('' == $UseUserName = trim($_POST['UseUserName'])) or 
				('' == $UsePassword = trim($_POST['UsePassword']))) {
					die ('Bitte füllen sie das Formular vollständig aus.');
			}
			$UseUserName = $_POST['UseUserName'];
			$UsePassword = $_POST['UsePassword'];
			$sql = "SELECT UseId FROM $table WHERE UseUserName = '$UseUserName' AND UsePassword = aes_encrypt('$UsePassword','G-KaPdSgUkXp2s5')";
			error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp8.log");
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); //gets the first row of the result but we have just one anyways
            echo $row['UseId'];
			$useid = $row['UseId'];
			//echo json_encode(UseId);
			} else {
            echo "error";
			}
			$conn->close();
			Header("Location: spenden.php?id=$useid");
			exit;
			return;
		}
	readfile('footer.html');
?>
