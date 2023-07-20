<?php
    include 'db.php';
    include 'config.php';

    session_start();
    if( !isset($_SESSION["user_id"]) || $_SESSION["user_type"] != 'Elder' ) {
        if ($_SESSION["user_type"] == 'Student') {
            header('Location: ' . URL . 'homeStu.php');
        }
        else{
            header('Location: ' . URL . 'login.php');
        }
    }

    $userId = $_SESSION["user_id"];
    $query = "SELECT tbl_chores_230.*, tbl_users_230.*
              FROM tbl_chores_230
              LEFT JOIN tbl_users_230 
              ON tbl_chores_230.chore_response = tbl_users_230.user_id
              WHERE chore_create = $userId";
    $result = mysqli_query($connection, $query);
    if (!$result) { 
        die("DB query failed.");
        header('Location: ' . URL . 'err.php');
    }
    $filterBy = '';
    if (!isset($_GET["filterBy"]))
        $filterBy = '';
    else if ($_GET["filterBy"] == "new")
        $filterBy = 'new';
    else if ($_GET["filterBy"] == "done")
        $filterBy = 'done';
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
        <title>My chores - Elder</title>
    </head>

    <body id="home">
        <header class="navbar navbar-expand-md">
            <a class="navbar-brand" href="index.php" id="logo"></a>
            <nav class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item nav-link"><a class="selcted" href="index.php">Home</a></li>
                    <li class="nav-item nav-link"><a href="profile.php">Profile</a></li>
                    <li class="nav-item nav-link"><a href="createChore.php">create a chore</a></li>
                    <li class="nav-item nav-link"><a href="logout.php">log out</a></li>
                </ul>
            </nav>
            <a class="d-flex align-items-center hidden-arrow" href="#">
                <?php
                    $img = $_SESSION["user_img"];
                    if (!$img)
                        $img = "images/default.png";
                    echo '<img src="'. $img . '" class="rounded-circle float-end" alt="profile" title="profile">';
                ?>
            </a>
        </header>

        <main class="wrapper">
            <h1>My chores</h1>
            <div>
                <form id="filterForm" method="GET" action="">
                    <label for="filterBy">Filter:</label>
                    <select name="filterBy" id="filterBy" onchange="on_filter_changed()">
                        <option value="" <?php if ($filterBy != "done" || $filterBy != "new") echo "selected"; ?>>All</option>
                        <option value="done" <?php if ($filterBy == "done") echo "selected"; ?>>Done</option>
                        <option value="new" <?php if ($filterBy == "new") echo "selected"; ?>>New</option>
                    </select>
                </form>
            </div>

            <div class="row">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["chore_status"] == 'done' && ($filterBy == 'done' || $filterBy == '')) {
                        // status done view
                        echo '<div class="col-md-4">';
                        echo    '<div class="card h-80">';
                        echo        '<div class="thumbnail">';
                        echo            '<img src="' . $row["user_img"] . '" class="rounded-circle mx-auto d-block" alt="profile" title="profile">';
                        echo            '<div class="card-body text-center">';
                        echo                '<h4 class="card-title">' . $row["user_name"] . '</h4>';
                        echo                '<br>';
                        echo                '<h5 class="city">' . $row["chore_help"] . '</h5>';
                        echo                '<a href="detail.php?choreId='. $row["chore_id"] .'" class="btn">Detail</a>';
                        echo            '</div>';
                        echo         '</div>';
                        echo    '</div>';
                        echo    '<br>';
                        echo '</div>';
                    } else if ($row["chore_status"] == 'New' && ($filterBy == 'new' || $filterBy == '')) {
                        // status new view
                        echo '<div class="col-md-4">';
                        echo     '<div class="card h-80">';
                        echo         '<div class="thumbnail">';
                        echo             '<div class="card-body text-center">';
                        echo                 '<h4 class="card-title">New chore</h4>';
                        echo                 '<h6 class="city">Timing: ' . $row["chore_time"] . '</h6>';
                        echo                 '<br>';
                        echo                 '<h5 class="city">' . $row["chore_help"] . '</h5>';
                        echo                 '<a href="editChore.php?choreId=' . $row["chore_id"] . '" class="btn">';
                        echo                     '<img src="images/edit.png" alt="edit" title="edit">';
                        echo                     'Edit';
                        echo                 '</a> ';
                        echo                 '<a href="deleteChore.php?choreId=' . $row["chore_id"] . '" class="btn">';
                        echo                     '<img src="images/delete.png" alt="delete" title="delete">Delete';
                        echo                 '</a>';
                        echo             '</div>';
                        echo         '</div>';
                        echo     '</div>';
                        echo     '<br>';
                        echo '</div>';
                    }
                }
                ?>
            <div>
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
        <?php 
            // release returned data
            if ($result)
                mysqli_free_result($result);
        ?>
        <script>
            function on_filter_changed() {
                let filterBy = document.getElementById("filterBy").value;
                const currentURL = window.location.href;
                const questionMarkIndex = currentURL.indexOf('?');
                const urlWithoutParams = (questionMarkIndex !== -1) ? currentURL.slice(0, questionMarkIndex) : currentURL;
                if (filterBy == '')
                    window.location.href = urlWithoutParams;
                else
                    window.location.href = `${urlWithoutParams}?filterBy=${filterBy}`;
            }
        </script>
    </body>
</html>

<?php
    // close DB connection
    mysqli_close($connection);
?>