<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if (!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php 
	//get data from querystring and escape variables for security
    $profileName = mysqli_real_escape_string($connection, $_GET['profileName']);
    $profilePass = mysqli_real_escape_string($connection, $_GET['profilePass']);
	$profileType = mysqli_real_escape_string($connection, $_GET['profileType']);
	$profileDescription = mysqli_real_escape_string($connection, $_GET['profileDescription']);
    $profileAddress  = mysqli_real_escape_string($connection, $_GET['profileAddress']);
	$profileEmail = mysqli_real_escape_string($connection, $_GET['profileEmail']);
    $profilePhone = mysqli_real_escape_string($connection, $_GET['profilePhone']);
	$profileImg = mysqli_real_escape_string($connection, $_GET['profileImg']);
    $profileCreate = mysqli_real_escape_string($connection, $_SESSION["user_id"]);

    $status  = $_GET['profileStatus'];
    $userId = $_SESSION["user_id"];

	if ($status == "insert") {
		$query = "INSERT INTO tbl_users_230(`user_name`, `user_pass`, `user_type`, `user_description`, `user_address`, `user_email`, `user_phone`, `user_img`) 
                  VALUES ('$profileName', '$profilePass', '$profileType', '$profileDescription', '$profileAddress', '$profileEmail', '$profilePhone', '$profileImg')";
	} else {
        $userId = $_GET['userId'];
		$query = "UPDATE tbl_users_230 
                  SET user_name='$profileName', user_type='$profileType', user_description='$profileDescription', user_address='$profileAddress', user_email='$profileEmail', user_phone='$profilePhone', user_img='$profileImg' 
                  WHERE user_id='$userId'";
	}
	$result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }

    if ($status == "insert")
        $user_id = mysqli_insert_id($connection);
    else
        $user_id = $userId;
    header('Location: ' . URL . 'profile.php?created_user_id=' . $user_id);
?>

<?php 
    // close DB connection
    mysqli_close($connection);
?>
