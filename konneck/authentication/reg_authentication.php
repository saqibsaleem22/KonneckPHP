<?php
//includes the connection file
include("../DBconnection/connection.php");

//checks if user has clicked the sign up button
if(isset($_POST['sign_up'])){
    //cleans all the information entered
    $name = htmlentities(mysqli_real_escape_string($con,$_POST['user_name']));
    $pass = htmlentities(mysqli_real_escape_string($con,$_POST['user_pass']));
    $email = htmlentities(mysqli_real_escape_string($con,$_POST['user_email']));
    $city = htmlentities(mysqli_real_escape_string($con,$_POST['user_city']));
    $gender = htmlentities(mysqli_real_escape_string($con,$_POST['user_gender']));
    $rand = rand(1, 2); //Random number between 1 and 2
    //checks if something is empty
    if($name == ''){
        echo "<script>alert('We can not verify your name')</script>";
    }
    //checks the length of password
    if(strlen($pass)<8){

        echo "<script>alert('Password should be minimum 8 characters!')</script>";
        exit();
    }

    $check_email = "select * from users where user_email='$email'";
    $run_email = mysqli_query($con,$check_email);
    //checks if email entered already exists
    $check = mysqli_num_rows($run_email);
    //if already exists throw a warning and redirects to registration page
    if($check==1){

        echo "<script>alert('Email already exist, please try another!')</script>";
        echo "<script>window.open('../login&Registration/registration.php','_self')</script>";
        exit();
    }
    //assigns avatar randomly
    if($rand == 1)
        $profile_pic = "../images/1.jpg";
    else if($rand == 2)
        $profile_pic = "../images/2.jpg";
    //inserts the information into the database creating a new user
    $insert = "insert into users (user_name,user_pass,user_email,user_profile,user_city,user_gender) values ('$name','$pass','$email','$profile_pic','$city','$gender')";

    //runs the query
    $query = mysqli_query($con,$insert);
    //if everything goes well throw the congrats message
    if($query){

        echo "<script>alert('Congratulations $name, your account has been created successfully.')</script>";
        echo "<script>window.open('../login&Registration/login.php','_self')</script>";

    }
    //otherwise throws warning and redirects
    else {

        echo "<script>alert('Registration failed, try again!')</script>";
        echo "<script>window.open('../login&Registration/registration.php','_self')</script>";
    }
}
?>




