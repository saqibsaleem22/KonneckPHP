<!DOCTYPE html>
<?php
session_start();
include("../DBconnection/connection.php");

if(!isset($_SESSION['user_email'])){

    header("location: ../login&Registration/login.php");

}
else{ ?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/home.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

<div class="container main-section">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
            <div class="input-group searchbox">
                    <?php
                    //logged in user's email
                    $logged_in_email = $_SESSION['user_email'];
                    //retrieving data from database for the current user
                    $logged_user_query = "select * from users where user_email= '$logged_in_email'";
                    //running the query
                    $run_user_query = mysqli_query($con,$logged_user_query);
                    $row=mysqli_fetch_array($run_user_query);
                    //we store the current user's data in variables to use it  later
                    $current_user_profile_image = $row['user_profile'];
                    $current_username = $row['user_name'];
                    $current_email = $row['user_email'];
                    $current_id = $row['user_id'];
                    ?>

                        <div class="right-header-img">
                            <img src=<?php echo"$current_user_profile_image";?>>
                        </div>
                        <div class="right-header-detail">
                            <form method="post">
                                <p><?php echo"$current_username";?></p>
                                <a href="account_settings.php"><span>User profile</span></a>&nbsp &nbsp
                                <button name="logout" class="btn btn-danger">Logout</button>
                            </form>
                            <?php
                            if(isset($_POST['logout'])){
                                $update_msg = mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_email='$current_email'");
                                header("Location:logout.php");
                                exit();
                            }
                            ?>
                        </div>
            </div>
            <div class="left-chat">
                <ul>
                    <?php include("../functions/get_users_data.php"); ?>
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
            <div class="row">

                <!-- getting the user data on which user click -->
                <?php
                if(isset($_GET['user_email'])) {

                    global $con;

                    $receiver_email = $_GET['user_email'];
                    $receiver_query = "select * from users where user_email='$receiver_email'";

                    $run_receiver = mysqli_query($con, $receiver_query);

                    $row_receiver = mysqli_fetch_array($run_receiver);
                    $receiver_id = $row_receiver['user_id'];
                    $receiver_name = $row_receiver['user_name'];
                    $receiver_profile_image = $row_receiver['user_profile'];

                    $unread_messages = "select * from users_chat where (sender_id='$receiver_id' AND receiver_id='$current_id') AND (msg_status='unread')";
                    $run_messages = mysqli_query($con, $unread_messages);
                    $total = mysqli_num_rows($run_messages);

                 ?>
                <div class="col-md-12 right-header">
                    <div class="right-header-img">
                        <img src=<?php echo"$receiver_profile_image";?>>
                    </div>
                    <div class="right-header-detail">
                        <form method="post">
                            <p><?php echo"$receiver_name";?></p>
                            <span><?php echo $total; ?> new messages</span>&nbsp &nbsp

                        </form>
                        <div style="width: 20px"></div>
                        <?php
                        if(isset($_POST['logout'])){
                            /*$update_msg = mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_name='$user_name'");
                            header("Location:logout.php");
                            exit();*/
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                    <?php

                    $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status='read' WHERE sender_id='$receiver_id' AND receiver_id='$current_id'");

                    $sel_msg = "select * from users_chat where (sender_id='$receiver_id' AND receiver_id='$current_id') OR (sender_id='$current_id' AND receiver_id='$receiver_id') ORDER by 1 ASC";
                    $run_msg = mysqli_query($con,$sel_msg);

                    while($row=mysqli_fetch_array($run_msg)){

                        $sender_chat_id = $row['sender_id'];
                        $receiver_chat_id = $row['receiver_id'];
                        $msg_content = $row['msg_content'];
                        $msg_status = $row['msg_status'];
                        $msg_date = $row['msg_date'];
                        $msg_type = $row['msg_type'];

                        ?>
                        <ul>
                            <?php

                            if($current_id == $sender_chat_id AND $receiver_id == $receiver_chat_id){
                                if($msg_type == "image"){
                                    echo"
								<li>
									<div class='rightside-right-chat'>
										<span> $current_username <small>$msg_date</small> </span><br><br>
										<p><a href='$msg_content'><img src='$msg_content' alt='' width='100px'>$msg_content</a></p>
									</div>
								</li>
							";
                                } else if($msg_type == "other") {
                                    echo "
								<li>
									<div class='rightside-right-chat'>
										<span> $current_username <small>$msg_date</small> </span><br><br>
										<p><a href='$msg_content'><img src='../images/file.png' alt='' width='40px'>$msg_content</a></p>
									</div>
								</li>
							";
                                } else 
                                 {
                                    echo"
								<li>
									<div class='rightside-right-chat'>
										<span> $current_username <small>$msg_date</small> </span><br><br>
										<p>$msg_content</p>
									</div>
								</li>
							";
                                }


                            }

                            else if($current_id == $receiver_chat_id AND $receiver_id == $sender_chat_id){
                                if($msg_type == "image"){
                                    echo"
								<li>
									<div class='rightside-left-chat'>
										<span> $receiver_name <small>$msg_date</small> </span><br><br>
										<p><a href='$msg_content'><img src='$msg_content' alt='' width='100px'>$msg_content</a></p>
									</div>
								</li>
							";
                                } else if($msg_type == "other") {
                                    echo "
								<li>
									<div class='rightside-left-chat'>
										<span> $receiver_name <small>$msg_date</small> </span><br><br>
										<p><a href='$msg_content'><img src='../images/file.png' alt='' width='40px'>$msg_content</a></p>
									</div>
								</li>
							";
                                } else
                                {
                                    echo"
								<li>
									<div class='rightside-left-chat'>
										<span> $receiver_name <small>$msg_date</small> </span><br><br>
										<p>$msg_content</p>
									</div>
								</li>
							";
                                }
                            }


                            ?>
                        </ul>
                        <?php

                   }

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 right-chat-textbox">
                    <form method="post" enctype="multipart/form-data">

                        <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message...">
                        <div class="image_upload">
                            <label for="fileToUpload">
                                <img src="../images/uploadImage.png"/>
                            </label>
                            <!--Input for file or image-->
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                        <button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php
//image and file upload

if(isset($_POST['submit'])) {

    if($_FILES["fileToUpload"]["name"]){
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $file_type = "image";
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        /*// Check if image file is a actual image or fake image
        $check = gesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }*/
        /*
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        /*
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
        }*/

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $file_type = "other";
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            // if everything is ok, try to upload file
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $insert = "insert into users_chat(sender_id,receiver_id,msg_content,msg_status,msg_date,msg_type) values ('$current_id','$receiver_id','$target_file','unread',NOW(),'$file_type')";
            $run_insert = mysqli_query($con,$insert);

        }
    }


    $msg = htmlentities($_POST['msg_content']);

    if(strlen($msg) < 100 && $msg != ""){
        $insert = "insert into users_chat(sender_id,receiver_id,msg_content,msg_status,msg_date,msg_type) values ('$current_id','$receiver_id','$msg','unread',NOW(),'text')";
        $run_insert = mysqli_query($con,$insert);
    }

    echo "<script>history.pushState({}, \"\", \"\")</script>";
}

?>

<script>
    $('#scrolling_to_bottom').animate({
        scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var height = $(window).height();
        $('.left-chat').css('height', (height - 92) + 'px');
        $('.right-header-contentChat').css('height', (height - 163) + 'px');
    });
</script>
</body>
</html>
<?php
} ?>
