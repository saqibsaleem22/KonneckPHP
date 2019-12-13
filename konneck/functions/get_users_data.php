<?php
/*This file gets all the information necessary to load the users list
  which is on the left side of home screen.
*/
//we create the connection
$con = mysqli_connect("localhost","root","","konneck");
$user_email = $_SESSION['user_email'];
//getting all the users other than one logged in
$get_user = "select * from users where user_email <> '$user_email'";
$run_user = mysqli_query($con,$get_user);



//iterating through all rows and assigning the information to divs
while ($row_user=mysqli_fetch_array($run_user)){

    $user_id = $row_user['user_id'];
    $user_name = $row_user['user_name'];
    $user_email = $row_user['user_email'];
    $user_profile = $row_user['user_profile'];
    $login = $row_user['log_in'];
    echo"
	<li>
		<div class='chat-left-img'>
			<img src='$user_profile'>
		</div>
		<div class='chat-left-detail'>
			<p><a href='home.php?user_email=$user_email'>$user_name</a></p>";
    if($login == 'Online'){
        echo "<span><i class='fa fa-circle' aria-hidden='true'></i> Online</span>";
    }else{
        echo "<span><i class='fa fa-circle-o' aria-hidden='true'></i> Offline</span>";
    }

    "
		</div>
	</li>

	";
}
?>