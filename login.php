<?php
    include 'db.php';
    include 'config.php';

    if ( ! ( empty($_POST["loginMail"]) && (empty($_POST["loginPass"])) ) ) {
        $query  = "SELECT * FROM tbl_users_230 WHERE user_email = '" 
            . $_POST["loginMail"] 
            . "' and user_pass = '"
            . $_POST["loginPass"]
            . "'";
        $result = mysqli_query($connection , $query);
        $row    = mysqli_fetch_array($result);
        $message = "";
        if (is_array($row)) {
            session_start();
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["user_img"] = $row['user_img'];
            $_SESSION["user_type"] = $row['user_type'];
            $_SESSION["user_name"] = $row['user_name'];
            if ($_SESSION["user_type"] == 'Elder') {
                header('Location: ' . URL . 'index.php');
            } else if ($_SESSION["user_type"] == 'Student') {
                header('Location: ' . URL . 'homeStu.php');
            } else if ($_SESSION["user_type"] == 'Admin') {
                header('Location: ' . URL . 'createProfile.php');
            }
        } else {
            $message = "Invalid email or password !";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
        <link rel="stylesheet" href="css/style.css">
        <title>Log in</title>
    </head>
    
    <body>
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="images/elderLogo.png" class="text-center" style="width: 150px;" alt="logo" title="logo">
                                    <p class="text-white-50 mb-5">Login</p>
                                    <form action="#" method="post">
                                        <div class="form-outline form-white mb-4">
                                            <input type="email" name="loginMail" id="typeEmailX" class="form-control form-control-lg" required>
                                            <label class="form-label" for="typeEmailX">Email</label>
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <input type="password" name="loginPass" id="typePasswordX" class="form-control form-control-lg" required>
                                            <label class="form-label" for="typePasswordX">Password</label>
                                        </div>
                                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                        <div class="error-message">
                                            <?php if(isset($message)) { echo '<small class="text-muted">' . $message . '</small>'; } ?>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <p class="mb-0">Don't have an account? <a href="createProfile.php" class="text-white-50 fw-bold">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

<?php
    //close DB connection
    mysqli_close($connection);
?>