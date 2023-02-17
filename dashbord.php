<?php
$conn = new mysqli('localhost','root', '', 'regis');
if(!$conn){
    echo "Something went wrong with your database connection";
}

session_start();

if(!empty($_SESSION['login'])){
    echo $_SESSION['login'];
} else{
    header('location: login.php');
}





		// select all tasks if page is visited or refreshed
		$user_info = mysqli_query($conn, "SELECT * FROM users");

		$users = mysqli_fetch_array($user_info) ?>
        <h4>Your Email is</h4>
			<li><?php echo $users['user_email'];?></li>
        <hr>
        <h4>Your Name is</h4>
			<li><?php echo $users['user_first_name'];?></li>
        <hr>
        <h4>Your Password is</h4>
			<li><?php echo $users['user_password'];?></li>
		
<h4><a href="logout.php">Logout</a></h4>









