<?php
$conn = new mysqli('localhost','root', '', 'regis');
if(!$conn){
    echo "Something went wrong with your database connection";
}





// Blank Variable for first name
$emptymsg_firstname = '';
$firstname_suc = '';

// Blank Variable for last name
$emptymsg_lastname = '';
$lastname_suc = '';

// Blank Variable for Email
$emptymsg_email = '';
$email_suc = '';

// Blank Variable for Password
$emptymsg_password = '';
$password_suc = '';

// Blank Variable for Again Password
$emptymsg_again_password = '';
$again_password_suc = '';

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $again_password = $_POST['again_password'];

    // Security for the password
    $md5_protection = md5($password);

    // First Name 
    if (empty($first_name)) {
        $emptymsg_firstname = "Please enter first name - Click to hide";
    } else {
        $firstname_suc = "Successfully entered first name - Click to hide - Your first name is . $first_name";
    }

    // Last Name 
    if (empty($last_name)) {
        $emptymsg_lastname = "Please enter last name - Click to hide";
    } else {
        $lastname_suc = "Successfully entered Last name - Your last name is . $last_name";
    }

    // Email 
    if (empty($email)) {
        $emptymsg_email = "Please enter Email - Click to hide";
    } else {
        $email_suc = "Successfully entered Email Address - Your email is . $email";
    }

    // Password
    if (empty($password)) {
        $emptymsg_password = "Please enter the Password";
    } else {
        $password_suc = "Successfully entered the password";
    }

    // Again Password
    if (empty($again_password)) {
        $emptymsg_again_password = "Please enter the Password Again";
    } else {
        $again_password_suc = "Successfully entered Password Again";
    }

    if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($again_password)){
        if($password === $again_password){

            $sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_password) VALUES ('$first_name', '$last_name', '$email', '$md5_protection')";

             if($conn->query($sql) === true){
                header("Location:login.php?usercreated");
             } 


        } else{
            echo "Please enter your password again";
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
                <h4>Status</h4>
                <!-- First Name -->
                <p class="hideme text-danger"><?php if (isset($_POST['submit'])) {
                                                    echo $emptymsg_firstname;
                                                } ?></p>
                <p class="hideme"><?php if (isset($_POST['submit'])) {
                                        echo $firstname_suc;
                                    } ?></p>
                <!-- Last Name -->
                <p class="hideme text-danger"><?php if (isset($_POST['submit'])) {
                                                    echo $emptymsg_lastname;
                                                } ?></p>
                <p class="hideme"><?php if (isset($_POST['submit'])) {
                                        echo $lastname_suc;
                                    } ?></p>
                <!-- Email -->
                <p class="hideme text-danger"><?php if (isset($_POST['submit'])) {
                                                    echo $emptymsg_email;
                                                } ?></p>
                <p class="hideme"><?php if (isset($_POST['submit'])) {
                                        echo $email_suc;
                                    } ?></p>

                <!-- Password -->
                <p class="hideme text-danger"><?php if (isset($_POST['submit'])) {
                                                    echo $emptymsg_password;
                                                } ?></p>
                <p class="hideme"><?php if (isset($_POST['submit'])) {
                                        echo $again_password_suc;
                                    } ?></p>

                <!-- Again Password -->
                <p class="hideme text-danger"><?php if (isset($_POST['submit'])) {
                                                    echo $emptymsg_again_password;
                                                } ?></p>
                <p class="hideme"><?php if (isset($_POST['submit'])) {
                                        echo $again_password_suc;
                                    } ?></p>
            </div>
            <div class="col-md-8">
                <form action="users.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php if(isset($_POST['submit'])){ echo $first_name; } ?>" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?php if(isset($_POST['submit'])){ echo $last_name; } ?>" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="<?php if(isset($_POST['submit'])){ echo $email; } ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Again Password</label>
                        <input type="password" name="again_password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-2">
                <h3>Already Have an account? <a href="login.php">Login Here</a></h3>
            </div>
        </div>
    </div>


    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            $('.hideme').click(function() {
                $(this).hide();
            });
        });
    </script>
    <script src="/assets/js/custom.js"></script>
    <!-- Bootstrap core JavaScript -->

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>