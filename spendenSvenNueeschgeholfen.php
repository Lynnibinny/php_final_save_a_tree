<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$_SESSION['pageloads'] = 0;
$servername = "127.0.0.1";
$username = "satree_user";
$password = "Uk$12?HB7";
$dbname = "Save_A_Tree";
$table = "TUser";

$conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
//echo($_SERVER['REQUEST_METHOD']);
// echo($_GET['epp_transaction_id']);
// echo($_POST['amount']);
error_log("hey papppiiiii",0);

if (('POST' == $_SERVER['REQUEST_METHOD']) && ($_SESSION['pageloads'] === 0)) {
	header('Content-type: text/html; charset=utf-8');
	if (isset($_POST['amount'])) {
	$amount = $_POST['amount'];
	$created = $_POST['created'];
	$transaction_id = $_POST['transaction_id'];
	$status = $_POST['status'];
	}
	if (!isset($_POST['amount'])) {
       die ('Benutzen sie nur Formulare von der Homepage.');
   }
	error_log("Spendebetrag: $amount",0);
	error_log("created: $created",0);
	error_log("transaction_id: $transaction_id",0);
	error_log("status: $status",0);
	echo("Spendebetrag: $amount");
	error_log($_SESSION['pageloads']);
	
	
        $UseId = $_SESSION['UseId'];
		$UseDonated = $amount;
        $sql = "UPDATE $table SET UseDonated = UseDonated + $UseDonated WHERE UseId = $UseId";
        error_log("$sql\n",3,"/var/www/i-kf.ch/SaveATree/logs/myphp6.log");
		if ($conn->query($sql) === TRUE) {
            echo "success";
			
        } else {
            echo "error";
        }
        $conn->close();
        return;
    
	
} else {
	//echo $_GET['id'];
	$_SESSION['UseId'] = $_GET['id'];
	//error_log("UseId: $_SESSION['UseId']",0);
	readfile('Website_spenden.html');
}
?>
