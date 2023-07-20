<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { header('Location: ' . URL . 'err.php'); }

    $userId = $_GET['userId'];
    $query  = "DELETE FROM tbl_users_230 
               WHERE user_id= '$userId'";
    $result = mysqli_query($connection, $query);
    if(!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
    header('Location: ' . URL . 'index.php');
?>

<?php
    //close DB connection
    mysqli_close($connection);
?>