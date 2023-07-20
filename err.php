<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if(!isset($_SESSION["user_id"])) { header('Location: ' . URL . 'login.php'); }
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
        <title>RehabOnline - Home</title>
    </head>
    
    <body id="err">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <span>RehabOnline</span>
                    </a>
                </div>
            </nav>
        </header>

        <main id="wrapper">
            <section class="container">
                <section class="container container-fluid">
                    <h1 class="display-5 fw-bold">404</h1>
                    <h1 class="display-5 fw-bold">Oops! Something is wrong...</h1>
                    <p class="col-md-8 fs-4">
                        We can't find that page, but seems to have gone missing.
                        We do apologise on it's behalf. </p>
                    <a href="#" class="btn btn-outline-primary btn-lg">Go back</a>
                    <a href="#" class="btn btn-outline-secondary btn-lg">Home</a>
                </section>
            </section>
        </main>

        <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2022 RehabOnline</p>
            <a href="#"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="images/logo.png" class="rounded-circle" alt="logo">
            </a>
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </body>
</html>