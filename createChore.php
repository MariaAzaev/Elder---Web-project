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
	$status  = "insert";
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
        <title>Create a chores</title>
    </head>

    <body>
        <header class="navbar navbar-expand-md">
            <a href="index.php" class="navbar-brand" id="logo"></a>
            <nav class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item nav-link"><a href="index.php">Home</a></li>
                    <li class="nav-item nav-link"><a href="profile.php">Profile</a></li>
                    <li class="nav-item nav-link"><a href="createChore.php" class="selcted">create a chore</a></li>                  
                    <li class="nav-item nav-link"><a href="login.php">log out</a></li>
                </ul>
            </nav>
            <?php
                $img = $_SESSION["user_img"];
                if (!$img) $img = "images/default.png";
                echo '<img src="'. $img . '" class="rounded-circle float-end" alt="profile" title="profile">';
            ?>
        </header>

        <main class="wrapper">
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card shadow-2-strong card-registration">
                                <div class="card-body p-4 p-md-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Create a chore:</h3>
                                    <form id="choreForm" action="save_chore.php" method="get">  
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label for="timing" class="form-label">Timing:</label>
                                                    <input type="text" name="choreTime" placeholder="hh:mm" id="choreTime" class="form-control form-control-lg" required>
                                                    <div id="timing-error" class="invalid-feedback">Please enter a valid time in the format hh:mm.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label>Choose option:</label>
                                                <select name="choreHelp" id="choreHelp" class="select form-control-lg" required>
                                                    <option value="Choose option" disabled>Choose option</option>
                                                    <option value="Kind of help:">Kind of help:</option>
                                                    <option value="Help with household">Help with household</option>
                                                    <option value="Help with the pet">Help with the pet</option>
                                                    <option value="Help with buying food/medicine">Help with buying food/medicine</option>
                                                    <option value="Help with alleviating loneliness">Help with alleviating loneliness</option>
                                                </select>                            
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline datepicker w-100">
                                                    <label for="description" class="form-label">Description:</label>
                                                    <textarea name="choreDescription" placeholder="Description" class="form-control form-control-lg" id="choreDescription" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        </div>            
                                        <div class="mt-4 pt-2">
                                            <input class="btn btn-lg" type="submit" value="Create">
                                        </div>
                                        <input type="hidden" name="status" id="status" value="<?php echo $status;?>">
                                    </form>
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
    // close DB connection
    mysqli_close($connection);
?>