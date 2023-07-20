<?php
    include 'db.php';
    include 'config.php';

    session_start();
    $userId = $_SESSION["user_id"];
    $query 	= " SELECT tbl_users_230.user_name, tbl_users_230.user_img, tbl_chores_230.chore_time, tbl_users_230.user_address, 
                       tbl_chores_230.chore_description, tbl_chores_230.chore_help, tbl_chores_230.chore_id 
                FROM tbl_users_230
                INNER JOIN tbl_chores_230 
                ON tbl_users_230.user_id = tbl_chores_230.chore_create 
                WHERE tbl_chores_230.chore_status = 'New'";
    $result = mysqli_query($connection, $query);
    if(!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
        <link rel="stylesheet" href="css/style.css">
        <title>My chores - Student</title>
    </head>

    <body>
        <header class="navbar navbar-expand-md">
            <a href="homeStu.php" class="navbar-brand" id="logo"></a>
            <nav class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item nav-link"><a class="selcted" href="homeStu.php">Home</a></li>
                    <li class="nav-item nav-link"><a href="profile.php">Profile</a></li>
                    <li class="nav-item nav-link"><a href="login.php">log out</a></li>
                </ul>
            </nav>
            <a class="d-flex align-items-center hidden-arrow" href="#">
                <?php
                    $img = $_SESSION["user_img"];
                    if(!$img) $img = "images/default.png";
                    echo '<img src="'. $img . '" class="rounded-circle float-end" alt="profile" title="profile">';
                ?>            
            </a>
        </header>

        <main class="wrapper">
            <br>
            <h2>Chores Feed:</h2>
            <br>
            <div class="row">
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-4">';
                    echo    '<div class="card h-80">';
                    echo        '<div class="thumbnail">';
                    echo            '<img src="' . $row["user_img"] . '" class="rounded-circle mx-auto d-block" alt="profile" title="profile">';
                    echo            '<div class="card-body text-center">';
                    echo                '<h4 class="card-title">' . $row["user_name"] . '</h4>';
                    echo                '<h6 class="city">' . $row["user_address"] . '</h6>';
                    echo                '<h6 class="city">' . $row["chore_time"] . '</h6>';
                    echo                '<br>'; 
                    echo                '<h5 class="city">' . $row["chore_help"] . '</h5>';
                    echo                '<p class="card-text">' . $row["chore_description"] . '</p>';
                    echo                '<a href="assignStudentToChore.php?chore_id=' . $row["chore_id"] .'" class="btn">Add chore</a>';
                    echo            '</div>';
                    echo        '</div>';
                    echo    '</div>';
                    echo    '<br>';
                    echo '</div>';
                    }
                ?>
            </div>
        </main>

        <footer class="page-footer">
            <div class="d-flex justify-content-around">
                <a href="#">
                    <img src="images/createIcon.png" alt="Create chore" title="Create chore">
                </a>
                <a href="homeStu.php">
                    <img src="images/homeIcon.png" alt="Home" title="Home">
                </a>
                <a href="profile.php">
                    <img src="images/profileIcon.png" alt="Profile" title="Profile">
                </a>
            </div>
        </footer>

        <?php 
            //release returned data
            if($result) mysqli_free_result($result);
        ?>
    </body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>