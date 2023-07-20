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
	$status  = "edit";

    if (isset($_GET["userId"]))
        $userId = $_GET["userId"];

    $query = "SELECT * FROM tbl_users_230 
              WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
	} else {
        header('Location: ' . URL . 'index.php');
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
        <title>Create a profile</title>
    </head>
    <body>
        <header class="navbar navbar-expand-md">
            <a href="index.php" class="navbar-brand" id="logo"></a>
            <nav class="collapse navbar-collapse" id="collapsibleNavbar"></nav>
        </header>

        <main class="wrapper">
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card shadow-2-strong card-registration">
                                <div class="card-body p-4 p-md-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Create a profile:</h3>
                                    <form action="save_profile.php" method="get">    
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="firstName">Full Name</label>
                                                    <input type="text" name="profileName" class="form-control form-control-lg" id="firstName" pattern="^[A-Za-z\s]+$" title="Full Name cannot contain numbers" value="<?php echo $row["user_name"];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <h6 class="mb-2 pb-1">Type: </h6>                                              
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="femaleGender">Elder</label>
                                                    <input type="radio" name="profileType" class="form-check-input" id="femaleGender" value="<?php echo $row["user_type"];?>" checked>
                                                </div>                          
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="maleGender">Student</label>
                                                    <input type="radio" name="profileType" class="form-check-input" id="maleGender" value="<?php echo $row["user_type"];?>">
                                                </div>
                                            </div>                                          
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline datepicker w-100">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea type="text" name="profileDescription" class="form-control form-control-lg" id="description" value="<?php echo $row["user_description"];?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline datepicker w-100">
                                                    <label for="address" class="form-label">Address</label>
                                                    <select name="profileAddress" class="form-control form-control-lg" id="profileAddress" value="<?php echo $row["user_address"];?>"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="emailAddress">Email</label>
                                                    <input type="email" name="profileEmail" class="form-control form-control-lg" id="profileEmail" value="<?php echo $row["user_email"];?>">
                                                </div>
                                            </div>                                     
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="emailAddress">Phone</label>
                                                    <input type="tel" name="profilePhone" class="form-control form-control-lg" id="profilePhone" pattern="[0-9]{9,10}" title="The phone number should be 9 or 10 digits long" value="<?php echo $row["user_phone"];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <h6 class="mb-2 pb-1">Images</h6>                                               
                                                <div class="form-outline datepicker w-100">
                                                    <input type="text" name="profileImg" class="form-control form-control-lg" id="formFileLg" value="<?php echo $row["user_img"];?>">                                      
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 pt-2">
                                            <input class="btn btn-lg" type="submit" value="Submit">
                                        </div>

                                        <input type="hidden" name="status" id="status" value="<?php echo $status;?>">
                                        <input type="hidden" name="userId" id="userId" value="<?php echo $userId;?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
        <script src="js/createProfile.js"></script>
    </body>
</html>

<?php
    // close DB connection
    mysqli_close($connection);
?>