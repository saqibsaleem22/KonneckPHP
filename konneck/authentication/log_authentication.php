<?php
session_start();
//includes the connecition file
include("../DBconnection/connection.php");


//checks if the user has already logged in
if(isset($_POST['sign_in'])){
    //cleans the variables
    $email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
    $pass = htmlentities(mysqli_real_escape_string($con,$_POST['pass']));
    //creating a query we are going to use to retrieve data in this case the logged in user's data
    $select_user = "select * from users where user_email ='$email' AND user_pass ='$pass'";
    //running the query
    $query = mysqli_query($con,$select_user);
    //getting the rows
    $check_user = mysqli_num_rows($query);
    //if there's no error we continue
    if($check_user==1){
        //saves the email of user in session
        $_SESSION['user_email']=$email;
        //updating the login status
        $update_msg = mysqli_query($con, "UPDATE users SET log_in='Online' WHERE user_email='$email'");
        //getting all the users to show them in the list
        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email<>'$user'";
        $run_user = mysqli_query($con,$get_user);
        $row=mysqli_fetch_array($run_user);

        $user_name = $row['user_name'];

        echo "<script>window.open('../main_screens/home.php','_self')</script>";

    }
    else {
        //throws a message if the email or password is incorrect
        echo "

	<div class='alert alert-danger'>
	  <strong>Check your email and password!</strong>
	</div>

	";
    }

}
?>
