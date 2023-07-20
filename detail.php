<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }

    $choreId = $_GET["choreId"];
    
    $query = "SELECT tbl_users_230.user_name, tbl_users_230.user_img, tbl_users_230.user_description, tbl_chores_230.chore_time, tbl_chores_230.chore_help, tbl_chores_230.chore_description
              FROM tbl_chores_230
              INNER JOIN tbl_users_230 
              ON tbl_users_230.user_id = tbl_chores_230.chore_response 
              WHERE tbl_chores_230.chore_id = $choreId";
    $result = mysqli_query($connection, $query);
	if($result) {
		$row = mysqli_fetch_assoc($result);
	}
	else die("DB query failed.");
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
        <title>Detail</title>
    </head>

    <body>
        <header class="navbar navbar-expand-md">
            <a href="index.php" class="navbar-brand" id="logo"></a>
            <nav class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item nav-link"><a href="index.php">Home</a></li>
                    <li class="nav-item nav-link"><a href="profile.php">Profile</a></li>
                    <li class="nav-item nav-link"><a href="createChore.php">create a chore</a></li>
                    <li class="nav-item nav-link"><a href="logout.php">log out</a></li>
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
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card shadow-2-strong card-registration">
                                <div class="card-body p-4 p-md-5">
                                    <section class="detail">
                                        <?php
                                            echo '<h3 class="mb-4 pb-2 pb-md-0 mb-md-5">' . $row["user_name"] . '</h3>';
                                            echo '<img src="' . $row["user_img"] . '" class="rounded-circle mx-auto d-block" alt="profile" title="profile">';
                                            echo '<div class="card-body text-center">';
                                            echo    '<h4 class="card-title">' . $row["chore_help"] .' </h4>';
                                            echo    '<h6 class="city">' . $row["chore_time"] .'</h6>';
                                            echo    '<br>';
                                            echo    '<p class="card-text"><b> Details about volunteering: </b> <br>' . $row["chore_description"] . '</p>';
                                            echo    '<p class="card-text"><b> Details about the student: </b> <br>' . $row["user_description"] . '</p>';
                                            echo '</div>';
                                        ?>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
                                    
        <footer class="page-footer">
            <div class="d-flex justify-content-around">
                <a href="createChore.php">
                    <img src="images/createIcon.png" alt="Create chore" title="Create chore">
                </a>
                <a href="index.php">
                    <img src="images/homeIcon.png" alt="Home" title="Home">
                </a>
                <a href="profile">
                    <img src="images/profileIcon.png" alt="Profile" title="Profile">
                </a>
            </div>
        </footer>

        <script src="js/script.js"></script>
    </body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>