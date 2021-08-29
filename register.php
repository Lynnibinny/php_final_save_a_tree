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
			if (!isset($_POST['UseMail'], $_POST['UseUserName'], $_POST['UsePassword'],)) {
				die ('Benutzen sie nur Formulare von der Homepage.');
			}
			if (('' == $UseUserName = trim($_POST['UseUserName'])) or 
				('' == $UsePassword = trim($_POST['UsePassword']))) {
					die ('Bitte füllen sie das Formular vollständig aus.');
			}
			$UseMail = $_POST['UseMail'];
			$UseUserName = $_POST['UseUserName'];
			$UseSavedTrees = 0;
			$UseDonated = 0.0;
			$UseGoals = 0;
			$UsePassword = $_POST['UsePassword'];
			
			$sql = "INSERT INTO $table (UseMail, UseUserName, UseSavedTrees, UseDonated, UseGoals, UsePassword) VALUES('$UseMail', '$UseUserName', $UseSavedTrees, $UseDonated, $UseGoals, aes_encrypt('$UsePassword','G-KaPdSgUkXp2s5'))";
			error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp9.log");
			$result = $conn->query($sql);
		
			$sql = "SELECT LAST_INSERT_ID() as UseId"; //to figure out the ID of the last inserted user. We need this to remeber that this user has already registered before. 
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc(); //gets the first row of the result but we have just one anyways
				echo $row['UseId']; //sends the ID which is stored in the associative array row to the firstscreen widget. 
				$useid = $row['UseId'];
			} else {
				echo "error";
			}
			
			$conn->close();
			Header("Location: spenden.php?id=$useid");
			return;
		}
	readfile('footer.html');
?>
