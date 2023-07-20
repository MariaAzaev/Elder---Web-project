<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if (!isset($_SESSION["user_id"])) {
        header('Location: ' . URL . 'login.php');
    }
?>

<?php
    if (isset($_GET["created_user_id"])) {
        $userId = $_GET["created_user_id"];
    } else {
	    $userId = $_SESSION["user_id"];
    }
	
    $status = "insert";
    $query = "SELECT * FROM tbl_users_230 WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
	if ($result) {
		$row = mysqli_fetch_assoc($result); // there is only 1 with id=X
	}
    else{
        header('Location: ' . URL . 'index.php');
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
        <title>Profile</title>
    </head>

    <body>
        <header class="navbar navbar-expand-md">
            <a class="navbar-brand" href="homeStu.php" id="logo"></a>
            <nav class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item nav-link"><a class="selcted" href="homeStu.php">Home</a></li>
                    <li class="nav-item nav-link"><a href="profile.php">Profile</a></li>
                    <li class="nav-item nav-link"><a href="createChore.php">create a chore</a></li>
                    <li class="nav-item nav-link"><a href="login.php">log out</a></li>
                </ul>
            </nav>
            <a class="d-flex align-items-center hidden-arrow" href="#">
                <?php
                    $img = $row["user_img"];
                    if(!$img) $img = "images/default.png";
                    echo '<img src="'. $img . '" class="rounded-circle float-end" alt="profile" title="profile">';
                ?>           
            </a>
        </header>

        <main class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-4">
                        <div class="cardProfile">
                            <a href="login.php">
                                <div class="media">
                                    <img class="mr-3" src="images/logoutIcon.png" alt="logout" title="logout">
                                    <div class="media-body">
                                        <h5 class="mt-3">Log out</h5>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <?php
                                    $name = $row["user_name"];
                                    $type = $row["user_type"];
                                    $desc = $row["user_description"];
                                    $add  = $row["user_address"];
                                    $mail = $row["user_email"];
                                    $phon = $row["user_phone"];

                                    echo '<div class="mt-3 mb-4">';
                                    echo    '<img src="' . $img . '" class="rounded-circle img-fluid" alt="profile" title="profile">';
                                    echo '</div>';
                                    echo '<h4 class="mb-2">' . $name .' - ' . $type . '</h4>';
                                    echo '<p class="text-muted mb-4">' . $desc . '</p>';
                                    echo '<div class="d-flex justify-content-between text-center mt-5 mb-2">';
                                    echo    '<div>';
                                    echo        '<p class="mb-2 h5">Address</p>';
                                    echo        '<p class="text-muted mb-0">' . $add . '</p>';
                                    echo    '</div>';
                                    echo    '<div class="px-3">';
                                    echo        '<p class="mb-2 h5">Email</p>';
                                    echo        '<p class="text-muted mb-0">' . $mail . '</p>';
                                    echo    '</div>';
                                    echo    '<div>';
                                    echo        '<p class="mb-2 h5">Phone</p>';
                                    echo        '<p class="text-muted mb-0">' . $phon . '</p>';
                                    echo    '</div>';
                                    echo '</div>';
                                    echo '<a href="editProfile.php?userId=' . $row["user_id"] . '" class="btn">';
                                    echo    '<img src="images/edit.png" alt="edit" title="edit"> Edit';
                                    echo '</a>'; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    //release returned data
    mysqli_free_result($result);

    //close DB connection
    mysqli_close($connection);
?>

