<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { header('Location: ' . URL . 'err.php'); }

    $choreId = $_GET['choreId'];
    $query  = "DELETE FROM tbl_chores_230 
               WHERE chore_id = '$choreId'";
    $result = mysqli_query($connection, $query);
    if (!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
    header('Location: ' . URL . 'index.php');
?>

<?php
    //close DB connection
    mysqli_close($connection);
?>