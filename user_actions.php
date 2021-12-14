<?php
	error_reporting(E_ALL);
    $servername = "XXXXXXX";
    $username = "XXXXXXX";
    $password = "XXXXXXX";
    $dbname = "XXXXXXX";
    $table = "XXXXXXX";

    $action = $_POST['action'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	error_log("got action:$action\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp3.log");
    
    if('GET_ALL' == $action){
        $dbdata = array();
        $sql = "SELECT UseId, UseMail, UseUserName, UseSavedTrees, UseDonated, UseGoals FROM $table ORDER BY UseId DESC";
        $result = $conn->query($sql);
		error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dbdata[]=$row;
            }
			error_log(json_encode($dbdata)."\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
            echo json_encode($dbdata);
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }

    if('ADD_USER' == $action){
        $UseMail = $_POST['UseMail'];
        $UseUserName = $_POST['UseUserName'];
		//$UsePicture = $_POST['UsePicture'];
		$UseSavedTrees = $_POST['UseSavedTrees'];
		$UseDonated = $_POST['UseDonated'];
		$UseGoals = $_POST['UseGoals'];
		$UsePassword = $_POST['UsePassword'];
		
        $sql = "INSERT INTO $table (UseMail, UseUserName, UseSavedTrees, UseDonated, UseGoals, UsePassword) VALUES('$UseMail', '$UseUserName', $UseSavedTrees, $UseDonated, $UseGoals, aes_encrypt('$UsePassword','G-KaPdSgUkXp2s5'))";
		// $sql = "INSERT INTO $table (UseMail, UseUserName, UsePicture, UseSavedTrees, UseDonated, UsePassword) VALUES('$UseMail', '$UseUserName', '$UsePicture', '$UseSavedTrees', '$UseDonated', aes_encrypt('$UsePassword','G-KaPdSgUkXp2s5'))";
		error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
        $result = $conn->query($sql);
		
        $sql = "SELECT LAST_INSERT_ID() as UseId"; //to figure out the ID of the last inserted user. We need this to remeber that this user has already registered before. 
        $result = $conn->query($sql);
		
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); //gets the first row of the result but we have just one anyways
            echo $row['UseId']; //sends the ID which is stored in the associative array row to the firstscreen widget. 
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }

    if('UPDATE_USER' == $action){
        $UseId = $_POST['UseId'];
        $UseMail = $_POST['UseMail'];
        $UseUserName = $_POST['UseUserName'];
		$UseSavedTrees = $_POST['UseSavedTrees'];
		$UseDonated = $_POST['UseDonated'];
		$UseGoals = $_POST['UseGoals'];
        $sql = "UPDATE $table SET UseMail = '$UseMail', UseUserName = '$UseUserName', UseSavedTrees = $UseSavedTrees, UseDonated = $UseDonated, UseGoals = $UseGoals WHERE UseId = $UseId";
        error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
		if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }

    if('DELETE_USER' == $action){
        $UseId = $_POST['UseId'];
        $sql = "DELETE FROM $table WHERE UseId = $UseId";
 		error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
		if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }
	
	if('LOGIN_USER' == $action){
		$UseUserName = $_POST['UseUserName'];
		$UsePassword = $_POST['UsePassword'];
		$sql = "SELECT UseId FROM $table WHERE UseUserName = '$UseUserName' AND UsePassword = aes_encrypt('$UsePassword','G-KaPdSgUkXp2s5')";
		error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); //gets the first row of the result but we have just one anyways
            echo $row['UseId'];
			//echo json_encode(UseId);
        } else {
            echo "error";
        }
        $conn->close();
        return;
	}
	
	
    
?>
