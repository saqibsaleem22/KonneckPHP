<!DOCTYPE html>

<html lang="en">
<head>
    <title>Login to your account</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
</head>
<body>
<div class="signin-form">
    <form action="" method="post">
        <div class="form-header">
            <img style="width: 100px" src="../images/konnecklogo.PNG" alt="">
            <h2 style="font-family: 'Bookman Old Style'">konneck</h2>
            <p>Login and start konneck"ting"</p>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" placeholder="example@example.com" name="email" autocomplete="off" required="required">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Password" name="pass" autocomplete="off" required="required">
        </div>
        <div class="small">Forgot password? <a href="../main_screens/forgot_pass.php">Click Here</a></div><br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in">Sign in</button>
        </div>
        <?php include("../authentication/log_authentication.php"); ?>
    </form>
    <div class="text-center small" style='color:#67428B;'>Don't have an account? <a href="registration.php">Create one</a></div>
</div>
</body>
</html>
