<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php 
	//get data from querystring and escape variables for security
    $choreTime  = mysqli_real_escape_string($connection, $_GET['choreTime']);
	$choreHelp = mysqli_real_escape_string($connection, $_GET['choreHelp']);
	$choreDescription  = mysqli_real_escape_string($connection, $_GET['choreDescription']);
    $choreStatus = mysqli_real_escape_string($connection, 'New');
    $choreCreate = mysqli_real_escape_string($connection, $_SESSION["user_id"]);

	$status  = $_GET['status'];
	$userId = $_SESSION["user_id"];

	if ($status == "insert") {
		$query = "INSERT INTO tbl_chores_230(`chore_time`, `chore_help`, `chore_description`, `chore_status`, `chore_create`) 
                  VALUES ('$choreTime', '$choreHelp', '$choreDescription', '$choreStatus', '$choreCreate')";
	}
	else {
        $choreId = $_GET['choreId'];
		$query = "UPDATE tbl_chores_230 
                  SET chore_time='$choreTime', chore_help='$choreHelp', chore_description='$choreDescription', chore_status='$choreStatus', chore_create='$choreCreate' 
                  WHERE chore_id='$choreId'";
	}

	$result = mysqli_query($connection, $query);

    if(!$result) {
        die("DB query failed.");
    }
    header('Location: ' . URL . 'index.php');
?>

<?php 
    //release returned data
    mysqli_free_result($result);
    //close DB connection
    mysqli_close($connection);
?>
