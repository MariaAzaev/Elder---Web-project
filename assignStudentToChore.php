<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if (!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php
    $userId = $_SESSION["user_id"];
    $choreId = $_GET["chore_id"];
    $choreStatus = 'done';

    $query = "UPDATE tbl_chores_230 
              SET chore_status='$choreStatus', chore_response='$userId' 
              WHERE chore_id='$choreId'";
    $result = mysqli_query($connection, $query);
    if (!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }

    header('Location: ' . URL . 'homeStu.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>userId</h1>
        <span><?= $userId ?></span>
        <h1>choreId</h1>
        <span><?= $choreId ?></span>
    </body>
</html>

<?php
    // close DB connection
    mysqli_close($connection);
?>