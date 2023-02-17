<?php 
session_start();
$conn = new mysqli('localhost','root', '', 'regis');
if(!$conn){
    echo "Something went wrong with your database connection";
}

// Creating blank variables
$user_email_msg = "";
$password_msg = "";



if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];
    // Security for the password
    $md5_protection = md5($password);
    if(empty($user_email)){
        $user_email_msg = "Please enter Your email address";
    }
    if(empty($password)){
        $password_msg = "Please enter Your password";
    }

    if(!empty($user_email) && !empty($password) ){

        $sql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$md5_protection' ";
        $query = $conn->query($sql);

        // Checking if the user exists
        if($query->num_rows > 0) {
            $_SESSION['login'] = 'Login Success';
            header('location:dashbord.php');

        } else {
            echo "User Not Found";
        }

    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Login and Registration System in PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h1>Status</h1>
                <p><?php
                    if(isset($_GET['usercreated'])){
                        echo "You have successfully completed your registration, Now login";
                    }
                ?></p>
                <p><?php if(isset($_POST['submit'])){ echo $user_email_msg; }?></p>
                <p><?php if(isset($_POST['submit'])){ echo $password_msg; }?></p>
            </div>
            <div class="col-md-8">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="user_email" class="form-control" value="<?php if(isset($_POST['submit'])){ echo $user_email; } ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-2">
            <h3>Don't Have an account? <a href="users.php">Register Here</a></h3>
            </div>
        </div>
    </div>




    <!-- Custom JS -->
    <script src="/assets/js/custom.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>